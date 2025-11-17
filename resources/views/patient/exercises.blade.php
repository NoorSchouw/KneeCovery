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
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}">

    @vite([
    'resources/css/app.css',
    'resources/css/main.css',
    'resources/css/daterange.css',
    'resources/css/overlayScrollbars.css',
    'resources/css/remixicon.css',
    'resources/js/app.js',
])

</head>

<body>

<div class="page-wrapper">

    <div class="main-container">

        <!-- Sidebar Component -->
        <x-sidebar/>

        <!-- App container -->
        <div class="app-container">

            <!-- Header Component -->
            <x-header/>

            <!-- App hero header starts -->
            <div class="app-hero-header d-flex align-items-center">

                <!-- Breadcrumb -->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/resources/views/homepage.blade.php">
                            <i class="ri-home-3-line"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item text-primary" aria-current="page">
                        All exercises
                    </li>
                </ol>
            </div>
            <!-- App Hero header ends -->

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
</body>
</html>
