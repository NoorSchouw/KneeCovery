<!DOCTYPE html>
<html lang="en">
{{--Patient--}}
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

                {{-- Dropdown --}}
                <div class="mb-3">
                    <select name="execution_id" id="executionSelect" class="form-select" required>
                        <option value="">Select an execution</option>
                        @foreach($executions as $exec)
                            <option value="{{ $exec->execution_id }}"
                                    @if($execution && $execution->execution_id == $exec->execution_id) selected @endif>
                                {{ optional($exec->calendarEntry->exercise)->exercise_name ?? 'Onbekende oefening' }}
                                — {{ \Carbon\Carbon::parse($exec->execution_date)->format('d-m-Y') }}
                                {{ $exec->start_time ? '(' . substr($exec->start_time,0,5) . ')' : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <!-- Content area: video, report, gauge -->
                <div class="row gx-4">

                    <!-- Video -->
                    <div class="col-xl-4 col-lg-12 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Recorded Video</h5>
                            </div>
                            <div class="card-body text-center" id="video-container">
                                <video id="executionVideo" width="100%" controls @if(!$execution) style="display:none" @endif>
                                    <source id="videoSource"
                                            src="{{ $execution && $execution->execution_video_path ? url('/video/' . $execution->execution_id) : '' }}"
                                            type="video/webm">
                                </video>

                            @if(!$execution)
                                    <p id="noVideoText" @if($execution && $execution->execution_video_path) style="display:none" @endif>
                                        No video available.
                                    </p>
                                @endif
                            </div>

                        </div>
                    </div>

                    <!-- Feedback -->
                    <div class="col-xl-4 col-lg-12 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Patient Report</h5>
                            </div>
                            <div class="card-body" id="patient-report">
                                <p id="feedbackText">{{ $execution ? $execution->feedback : 'No feedback available.' }}</p>


                            </div>

                        </div>
                    </div>

                    <!-- Match percentage -->
                    <div class="col-xl-4 col-lg-12 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Match Percentage</h5>
                            </div>
                            <div class="card-body text-center">
                                <h2 id="matchPercentage">{{ $execution ? round($execution->match_percentage) . '%' : '0%' }}</h2>
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


