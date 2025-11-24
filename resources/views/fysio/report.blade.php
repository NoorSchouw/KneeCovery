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
<div class="page-wrapper">

    <!-- Main container starts -->
    <div class="main-container">

        <!-- Sidebar wrapper starts -->
        <nav id="sidebar" class="sidebar-wrapper">
            <!-- Brand -->
            <div class="brand-container d-flex align-items-center justify-content-between">
                <div class="app-brand ms-3">
                    <a href="/homepage">
                        <img src="assets/images/logo.svg" class="logo" alt="Logo">
                    </a>
                </div>
            </div>

            <!-- Sidebar profile starts -->
            <div class="sidebar-profile">
                <img src="assets/images/doctor5.png" class="rounded-5 border border-primary border-3"
                     alt="Dentist Admin Templates">
                <h6 class="mb-1 profile-name text-nowrap text-truncate text-primary">Jennifer Arter</h6>
                <small class="profile-name text-nowrap text-truncate">Department Head</small>
            </div>
            <!-- Sidebar menu, exercises link moet misschien aangepast worden-->
            <div class="sidebarMenuScroll">
                <ul class="sidebar-menu">
                    <li><a href="/patients"><i class="ri-home-6-line"></i> <span class="menu-text">Homepage</span></a></li>
                    <li><a href="/report"><i class="ri-file-text-line"></i> <span class="menu-text">Report</span></a></li>
                    <li><a href="/exercises"><i class="ri-add-line"></i> <span class="menu-text">Add Exercise</span></a></li>
                </ul>
            </div>

        </nav>


        <!-- App container starts -->
        <div class="app-container">

            <!-- App header (leeg) -->
            <div class="app-header d-flex align-items-center"></div>

            <!-- App body starts -->
            <div class="app-body p-4">

                <!-- Patiënt info -->
                <div class="mb-3">
                    <h2 class="patient-name" >Report Jane Doe (Female)</h2>

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
                            <option>Heel slide</option>
                            <option>Squat</option>
                            <option>Hamstring curls</option>
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
<script src="{{ asset('assets/js/Fysio.js') }}"></script>
</body>

</html>
