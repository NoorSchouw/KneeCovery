<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patient Report Dashboard</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/remix/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/daterange/daterange.css') }}">
</head>

<body>
{{--Tijdelijk!!!--}}
<div style="background:#111;color:#0f0;padding:10px;font-size:12px">
    <strong>DEBUG EXECUTIONS</strong><br>

    Aantal executions: {{ $executions->count() }}

    <br><br>

    @if($executions->isEmpty())
        GEEN EXECUTIONS GEVONDEN
    @else
        @foreach($executions as $exec)
            ID: {{ $exec->execution_id ?? 'NULL' }} |
            Date: {{ $exec->execution_date ?? 'NULL' }} |
            Exercise: {{ optional($exec->assignment->exercise)->exercise_name ?? 'NO EXERCISE' }} |
            Score: {{ $exec->score ?? 'NULL' }}
            <br>
        @endforeach
    @endif
</div>

{{--EInde --}}

<div class="page-wrapper">

    <!-- Main container starts -->
    <div class="main-container">

        <!-- Sidebar Component -->
        <x-sidebar-patient/>

        <!-- App container starts -->
        <div class="app-container">

            <x-header/>

            <!-- Hero Header -->
            <div class="app-hero-header d-flex justify-content-between align-items-center">
                <!-- Breadcrumb -->
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/homepage') }}"><i class="ri-home-3-line"></i></a>
                    </li>
                    <li class="breadcrumb-item text-primary">Report</li>
                </ol>
            </div>

            <!-- App body starts -->
            <div class="app-body p-4">

                <!-- Patiënt info -->
                <div class="mb-3">
                    <h2 class="patient-name" >Report</h2>

                </div>

                <div class="row mb-3">
                    <!-- Date picker -->
                    <div class="col-md-4">
                        <label class="label-date">Date</label>
                        <input type="text" id="report-date" class="form-control form-control-sm" />
                    </div>

                    <!-- Exercise select -->
                    <div class="col-md-4">
                        <label class="label-exercise">Exercise</label>
                        <select id="exercise-select" class="form-control form-control-sm">
                            @foreach($executions->unique('assignment_id') as $exec)
                                <option value="{{ $exec->assignment_id }}"
                                        data-latest-date="{{ $exec->execution_date }}">
                                    {{ $exec->assignment->exercise->exercise_name }}
                                </option>
                            @endforeach
                        </select>

                    </div>
                </div>



                <!-- Content area: video, report, gauge -->
                <div class="row gx-4">

                    <!-- Video -->
                    <div class="col-xl-4 col-lg-12 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Recorded Video</h5>
                            </div>
                            <div class="card-body text-center">
                                <video width="100%" controls>
                                    <source src="http://localhost/filming/sample.mp4" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    </div>

                    <!-- Report text -->
                    <div class="col-xl-4 col-lg-12 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Patient Report</h5>
                            </div>
                            <div class="card-body">
                                <p>Report content will appear here. This is backend generated.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Gauge -->
                    <div class="col-xl-4 col-lg-12 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Match with example exercise </h5>
                            </div>
                            <div class="card-body">
                                <div id="gauge" style="height: 250px;"></div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Row end -->

            </div>
            <!-- App body ends -->

        </div>
        <!-- App container ends -->

    </div>
    <!-- Main container ends -->

</div>
<!-- Page wrapper ends -->

<!-- JS -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets/vendor/daterange/daterange.js') }}"></script>
<script src="{{ asset('assets/vendor/apex/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/js/Report.js') }}"></script>
</body>

</html>
