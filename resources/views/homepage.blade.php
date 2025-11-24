<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KneeCovery</title>

    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:title" content="KneeCovery">
    <meta property="og:description" content="Overview page for the patient">
    <meta property="og:type" content="Website">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}">

    <!-- *************
		************ CSS Files *************
	  ************* -->
    <link rel="stylesheet" href="{{  asset ('assets/fonts/remix/remixicon.css') }}">
    <link rel="stylesheet" href="{{  asset ('assets/css/main.css') }}">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/daterange/daterange.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bs5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bs5-custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/buttons/dataTables.bs5-custom.css') }}">
</head>
<body>

<!-- Page wrapper starts -->
<div class="page-wrapper">

    <!-- Main container starts -->
    <div class="main-container">

        <!-- Sidebar Component -->
        <x-sidebar-patient/>

        <!-- App container -->
        <div class="app-container">

            <!-- Header Component -->
            <x-header/>

            <!-- App hero header starts -->
            <div class="app-hero-header d-flex align-items-center">

                <!-- Breadcrumb starts -->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">
                            <i class="ri-home-3-line"></i>
                        </a>
                    </li>
                </ol>
                <!-- Breadcrumb ends -->
            </div>
            <!-- App Hero header ends -->

            <!-- App body starts -->
            <div class="app-body">

                <!-- Row starts -->
                <div class="row gx-4">
                    <div class="col-xxl-9 col-sm-12">

                        <!-- Row starts -->
                        <div class="row gx-4">
                            <div class="col-sm-12"></div>
                            <div class="col-sm-12">
                                <div class="card mb-4">
                                    <div class="card-header pb-0 d-flex align-items-center justify-content-between">
                                        <h5 class="card-title">Progress</h5>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <select id="exerciseSelector" class="form-select form-select-sm" style="width: 180px;">
                                                <option value="heelSlides">Heel Slides</option>
                                                <option value="squat">Squat</option>
                                                <option value="hamstringCurls">Hamstring Curls</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="overflow-hidden">
                                            <div id="Progress"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-4">
                                    <div class="card-header pb-0 d-flex align-items-center justify-content-between">
                                        <h5 class="card-title">Knee extension and flexion</h5>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="overflow-hidden">
                                            <div id="Knee-extension-flexion"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Row ends -->

                    </div>
                    <div class="col-xxl-3 col-sm-12">
                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <h5 class="card-title">Exercises</h5>
                            </div>
                            <div class="card-body">

                                <!-- Date calendar starts -->
                                <div class="datepicker-bg d-flex justify-content-center align-items-center mb-3">
                                    <!-- Loader starts -->
                                    <div id="datepicker-loader" class="text-center">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <!-- Loader ends -->
                                    <div id="datepicker" class="d-none w-100"></div>
                                </div>
                                <!-- Date calendar ends -->

                                <!-- Appointments starts -->
                                <div class="mb-4">
                                    <div class="scroll300">

                                        <!-- Grid starts -->
                                        <div class="d-grid gap-2">

                                            <a href="{{ url('/exercises') }}"
                                               class="d-flex flex-column gap-1 appointment-card">
                                                <div class="fw-semibold">Heel slide</div>
                                                <span class="badge bg-danger w-fit">3x 10</span>
                                            </a>

                                            <a href="{{ url('/exercises') }}"
                                               class="d-flex flex-column gap-1 appointment-card">
                                                <div class="fw-semibold">Squat</div>
                                                <span class="badge bg-danger w-fit">3x 10</span>
                                            </a>

                                            <a href="{{ url('/exercises') }}"
                                               class="d-flex flex-column gap-1 appointment-card">
                                                <div class="fw-semibold">Ham string curls</div>
                                                <span class="badge bg-danger w-fit">3x 10</span>
                                            </a>

                                        </div>
                                        <!-- Grid ends -->

                                    </div>
                                </div>
                                <!-- Appointments ends -->

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row ends -->

            </div>
            <!-- App body ends -->

        </div>
        <!-- App container ends -->

    </div>
    <!-- Main container ends -->

</div>
<!-- Page wrapper ends -->

<!-- JavaScript Files -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>

<!-- Vendor Js Files -->
<script src="{{ asset('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets/vendor/overlay-scroll/custom-scrollbar.js') }}"></script>

<script src="{{ asset('assets/vendor/daterange/daterange.js') }}"></script>
<script src="{{ asset('assets/vendor/daterange/custom-daterange.js') }}"></script>

<script src="{{ asset('assets/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-ui/custom.js') }}"></script>

<script src="{{ asset('assets/vendor/apex/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/apex/custom/home/patients.js') }}"></script>
<script src="{{ asset('assets/vendor/apex/custom/home/department-income.js') }}"></script>
<script src="{{ asset('assets/vendor/apex/custom/home/knee-extension-flexion.js') }}"></script>
<script src="{{ asset('assets/vendor/apex/custom/home/progress.js') }}"></script>
<script src="{{ asset('assets/vendor/apex/custom/home/appointments-overview.js') }}"></script>
<script src="{{ asset('assets/vendor/apex/custom/home/sparklines.js') }}"></script>

<script src="{{ asset('assets/vendor/datatables/dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/custom/custom-datatables.js') }}"></script>

<!-- Custom JS files -->
<script src="{{ asset('assets/js/custom.js') }}"></script>

</body>
</html>
