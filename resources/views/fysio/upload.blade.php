<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Fysio – Referentie Analyse</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: Arial; margin: 20px; }
        .row { display:flex; gap:20px; align-items:flex-start; }
        video, canvas { max-width: 480px; border:1px solid #222; border-radius:8px; }
        label { display:block; margin:8px 0 4px; }
        button { margin-top: 10px; }
        #status { margin-top: 10px; color: #0a7; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@4.12.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/pose-detection"></script>
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/pose"></script>
</head>
<body>
<h1>Referentie opnemen/analyseren</h1>
<div>
    <label>Oefening naam</label>
    <input id="exercise" type="text" placeholder="bijv. squat" />
</div>
<div class="row">
    <div>
        <label>Videobestand</label>
        <input id="videoInput" type="file" accept="video/*" />
        <button id="uploadBtn">Upload</button>
        <video id="video" controls></video>
        <div style="margin-top:8px; width:480px;">
            <div style="background:#eee; border-radius:6px; overflow:hidden; height:12px;">
                <div id="progressBar" style="background:#0a7; width:0%; height:100%; transition:width 0.1s;"></div>
            </div>
            <div id="progressText" style="font-size:12px; margin-top:4px; color:#555;">0%</div>
        </div>
        <div id="status"></div>
    </div>
    <div>
        <label>Webcam alternatief</label>
        <video id="webcam" autoplay playsinline muted></video>
        <canvas id="overlay"></canvas>
        <div>
            <button id="startWebcam">Start webcam</button>
            <button id="useWebcam">Gebruik webcam frames voor referentie</button>
        </div>
    </div>
</div>
<div>
    <button id="analyzeBtn">Analyseer (gebruik video)</button>
</div>

<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const statusEl = document.getElementById('status');
const exerciseEl = document.getElementById('exercise');
const progressBar = document.getElementById('progressBar');
const progressText = document.getElementById('progressText');

const videoInput = document.getElementById('videoInput');
const uploadBtn = document.getElementById('uploadBtn');
const video = document.getElementById('video');
const analyzeBtn = document.getElementById('analyzeBtn');

const webcam = document.getElementById('webcam');
const overlay = document.getElementById('overlay');
const startWebcam = document.getElementById('startWebcam');
const useWebcam = document.getElementById('useWebcam');
const octx = overlay.getContext('2d');

let uploadedFileName = null;
let detector;

function msg(t){ statusEl.textContent = t; }

async function ensureDetector(){
  if (!detector){
    detector = await poseDetection.createDetector(
      poseDetection.SupportedModels.BlazePose,
      { runtime: 'mediapipe', modelType: 'full', solutionPath: 'https://cdn.jsdelivr.net/npm/@mediapipe/pose' }
    );
  }
}

function kangle(a,b,c){
  const ab = { x: a.x-b.x, y: a.y-b.y };
  const cb = { x: c.x-b.x, y: c.y-b.y };
  const dot = ab.x*cb.x + ab.y*cb.y;
  const abLen = Math.hypot(ab.x,ab.y);
  const cbLen = Math.hypot(cb.x,cb.y);
  const cos = Math.min(1, Math.max(-1, dot/(abLen*cbLen)));
  return Math.acos(cos)*(180/Math.PI);
}

async function uploadVideoFile(){
  const file = videoInput.files[0];
  if(!file) return alert('Selecteer een videobestand');
  const fd = new FormData(); fd.append('video', file);
  const res = await fetch('/fysio/upload', { method:'POST', headers:{'X-CSRF-TOKEN': csrfToken}, body: fd });
  const json = await res.json();
  if (json.status==='success'){
    uploadedFileName = json.file;
    video.src = `/videos/${uploadedFileName}`;
    // forceer decodeerbaar frame
    try {
      await video.play();
      setTimeout(()=> video.pause(), 300);
    } catch(e) { /* autoplay kan mislukken, is niet fataal */ }
    msg('Upload geslaagd');
  } else { alert('Upload mislukt'); }
}

async function analyzeFromVideo(){
  if(!uploadedFileName) return alert('Upload eerst een video');
  if(!exerciseEl.value) return alert('Vul oefening naam in');
  await ensureDetector();

  // Warmup en zorg dat de player decodet
  try { await video.play(); } catch(_) {}
  await new Promise(r => setTimeout(r, 300));
  try { video.pause(); } catch(_) {}

  // Wacht tot metadata en duration beschikbaar zijn
  await new Promise(r => (video.readyState >= 1 && video.duration) ? r() : (video.onloadedmetadata=r));

  const fps = 15; // stabielere sampling
  const frames = Math.max(1, Math.floor(video.duration * fps));
  const angles = [];
  // reset progress
  progressBar.style.width = '0%';
  progressText.textContent = '0%';

  for (let i=0;i<frames;i++){
    const t = (i/frames) * video.duration;
    video.currentTime = t;

    // wacht op nieuw frame met guard
    await Promise.race([
      new Promise(r => video.onseeked = r),
      new Promise(r => setTimeout(r, 400))
    ]);
    // extra rendering frames
    await new Promise(r => requestAnimationFrame(() => requestAnimationFrame(r)));

    // update progress direct, ongeacht detectie
    const pct = Math.round(((i+1)/frames)*100);
    progressBar.style.width = pct + '%';
    progressText.textContent = pct + '%';

    // pose detectie met try/catch zodat 1 frame niet alles breekt
    try{
      const poses = await detector.estimatePoses(video);
      if(poses && poses.length){
        const kp = poses[0].keypoints;
        const hip = kp.find(k=>k.name==='left_hip');
        const knee = kp.find(k=>k.name==='left_knee');
        const ankle = kp.find(k=>k.name==='left_ankle');
        if (hip&&knee&&ankle && hip.score>0.4 && knee.score>0.4 && ankle.score>0.4){
          angles.push(kangle(hip,knee,ankle));
        } else { angles.push(null); }
      } else { angles.push(null); }
    } catch(e){ angles.push(null); }
  }

  const payload = { model:'BlazePose', side:'left', fps, angles };
  try{
    const res = await fetch('/references', { method:'POST', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrfToken}, body: JSON.stringify({ exercise: exerciseEl.value, payload }) });
    const out = await res.json();
    if(out.status==='success') msg('Referentie opgeslagen: ' + out.file);
    else { msg('Opslaan mislukt'); console.error(out); alert('Opslaan mislukt'); }
  }catch(err){ console.error('POST /references failed', err); alert('Opslaan mislukt (netwerk)'); }

  // complete
  setTimeout(()=>{ progressBar.style.width = '0%'; progressText.textContent = '0%'; }, 800);
}

