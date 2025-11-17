<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clove Dental Care Admin Template</title>

    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:title" content="Admin Templates - Dashboard Templates">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}">

    <!-- *************
		************ CSS Files *************
	  ************* -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/remix/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <!-- *************
		************ Vendor Css Files *************
	  ************ -->

    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css') }}">

    <!-- Date Range CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/daterange/daterange.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@4.12.0/dist/tf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/pose-detection"></script>
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/pose"></script>

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
                    <a href="{{ url('/homepage')}}">
                        <img src="{{ asset ('assets/images/logo.png') }} " class="logo"
                            alt="Dental Care Admin Template">
                    </a>
                </div>
                <!-- App brand ends -->

            </div>
            <!-- Brand container ends -->

            <!-- Sidebar profile starts -->
            <div class="sidebar-profile">
                <img src="{{ asset ('assets/images/doctor5.png') }}"
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
                            <i class="ri-send-plane-line"></i>
                            <span class="menu-text">Filming</span>
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
                            <img src="{{ asset('assets/images/logo.png') }}"
                                 class="logo"
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
                                <img src="{{ asset('assets/images/doctor5.png')}}"
                                     class="img-2xx rounded-5 border border-3 border-white"
                                     alt="Dentist Dashboard">
                                <span class="status busy"></span>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-300 shadow-lg">
                            <div class="d-flex align-items-center justify-content-between p-3">
                                <div>
                                    <span class="small">Doctor</span>
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
                        Filming
                    </li>
                </ol>
                <!-- Breadcrumb ends -->

                <!-- Sales stats starts -->
                <!-- Sales stats ends -->

            </div>
            <!-- App Hero header ends -->

            <!-- App body starts -->
            <div class="app-body">

                <div class="filming-container">

                    <!-- Header links -->
                    <div class="filming-header">
                        <h1 class="filming-title">Exercise</h1>
                        <p class="filming-subtitle">Select the knee and start tracking your motion.</p>
                    </div>

                    <!-- Alles gecentreerd -->
                    <div class="filming-center">

                        <!-- Controls -->
                        <div id="controls" class="filming-controls">
                            <label for="kneeSelect">Select knee:</label>
                            <select id="kneeSelect">
                                <option value="left">Left knee</option>
                                <option value="right">Right knee</option>
                            </select>
                            <button id="recordBtn">Start recording</button>
                        </div>

                        <!-- Statusbar -->
                        <div id="statusbar" class="filming-statusbar">
                            <span id="camStatus" class="badge off">Camera: off</span>
                            <span id="trackStatus" class="badge off">Tracking: off</span>
                            <span id="refStatus" class="badge warn">Reference: unknown</span>
                            <span id="msg"></span>
                        </div>

                        <!-- Video container -->
                        <div id="video-container" class="filming-video-container">
                            <video id="video" autoplay playsinline muted></video>
                            <canvas id="output"></canvas>
                        </div>

                        <!-- Hidden canvas voor opname -->
                        <canvas id="recordCanvas" style="display:none;"></canvas>

                        <!-- Angle display -->
                        <div id="angle-display" class="filming-angle-display">Angle: --° | Reference: --°</div>

                    </div> <!-- .filming-center -->

                </div> <!-- .filming-container -->

            </div>
            <!-- App body ends -->


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
{{--<script src="{{ asset('assets/js/moment.min.js') }}"></script>--}}

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
<script src="{{ asset('assets/js/filming.js') }}"></script>
</body>

</html>
