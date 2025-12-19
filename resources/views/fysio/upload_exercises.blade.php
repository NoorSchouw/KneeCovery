<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Physio – Bewegingsanalyse</title>

    <!-- CSRF + USER ID -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ auth()->user()->id ?? 1 }}">

    <!-- Existing styles -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/remix/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/daterange/daterange.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/calendar/css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/calendar/css/custom.css') }}">

    <!-- Flatpickr (multi-date picker) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
<div class="page-wrapper">
    <div class="main-container">
        <!-- Sidebar Component -->
        <x-sidebar-physio/>

        <!-- App container -->
        <div class="app-container">
            <!-- Header Component -->
            <x-header/>

            <!-- Hero Header -->
            <div class="app-hero-header d-flex justify-content-between align-items-center">
                <!-- Breadcrumb -->
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/homepage') }}"><i class="ri-home-3-line"></i></a>
                    </li>
                    <li class="breadcrumb-item text-primary">Add exercises</li>
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

                                <div class="search-wrapper ms-2">
                                    <input type="text" class="form-control physio-search" placeholder="Search" id="searchInput">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>

                            <div class="physio-exercise-list" id="exerciseList">
                            </div>

                            <button class="btn physio-add-selected mt-3" id="addSelectedBtn">
                                Add all selected to calendar
                            </button>
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
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content p-3">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Exercises to Calendar</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <!-- Per-exercise items worden hier geïnjecteerd -->
                            <div id="modalExercisesContainer"></div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="modalAddBtn">Add to Calendar</button>
                        </div>
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

            <!-- ================= Exercise Details Modal ================= -->
            <div class="modal fade" id="exerciseDetailModal" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content p-3">

                        <div class="modal-header">
                            <h4 id="detailExerciseName" class="modal-title"></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <!-- Reference Video (optioneel, als backend video_url teruggeeft) -->
                            <div id="detailVideoWrapper" class="mb-3" style="display:none;">
                                <label class="fw-bold mb-2">Reference video:</label>
                                <video id="detailVideo" controls width="100%" style="border-radius:8px;" crossorigin="anonymous"></video>
                            </div>

                            <!-- Frequency -->
                            <div class="mb-3">
                                <label class="fw-bold">Frequency</label>
                                <input type="text" class="form-control" id="detailFrequency" placeholder="e.g., 3×10 sets">
                            </div>

                            <!-- Upload new video -->
                            <div class="mb-3">
                                <label class="fw-bold">Upload new reference video</label>
                                <input type="file" class="form-control" id="detailFileInput" accept="video/*">
                                <small id="detailAnalysisText" class="text-muted"></small>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-danger me-auto" id="detailRemoveBtn">Remove from calendar</button>
                            <button class="btn btn-primary" id="detailSaveBtn">Save frequency</button>
                        </div>

                    </div>
                </div>
            </div>

        </div> <!-- /.app-container -->
    </div> <!-- /.main-container -->
</div> <!-- /.page-wrapper -->

<!-- SCRIPTS -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>

