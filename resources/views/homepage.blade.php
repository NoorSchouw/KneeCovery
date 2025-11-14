<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KneeCovery</title>

    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:title" content="Admin Templates - Dashboard Templates">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
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

<!-- Loading starts -->
<div id="loading-wrapper">
    <div class="spin-wrapper">
        <div class="circle"></div>
        <div class="circle"></div>
    </div>
    <div class="spin-wrapper">
        <div class="circle"></div>
        <div class="circle"></div>
    </div>
    <div class="spin-wrapper">
        <div class="circle"></div>
        <div class="circle"></div>
    </div>
    <div class="spin-wrapper">
        <div class="circle"></div>
        <div class="circle"></div>
    </div>
    <div class="spin-wrapper">
        <div class="circle"></div>
        <div class="circle"></div>
    </div>
    <div class="spin-wrapper">
        <div class="circle"></div>
        <div class="circle"></div>
    </div>
    <div class="spin-wrapper">
        <div class="circle"></div>
        <div class="circle"></div>
    </div>
    <div class="spin-wrapper">
        <div class="circle"></div>
        <div class="circle"></div>
    </div>
    <div class="spin-wrapper">
        <div class="circle"></div>
        <div class="circle"></div>
    </div>
    <div class="spin-wrapper">
        <div class="circle"></div>
        <div class="circle"></div>
    </div>
    <div class="spin-wrapper">
        <div class="circle"></div>
        <div class="circle"></div>
    </div>
    <div class="spin-wrapper">
        <div class="circle"></div>
        <div class="circle"></div>
    </div>
</div>
<!-- Loading ends -->