async function startWebcamStream(){
  overlay.width = 480; overlay.height = 360;
  const stream = await navigator.mediaDevices.getUserMedia({ video: { width: 480, height:360 }, audio:false });
  webcam.srcObject = stream;
}

async function analyzeFromWebcam(){
  if(!exerciseEl.value) return alert('Vul oefening naam in');
  await ensureDetector();
  // warmup 1s zodat model en camera stabiel zijn
  await new Promise(r => setTimeout(r, 1000));
  const angles = [];
  const durationMs = 6000; // iets langer opnemen
  const start = performance.now();
  const fps = 15; let lastSample = 0; const interval = 1000/fps;
  // reset progress
  progressBar.style.width = '0%';
  progressText.textContent = '0%';
  async function step(ts){
    const poses = await detector.estimatePoses(webcam);
    octx.clearRect(0,0,overlay.width, overlay.height);
    if (poses.length){
      const kp = poses[0].keypoints;
      const hip = kp.find(k=>k.name==='left_hip');
      const knee = kp.find(k=>k.name==='left_knee');
      const ankle = kp.find(k=>k.name==='left_ankle');
      if (hip&&knee&&ankle && hip.score>0.4 && knee.score>0.4 && ankle.score>0.4){
        if (!lastSample || (ts - lastSample) >= interval){
          angles.push(kangle(hip,knee,ankle));
          lastSample = ts;
        }
      } else {
        if (!lastSample || (ts - lastSample) >= interval){
          angles.push(null);
          lastSample = ts;
        }
      }
    }
    const elapsed = performance.now()-start;
    const pct = Math.max(0, Math.min(100, Math.round((elapsed/durationMs)*100)));
    progressBar.style.width = pct + '%';
    progressText.textContent = pct + '%';

    if (elapsed < durationMs){ requestAnimationFrame(step); }
    else {
      const payload = { model:'BlazePose', side:'left', fps, angles };
      fetch('/references', { method:'POST', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrfToken}, body: JSON.stringify({ exercise: exerciseEl.value, payload }) })
        .then(r=>r.json()).then(out=>{ if(out.status==='success') msg('Referentie opgeslagen: ' + out.file); else alert('Opslaan mislukt'); });
      setTimeout(()=>{ progressBar.style.width = '0%'; progressText.textContent = '0%'; }, 800);
    }
  }
  requestAnimationFrame(step);
}

uploadBtn.addEventListener('click', uploadVideoFile);
startWebcam.addEventListener('click', startWebcamStream);
useWebcam.addEventListener('click', analyzeFromWebcam);
analyzeBtn.addEventListener('click', analyzeFromVideo);
</script>
</body>
</html>
