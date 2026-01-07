<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KneeCovery</title>
    <meta name="description" content="Overview page for the patient">
    <meta property="og:title" content="KneeCovery">
    <meta property="og:type" content="Website">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/remix/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/jquery-ui/jquery-ui.min.css') }}">
</head>

<body>

<div class="page-wrapper">
    <div class="main-container">

        <x-sidebar-patient/>

        <div class="app-container">

            <x-header/>

            <div class="app-hero-header d-flex align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <i class="ri-home-3-line"></i>
                    </li>
                </ol>
            </div>

            <div class="app-body">
                <div class="row gx-4">

                    <!-- LEFT COLUMN: Graphs -->
                    <div class="col-xxl-9 col-sm-12">

                        <div class="d-flex gap-2 mb-3">
                            <select id="exerciseSelector" class="form-select form-select-sm">
                                @foreach($exercises as $exercise)
                                    <option value="{{ $exercise->exercise_name }}">{{ $exercise->exercise_name }}</option>
                                @endforeach
                            </select>

                            <select id="rangeSelector" class="form-select form-select-sm">
                                <option value="week">Week</option>
                                <option value="2weeks">2 weeks</option>
                                <option value="month">Month</option>
                            </select>
                        </div>

                        <!-- Match % Progress -->
                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <h5 class="card-title">Match % Progress</h5>
                            </div>
                            <div class="card-body pt-0">
                                <div id="Progress"></div>
                            </div>
                        </div>

                        <!-- Knee Metrics -->
                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <h5 class="card-title">Knee Metrics (Flexion/Extension)</h5>
                            </div>
                            <div class="card-body pt-0">
                                <div id="Knee-extension-flexion"></div>
                            </div>
                        </div>

                    </div>

                    <!-- RIGHT COLUMN: Calendar & Exercises -->
                    <div class="col-xxl-3 col-sm-12">

                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <h5 class="card-title">Exercises</h5>
                            </div>
                            <div class="card-body">

                                <!-- Calendar -->
                                <div class="mb-3">
                                    <div id="datepicker"></div>
                                </div>

                                <!-- Exercise list -->
                                <div class="scroll300">
                                    <div class="d-grid gap-2" id="exercise-list">
                                        <div class="text-muted text-center">Select a date</div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- JS -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/vendor/apex/apexcharts.min.js') }}"></script>

<script>
    $(function () {

        // ---------- Calendar ----------
        function loadExercises(date) {
            $('#exercise-list').html('<div class="text-muted text-center">Loading...</div>');

            $.get(`/homepage/calendar/${date}`, function (data) {
                if (!data.length) {
                    $('#exercise-list').html('<div class="text-muted text-center">No exercises</div>');
                    return;
                }

                let html = '';
                data.forEach(exercise => {
                    html += `
                    <a href="/filming" class="appointment-card d-flex flex-column gap-1">
                        <div class="fw-semibold">${exercise.name}</div>
                        ${exercise.frequency ? `<span class="badge bg-danger w-fit">${exercise.frequency}</span>` : ''}
                    </a>
                `;
                });

                $('#exercise-list').html(html);
            });
        }

        $('#datepicker').datepicker({
            dateFormat: 'yy-mm-dd',
            prevText: 'Prev',
            nextText: 'Next',
            onSelect: function (dateText) { loadExercises(dateText); }
        });

        const today = $.datepicker.formatDate('yy-mm-dd', new Date());
        $('#datepicker').datepicker('setDate', today);
        loadExercises(today);

        // ---------- Graphs ----------
        function loadProgressGraph(exercise, range) {
            $.get('/homepage/progress', { exercise, range }, function(data) {
                if (!data.length) {
                    $('#Progress').html('<div class="text-center text-muted">No data for this exercise</div>');
                    return;
                }

                let dates = data.map(d => d.execution_date);
                let percentages = data.map(d => d.match_percentage);

                let options = {
                    chart: { type: 'line', height: 300 },
                    series: [{ name: 'Match %', data: percentages }],
                    xaxis: { categories: dates },
                    stroke: { curve: 'smooth', width: 3 , colors: ['#FD98B1'] },
                    markers: {
                        size: 3,
                        colors: ['#FD98B1'],       // fill color of markers
                        strokeColors: ['#FD98B1'] , // border color of markers
                        strokeWidth: 2
                    },
                    tooltip: {
                        marker: {
                            show: true,
                            fillColors: ['#FD98B1','#FAAA89FF'],
                            strokeColors: ['#FD98B1','#FAAA89FF']
                        }
                    },
                };

                $('#Progress').html('');
                new ApexCharts(document.querySelector("#Progress"), options).render();
            });
        }

        function loadKneeMetricsGraph(exercise, range) {
            $.get('/homepage/knee-metrics', { exercise, range }, function(data) {
                if (!data.length) {
                    $('#Knee-extension-flexion').html('<div class="text-center text-muted">No data for this exercise</div>');
                    return;
                }

                let dates = data.map(d => d.execution_date);
                let maxAngles = data.map(d => d.max_angle);
                let minAngles = data.map(d => d.min_angle);

                let options = {
                    chart: { type: 'line', height: 300 },
                    series: [
                        { name: 'Max Angle', data: maxAngles },
                        { name: 'Min Angle', data: minAngles }
                    ],
                    xaxis: { categories: dates },
                    stroke: { curve: 'smooth', width: 3, colors: ['#FD98B1','#FAAA89FF'] },
                    markers: {
                        size: 3,
                        colors: ['#FD98B1','#FAAA89FF'],       // fill color of markers
                        strokeColors: ['#FD98B1','#FAAA89FF'], // border color of markers
                        strokeWidth: 2
                    },
                    tooltip: {
                        marker: {
                            show: true,
                            fillColors: ['#FD98B1','#FAAA89FF'],
                            strokeColors: ['#FD98B1','#FAAA89FF']
                        }
                    },

                    // ---------- LEGEND COLORS ----------
                    legend: {
                        markers: {
                            width: 12,
                            height: 12,
                            radius: 12, // round circles
                            fillColors: ['#FD98B1','#FAAA89FF'] // pink for max, orange for min
                        }
                    }
                };

                $('#Knee-extension-flexion').html('');
                new ApexCharts(document.querySelector("#Knee-extension-flexion"), options).render();
            });
        }

        function loadGraphs() {
            let exercise = $('#exerciseSelector').val();
            let range = $('#rangeSelector').val();
            loadProgressGraph(exercise, range);
            loadKneeMetricsGraph(exercise, range);
        }

        // Initial load
        loadGraphs();

        // Update graphs on selector change
        $('#exerciseSelector, #rangeSelector').on('change', loadGraphs);

    });
</script>
</body>
</html>
