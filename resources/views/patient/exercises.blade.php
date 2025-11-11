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
    <link rel="shortcut icon" href="{{  asset ('assets/images/favicon.svg') }}">

    <!-- *************
		************ CSS Files *************
	  ************* -->
    <link rel="stylesheet" href="{{ asset ('assets/fonts/remix/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset ('assets/css/main.min.css') }}">

    <!-- *************
		************ Vendor Css Files *************
	  ************ -->

    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="{{ asset ('assets/vendor/overlay-scroll/OverlayScrollbars.min.css') }}">

    <!-- Date Range CSS -->
    <link rel="stylesheet" href="{{ asset ('assets/vendor/daterange/daterange.css') }}">

</head>

<body>

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
                    <a href="/resources/views/homapage.blade.php">
                        <img src="{{ asset ('assets/images/logo.png') }}" class="logo" alt="Dental Care Admin Template">
                    </a>
                </div>
                <!-- App brand ends -->

                <!-- Pin sidebar starts -->
                <button type="button" class="pin-sidebar me-3">
                    <i class="ri-menu-line"></i>
                </button>
                <!-- Pin sidebar ends -->

            </div>
            <!-- Brand container ends -->

            <!-- Sidebar profile starts -->
            <div class="sidebar-profile">
                <img src="{{ asset('assets/images/doctor5.png') }}" class="rounded-5 border border-primary border-3"
                     alt="Dentist Admin Templates">
                <h6 class="mb-1 profile-name text-nowrap text-truncate text-primary">Jennifer Arter</h6>
                <small class="profile-name text-nowrap text-truncate">Department Head</small>
            </div>
            <!-- Sidebar profile ends -->

            <!-- Sidebar menu starts -->
            <div class="sidebarMenuScroll">
                <ul class="sidebar-menu">
                    <li>
                        <a href="/resources/views/homapage.blade.php">
                            <i class="ri-home-6-line"></i>
                            <span class="menu-text">Homepage</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Sidebar menu ends -->

            <!-- Sidebar contact starts -->
            <div class="sidebar-contact">
                <p class="fw-light mb-1 text-nowrap text-truncate">Emergency Contact</p>
                <h5 class="m-0 lh-1 text-nowrap text-truncate">0987654321</h5>
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
                        <a href="/resources/views/homapage.blade.php">
                            <img src="{{ asset('assets/images/logo.png') }}" class="logo" alt="Dental Care Admin Template">
                        </a>
                    </div>
                    <!-- App brand ends -->

                    <!-- Toggle sidebar starts -->
                    <button type="button" class="toggle-sidebar">
                        <i class="ri-menu-line"></i>
                    </button>
                    <!-- Toggle sidebar ends -->

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

                    <!-- Header user settings starts -->
                    <div class="dropdown ms-3">
                        <a id="userSettings" class="dropdown-toggle d-flex align-items-center" href="#!" role="button"
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
                                    <span class="small">Doctor</span>
                                    <h6 class="m-0">Martin Boyer, MD</h6>
                                </div>
                                <div class="d-flex flex-column text-end">
                                    <h5 class="fw-bold lh-1 m-0">$5900</h5>
                                    <div class="text-primary small">Weekly Earnings</div>
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
                        <a href="/resources/views/homapage.blade.php">
                            <i class="ri-home-3-line"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item text-primary" aria-current="page">
                        All exercises
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
                    <div class="col-lg-6 col-sm-12 col-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <img src="{{ asset('assets/images/products/4.jpg') }}" class="img-fluid rounded-3"
                                             alt="Bootstrap Gallery">
                                    </div>
                                    <div class="col-sm-6">
                                        <h5 class="mb-2 text-danger">Card title</h5>
                                        <p>
                                            Check out our most popular Admin Templatess. Best open-source admin
                                            dashboard & control panel
                                            theme. Download responsive HTML5 CSS3 Admin Dashboard Templates.
                                        </p>
                                        <p><small class="text-dark">Last updated 3 mins ago</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="text-end">
                                            <h5 class="mb-2 text-success">Card title</h5>
                                            <p>
                                                Check out our most popular Admin Templatess. Best open-source admin
                                                dashboard & control
                                                panel
                                                theme. Download responsive HTML5 CSS3 Admin Dashboard Templates.
                                            </p>
                                            <p><small class="text-dark">Last updated 3 mins ago</small></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="{{ asset('assets/images/products/2.jpg') }}" class="img-fluid rounded-3"
                                             alt="Bootstrap Gallery">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <img src="{{ asset('assets/images/products/5.jpg') }}" class="img-fluid rounded-2"
                                             alt="Bootstrap Gallery">
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="align-items-center">
                                            <h5>Bootstrap Gallery</h5>
                                            <p>Check out our most popular Admin Templatess. Best open-source admin
                                                dashboard & control
                                                panel
                                                theme. Download responsive HTML5 CSS3 Admin Dashboard Templates.</p>
                                            <a href="#" class="btn btn-danger">Button</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="align-items-center">
                                            <div class="text-end">
                                                <h5>Bootstrap Gallery</h5>
                                                <p>Check out our most popular Admin Templatess. Best open-source admin
                                                    dashboard & control
                                                    panel
                                                    theme. Download responsive HTML5 CSS3 Admin Dashboard Templates.</p>
                                                <a href="#" class="btn btn-info">Button</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="{{ asset('assets/images/products/3.jpg') }}" class="img-fluid rounded-2"
                                             alt="Bootstrap Gallery">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row ends -->

            </div>
            <!-- App body ends -->

            <!-- App footer starts -->
            <div class="app-footer">
                <span>© Dental Care Admin 2025</span>
            </div>
            <!-- App footer ends -->

        </div>
        <!-- App container ends -->

    </div>
    <!-- Main container ends -->

</div>
<!-- Page wrapper ends -->

<!-- *************
        ************ JavaScript Files *************
    ************* -->
<!-- Required jQuery first, then Bootstrap Bundle JS -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>

<!-- *************
        ************ Vendor Js Files *************
    ************* -->

<!-- Overlay Scroll JS -->
<script src="{{ asset('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets/vendor/overlay-scroll/custom-scrollbar.js') }}"></script>

<!-- Date Range JS -->
<script src="{{ asset('assets/vendor/daterange/daterange.js') }}"></script>
<script src="{{ asset('assets/vendor/daterange/custom-daterange.js') }}"></script>

<!-- Custom JS files -->
<script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>
