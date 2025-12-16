<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Filming page for exercise</title>

    <meta name="user-id" content="{{ auth()->id() ?? 1 }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="stylesheet" href="{{ asset('assets/fonts/remix/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/pose-detection"></script>
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/pose"></script>

</head>
<body>

<div class="page-wrapper">
    <div class="main-container">
        <x-sidebar-patient/>
        <div class="app-container">
            <x-header/>

            <div class="app-hero-header d-flex align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/homepage"><i class="ri-home-3-line"></i></a></li>
                    <li class="breadcrumb-item text-primary">Filming</li>
                </ol>
            </div>

            <div class="app-body">
                <div class="filming-container">

                    <div class="filming-header">
                        <h1 id="pageTitle" class="filming-title">Exercise</h1>
                        <p class="filming-subtitle">Make sure your knee is visible and start tracking your motion.</p>
                    </div>

                    <div class="filming-center">

                        <!-- VIDEO -->
                        <div class="video-side">
                            <div id="video-container" class="filming-video-container">
                                <video id="video" autoplay playsinline muted></video>
                                <canvas id="output"></canvas>
                                <div id="countdown-overlay"></div>
                            </div>

                            <canvas id="recordCanvas" style="display:none;"></canvas>

                            <!-- Angle, Ref & Match inline -->
                            <div id="angle-display" class="filming-angle-display">
                                Knee: -- | Angle: --° | Ref: --° | Match: --%
                            </div>

                            <div id="feedbackBox"></div> <!-- Feedback text -->
                        </div>

                        <!-- CONTROLS -->
                        <div class="controls-side">

                            <div class="filming-controls">
                                <button id="recordBtn">Start recording</button>
                            </div>

                            <div id="statusbar" class="filming-statusbar">
                                <span id="camStatus" class="badge off">Camera: off</span>
                                <span id="trackStatus" class="badge off">Tracking: off</span>
                                <span id="refStatus" class="badge warn">Reference: unknown</span>
                                <span id="msg"></span>
                            </div>

                            <!-- popup -->
                            <div id="recording-popup" class="popup-overlay">
                                <div class="popup-box">
                                    <h3>Recording finished</h3>
                                    <p class="popup-text">What would you like to do?</p>
                                    <div class="popup-buttons">
                                        <button id="saveVideoBtn" class="btn-save">Save video</button>
                                        <button id="retryBtn" class="btn-retry">Try again</button>
                                    </div>
                                </div>
                            </div>

                            <div class="filming-controls">
                                <label>Select exercise:</label>
                                <select id="exerciseSelect"></select>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded',async()=>{

            /* DOM */
            const video=document.getElementById('video');
            const canvas=document.getElementById('output');
            const ctx=canvas.getContext('2d');
            const rCanvas=document.getElementById('recordCanvas');
            const rctx=rCanvas.getContext('2d');
            const recordBtn=document.getElementById('recordBtn');
            const camBadge=document.getElementById('camStatus');
            const trackBadge=document.getElementById('trackStatus');
            const refBadge=document.getElementById('refStatus');
            const angleDisplay=document.getElementById('angle-display');
            const exerciseSelect=document.getElementById('exerciseSelect');
            const feedbackBox=document.getElementById('feedbackBox');
            const saveVideoBtn = document.getElementById('saveVideoBtn');
            const retryBtn = document.getElementById('retryBtn');

            /* Vars */
            let detector,isRecording=false,mediaRecorder=null,recordedChunks=[];
            let emaAngle=null,referencePeak=null,referenceDirection="flexion";
            let totalFrames=0,goodFrames=0;
            let hasStartedRecording = false;
            let cameraReady = false;
            let trackingReady = false;
            let referenceReady = false;
            let finalScore = 0;
            let recordingStartTime = null;
            let recordingDuration = 0;
            let minAngle = null;
            let maxAngle = null;


            /* LOAD EXERCISES */
            async function loadExercisesOfToday() {
                const uid = document.querySelector('meta[name="user-id"]').content;
                const res = await fetch(`/patient/today-exercises/${uid}`);
                const data = await res.json();

                if (!data.length) {
                    exerciseSelect.innerHTML = `<option>No exercises today</option>`;
                    return;
                }

                exerciseSelect.innerHTML = data.map(ex => {
                    let set = {};

                    if (typeof ex.settings === "string") {
                        try {
                            set = JSON.parse(ex.settings);
                        } catch {
                            set = {};
                        }
                    } else if (typeof ex.settings === "object" && ex.settings !== null) {
                        set = ex.settings;
                    }

                    return `<option value="${ex.id}"
            data-peak="${set.analysis?.peakAngle ?? ''}"
            data-direction="${set.analysis?.direction ?? 'flexion'}">
            ${ex.exercise} (${set.frequency ?? 'No freq'})
        </option>`;
                }).join('');

                exerciseSelect.onchange = applyExerciseSelection;
                exerciseSelect.selectedIndex = 0;
                applyExerciseSelection();
            }


            function applyExerciseSelection() {
                const opt = exerciseSelect.options[exerciseSelect.selectedIndex];
                referencePeak = parseFloat(opt.dataset.peak) || null;
                referenceDirection = opt.dataset.direction || "flexion";

                document.getElementById("pageTitle").textContent =
                    opt.text.split("(")[0].trim();

                totalFrames = 0;
                goodFrames = 0;
                feedbackBox.textContent = "";

                if (referencePeak) {
                    referenceReady = true;
                    refBadge.className = "badge on";
                    refBadge.textContent = "Reference: loaded";

                    angleDisplay.textContent =
                        `Knee: -- | Angle: --° | Ref: ${referencePeak.toFixed(1)}° | Match: --%`;
                } else {
                    referenceReady = false;
                    refBadge.className = "badge warn";
                    refBadge.textContent = "Reference: none";

                    angleDisplay.textContent =
                        `Knee: -- | Angle: --° | Ref: --° | Match: --%`;
                }

                updateRecordButtonState();
            }

            /* FAN COLOUR */
            function getFanColour(angle){
                if(!referencePeak) return "limegreen";
                if(referenceDirection==="flexion"&&angle<referencePeak) return "red";
                if(referenceDirection==="extension"&&angle>referencePeak) return "red";
                return "limegreen";
            }

            /* FEEDBACK ON ERROR ONLY */
            function giveFeedbackOnlyOnError(angle){
                if(!referencePeak) return;

                if(referenceDirection==="flexion"&&angle<referencePeak){
                    feedbackBox.textContent="⚠ Flex less – too deep!";
                    return;
                }
                if(referenceDirection==="extension"&&angle>referencePeak){
                    feedbackBox.textContent="⚠ Extend less – too far!";
                    return;
                }
                feedbackBox.textContent="";
            }

            /* MATCH SCORE */
            function updateMatchScore(angle){
                if(!referencePeak) return;
                totalFrames++;
                if(getFanColour(angle)==="limegreen") goodFrames++;
            }

            /* DRAW */
            function drawFan(h,k,a,col,ang){
                ctx.beginPath();ctx.moveTo(h.x,h.y);ctx.lineTo(k.x,k.y);ctx.lineTo(a.x,a.y);
                ctx.closePath();ctx.fillStyle=col;ctx.globalAlpha=.35;ctx.fill();ctx.globalAlpha=1;
                ctx.strokeStyle=col;ctx.lineWidth=2;ctx.stroke();

                [h,k,a].forEach(p=>{ctx.beginPath();ctx.arc(p.x,p.y,6,0,6.28);
                    ctx.fillStyle=col;ctx.fill();ctx.strokeStyle="#fff";ctx.stroke();});

                ctx.fillStyle=col;ctx.font="16px Arial";
                ctx.fillText(ang.toFixed(1)+"°",k.x+10,k.y-10);
            }

            const smooth=(p,v,a=.2)=>p==null?v:p*(1-a)+v*a;

            /* CAMERA */
            async function setupCam() {
                try {
                    const stream = await navigator.mediaDevices.getUserMedia({
                        video: { width: 640, height: 480 }
                    });

                    video.srcObject = stream;

                    await new Promise(r => video.onloadedmetadata = r);

                    canvas.width = 640;
                    canvas.height = 480;
                    rCanvas.width = 640;
                    rCanvas.height = 480;

                    await video.play();

                    cameraReady = true;
                    camBadge.className = "badge on";
                    camBadge.textContent = "Camera: on";

                } catch (err) {
                    cameraReady = false;
                    camBadge.className = "badge off";
                    camBadge.textContent = "Camera: off";
                    console.error("Camera failed:", err);
                }

                updateRecordButtonState();
            }

            async function initDetector() {
                try {
                    detector = await poseDetection.createDetector(
                        poseDetection.SupportedModels.BlazePose,
                        {
                            runtime: "mediapipe",
                            modelType: "full",
                            solutionPath: "https://cdn.jsdelivr.net/npm/@mediapipe/pose"
                        }
                    );

                    trackingReady = true;
                    trackBadge.className = "badge on";
                    trackBadge.textContent = "Tracking: on";

                } catch (err) {
                    trackingReady = false;
                    trackBadge.className = "badge off";
                    trackBadge.textContent = "Tracking: off";
                    console.error("Tracking failed:", err);
                }

                updateRecordButtonState();
            }

            /* RECORDING */
            function updateRecordButtonState() {
                const canRecord = cameraReady && trackingReady && referenceReady;

                recordBtn.disabled = !canRecord;
                recordBtn.classList.toggle("disabled", !canRecord);

                if (!canRecord) {
                    recordBtn.textContent = "Start recording";
                }
            }

            recordBtn.onclick = () => {
                if (!cameraReady || !trackingReady || !referenceReady) {
                    alert("Camera, tracking and reference must be active.");
                    return;
                }

                !isRecording ? startCountdown() : stopRecording();
            };


            function startCountdown(sec=3){
                const o=document.getElementById("countdown-overlay");
                o.classList.add("show");o.textContent=sec;
                let t=setInterval(()=>{sec--;o.textContent=sec;
                    if(sec<=0){clearInterval(t);o.classList.remove("show");startRecording();}},1000);
            }

            function startRecording(){
                recordedChunks=[];
                minAngle = null;
                maxAngle = null;
                const stream=rCanvas.captureStream(30);
                mediaRecorder=new MediaRecorder(stream);
                mediaRecorder.ondataavailable=e=>recordedChunks.push(e.data);
                mediaRecorder.start();

                recordingStartTime = Date.now(); // ⏱ START METEN

                isRecording = true;
                hasStartedRecording = true;

                recordBtn.textContent = "Stop recording";
                recordBtn.classList.add("recording"); // 👈 PEACH KLEUR
            }

            function stopRecording(){
                mediaRecorder.stop();
                isRecording = false;

                recordBtn.textContent = "Start recording";
                recordBtn.classList.remove("recording"); // 👈 TERUG NAAR ROZE

                // ⏱ DUUR BEREKENEN (in seconden)
                recordingDuration = Math.round(
                    (Date.now() - recordingStartTime) / 1000
                );

                // 🎯 SCORE BEREKENEN
                finalScore = Number(
                    ((goodFrames / totalFrames) * 100 || 0).toFixed(1)
                );

                // 🔁 RESET NA STOP RECORDING
                hasStartedRecording = false;
                totalFrames = 0;
                goodFrames = 0;
                emaAngle = null; // ✅ BELANGRIJK
                feedbackBox.textContent = "";

                angleDisplay.textContent =
                    `Knee: -- | Angle: --° | Ref: ${referencePeak ? referencePeak.toFixed(1) : "--"}° | Match: --%`;

                document.getElementById("recording-popup").classList.add("show");
            }



            saveVideoBtn.onclick = async () => {

                document.getElementById("recording-popup").classList.remove("show");

                const blob = new Blob(recordedChunks, { type: "video/webm" });

                const formData = new FormData();
                formData.append("calendar_entry_id", exerciseSelect.value); // <-- ID uit select
                formData.append("score", finalScore);
                formData.append("match_percentage", finalScore); // 👈 DIT WAS DE MISSENDE
                formData.append("min_angle", minAngle);
                formData.append("max_angle", maxAngle);
                formData.append("duration", Math.max(recordingDuration, 1));
                formData.append("video", blob, "exercise.webm");




                try {
                    const response = await fetch("/exercise-executions", {
                        method: "POST",
                        credentials: "same-origin", // 👈 DIT IS DE FIX
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                            "Accept": "application/json"
                        },
                        body: formData
                    });


                    const result = await response.json();

                    if (!response.ok) {
                        console.error("VALIDATION ERROR:", result);
                        alert(JSON.stringify(result.errors, null, 2));
                        return;
                    }

                    console.log("Video opgeslagen:", result.execution_id);


                } catch (err) {
                    console.error("Upload error", err);
                }
            };

            retryBtn.onclick=()=>{
                recordedChunks=[];
                minAngle = null;
                maxAngle = null;
                hasStartedRecording = false;
                totalFrames = 0;
                goodFrames = 0;
                emaAngle = null; // ✅ OOK HIER
                feedbackBox.textContent = "";

                angleDisplay.textContent =
                    `Knee: -- | Angle: --° | Ref: ${referencePeak ? referencePeak.toFixed(1) : "--"}° | Match: --%`;

                document.getElementById("recording-popup").classList.remove("show");
            };


            /* RENDER LOOP */
            async function render(){
                const poses=await detector.estimatePoses(video);
                ctx.clearRect(0,0,640,480);

                if(poses.length) {
                    const k = poses[0].keypoints;
                    const h = k.find(x => x.name.includes("hip"));
                    const kn = k.find(x => x.name.includes("knee"));
                    const a = k.find(x => x.name.includes("ankle"));

                    if (h && kn && a && h.score > .1 && kn.score > .1 && a.score > .1) {
                        const AB = [h.x - kn.x, h.y - kn.y], CB = [a.x - kn.x, a.y - kn.y];
                        const ang = Math.acos((AB[0] * CB[0] + AB[1] * CB[1]) / (Math.hypot(...AB) * Math.hypot(...CB))) * (180 / Math.PI);
                        emaAngle = smooth(emaAngle, ang);

                        if (hasStartedRecording && emaAngle != null) {

                            if (minAngle === null || emaAngle < minAngle) {
                                minAngle = emaAngle;
                            }

                            if (maxAngle === null || emaAngle > maxAngle) {
                                maxAngle = emaAngle;
                            }
                        }

                        let col = getFanColour(emaAngle);
                        drawFan(h, kn, a, col, emaAngle);

                        let baseText =
                            `Knee:${kn.name.includes("left") ? 'left' : 'right'} | ` +
                            `Angle:${emaAngle.toFixed(1)}° | ` +
                            `Ref:${referencePeak ? referencePeak.toFixed(1) : "--"}° | `;

                        if (hasStartedRecording) {
                            updateMatchScore(emaAngle);
                            giveFeedbackOnlyOnError(emaAngle);

                            const percent = ((goodFrames / totalFrames) * 100 || 0).toFixed(1);
                            angleDisplay.textContent = baseText + `Match:${percent}%`;
                        } else {
                            angleDisplay.textContent = baseText + `Match: --%`;
                            feedbackBox.textContent = "";
                        }
                    }
                }
                if(isRecording){
                    rctx.clearRect(0,0,640,480);
                    rctx.drawImage(video,0,0);
                    rctx.drawImage(canvas,0,0);
                }

                requestAnimationFrame(render);
            }

            /* START */
            recordBtn.disabled = true; // standaard UIT

            try {
                await loadExercisesOfToday(); // reference
                await setupCam();             // camera
                await initDetector();         // tracking
                render();
            } catch (e) {
                console.error(e);
                document.getElementById("msg").textContent = "Init failed";
            }

        });
    </script>
</body>
</html>
