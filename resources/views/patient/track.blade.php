<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>KneeCovery – Motion Tracking</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: #111;
            color: white;
            font-family: Arial, sans-serif;
        }
        h1 { margin-top: 20px; }
        #video-container { position: relative; width: 640px; height: 480px; margin-bottom: 20px; }
        video, canvas {
            position: absolute;
            top: 0; left: 0;
            width: 640px; height: 480px;
            border-radius: 8px;
            transform: scaleX(-1);
        }
        #controls { margin: 12px 0; display: flex; gap: 10px; align-items: center; }
        #angle-display { font-size: 18px; font-weight: bold; color: #fff; text-align: center; margin-top: 10px; }
        #statusbar { margin: 10px 0; padding: 6px 10px; border-radius: 6px; background: #222; color: #ddd; font-family: monospace; }
        .badge { display:inline-block; padding:2px 6px; border-radius:4px; margin-right:6px; font-weight:bold; }
        .on { background:#14532d; color:#a7f3d0; }
        .off { background:#7f1d1d; color:#fecaca; }
        .warn { background:#635c0b; color:#fef08a; }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@4.12.0/dist/tf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/pose-detection"></script>
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/pose"></script>
</head>

<body>
<h1>KneeCovery – Motion Tracking</h1>

<div id="controls">
    <label for="kneeSelect">Kies knie:</label>
    <select id="kneeSelect">
        <option value="left">Linkerknie</option>
        <option value="right">Rechterknie</option>
    </select>
    <button id="saveSession">Sessie opslaan</button>
</div>

<div id="statusbar">
    <span id="camStatus" class="badge off">Camera: uit</span>
    <span id="trackStatus" class="badge off">Tracking: uit</span>
    <span id="refStatus" class="badge warn">Referentie: onbekend</span>
    <span id="msg"></span>
</div>

<div id="video-container">
    <video id="video" autoplay playsinline muted></video>
    <canvas id="output"></canvas>
</div>

<div id="angle-display">Hoek: --° | Referentie: --°</div>

<script>
    const video = document.getElementById('video');
    const canvas = document.getElementById('output');
    const ctx = canvas.getContext('2d');
    const kneeSelect = document.getElementById('kneeSelect');
    const saveBtn = document.getElementById('saveSession');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const camBadge = document.getElementById('camStatus');
    const trackBadge = document.getElementById('trackStatus');
    const refBadge = document.getElementById('refStatus');
    const msgEl = document.getElementById('msg');

    let detector;
    let kneeSide = 'left';
    let referenceData = null;
    let emaAngle = null;
    let angleHistory = [];

    // 🔹 Dropdown wijziging
    kneeSelect.addEventListener('change', () => kneeSide = kneeSelect.value);

    // 🔹 Badge helpers
    function setBadge(el, on, labelOn, labelOff){ el.classList.remove('on','off','warn'); el.classList.add(on?'on':'off'); el.textContent = (on?labelOn:labelOff); }
    function setWarn(el, text){ el.classList.remove('on','off','warn'); el.classList.add('warn'); el.textContent = text; }
    function logMsg(t){ msgEl.textContent = t; }

    // 🔹 EMA smoothing
    function ema(prev, value, alpha=0.3){ return prev == null ? value : prev*(1-alpha) + value*alpha; }

    // 🔹 Hoekberekening
    function calculateAngle(a,b,c){
        const ab = {x:a.x-b.x, y:a.y-b.y};
        const cb = {x:c.x-b.x, y:c.y-b.y};
        const dot = ab.x*cb.x + ab.y*cb.y;
        const abLen = Math.hypot(ab.x,ab.y);
        const cbLen = Math.hypot(cb.x,cb.y);
        const cos = Math.min(1, Math.max(-1, dot/(abLen*cbLen)));
        return Math.acos(cos)*(180/Math.PI);
    }

    // 🔹 Punten + waaier tekenen
    function drawFanWithPoints(hip,knee,ankle,color,angle){
        // Waaier als driehoek
        ctx.beginPath();
        ctx.moveTo(hip.x, hip.y);
        ctx.lineTo(knee.x, knee.y);
        ctx.lineTo(ankle.x, ankle.y);
        ctx.closePath();
        ctx.fillStyle = color;
        ctx.globalAlpha = 0.35;
        ctx.fill();
        ctx.globalAlpha = 1;

        // Punten tekenen
        [hip,knee,ankle].forEach(pt => {
            ctx.beginPath();
            ctx.arc(pt.x, pt.y, 6, 0, 2*Math.PI);
            ctx.fillStyle = color;
            ctx.fill();
            ctx.strokeStyle = 'white';
            ctx.lineWidth = 2;
            ctx.stroke();
        });

        // Hoek bij knie
        ctx.font = "16px Arial";
        ctx.fillStyle = color;
        ctx.fillText(`${angle.toFixed(1)}°`, knee.x + 10, knee.y - 10);
    }

    // 🔹 Kleur bepalen op basis van referentie
    function getFanColor(liveAngle){
        if(!referenceData) return 'limegreen';
        const {peakAngle,direction} = referenceData;
        if(direction==='extension' && liveAngle > peakAngle) return 'red';
        if(direction==='flexion' && liveAngle < peakAngle) return 'red';
        return 'limegreen';
    }

    // 🔹 Camera setup
    async function setupCamera(){
        try{
            const stream = await navigator.mediaDevices.getUserMedia({video:{width:640,height:480},audio:false});
            video.srcObject = stream;
            return new Promise(resolve => video.onloadedmetadata=()=>{
                canvas.width=640;
                canvas.height=480;
                video.play();
                setBadge(camBadge,true,'Camera: aan','Camera: uit');
                resolve();
            });
        } catch(e){
            logMsg('❌ Geen camera-toegang');
            throw e;
        }
    }

    // 🔹 BlazePose detector
    async function initDetector(){
        detector = await poseDetection.createDetector(poseDetection.SupportedModels.BlazePose,{
            runtime:'mediapipe',
            modelType:'full',
            solutionPath:'https://cdn.jsdelivr.net/npm/@mediapipe/pose'
        });
        setBadge(trackBadge,true,'Tracking: aan','Tracking: uit');
    }

    // 🔹 Referentie laden en badge groen maken
    async function loadReference(){
        setWarn(refBadge,'Referentie: aan het laden');
        const refUrl = "{{ $referenceJson ?? '' }}";
        if(!refUrl){ setWarn(refBadge,'Referentie: geen'); return; }
        try{
            const res = await fetch(refUrl);
            referenceData = await res.json();
            setBadge(refBadge,true,'referentie:geladen','Referentie: geen'); // ✅ groen
        }catch{
            setWarn(refBadge,'Referentie: mislukt');
        }
    }

    // 🔹 Rendering loop
    async function render(){
        const poses = await detector.estimatePoses(video);
        ctx.clearRect(0,0,canvas.width,canvas.height);

        if(poses.length>0){
            const kps = poses[0].keypoints;
            const hip = kps.find(k=>k.name===`${kneeSide}_hip`);
            const knee = kps.find(k=>k.name===`${kneeSide}_knee`);
            const ankle = kps.find(k=>k.name===`${kneeSide}_ankle`);

            if(hip && knee && ankle){
                const a = calculateAngle(hip,knee,ankle);
                emaAngle = ema(emaAngle,a);
                angleHistory.push(emaAngle);

                const fanColor = getFanColor(emaAngle);
                drawFanWithPoints(hip,knee,ankle,fanColor,emaAngle);

                const refDisplay = referenceData ? referenceData.peakAngle.toFixed(1) : '--';
                document.getElementById('angle-display').textContent = `Hoek: ${emaAngle.toFixed(1)}° | Referentie: ${refDisplay}°`;
            }
        }

        requestAnimationFrame(render);
    }

    // 🔹 Sessie opslaan
    saveBtn.addEventListener('click', async ()=>{
        const summary = {angles: angleHistory};
        const res = await fetch('/sessions',{
            method:'POST',
            headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrfToken},
            body: JSON.stringify({exercise:'default',summary})
        });
        const json = await res.json();
        alert('✅ Sessie opgeslagen: '+json.file);
    });

    // 🔹 Start alles
    window.addEventListener('DOMContentLoaded',async ()=>{
        try{
            await setupCamera();
            await initDetector();
            await loadReference();
            render();
        }catch(err){
            console.error(err);
            logMsg('⚠️ Initialisatie mislukt');
        }
    });
</script>
</body>
</html>
