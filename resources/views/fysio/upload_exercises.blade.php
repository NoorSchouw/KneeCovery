<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clove Dental Care Admin Template</title>
    <link rel="stylesheet" href="{{ asset('assets/fonts/remix/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/daterange/daterange.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/calendar/css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/calendar/css/custom.css') }}">
</head>

<body>
<div class="page-wrapper">
    <div class="main-container">

        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="brand-container d-flex align-items-center justify-content-between">
                <div class="app-brand ms-3">
                    <a href="{{ url('/homepage') }}">
                        <img src="{{ asset('assets/images/logo.png') }}" class="logo" alt="Dental Care Admin Template">
                    </a>
                </div>
            </div>

            <div class="sidebar-profile">
                <img src="{{ asset('assets/images/doctor5.png') }}" class="rounded-5 border border-primary border-3" alt="Dentist Admin Templates">
                <h6 class="mb-1 profile-name text-nowrap text-truncate text-primary">John Doe</h6>
                <small class="profile-name text-nowrap text-truncate">Physio</small>
            </div>

            <div class="sidebarMenuScroll">
                <ul class="sidebar-menu">
                    <li class="active current page">
                        <a href="#">
                            <i class="ri-dossier-line"></i>
                            <span class="menu-text">Upload exercises</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- App container -->
        <div class="app-container">
            <!-- Header -->
            <div class="app-header d-flex align-items-center">
                <div class="brand-container-sm d-xl-none d-flex align-items-center">
                    <div class="app-brand">
                        <a href="#"><img src="{{ asset('assets/images/logo.png') }}" class="logo" alt="Dental Care Admin Template"></a>
                    </div>
                </div>

                <div class="search-container d-xl-block d-none">
                    <input type="text" class="form-control" id="searchId" placeholder="Search">
                    <i class="ri-search-line"></i>
                </div>

                <div class="header-actions">
                    <div class="dropdown ms-3">
                        <a id="userSettings" class="dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="avatar-box">
                                <img src="{{ asset('assets/images/doctor5.png') }}" class="img-2xx rounded-5 border border-3 border-white" alt="Dentist Dashboard">
                                <span class="status busy"></span>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-300 shadow-lg">
                            <div class="d-flex align-items-center justify-content-between p-3">
                                <div>
                                    <span class="small">Physio</span>
                                    <h6 class="m-0">John Doe, M</h6>
                                </div>
                            </div>
                            <div class="mx-3 my-2 d-grid">
                                <a href="login.html" class="btn btn-primary">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hero header -->
            <div class="app-hero-header d-flex align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="ri-home-3-line"></i></a></li>
                    <li class="breadcrumb-item text-primary" aria-current="page">Upload exercises</li>
                </ol>
            </div>

            <!-- App body -->
            <div class="app-body p-3">
                <div class="row gx-4 physio-wrapper">

                    <!-- LEFT PANEL -->
                    <div class="col-4">
                        <div class="physio-left">
                            <div class="d-flex align-items-center mb-3">
                                <button class="btn physio-add-btn" id="addExerciseBtn">Add exercise</button>
                                <input type="text" class="form-control physio-search ms-2" placeholder="Search" id="searchInput">
                            </div>

                            <div class="physio-exercise-list" id="exerciseList">
                                <div class="physio-ex-item">Heel slide</div>
                                <div class="physio-ex-item">Squat</div>
                                <div class="physio-ex-item">Hamstring curls</div>
                            </div>

                            <button class="btn physio-add-selected" id="addSelectedBtn">Add all selected to calendar</button>
                        </div>
                    </div>

                    <!-- RIGHT PANEL -->
                    <div class="col-8">
                        <div class="physio-calendar">
                            <div class="physio-cal-header">
                                <button class="cal-nav" id="prevWeek">&lt;</button>
                                <div class="cal-title" id="calTitle"></div>
                                <button class="cal-nav" id="nextWeek">&gt;</button>
                            </div>

                            <table class="physio-cal-table" id="calendarTable">
                                <thead>
                                <tr>
                                    <th>Exercise</th>
                                    <th>Mon</th>
                                    <th>Tue</th>
                                    <th>Wed</th>
                                    <th>Thu</th>
                                    <th>Fri</th>
                                    <th>Sat</th>
                                    <th>Sun</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Modal: Add exercises to calendar -->
            <div class="modal fade" id="addModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content p-3">
                        <h5>Add Exercises to Calendar</h5>
                        <div id="modalExercisesContainer">
                            <!-- Dynamische velden per oefening komen hier -->
                        </div>
                        <button class="btn btn-primary mt-3" id="modalAddBtn">Add to Calendar</button>
                    </div>
                </div>
            </div>

            <!-- Modal: Add new exercise -->
            <div class="modal fade" id="addExerciseModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content p-3">
                        <h5>Add New Exercise</h5>
                        <div class="mb-3">
                            <label for="newExerciseName">Exercise Name</label>
                            <input type="text" class="form-control" id="newExerciseName" placeholder="Enter exercise name">
                        </div>
                        <button class="btn btn-primary" id="addExerciseModalBtn">Add Exercise</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@4.12.0"></script>
