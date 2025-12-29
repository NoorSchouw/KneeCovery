<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KneeCovery</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/remix/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/daterange/daterange.css') }}">
</head>

<body>
<div class="page-wrapper">
    <div class="main-container">

        <x-sidebar-patient/>

        <div class="app-container">

            <x-header/>

            <div class="app-hero-header d-flex justify-content-between align-items-center">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/homepage') }}"><i class="ri-home-3-line"></i></a>
                    </li>
                    <li class="breadcrumb-item text-primary">Exercises</li>
                </ol>

                <div class="search-container d-xl-block d-none">
                    <input type="text" class="form-control" id="searchId" placeholder="Search"
                           style="border: 2px solid lightgray; border-radius: 5px;">
                    <i class="ri-search-line"></i>
                </div>
            </div>

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
                        <x-exercise-card :exercise="$exercise"/>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets/vendor/overlay-scroll/custom-scrollbar.js') }}"></script>
<script src="{{ asset('assets/vendor/daterange/daterange.js') }}"></script>
<script src="{{ asset('assets/vendor/daterange/custom-daterange.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

</body>
</html>
