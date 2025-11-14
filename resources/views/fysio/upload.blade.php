<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Physio – Bewegingsanalyse</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #111; color: white; }
        video { max-width: 640px; border:1px solid #222; border-radius:8px; display:block; margin-top:10px; }
        label { display:block; margin:8px 0 4px; }
        button { margin-top: 10px; }
        #status { margin-top: 10px; color: #0a7; }
        #progressText { font-size: 12px; margin-top:4px; color:#aaa; }
        #progressBarContainer { margin-top:8px; width:640px; background:#333; border-radius:6px; overflow:hidden; height:12px; }
        #progressBar { background:#0a7; width:0%; height:100%; transition:width 0.2s; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@4.12.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/pose-detection"></script>
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/pose"></script>
</head>
<body>

<h1>Physio Bewegingsanalyse</h1>

<div>
    <label>Oefening</label>
    <input id="exercise" type="text" placeholder="bijv. squat" />
</div>

<div>
    <label>Selecteer been</label>
    <select id="legSelect">
        <option value="auto" selected>Automatisch</option>
        <option value="left">Links</option>
        <option value="right">Rechts</option>
    </select>
</div>

<div>
    <label>Video bestand</label>
    <input id="videoInput" type="file" accept="video/*" />
    <button id="uploadBtn">Upload</button>
    <video id="video" controls></video>
    <div id="progressBarContainer">
        <div id="progressBar"></div>
    </div>
    <div id="progressText">0%</div>
    <div id="status"></div>
</div>

<div>
    <button id="analyseBtn">Analyseer Video</button>
</div>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const statusEl = document.getElementById('status');
        const progressBar = document.getElementById('progressBar');
        const progressText = document.getElementById('progressText');
        const exerciseEl = document.getElementById('exercise');
        const legSelect = document.getElementById('legSelect');
        const videoInput = document.getElementById('videoInput');
        const uploadBtn = document.getElementById('uploadBtn');
        const video = document.getElementById('video');
        const analyseBtn = document.getElementById('analyseBtn');

        let detector, uploadedFileName = null;
        let angles = [], emaAngle = null;

        function msg(text){ statusEl.textContent = text; }
        function ema(prev, value, alpha = 0.3){ return prev == null ? value : prev * (1 - alpha) + value * alpha; }

        function calcAngle2D(a, b, c){
            const ab = {x: a.x - b.x, y: a.y - b.y};
            const cb = {x: c.x - b.x, y: c.y - b.y};
            const dot = ab.x * cb.x + ab.y * cb.y;
            const abLen = Math.hypot(ab.x, ab.y);
            const cbLen = Math.hypot(cb.x, cb.y);
            const cos = Math.min(1, Math.max(-1, dot / (abLen * cbLen)));
            return Math.acos(cos) * (180 / Math.PI);
        }

        uploadBtn.addEventListener('click', async () => {
            const file = videoInput.files[0];
            if (!file) return alert('Selecteer eerst een video bestand');
            const fd = new FormData();
            fd.append('video', file);
            try {
                const res = await fetch('/fysio/upload', {
                    method: 'POST',
                    headers: {'X-CSRF-TOKEN': csrfToken},
                    body: fd
                });
                const json = await res.json();
                if (json.status === 'success') {
                    uploadedFileName = json.file;
                    video.src = `/videos/${uploadedFileName}`;
                    msg('Upload succesvol');
                } else alert('Upload mislukt');
            } catch (e) {
                console.error(e);
                alert('Upload mislukt');
            }
        });

        async function ensureDetector() {
            if (!detector) {
                detector = await poseDetection.createDetector(
                    poseDetection.SupportedModels.BlazePose,
                    {runtime:'mediapipe', modelType:'full', solutionPath:'https://cdn.jsdelivr.net/npm/@mediapipe/pose'}
                );
            }
        }

        async function analyseFromVideo() {
            if (!uploadedFileName) return alert('Upload eerst een video');
            if (!exerciseEl.value) return alert('Voer oefening naam in');
            await ensureDetector();

            video.play();
            msg('Bezig met analyseren...');
            progressBar.style.width = '0%';
            progressText.textContent = '0%';

            const fps = 15;
            const frameInterval = 1000 / fps;
            angles = [];
            emaAngle = null;

            const interval = setInterval(async () => {
                if (video.paused || video.ended) {
                    clearInterval(interval);
                    finalizeAnalysis();
                    msg('Analyse afgerond');
                    return;
                }

                const pct = Math.round((video.currentTime / video.duration) * 100);
                progressBar.style.width = pct + '%';
                progressText.textContent = pct + '%';

                const poses = await detector.estimatePoses(video);
                if (poses.length > 0) {
                    const kp = poses[0].keypoints;
                    const sideSel = legSelect.value;
                    const left = {hip:kp.find(k=>k.name==='left_hip'), knee:kp.find(k=>k.name==='left_knee'), ankle:kp.find(k=>k.name==='left_ankle')};
                    const right = {hip:kp.find(k=>k.name==='right_hip'), knee:kp.find(k=>k.name==='right_knee'), ankle:kp.find(k=>k.name==='right_ankle')};
                    let leg;
                    if (sideSel === 'auto') {
                        const lScore = (left.hip?.score||0)+(left.knee?.score||0)+(left.ankle?.score||0);
                        const rScore = (right.hip?.score||0)+(right.knee?.score||0)+(right.ankle?.score||0);
                        leg = rScore > lScore ? right : left;
                    } else {
                        leg = sideSel === 'left' ? left : right;
                    }

                    if (leg.hip?.score > 0.3 && leg.knee?.score > 0.3 && leg.ankle?.score > 0.3) {
                        const angle = calcAngle2D(leg.hip, leg.knee, leg.ankle);
                        emaAngle = ema(emaAngle, angle, 0.3);
                        angles.push(emaAngle);
                    } else {
                        angles.push(null);
                    }
                }
            }, frameInterval);

            async function finalizeAnalysis(){
                clearInterval(interval);
                const validAngles = angles.filter(a => a !== null);
                const neutral = validAngles[0] || 0;

                const maxAngle = Math.max(...validAngles);
                const minAngle = Math.min(...validAngles);

                let peakAngle, peakIndex, direction;

                if (Math.abs(maxAngle - neutral) >= Math.abs(minAngle - neutral)) {
                    peakAngle = maxAngle;
                    peakIndex = angles.indexOf(maxAngle);
                    direction = 'extension';
                } else {
                    peakAngle = minAngle;
                    peakIndex = angles.indexOf(minAngle);
                    direction = 'flexion';
                }

                const maxDiff = peakAngle - neutral;

                const payload = {
                    model: 'BlazePose',
                    side: legSelect.value,
                    fps,
                    neutralAngle: neutral,
                    peakAngle,
                    peakIndex,
                    maxDiff,
                    direction,
                    angles
                };

                try {
                    const res = await fetch('/references', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json','X-CSRF-TOKEN': csrfToken},
                        body: JSON.stringify({ exercise: exerciseEl.value, payload })
                    });
                    const out = await res.json();
                    if (out.status === 'success') msg('Reference opgeslagen: ' + out.file);
                    else { msg('Opslaan mislukt'); console.error(out); alert('Opslaan mislukt'); }
                } catch (err) {
                    console.error(err);
                    alert('Opslaan mislukt (network error)');
                }
            }
        }

        analyseBtn.addEventListener('click', analyseFromVideo);
    });
</script>
</body>
</html>
