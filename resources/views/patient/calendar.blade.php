<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calendar patient</title>

    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:title" content="Admin Templates - Dashboard Templates">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <link rel="shortcut icon" href="assets/images/favicon.svg">

    <!-- *************
		************ CSS Files *************
	  ************* -->
    <link rel="stylesheet" href="assets/fonts/remix/remixicon.css">
    <link rel="stylesheet" href="assets/css/main.css">

    <!-- *************
		************ Vendor Css Files *************
	  ************ -->

    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="assets/vendor/overlay-scroll/OverlayScrollbars.min.css">

    <!-- Date Range CSS -->
    <link rel="stylesheet" href="assets/vendor/daterange/daterange.css">

    <!-- Calendar CSS -->
    <link rel="stylesheet" href="assets/vendor/calendar/css/main.min.css">
    <link rel="stylesheet" href="assets/vendor/calendar/css/custom.css">

</head>

<body>

<!-- Page wrapper starts -->
<div class="page-wrapper">

    <!-- Main container starts -->
    <div class="main-container">

        <!-- Sidebar Component -->
        <x-sidebar-patient/>

        <!-- App container starts -->
        <div class="app-container">

            <x-header/>

            <!-- App hero header starts -->
            <div class="app-hero-header d-flex align-items-center">

                <!-- Breadcrumb starts -->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/homepage">
                            <i class="ri-home-3-line"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item text-primary" aria-current="page">
                        Appointments
                    </li>
                </ol>
                <!-- Breadcrumb ends -->

            </div>
            <!-- App Hero header ends -->

            <!-- App body starts -->
            <div class="app-body">

                <!-- Row starts -->
                <div class="row gx-4">
                    <div class="col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="card-title">Applointments</h5>
                                <a href="book-appointment.html" class="btn btn-primary ms-auto">Book Appointment</a>
                            </div>
                            <div class="card-body">

                                <div id="appointmentsCal"></div>

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
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/moment.min.js"></script>

<!-- *************
        ************ Vendor Js Files *************
    ************* -->

<!-- Overlay Scroll JS -->
<script src="assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js"></script>
<script src="assets/vendor/overlay-scroll/custom-scrollbar.js"></script>

<!-- Date Range JS -->
<script src="assets/vendor/daterange/daterange.js"></script>
<script src="assets/vendor/daterange/custom-daterange.js"></script>

<!-- Calendar JS -->
<script src="assets/vendor/calendar/js/main.min.js"></script>
<script src="assets/vendor/calendar/custom/appointments-calendar.js"></script>

<!-- Custom JS files -->
<script src="assets/js/custom.js"></script>
</body>

</html>
