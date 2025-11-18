<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KneeCovery</title>

    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:title" content="KneeCovery">
    <meta property="og:description" content="All exercises">
    <meta property="og:type" content="Website">
    <link rel="shortcut icon" href="{{  asset ('assets/images/favicon.svg') }}">

    <!-- *************
		************ CSS Files *************
	  ************* -->
    <link rel="stylesheet" href="{{ asset ('assets/fonts/remix/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset ('assets/css/main.css') }}">

    <!-- *************
		************ Vendor Css Files *************
	  ************ -->

    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="{{ asset ('assets/vendor/overlay-scroll/OverlayScrollbars.min.css') }}">

    <!-- Date Range CSS -->
    <link rel="stylesheet" href="{{ asset ('assets/vendor/daterange/daterange.css') }}">

</head>

<body>

<div class="page-wrapper">

    <div class="main-container">

        <!-- Sidebar Component -->
        <x-sidebar-patient/>

        <!-- App container -->
        <div class="app-container">

            <!-- Header Component -->
            <x-header/>

            <!-- Hero Header -->
            <div class="app-hero-header d-flex justify-content-between align-items-center">

                <!-- Breadcrumb -->
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/homepage') }}"><i class="ri-home-3-line"></i></a>
                    </li>
                    <li class="breadcrumb-item text-primary">Patients</li>
                </ol>

                <!-- Search container starts -->
                <div class="search-container d-xl-block d-none">
                    <input type="text" class="form-control" id="searchId" placeholder="Search"
                           style="border: 2px solid lightgray; border-radius: 5px;">
                    <i class="ri-search-line"></i>
                </div>
                <!-- Search container ends -->

            </div>

            <!-- App body starts -->
            <div class="app-body">

                <!-- Heel Slide -->
                <x-exercise-card
                    title="Heel Slide"
                    video="heel-slide.mp4"
                    :steps="[
                            'Lie on your back with your legs extended.',
                            'Slowly bend one knee by sliding your heel toward your buttocks.',
                            'Hold the end position for 3–5 seconds.',
                            'Slide the heel back to the starting position.'
                            ]"
                />

                <!-- Squat -->
                <x-exercise-card
                    title="Squat"
                    video="squat.mp4"
                    :steps="[
                            'Stand with feet shoulder-width apart.',
                            'Lower your hips back and down as if sitting in a chair.',
                            'Keep your chest upright and knees aligned over your toes.',
                            'Return to standing by pressing through your heels.'
                            ]"
                />

                <!-- Hamstring Curl -->
                <x-exercise-card
                    title="Hamstring Curls"
                    video="hamstring-curl.mp4"
                    :steps="[
                            'Stand holding a chair or wall for balance.',
                            'Bend your knee and lift your heel toward your buttocks.',
                             'Keep your thigh steady and avoid swinging.',
                            'Lower your foot back down with control.'
                            ]"/>
            </div>
            <!-- App body ends -->
        </div>
        <!-- App container ends -->
    </div>
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
