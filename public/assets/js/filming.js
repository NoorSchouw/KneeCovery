// filming.js

document.addEventListener('DOMContentLoaded', async () => {
    // DOM-elementen ophalen
    const video = document.getElementById('video');
    const canvas = document.getElementById('output');
    const ctx = canvas.getContext('2d');
    const recordCanvas = document.getElementById('recordCanvas');
    const rctx = recordCanvas.getContext('2d');

    const kneeSelect = document.getElementById('kneeSelect');
    const recordBtn = document.getElementById('recordBtn');

    const camBadge = document.getElementById('camStatus');
    const trackBadge = document.getElementById('trackStatus');
    const refBadge = document.getElementById('refStatus');
    const msgEl = document.getElementById('msg');
    const angleDisplay = document.getElementById('angle-display');

    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';

    // Variabelen
    let detector;
    let kneeSide = 'left';
    let referenceData = null;
    let emaAngle = null;
    let angleHistory = [];

    let mediaRecorder = null;
    let recordedChunks = [];
    let isRecording = false;

    // Event listeners
    kneeSelect.addEventListener('change', () => kneeSide = kneeSelect.value);
    recordBtn.addEventListener('click', () => {
        if (!isRecording) startRecording();
        else stopRecording();
    });

    // Helper functies
    function setBadge(el, on, labelOn, labelOff) {
        el.classList.remove('on','off','warn');
        el.classList.add(on ? 'on' : 'off');
        el.textContent = on ? labelOn : labelOff;
    }

    function setWarn(el, text) {
        el.classList.remove('on','off','warn');
        el.classList.add('warn');
        el.textContent = text;
    }

    function logMsg(t) { msgEl.textContent = t; }

    function ema(prev, value, alpha = 0.25) {
        return prev == null ? value : prev*(1-alpha) + value*alpha;
    }

    function calculateAngle(a,b,c) {
        const ab = {x:a.x-b.x, y:a.y-b.y};
        const cb = {x:c.x-b.x, y:c.y-b.y};
        const dot = ab.x*cb.x + ab.y*cb.y;
        const abLen = Math.hypot(ab.x, ab.y);
        const cbLen = Math.hypot(cb.x, cb.y);
        const cos = Math.min(1, Math.max(-1, dot/(abLen*cbLen)));
        return Math.acos(cos)*(180/Math.PI);
    }

    function drawFanWithPoints(hip, knee, ankle, colour, angle) {
        ctx.beginPath();
        ctx.moveTo(hip.x, hip.y);
        ctx.lineTo(knee.x, knee.y);
        ctx.lineTo(ankle.x, ankle.y);
        ctx.closePath();
        ctx.fillStyle = colour;
        ctx.globalAlpha = 0.35;
        ctx.fill();
        ctx.globalAlpha = 1;

        ctx.strokeStyle = colour;
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.moveTo(knee.x, knee.y);
        ctx.lineTo(hip.x, hip.y);
        ctx.moveTo(knee.x, knee.y);
        ctx.lineTo(ankle.x, ankle.y);
        ctx.stroke();

        [hip, knee, ankle].forEach(pt => {
            ctx.beginPath();
            ctx.arc(pt.x, pt.y, 6, 0, 2*Math.PI);
            ctx.fillStyle = colour;
            ctx.fill();
            ctx.strokeStyle = 'white';
            ctx.lineWidth = 2;
            ctx.stroke();
        });

        ctx.font = "16px Arial";
        ctx.fillStyle = colour;
        ctx.fillText(`${angle.toFixed(1)}°`, knee.x + 10, knee.y - 10);
    }

    function getFanColour(liveAngle) {
        if(!referenceData) return 'limegreen';
        const {peakAngle, direction} = referenceData;
        if(direction === 'extension' && liveAngle > peakAngle) return 'red';
        if(direction === 'flexion' && liveAngle < peakAngle) return 'red';
        return 'limegreen';
    }

    // Camera setup
    async function setupCamera() {
        try {
            const stream = await navigator.mediaDevices.getUserMedia({video:{width:640,height:480},audio:false});
            video.srcObject = stream;
            return new Promise(resolve => video.onloadedmetadata = () => {
                canvas.width = 640; canvas.height = 480;
                recordCanvas.width = 640; recordCanvas.height = 480;
                video.play();
                setBadge(camBadge, true, 'Camera: on', 'Camera: off');
                resolve();
            });
        } catch (e) {
            logMsg('❌ Camera access denied');
            throw e;
        }
    }

    // Pose detector
    async function initDetector() {
        detector = await poseDetection.createDetector(poseDetection.SupportedModels.BlazePose, {
            runtime:'mediapipe',
            modelType:'full',
            solutionPath:'https://cdn.jsdelivr.net/npm/@mediapipe/pose'
        });
        setBadge(trackBadge, true, 'Tracking: on', 'Tracking: off');
    }

    // Reference data
    async function loadReference() {
        setWarn(refBadge,'Reference: loading');
        const refUrl = "{{ $referenceJson ?? '' }}";
        if(!refUrl){ setWarn(refBadge,'Reference: none'); return; }
        try {
            const res = await fetch(refUrl);
            referenceData = await res.json();
            setBadge(refBadge,true,'Reference: loaded','Reference: none');
        } catch(e) {
            console.error(e);
            setWarn(refBadge,'Reference: failed');
        }
    }

    // Recording
    function startRecording() {
        recordedChunks = [];
        const stream = recordCanvas.captureStream(30);
        const options = { mimeType: 'video/webm;codecs=vp9' };
        try { mediaRecorder = new MediaRecorder(stream, options); }
        catch { mediaRecorder = new MediaRecorder(stream); }

        mediaRecorder.ondataavailable = (event) => {
            if (event.data && event.data.size > 0) recordedChunks.push(event.data);
        };

        mediaRecorder.onstop = () => {
            if(recordedChunks.length === 0) return;
            const blob = new Blob(recordedChunks, { type: 'video/webm' });
            const url = URL.createObjectURL(blob);

            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.download = 'recording.webm';
            document.body.appendChild(a);
            a.click();
            setTimeout(()=> {
                URL.revokeObjectURL(url);
                a.remove();
            }, 1000);
        };

        mediaRecorder.start();
        isRecording = true;
        recordBtn.classList.add('recording');
        recordBtn.textContent = 'Stop recording';
    }

    function stopRecording() {
        if(mediaRecorder && mediaRecorder.state !== 'inactive') mediaRecorder.stop();
        isRecording = false;
        recordBtn.classList.remove('recording');
        recordBtn.textContent = 'Start recording';
    }

    // Render loop
    async function render() {
        const poses = await detector.estimatePoses(video);
        ctx.clearRect(0,0,canvas.width,canvas.height);

        if(poses.length > 0) {
            const kps = poses[0].keypoints;
            const hip = kps.find(k => k.name === `${kneeSide}_hip`);
            const knee = kps.find(k => k.name === `${kneeSide}_knee`);
            const ankle = kps.find(k => k.name === `${kneeSide}_ankle`);

            if(hip && knee && ankle && hip.score>0.1 && knee.score>0.1 && ankle.score>0.1){
                const a = calculateAngle(hip,knee,ankle);
                emaAngle = ema(emaAngle, a);
                angleHistory.push(emaAngle);

                const colour = getFanColour(emaAngle);
                drawFanWithPoints(hip,knee,ankle,colour,emaAngle);

                const refDisplay = referenceData ? referenceData.peakAngle.toFixed(1) : '--';
                angleDisplay.textContent = `Angle: ${emaAngle.toFixed(1)}° | Reference: ${refDisplay}°`;
            }
        }

        if(isRecording){
            rctx.clearRect(0,0,recordCanvas.width, recordCanvas.height);
            rctx.drawImage(video, 0, 0, recordCanvas.width, recordCanvas.height);
            rctx.drawImage(canvas, 0, 0, recordCanvas.width, recordCanvas.height);
        }

        requestAnimationFrame(render);
    }

    // Initialization
    try {
        await setupCamera();
        await initDetector();
        await loadReference();
        render();
    } catch(err) {
        console.error(err);
        logMsg('⚠️ Initialisation failed');
    }
});