<!-- Flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Tensorflow & BlazePose -->
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@4.12.0"></script>
<script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/pose-detection"></script>
<script src="https://cdn.jsdelivr.net/npm/@mediapipe/pose"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // ----- Globals -----
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
        const metaUser = document.querySelector('meta[name="user-id"]')?.getAttribute('content');
        const userId = metaUser && metaUser !== '' ? metaUser : 1; // fallback voor testen

        const exerciseList = document.getElementById("exerciseList");
        const addExerciseBtn = document.getElementById("addExerciseBtn");
        const addExerciseModalEl = document.getElementById('addExerciseModal');
        const addExerciseModal = new bootstrap.Modal(addExerciseModalEl);
        const addExerciseModalBtn = document.getElementById('addExerciseModalBtn');
        const newExerciseName = document.getElementById('newExerciseName');

        const addSelectedBtn = document.getElementById("addSelectedBtn");
        const calendarBody = document.querySelector("#calendarTable tbody");
        const modalAddBtn = document.getElementById("modalAddBtn");
        const calTitle = document.getElementById("calTitle");
        const prevWeekBtn = document.getElementById("prevWeek");
        const nextWeekBtn = document.getElementById("nextWeek");
        const container = document.getElementById("modalExercisesContainer");

        // Detail modal elements
        const detailModalEl = document.getElementById('exerciseDetailModal');
        const detailModal = new bootstrap.Modal(detailModalEl);
        const detailExerciseNameEl = document.getElementById("detailExerciseName");
        const detailFrequencyInput = document.getElementById("detailFrequency");
        const detailFileInput = document.getElementById("detailFileInput");
        const detailAnalysisText = document.getElementById("detailAnalysisText");
        const detailVideoWrapper = document.getElementById("detailVideoWrapper");
        const detailVideo = document.getElementById("detailVideo");
        const detailSaveBtn = document.getElementById("detailSaveBtn");
        const detailRemoveBtn = document.getElementById("detailRemoveBtn"); // ⬅️ NIEUW

        let detector = null;
        let currentWeekOffset = 0; // hoeveel weken van huidige
        let calendarEntries = [];  // alle calendar entries (server + nieuw)
        let detailNewAnalysis = null; // nieuwe analyse uit detail modal

        // ---- TensorFlow Detector ----
        async function ensureDetector() {
            if (!detector) {
                detector = await poseDetection.createDetector(
                    poseDetection.SupportedModels.BlazePose,
                    {
                        runtime: 'mediapipe',
                        modelType: 'full',
                        solutionPath: 'https://cdn.jsdelivr.net/npm/@mediapipe/pose'
                    }
                );
            }
        }

        function calcAngle2D(a, b, c) {
            const ab = {x: a.x - b.x, y: a.y - b.y};
            const cb = {x: c.x - b.x, y: c.y - b.y};
            const dot = ab.x * cb.x + ab.y * cb.y;
            const abLen = Math.hypot(ab.x, ab.y);
            const cbLen = Math.hypot(cb.x, cb.y);
            const cos = Math.min(1, Math.max(-1, dot / (abLen * cbLen)));
            return Math.acos(cos) * (180 / Math.PI);
        }

        function ema(prev, value, alpha = 0.3){
            return prev == null ? value : prev * (1 - alpha) + value * alpha;
        }

        async function analyseVideo(file, side='auto') {
            await ensureDetector();

            return new Promise((resolve, reject) => {
                const video = document.createElement("video");
                video.src = URL.createObjectURL(file);
                video.crossOrigin = "anonymous";
                video.muted = true;

                video.addEventListener('loadedmetadata', () => {
                    video.play().catch(()=>{});
                });

                const angles = [];
                let emaAngle = null;
                const fps = 15;
                const frameInterval = 1000 / fps;

                const interval = setInterval(async () => {
                    if (video.paused || video.ended || isNaN(video.duration)) {
                        clearInterval(interval);
                        const validAngles = angles.filter(a => a != null);
                        const neutral = validAngles.length ? validAngles[0] : 0;
                        const maxAngle = validAngles.length ? Math.max(...validAngles) : neutral;
                        const minAngle = validAngles.length ? Math.min(...validAngles) : neutral;

                        let peakAngle = neutral, peakIndex = 0, direction = 'neutral';
                        if (validAngles.length) {
                            if (Math.abs(maxAngle - neutral) >= Math.abs(minAngle - neutral)) {
                                peakAngle = maxAngle;
                                peakIndex = angles.indexOf(maxAngle);
                                direction = 'extension';
                            } else {
                                peakAngle = minAngle;
                                peakIndex = angles.indexOf(minAngle);
                                direction = 'flexion';
                            }
                        }

                        const maxDiff = peakAngle - neutral;
                        resolve({ fps, neutralAngle: neutral, peakAngle, peakIndex, maxDiff, direction, angles });
                        return;
                    }

                    try {
                        const poses = await detector.estimatePoses(video);
                        if (poses.length > 0) {
                            const kp = poses[0].keypoints;
                            const left = {
                                hip: kp.find(k => k.name === 'left_hip'),
                                knee: kp.find(k => k.name === 'left_knee'),
                                ankle: kp.find(k => k.name === 'left_ankle')
                            };
                            const right = {
                                hip: kp.find(k => k.name === 'right_hip'),
                                knee: kp.find(k => k.name === 'right_knee'),
                                ankle: kp.find(k => k.name === 'right_ankle')
                            };
                            let leg;
                            if (side === 'auto') {
                                const lScore = (left.hip?.score || 0) + (left.knee?.score || 0) + (left.ankle?.score || 0);
                                const rScore = (right.hip?.score || 0) + (right.knee?.score || 0) + (right.ankle?.score || 0);
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
                        } else {
                            angles.push(null);
                        }
                    } catch (e) {
                        console.error('pose error', e);
                        angles.push(null);
                    }
                }, frameInterval);
            });
        }

        // ----- Helper: POST JSON with CSRF -----
        async function postJSON(url, body) {
            try {
                const res = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(body)
                });
                if (!res.ok) {
                    const txt = await res.text();
                    console.warn('POST', url, 'failed', res.status, txt);
                    throw new Error(`HTTP ${res.status}`);
                }
                return res.json();
            } catch (e) {
                console.warn('postJSON failed for', url, e);
                return { error: true, message: e.message || '' };
            }
        }

        async function saveReferenceAnalysis(exerciseName, analysisData) {
            if (!exerciseName) return { error: true };
            return await postJSON('/reference-analysis', {
                exercise: exerciseName,
                payload: analysisData || {}
            });
        }
        async function uploadReferenceVideo(exerciseName, file, payload) {
            const form = new FormData();
            form.append("exercise", exerciseName);
            form.append("payload", JSON.stringify(payload));
            form.append("video", file);

            return await fetch("/reference-video",{
                method:"POST",
                headers:{ "X-CSRF-TOKEN":csrfToken },
                body:form
            }).then(r=>r.json());
        }

        async function saveCalendarEntry(user_id, dateISO, exerciseName, settings = {}) {
            try {
                return await postJSON('/calendar-exercise', {
                    user_id,
                    date: dateISO,
                    exercise: exerciseName,
                    settings
                });
            } catch (e) {
                console.error('saveCalendarEntry error', e);
                return { error: true };
            }
        }

        // ⬇️ NIEUWE helper voor verwijderen van 1 entry (1 datum)
        async function deleteCalendarEntry(user_id, dateISO, exerciseName) {
            try {
                return await postJSON('/calendar-exercise/delete', {
                    user_id,
                    date: dateISO,
                    exercise: exerciseName
                });
            } catch (e) {
                console.error('deleteCalendarEntry error', e);
                return { error: true };
            }
        }

        async function syncUserExercises(user_id, namesArray) {
            return await postJSON('/user-exercises/sync', {
                user_id,
                exercises: namesArray
            });
        }

        // ----- Remove buttons links -----
        function ensureRemoveButtons() {
            exerciseList.querySelectorAll('.physio-ex-item .remove-ex').forEach(btn => {
                if (btn.dataset.bound === '1') return;
                btn.dataset.bound = '1';
                btn.addEventListener('click', ev => {
                    ev.stopPropagation();
                    const item = btn.closest('.physio-ex-item');
                    if (item) {
                        item.remove();
                        const names = [...exerciseList.querySelectorAll('.physio-ex-item')]
                            .map(n => n.textContent.replace('×', '').trim());
                        syncUserExercises(userId, names).catch(()=>{});
                    }
                });
            });
        }

        // ---- Load existing user exercises ----
        async function loadUserExercises() {
            try {
                const res = await fetch('/user-exercises', {
                    method: 'GET',
                    headers: { 'X-CSRF-TOKEN': csrfToken }
                });
                if (res.ok) {
                    const data = await res.json();
                    if (Array.isArray(data.exercises)) {
                        exerciseList.innerHTML = '';
                        data.exercises.forEach(name => {
                            const div = document.createElement('div');
                            div.className = 'physio-ex-item';
                            div.innerHTML = `
                                <span class="exercise-name-text">${name}</span>
                                <button class="btn btn-sm btn-link text-danger remove-ex" title="Remove">×</button>
                            `;
                            exerciseList.appendChild(div);
                        });
                        ensureRemoveButtons();
                    }
                }
            } catch (e) {
                console.warn('Failed to load user exercises:', e);
            }
        }

        // ---- Load existing calendar entries ----
        async function loadCalendarEntries() {
            try {
                const res = await fetch('/user-calendar', {
                    method: 'GET',
                    headers: { 'X-CSRF-TOKEN': csrfToken }
                });
                if (res.ok) {
                    const data = await res.json();
                    if (Array.isArray(data.entries)) {
                        // Verwacht: entries = [{exercise, date, settings: {frequency, analysis, (optioneel) video_url}}]
                        calendarEntries = data.entries;
                        renderCalendarForWeek();
                    }
                }
            } catch (e) {
                console.warn('Failed to load calendar entries:', e);
            }
        }

        // === OPEN DETAIL MODAL ON ROW CLICK ===
        calendarBody.addEventListener("click", function(e){
            const row = e.target.closest("tr");
            if(!row) return;
            const exerciseName = row.querySelector(".ex-name")?.innerText.trim();
            if (!exerciseName) return;
            openDetailModal(exerciseName);
        });

        // ---- Add Exercise Modal ----
        addExerciseBtn.addEventListener('click', () => {
            newExerciseName.value = '';
            addExerciseModal.show();
        });

        addExerciseModalBtn.addEventListener('click', async () => {
            const name = newExerciseName.value.trim();
            if (!name) {
                alert('Please enter a name.');
                return;
            }

            const div = document.createElement('div');
            div.className = 'physio-ex-item';
            div.innerHTML = `
                <span class="exercise-name-text">${name}</span>
                <button class="btn btn-sm btn-link text-danger remove-ex" title="Remove">×</button>
            `;
            exerciseList.appendChild(div);
            addExerciseModal.hide();

            ensureRemoveButtons();

            const names = [...exerciseList.querySelectorAll('.physio-ex-item')]
                .map(n => n.textContent.replace('×','').trim());
            await syncUserExercises(userId, names).catch(()=>{});
        });

        // ---- Select/deselect exercises ----
        exerciseList.addEventListener('click', e => {
            if (e.target.closest('.remove-ex')) return;
            const item = e.target.closest('.physio-ex-item');
            if (item) item.classList.toggle('selected');
        });

        // ---- Search filter ----
        document.getElementById('searchInput').addEventListener('input', () => {
            const search = document.getElementById('searchInput').value.toLowerCase();
            exerciseList.querySelectorAll('.physio-ex-item').forEach(item => {
                const text = item.textContent.replace('×','').toLowerCase();
                item.style.display = text.includes(search) ? 'flex' : 'none';
            });
        });

        // ---- Add selected exercises to modal ----
        addSelectedBtn.addEventListener('click', () => {
            const selected = [...exerciseList.querySelectorAll('.physio-ex-item.selected')];
            if (!selected.length) {
                alert('Select at least one exercise.');
                return;
            }

            container.innerHTML = '';

            selected.forEach(ex => {
                const name = ex.querySelector('.exercise-name-text')?.textContent?.trim()
                    || ex.textContent.replace('×','').trim();

                const div = document.createElement('div');
                div.className = 'mb-3 p-3 border rounded exercise-modal-item';

                div.innerHTML = `
                    <h5 class="mb-3 modal-exercise-title">${name}</h5>

                    <div class="modal-input-group">
                        <label>Frequency</label>
                        <input type="text" class="modal-input frequency-input" placeholder="e.g., 3×10 sets">
                    </div>

                    <div class="modal-input-group">
                        <label>Select dates</label>
                        <div class="input-with-icon">
                            <input type="text"
                                   class="modal-input select-days-input date-picker-input"
                                   placeholder="Choose dates">
                            <i class="ri-calendar-2-line calendar-icon"></i>
                        </div>
                    </div>

                    <div class="modal-input-group">
                        <label>Upload video</label>
                        <input type="file" class="modal-input file-input" accept="video/*">
                        <small class="text-muted analysisStatus"></small>
                    </div>
                `;

                div._flatpickr = null;
                container.appendChild(div);

                const dateInput = div.querySelector('.date-picker-input');

                // Flatpickr: week begint op maandag
                div._flatpickr = flatpickr(dateInput, {
                    mode: "multiple",
                    dateFormat: "Y-m-d",
                    locale: {
                        firstDayOfWeek: 1 // maandag als eerste dag
                    }
                });

                const fileInput = div.querySelector('.file-input');
                const statusEl = div.querySelector('.analysisStatus');

                fileInput.addEventListener('change', async () => {
                    const file = fileInput.files[0];
                    if (!file) return;
                    statusEl.textContent = "Analyzing video...";

                    const result = await analyseVideo(file);
                    div.dataset.analysis = JSON.stringify(result);

                    statusEl.textContent = "Uploading reference video...";

                    const response = await uploadReferenceVideo(name,file,result);

                    statusEl.textContent = response.success ? "Saved ✓" : "Error saving";
                });
            });

            new bootstrap.Modal(document.getElementById('addModal')).show();
        });

        // ---- Modal: Add to calendar ----
        modalAddBtn.addEventListener('click', async () => {
            const exercises = document.querySelectorAll('.exercise-modal-item');
            if (!exercises.length) return;

            for (const div of exercises) {
                const name = div.querySelector('h5').textContent;
                const freq = div.querySelector('.frequency-input').value.trim();
                const fp = div._flatpickr;
                const analysisJSON = div.dataset.analysis ? JSON.parse(div.dataset.analysis) : null;

                if (!freq) {
                    alert(`Please fill in frequency for ${name}`);
                    return;
                }

                if (!fp || !fp.selectedDates.length) {
                    alert(`Please select at least one date for ${name}`);
                    return;
                }

                if (!analysisJSON) {
                    alert(`Please upload and analyze a video for ${name}`);
                    return;
                }

// ↓ blijft zoals het was
                const dates = fp.selectedDates.map(d => fp.formatDate(d, "Y-m-d"));


                for (const iso of dates) {
                    const settings = {
                        frequency: freq,
                        analysis: analysisJSON
                        // optional: video_url kun je hier toevoegen als backend het terugstuurt na upload
                    };
                    const res = await saveCalendarEntry(userId, iso, name, settings).catch(()=>{});
                    if (!res || !res.error) {
                        calendarEntries.push({
                            exercise: name,
                            date: iso,
                            settings
                        });
                    }
                }
            }

            renderCalendarForWeek();

            document.querySelectorAll('.physio-ex-item.selected')
                .forEach(el => el.classList.remove('selected'));

            bootstrap.Modal.getInstance(document.getElementById('addModal')).hide();
        });

        // ---- Calendar helpers ----
        function getISOWeekMonday(date, offsetWeeks = 0){
            const d = new Date(date);
            const day = d.getDay();
            const diff = (day === 0 ? -6 : 1 - day); // zondag=0 → -6, anders 1-maandag
            d.setDate(d.getDate() + diff + offsetWeeks * 7);
            d.setHours(0,0,0,0);
            return d;
        }

        function getISOWeekNumber(date){
            const d = new Date(date);
            d.setHours(0,0,0,0);
            d.setDate(d.getDate() + 3 - (d.getDay()+6)%7);
            const week1 = new Date(d.getFullYear(),0,4);
            return 1 + Math.round(((d - week1)/86400000 - 3 + (week1.getDay()+6)%7)/7);
        }

        // 🎯 BELANGRIJK: lokale datum, geen toISOString()
        function formatDate(date){
            const y = date.getFullYear();
            const m = String(date.getMonth() + 1).padStart(2, '0');
            const d = String(date.getDate()).padStart(2, '0');
            return `${y}-${m}-${d}`;
        }

        function updateCalendarTitle(){
            const monday = getISOWeekMonday(new Date(), currentWeekOffset);
            const sunday = new Date(monday);
            sunday.setDate(monday.getDate() + 6);
            const weekNumber = getISOWeekNumber(monday);
            calTitle.textContent = `Week ${weekNumber} (${formatDate(monday)} - ${formatDate(sunday)})`;
        }

        function renderCalendarForWeek() {
            calendarBody.innerHTML = "";

            const monday = getISOWeekMonday(new Date(), currentWeekOffset);

            // Mapping voor maandag t/m zondag
            const dateToCol = {};
            for (let i = 0; i < 7; i++) {
                const d = new Date(monday);
                d.setDate(monday.getDate() + i);
                const iso = formatDate(d);  // lokale YYYY-MM-DD
                dateToCol[iso] = i;
            }

            const rows = {};

            calendarEntries.forEach(entry => {
                const iso = String(entry.date).split("T")[0];

                if (!(iso in dateToCol)) {
                    return; // datum niet in huidige week
                }

                const exercise = entry.exercise;

                if (!rows[exercise]) {
                    rows[exercise] = Array(7).fill("");
                }

                const col = dateToCol[iso];
                rows[exercise][col] = entry.settings?.frequency || "";
            });

            Object.keys(rows).forEach(exName => {
                const tr = document.createElement("tr");
                tr.innerHTML =
                    `<td class="ex-name">${exName}</td>` +
                    rows[exName].map(v => `<td>${v}</td>`).join("");
                calendarBody.appendChild(tr);
            });
        }

        prevWeekBtn.addEventListener('click', () => {
            currentWeekOffset--;
            updateCalendarTitle();
            renderCalendarForWeek();
        });

        nextWeekBtn.addEventListener('click', () => {
            currentWeekOffset++;
            updateCalendarTitle();
            renderCalendarForWeek();
        });

        updateCalendarTitle();

        // ========= DETAIL MODAL LOGIC =========
        async function openDetailModal(exerciseName) {
            detailNewAnalysis = null;
            detailExerciseNameEl.textContent = exerciseName;
            detailAnalysisText.textContent = "";
            detailFileInput.value = "";
            detailVideoWrapper.style.display = "none";
            detailVideo.removeAttribute("src");

            // Zoek een bestaand entry voor deze oefening om frequency te tonen
            const existingEntry = calendarEntries.find(e => e.exercise === exerciseName && e.settings);
            detailFrequencyInput.value = existingEntry?.settings?.frequency || "";

            // Optioneel: probeer reference video op te halen
            try {
                const res = await fetch(`/reference/${encodeURIComponent(exerciseName)}`);
                if (res.ok) {
                    const data = await res.json();
                    if (data && data.video_url) {
                        detailVideoWrapper.style.display = "block";
                        detailVideo.src = data.video_url;
                    }
                }
            } catch (err) {
                console.warn('No reference video found or error:', err);
            }

            detailModal.show();
        }

        // Nieuwe video uploaden & analyseren vanuit detail modal
        detailFileInput.addEventListener("change", async () => {
            const file = detailFileInput.files[0];
            if (!file) return;

            detailAnalysisText.textContent = "Analyzing new reference video...";

            try {
                const result = await analyseVideo(file);
                detailNewAnalysis = result;
                const name = detailExerciseNameEl.textContent.trim();

                // Opslaan van analyse
                const saved = await saveReferenceAnalysis(name, result);

                // NU OOK VIDEO UPLOADEN
                detailAnalysisText.textContent = "Uploading video...";
                const upload = await uploadReferenceVideo(name, file, result);

                if(upload?.video_url){
                    // Toon direct de nieuw geüploade video
                    detailVideoWrapper.style.display = "block";
                    detailVideo.src = upload.video_url;
                    detailAnalysisText.textContent = "New video saved ✓";
                } else {
                    detailAnalysisText.textContent = "Uploaded, but no video URL returned";
                }

            } catch (e) {
                console.error(e);
                detailAnalysisText.textContent = "Upload or analysis failed.";
            }
        });


        // Save changes
        detailSaveBtn.addEventListener("click", async () => {
            const name = detailExerciseNameEl.textContent.trim();
            const freq = detailFrequencyInput.value;

            // zoek ALLE rijen in deze week met dezelfde oefening
            const entriesToUpdate = calendarEntries.filter(e => e.exercise === name);

            for (const entry of entriesToUpdate) {
                entry.settings.frequency = freq; // update in geheugen

                if(detailNewAnalysis){
                    entry.settings.analysis = detailNewAnalysis; // voeg analyse toe indien nieuw
                }

                // 🔥 juiste route hier!
                await postJSON("/calendar-update", {
                    user_id: userId,
                    date: entry.date,
                    exercise: name,
                    settings: entry.settings
                });
            }

            detailModal.hide();
            renderCalendarForWeek();

        });


        // ✅ NIEUW: Remove exercise from current week vanuit detail modal
        detailRemoveBtn.addEventListener("click", async () => {
            const name = detailExerciseNameEl.textContent.trim();
            if (!name) return;

            if (!confirm(`Remove "${name}" from this week?`)) return;

            const monday = getISOWeekMonday(new Date(), currentWeekOffset);
            const start = formatDate(monday);

            const endDate = new Date(monday);
            endDate.setDate(monday.getDate()+6);
            const end = formatDate(endDate);

            const result = await postJSON('/calendar-exercise/delete-week',{
                user_id:userId,
                exercise:name,
                start,
                end
            });

            if(result.success){
                calendarEntries = calendarEntries.filter(e => !(e.exercise===name && e.date>=start && e.date<=end));
                detailModal.hide();
                renderCalendarForWeek();
            }else{
                alert("Failed to delete");
            }
        });


        // ---- Init ----
        (async function init() {
            ensureRemoveButtons();
            await loadUserExercises();
            await loadCalendarEntries();
            ensureRemoveButtons();
        })();
    });
</script>


</body>
</html>
