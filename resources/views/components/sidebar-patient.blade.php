@php
    use Illuminate\Support\Facades\Auth;

    $user = Auth::user(); // currently logged-in user

    // Full name
    $userName = $user ? $user->first_name . ' ' . $user->last_name : 'John Doe';

    // Determine role based on related models
    if ($user && $user->patient) {
        $userRole = 'Patient';
    } elseif ($user && $user->physiotherapist) {
        $userRole = 'Physiotherapist';
    } else {
        $userRole = 'Guest';
    }
@endphp

    <!-- Sidebar wrapper starts -->
<nav id="sidebar" class="sidebar-wrapper">

    <!-- Brand container starts -->
    <div class="brand-container d-flex align-items-center justify-content-between">
        <div class="app-brand ms-3">
            <a href="{{ url('/homepage') }}">
                <img src="{{ asset('assets/images/logo.png') }}" class="logo" alt="Kneecovery">
            </a>
        </div>
    </div>
    <!-- Brand container ends -->

    <!-- Sidebar profile starts -->
    <div class="sidebar-profile">
        <img src="{{ asset('assets/images/doctor5.png') }}"
             class="rounded-5 border border-primary border-3"
             alt="profile">
        <h6 class="mb-1 profile-name text-nowrap text-truncate text-primary">
            {{ $userName }}
        </h6>
        <small class="profile-name text-nowrap text-truncate text-black">
            {{ $userRole }}
        </small>
    </div>
    <!-- Sidebar profile ends -->

    <!-- Sidebar menu starts -->
    <div class="sidebarMenuScroll">
        <ul class="sidebar-menu">
            <li class="{{ request()->is('homepage') ? 'active current-page' : '' }}">
                <a href="{{ url('/homepage') }}">
                    <i class="ri-home-6-line"></i>
                    <span class="menu-text">Homepage</span>
                </a>
            </li>
            <li class="{{ request()->is('calendar') ? 'active current-page' : '' }}">
                <a href="{{ url('/calendar') }}">
                    <i class="ri-calendar-close-line"></i>
                    <span class="menu-text">Calendar</span>
                </a>
            </li>
            <li class="{{ request()->is('all-exercises') ? 'active current-page' : '' }}">
                <a href="{{ url('/all-exercises') }}">
                    <i class="ri-body-scan-line"></i>
                    <span class="menu-text">Exercises</span>
                </a>
            </li>
            <li class="{{ request()->is('patient-report') ? 'active current-page' : '' }}">
                <a href="{{ url('/patient-report') }}">
                    <i class="ri-file-chart-line"></i>
                    <span class="menu-text">Report</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- Sidebar menu ends -->

    <!-- Sidebar contact starts -->
    <div class="sidebar-contact">
        <a href="/contact" class="contact-sidebar">Physiotherapist Contact</a>
        <h5 class="m-0 lh-1 text-nowrap text-truncate">040 - 202 50 87</h5>
        <i class="ri-phone-line"></i>
    </div>
    <!-- Sidebar contact ends -->

</nav>
<!-- Sidebar wrapper ends -->
