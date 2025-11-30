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

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset ('assets/fonts/remix/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset ('assets/css/main.css') }}">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset ('assets/vendor/overlay-scroll/OverlayScrollbars.min.css') }}">
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
                    <li class="breadcrumb-item text-primary">Exercises</li>
                </ol>

                <!-- Search -->
                <div class="search-container d-xl-block d-none">
                    <input type="text" class="form-control" id="searchId" placeholder="Search"
                           style="border: 2px solid lightgray; border-radius: 5px;">
                    <i class="ri-search-line"></i>
                </div>
            </div>

            <!-- App body -->
            <div class="app-body">

                {{-- CASE 1: No patient record --}}
                @if(!$patient)
                    <div class="alert alert-warning">
                        You are not registered as a patient. No exercises available.
                    </div>

                    {{-- CASE 2: Patient exists but no exercises --}}
                @elseif($exercises->isEmpty())
                    <div class="alert alert-info">
                        No exercises linked to this user.
                    </div>

                    {{-- CASE 3: Patient with exercises --}}
                @else
                    @foreach($exercises as $exercise)
                        <x-exercise-card
                            :title="$exercise->exercise_name"
                            :video="$exercise->exercise_video_path"
                            :steps="explode('|', $exercise->exercise_description)"
                        />
                    @endforeach
                @endif
            </div>
            <!-- App body ends -->

        </div>
        <!-- App container ends -->

    </div>
</div>

<!-- JS -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>

<!-- Vendor JS -->
<script src="{{ asset('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets/vendor/overlay-scroll/custom-scrollbar.js') }}"></script>

<script src="{{ asset('assets/vendor/daterange/daterange.js') }}"></script>
<script src="{{ asset('assets/vendor/daterange/custom-daterange.js') }}"></script>

<!-- Custom JS -->
<script src="{{ asset('assets/js/custom.js') }}"></script>

</body>
</html>
