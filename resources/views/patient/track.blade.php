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
        #angle-display { font-size: 18px; font-weight: bold; color: #fff; text-align: center; }
        video, canvas {
            position: absolute;
            top: 0; left: 0;
            width: 640px; height: 480px;
            border-radius: 8px;
        }
        #controls { margin: 12px 0; display: flex; gap: 10px; align-items: center; }
        #statusbar { margin: 10px 0; padding: 6px 10px; border-radius: 6px; background: #222; color: #ddd; font-family: monospace; }
        .badge { display:inline-block; padding:2px 6px; border-radius:4px; margin-right:6px; font-weight:bold; }
        .on { background:#14532d; color:#a7f3d0; }
        .off { background:#7f1d1d; color:#fecaca; }
        .warn { background:#635c0b; color:#fef08a; }
    </style>

    <!-- ✅ Betrouwbare CDN-versies -->
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

    // 🔵 UI helpers
    const camBadge = document.getElementById('camStatus');
    const trackBadge = document.getElementById('trackStatus');
    const refBadge = document.getElementById('refStatus');
    const msgEl = document.getElementById('msg');
    const angleDisplay = document.getElementById('angle-display');
    function setBadge(el, on, labelOn, labelOff){ el.classList.remove('on','off'); el.classList.add(on?'on':'off'); el.textContent = (on?labelOn:labelOff); }
    function setWarn(el, text){ el.classList.remove('on','off'); el.classList.add('warn'); el.textContent = text; }
    function logMsg(t){ msgEl.textContent = t; }

    // 🔧 Variabelen
    let detector;
    let referenceData = null;
    let kneeSide = 'left';
    let emaAngle = null;
    let angleHistory = [];

    kneeSelect.addEventListener('change', () => kneeSide = kneeSelect.value);

    // 🔹 Smoothing helper
    function ema(prev, value, alpha=0.3){ return prev == null ? value : prev * (1 - alpha) + value * alpha; }

    // 🔹 Hoekberekening (tussen 3 keypoints)
    function angle(a,b,c){
        const ab = {x:a.x-b.x, y:a.y-b.y};
        const cb = {x:c.x-b.x, y:c.y-b.y};
        const dot = ab.x*cb.x + ab.y*cb.y;
        const abLen = Math.hypot(ab.x,ab.y);
        const cbLen = Math.hypot(cb.x,cb.y);
        const cos = Math.min(1, Math.max(-1, dot/(abLen*cbLen)));
        return Math.acos(cos)*(180/Math.PI);
    }

    // 🔹 Waaier tekenen bij knie
    function drawFan(hip, knee, ankle, color){
        const v1 = {x: hip.x - knee.x, y: hip.y - knee.y};
        const v2 = {x: ankle.x - knee.x, y: ankle.y - knee.y};
        const start = Math.atan2(v1.y, v1.x);
        let end = Math.atan2(v2.y, v2.x);
        let diff = end - start;
        while (diff > Math.PI) { end -= 2*Math.PI; diff = end - start; }
        while (diff < -Math.PI) { end += 2*Math.PI; diff = end - start; }
        const radius = Math.min(80, 0.5 * (Math.hypot(v1.x,v1.y) + Math.hypot(v2.x,v2.y)));

        ctx.save();
        ctx.beginPath();
        ctx.moveTo(knee.x, knee.y);
        ctx.arc(knee.x, knee.y, radius, start, end, false);
        ctx.closePath();
        ctx.fillStyle = color;
        ctx.globalAlpha = 0.35;
        ctx.fill();
        ctx.globalAlpha = 1;
        ctx.strokeStyle = color;
        ctx.lineWidth = 3;
        ctx.beginPath();
        ctx.moveTo(knee.x, knee.y);
        ctx.lineTo(hip.x, hip.y);
        ctx.moveTo(knee.x, knee.y);
        ctx.lineTo(ankle.x, ankle.y);
        ctx.stroke();
        ctx.restore();
    }

    // 🔹 Camera activeren
    async function setupCamera() {
        try {
            const stream = await navigator.mediaDevices.getUserMedia({video:{width:640,height:480}, audio:false});
            video.srcObject = stream;
            await new Promise(r => video.onloadedmetadata = r);
            setBadge(camBadge, true, 'Camera: aan', 'Camera: uit');
        } catch (e) {
            logMsg('❌ Geen camera-toegang');
            throw e;
        }
    }

    // 🔹 Detector initialiseren
    async function initDetector() {
        detector = await poseDetection.createDetector(poseDetection.SupportedModels.BlazePose, {
            runtime: 'mediapipe',
            modelType: 'full',
            solutionPath: 'https://cdn.jsdelivr.net/npm/@mediapipe/pose'
        });
        setBadge(trackBadge, true, 'Tracking: aan', 'Tracking: uit');
    }

    // 🔹 Referentie laden (indien aanwezig)
    async function loadReference() {
        const refUrl = "{{ $referenceJson ?? '' }}";
        if (!refUrl) { setWarn(refBadge, 'Referentie: geen'); return; }
        try {
            const res = await fetch(refUrl);
            referenceData = await res.json();
            setBadge(refBadge, true, 'Referentie: geladen', 'Referentie: geen');
        } catch {
            setWarn(refBadge, 'Referentie: mislukt');
        }
    }

    // 🔹 Hoekdata samenvatten (ROM, gemiddelde, afwijking)
    function summarizeSession() {
        const valid = angleHistory.filter(a => Number.isFinite(a));
        if (valid.length === 0) return {count: 0};
        const avg = valid.reduce((a,b) => a+b, 0) / valid.length;
        const min = Math.min(...valid);
        const max = Math.max(...valid);
        const rom = max - min;
        let deviation = null;
        if (referenceData?.angles?.length) {
            const refAvg = referenceData.angles.reduce((a,b) => a+b,0) / referenceData.angles.length;
            deviation = Math.abs(avg - refAvg);
        }
        return {count: valid.length, avg, min, max, rom, deviation};
    }

    // 🔹 Tracking loop
    async function render() {
        const poses = await detector.estimatePoses(video);
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        if (poses.length > 0) {
            const kps = poses[0].keypoints;

            // Draw keypoints for hip, knee, ankle only
            const relevantKps = [`${kneeSide}_hip`, `${kneeSide}_knee`, `${kneeSide}_ankle`];
            kps.forEach(kp => {
                if (relevantKps.includes(kp.name) && kp.score > 0.3) {
                    ctx.beginPath();
                    ctx.arc(kp.x, kp.y, 6, 0, 2 * Math.PI);
                    ctx.fillStyle = 'yellow';
                    ctx.fill();
                    // Label keypoints
                    ctx.fillStyle = 'white';
                    ctx.font = '12px Arial';
                    ctx.fillText(kp.name.replace(`${kneeSide}_`, ''), kp.x + 8, kp.y - 8);
                }
            });

            const hip = kps.find(k=>k.name===`${kneeSide}_hip`);
            const knee = kps.find(k=>k.name===`${kneeSide}_knee`);
            const ankle = kps.find(k=>k.name===`${kneeSide}_ankle`);
            if (hip && knee && ankle && hip.score>0.3 && knee.score>0.3 && ankle.score>0.3) {
                const a = angle(hip, knee, ankle);
                emaAngle = ema(emaAngle, a, 0.3);
                angleHistory.push(emaAngle);

                // Compare with reference angles over time
                let color = 'limegreen';
                let refAngleDisplay = '--';
                if (referenceData?.angles?.length) {
                    const currentIndex = Math.min(angleHistory.length - 1, referenceData.angles.length - 1);
                    const refAngle = referenceData.angles[currentIndex];
                    refAngleDisplay = refAngle.toFixed(1);
                    if (Math.abs(emaAngle - refAngle) > 10) {
                        color = 'red';
                    }
                }

                drawFan(hip, knee, ankle, color);

                // Update angle display
                angleDisplay.textContent = `Hoek: ${emaAngle.toFixed(1)}° | Referentie: ${refAngleDisplay}°`;
            } else {
                angleDisplay.textContent = 'Hoek: --° | Referentie: --°';
            }
        }
        requestAnimationFrame(render);
    }

    // 🔹 Sessie opslaan
    saveBtn.addEventListener('click', async () => {
        const summary = summarizeSession();
        const res = await fetch('/sessions', {
            method: 'POST',
            headers: {'Content-Type':'application/json','X-CSRF-TOKEN':csrfToken},
            body: JSON.stringify({exercise:'default', summary})
        });
        const json = await res.json();
        alert('✅ Sessie opgeslagen: ' + json.file);
    });

    // ✅ Start de app
    window.addEventListener('DOMContentLoaded', async () => {
        try {
            await setupCamera();
            await initDetector();
            await loadReference();
            render();
        } catch (err) {
            console.error(err);
            logMsg('⚠️ Initialisatie mislukt');
        }
    });
</script>
</body>
</html>

