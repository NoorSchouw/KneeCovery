<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Physio – Patient Report</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/remix/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/daterange/daterange.css') }}">
</head>

<body>
<div class="page-wrapper">

    <div class="main-container">

        <!-- Sidebar for physio -->
        <x-sidebar-physio/>

        <div class="app-container">

            <x-header/>

            <!-- Hero header -->
            <div class="app-hero-header d-flex justify-content-between align-items-center">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/homepage') }}"><i class="ri-home-3-line"></i></a>
                    </li>
                    <li class="breadcrumb-item text-primary">Report</li>
                </ol>
            </div>

            <!-- MAIN BODY -->
            <div class="app-body p-4">

                <!-- Patient info -->
                <div class="mb-3">
                    <h2 class="patient-name">Report for {{ $patient->name ?? 'Patient' }}</h2>
                </div>

                <!-- FILTERS -->
                <div class="row mb-3">

                    <div class="col-md-4">
                        <label>Date</label>
                        <input type="date" id="report-date" class="form-control form-control-sm">
                    </div>

                    <div class="col-md-4">
                        <label>Exercise</label>
                        <select id="exercise-select" class="form-control form-control-sm">
                            @foreach($exercises as $exercise)
                                <option value="{{ $exercise->assignment_id }}">
                                    {{ $exercise->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <!-- CONTENT ROW -->
                <div class="row gx-4">

                    <!-- VIDEOS -->
                    <div class="col-xl-4 col-lg-12 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Recorded Video</h5>
                            </div>
                            <div class="card-body">
                                <div id="video-container">
                                    <p>Select a date and exercise.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- REPORT -->
                    <div class="col-xl-4 col-lg-12 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Patient Report</h5>
                            </div>
                            <div class="card-body">
                                <p id="patient-report">Select a date to load report.</p>
                            </div>
                        </div>
                    </div>

                    <!-- GAUGE -->
                    <div class="col-xl-4 col-lg-12 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Match with Example Exercise</h5>
                            </div>
                            <div class="card-body">
                                <div id="gauge" style="height:250px;"></div>
                            </div>
                        </div>
                    </div>

                </div><!-- /row -->

            </div>
        </div>

    </div>

</div>

<!-- JS -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets/vendor/daterange/daterange.js') }}"></script>
<script src="{{ asset('assets/vendor/apex/apexcharts.min.js') }}"></script>

<!-- Your logic -->
<script src="{{ asset('assets/js/Fysio.js') }}"></script>

</body>
</html>