<script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/pose-detection"></script>
<script src="https://cdn.jsdelivr.net/npm/@mediapipe/pose"></script>

<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@4.12.0"></script>
<script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/pose-detection"></script>
<script src="https://cdn.jsdelivr.net/npm/@mediapipe/pose"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const exerciseList = document.getElementById("exerciseList");
        const addExerciseBtn = document.getElementById("addExerciseBtn");
        const addExerciseModal = new bootstrap.Modal(document.getElementById('addExerciseModal'));
        const addExerciseModalBtn = document.getElementById('addExerciseModalBtn');
        const newExerciseName = document.getElementById('newExerciseName');

        const addSelectedBtn = document.getElementById("addSelectedBtn");
        const calendarBody = document.querySelector("#calendarTable tbody");
        const modalAddBtn = document.getElementById("modalAddBtn"); // Correct knop ID
        const calTitle = document.getElementById("calTitle");
        const prevWeekBtn = document.getElementById("prevWeek");
        const nextWeekBtn = document.getElementById("nextWeek");

        const container = document.getElementById("modalExercisesContainer");
        let detector = null;
        let currentWeekOffset = 0;

        // ---- TensorFlow Detector ----
        async function ensureDetector() {
            if (!detector) {
                detector = await poseDetection.createDetector(
                    poseDetection.SupportedModels.BlazePose,
                    {runtime:'mediapipe', modelType:'full', solutionPath:'https://cdn.jsdelivr.net/npm/@mediapipe/pose'}
                );
            }
        }

        function calcAngle2D(a, b, c){
            const ab = {x: a.x - b.x, y: a.y - b.y};
            const cb = {x: c.x - b.x, y: c.y - b.y};
            const dot = ab.x * cb.x + ab.y * cb.y;
            const abLen = Math.hypot(ab.x, ab.y);
            const cbLen = Math.hypot(cb.x, cb.y);
            const cos = Math.min(1, Math.max(-1, dot / (abLen * cbLen)));
            return Math.acos(cos) * (180 / Math.PI);
        }

        function ema(prev, value, alpha = 0.3){ return prev == null ? value : prev * (1 - alpha) + value * alpha; }

        async function analyseVideo(file, side='auto') {
            await ensureDetector();

            return new Promise((resolve, reject) => {
                const video = document.createElement("video");
                video.src = URL.createObjectURL(file);
                video.crossOrigin = "anonymous";
                video.muted = true;
                video.play();

                const angles = [];
                let emaAngle = null;
                const fps = 15;
                const frameInterval = 1000 / fps;

                const interval = setInterval(async () => {
                    if (video.paused || video.ended) {
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
                        resolve({
                            fps, neutralAngle: neutral, peakAngle, peakIndex,
                            maxDiff, direction, angles
                        });
                        return;
                    }

                    const poses = await detector.estimatePoses(video);
                    if (poses.length > 0) {
                        const kp = poses[0].keypoints;
                        const left = {hip:kp.find(k=>k.name==='left_hip'), knee:kp.find(k=>k.name==='left_knee'), ankle:kp.find(k=>k.name==='left_ankle')};
                        const right = {hip:kp.find(k=>k.name==='right_hip'), knee:kp.find(k=>k.name==='right_knee'), ankle:kp.find(k=>k.name==='right_ankle')};
                        let leg;
                        if (side === 'auto') {
                            const lScore = (left.hip?.score||0)+(left.knee?.score||0)+(left.ankle?.score||0);
                            const rScore = (right.hip?.score||0)+(right.knee?.score||0)+(right.ankle?.score||0);
                            leg = rScore > lScore ? right : left;
                        } else {
                            leg = side === 'left' ? left : right;
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
            });
        }

        // ---- Add Exercise Modal ----
        addExerciseBtn.addEventListener("click", () => {
            newExerciseName.value = "";
            addExerciseModal.show();
        });

        addExerciseModalBtn.addEventListener("click", () => {
            const name = newExerciseName.value.trim();
            if(name === "") { alert("Please enter a name."); return; }
            const div = document.createElement("div");
            div.className = "physio-ex-item";
            div.textContent = name;
            exerciseList.appendChild(div);
            addExerciseModal.hide();
        });

        // ---- Select/deselect exercises ----
        exerciseList.addEventListener("click", e => {
            if(e.target.classList.contains("physio-ex-item")){
                e.target.classList.toggle("selected");
            }
        });

        // ---- Search filter ----
        document.getElementById("searchInput").addEventListener("input", () => {
            const search = document.getElementById("searchInput").value.toLowerCase();
            exerciseList.querySelectorAll(".physio-ex-item").forEach(item => {
                item.style.display = item.textContent.toLowerCase().includes(search) ? "block" : "none";
            });
        });

        // ---- Add selected exercises to modal ----
        addSelectedBtn.addEventListener("click", () => {
            const selected = [...exerciseList.querySelectorAll(".physio-ex-item.selected")];
            if(selected.length === 0){ alert("Select at least one exercise."); return; }

            container.innerHTML = "";
            selected.forEach(ex => {
                const div = document.createElement("div");
                div.className = "mb-3 p-2 border rounded";
                div.innerHTML = `
                <h6>${ex.textContent}</h6>
                <div class="mb-1">
                    <label>Frequency</label>
                    <input type="text" class="form-control frequency-input" placeholder="e.g., 3×10">
                </div>
                <div class="mb-1">
                    <label>Days</label><br>
                    ${['Mon','Tue','Wed','Thu','Fri','Sat','Sun'].map(day => `
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input day-checkbox" value="${day}">${day}
                        </div>
                    `).join('')}
                </div>
                <div>
                    <label>Upload video</label>
                    <input type="file" class="form-control file-input" accept="video/*">
                    <small class="text-muted analysisStatus"></small>
                </div>
            `;
                container.appendChild(div);

                // Auto-analyse bij file selectie
                const fileInput = div.querySelector(".file-input");
                const statusEl = div.querySelector(".analysisStatus");
                fileInput.addEventListener("change", async () => {
                    const file = fileInput.files[0];
                    if(!file) return;
                    statusEl.textContent = "Analyzing...";
                    try {
                        const result = await analyseVideo(file);
                        div.dataset.analysis = JSON.stringify(result);
                        statusEl.textContent = "Analysis complete!";
                    } catch(e) {
                        console.error(e);
                        statusEl.textContent = "Analysis failed!";
                    }
                });
            });

            const modal = new bootstrap.Modal(document.getElementById('addModal'));
            modal.show();
        });

        // ---- Add exercises from modal to calendar ----
        modalAddBtn.addEventListener("click", () => {
            const exercises = document.querySelectorAll("#modalExercisesContainer > div");
            exercises.forEach(div => {
                const name = div.querySelector("h6").textContent;
                const freq = div.querySelector(".frequency-input").value;
                const file = div.querySelector(".file-input").files[0];
                const days = [...div.querySelectorAll(".day-checkbox:checked")].map(d => d.value);

                if(!file || !div.dataset.analysis){
                    alert(`Please upload and analyze a video for ${name}`);
                    return;
                }

                const row = document.createElement("tr");
                const allDays = ["Mon","Tue","Wed","Thu","Fri","Sat","Sun"];
                row.innerHTML = `<td class="ex-name">${name}</td>` +
                    allDays.map(day => `<td title="${file.name}">${days.includes(day)?freq:""}</td>`).join('');
                calendarBody.appendChild(row);

                console.log(`Analysis JSON for ${name}:`, div.dataset.analysis);
            });

            document.querySelectorAll(".physio-ex-item.selected").forEach(ex => ex.classList.remove("selected"));
            bootstrap.Modal.getInstance(document.getElementById('addModal')).hide();
        });

        // ---- Calendar week navigation ----
        function getISOWeekMonday(date){
            const d = new Date(date);
            const day = d.getDay();
            const diff = (day === 0 ? -6 : 1 - day);
            d.setDate(d.getDate() + diff + currentWeekOffset*7);
            return d;
        }

        function getISOWeekNumber(date){
            const d = new Date(date);
            d.setHours(0,0,0,0);
            d.setDate(d.getDate() + 3 - (d.getDay()+6)%7);
            const week1 = new Date(d.getFullYear(),0,4);
            return 1 + Math.round(((d - week1)/86400000 - 3 + (week1.getDay()+6)%7)/7);
        }

        function formatDate(date){ return date.toISOString().split('T')[0]; }

        function updateCalendarTitle(){
            const monday = getISOWeekMonday(new Date());
            const sunday = new Date(monday);
            sunday.setDate(monday.getDate() + 6);
            const weekNumber = getISOWeekNumber(monday);
            calTitle.textContent = `Week ${weekNumber} (${formatDate(monday)} - ${formatDate(sunday)})`;
        }

        prevWeekBtn.addEventListener("click",()=>{ currentWeekOffset--; updateCalendarTitle(); });
        nextWeekBtn.addEventListener("click",()=>{ currentWeekOffset++; updateCalendarTitle(); });

        updateCalendarTitle();
    });
</script>

</body>
</html>