<!-- Page wrapper starts -->
<div class="page-wrapper">

    <!-- Main container starts -->
    <div class="main-container">

        <!-- Sidebar wrapper starts -->
        <nav id="sidebar" class="sidebar-wrapper">

            <!-- Brand container starts -->
            <div class="brand-container d-flex align-items-center justify-content-between">

                <!-- App brand starts -->
                <div class="app-brand ms-3">
                    <a href="{{ url('/') }}">
                        <img src="{{  asset ('assets/images/logo.png') }}" class="logo"
                             alt="Dental Care Admin Template">
                    </a>
                </div>
                <!-- App brand ends -->


            </div>
            <!-- Brand container ends -->

            <!-- Sidebar profile starts -->
            <div class="sidebar-profile">
                <img src="{{  asset ('assets/images/doctor5.png') }}"
                     class="rounded-5 border border-primary border-3"
                     alt="Dentist Admin Templates">
                <h6 class="mb-1 profile-name text-nowrap text-truncate text-primary">John Doe</h6>
                <small class="profile-name text-nowrap text-truncate">Patient</small>
            </div>
            <!-- Sidebar profile ends -->

            <!-- Sidebar menu starts -->
            <div class="sidebarMenuScroll">
                <ul class="sidebar-menu">
                    <li class="active current-page">
                        <a href="#">
                            <i class="ri-home-6-line"></i>
                            <span class="menu-text">Homepage</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Sidebar menu ends -->

            <!-- Sidebar contact starts -->
            <div class="sidebar-contact">
                <p class="fw-light mb-1 text-nowrap text-truncate">Physiotherapist Contact</p>
                <h5 class="m-0 lh-1 text-nowrap text-truncate">06-187654321</h5>
                <i class="ri-phone-line"></i>
            </div>
            <!-- Sidebar contact ends -->

        </nav>
        <!-- Sidebar wrapper ends -->

        <!-- App container starts -->
        <div class="app-container">

            <!-- App header starts -->
            <div class="app-header d-flex align-items-center">

                <!-- Brand container sm starts -->
                <div class="brand-container-sm d-xl-none d-flex align-items-center">

                    <!-- App brand starts -->
                    <div class="app-brand">
                        <a href="#">
                            <img src="{{ asset('assets/images/logo.png') }}" class="logo"
                                 alt="Dental Care Admin Template">
                        </a>
                    </div>
                    <!-- App brand ends -->

                </div>
                <!-- Brand container sm ends -->

                <!-- Search container starts -->
                <div class="search-container d-xl-block d-none">
                    <input type="text" class="form-control" id="searchId" placeholder="Search">
                    <i class="ri-search-line"></i>
                </div>
                <!-- Search container ends -->

                <!-- App header actions starts -->
                <div class="header-actions">
                    <!-- Header actions starts -->
                    <div class="d-lg-flex d-none gap-2">
                    </div>
                    <!-- Header actions ends -->

                    <!-- Header user settings starts -->
                    <div class="dropdown ms-3">
                        <a id="userSettings" class="dropdown-toggle d-flex align-items-center" href="#" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="avatar-box">
                                <img src="{{ asset('assets/images/doctor5.png') }}"
                                     class="img-2xx rounded-5 border border-3 border-white"
                                     alt="Dentist Dashboard">
                                <span class="status busy"></span>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-300 shadow-lg">
                            <div class="d-flex align-items-center justify-content-between p-3">
                                <div>
                                    <span class="small">Patient</span>
                                    <h6 class="m-0">John Doe, M</h6>
                                </div>
                            </div>
                            <div class="mx-3 my-2 d-grid">
                                <a href="#" class="btn btn-primary">Logout</a>
                            </div>
                        </div>
                    </div>
                    <!-- Header user settings ends -->

                </div>
                <!-- App header actions ends -->

            </div>
            <!-- App header ends -->

            <!-- App hero header starts -->
            <div class="app-hero-header d-flex align-items-center">

                <!-- Breadcrumb starts -->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">
                            <i class="ri-home-3-line"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item text-primary" aria-current="page">
                        Homepage
                    </li>
                </ol>
                <!-- Breadcrumb ends -->

                <!-- Sales stats starts -->
                <div class="ms-auto d-lg-flex d-none flex-row">
                    <div class="input-group">
                <span class="input-group-text bg-primary-lighten">
                  <i class="ri-calendar-2-line text-primary"></i>
                </span>
                        <input type="text" id="abc" class="form-control custom-daterange">
                    </div>
                </div>
                <!-- Sales stats ends -->

            </div>
            <!-- App Hero header ends -->

            <!-- App body starts -->
            <div class="app-body">

                <!-- Row starts -->
                <div class="row gx-4">
                    <div class="col-xxl-9 col-sm-12">

                        <!-- Row starts -->
                        <div class="row gx-4">
                            <div class="col-sm-12">
                            </div>
                            <div class="col-sm-12">
                                <div class="card mb-4">
                                    <div class="card-header pb-0 d-flex align-items-center justify-content-between">
                                        <h5 class="card-title">Revenue</h5>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button type="button" class="btn btn-primary">2025</button>
                                            <button type="button" class="btn btn-outline-primary">2024</button>
                                            <button type="button" class="btn btn-outline-primary">2023</button>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="overflow-hidden">
                                            <div id="income"></div>
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
                                            <a href="{{ url('/patient-profile') }}"
                                               class="d-flex align-items-center gap-3 appointment-card">
                                                <div class="d-flex flex-column flex-fill">
                                                    <div class="fw-semibold text-truncate">Heel slide</div>
                                                </div>
                                                <span class="badge bg-danger">3x 10</span>
                                            </a>
                                            <a href="{{ url('/patient-profile') }}"
                                                   class="d-flex align-items-center gap-3 appointment-card">
                                                <div class="d-flex flex-column flex-fill">
                                                    <div class="fw-semibold text-truncate">Heel slide</div>
                                                </div>
                                                <span class="badge bg-danger">3x 10</span>
                                            </a>
                                            <a href="{{ url('/patient-profile') }}"
                                               class="d-flex align-items-center gap-3 appointment-card">
                                                <div class="d-flex flex-column flex-fill">
                                                    <div class="fw-semibold text-truncate">Heel slide</div>
                                                </div>
                                                <span class="badge bg-danger">3x 10</span>
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
<script src="{{ asset('assets/vendor/apex/custom/home/income.js') }}"></script>
<script src="{{ asset('assets/vendor/apex/custom/home/appointments-overview.js') }}"></script>
<script src="{{ asset('assets/vendor/apex/custom/home/sparklines.js') }}"></script>

<script src="{{ asset('assets/vendor/datatables/dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/custom/custom-datatables.js') }}"></script>

<!-- Custom JS files -->
<script src="{{ asset('assets/js/custom.js') }}"></script>

</body>
</html>
