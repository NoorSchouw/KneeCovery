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
                <img src="{{ asset('assets/images/logo.png') }}" class="logo" alt="Kneecovery">
        </div>

    </div>
    <!-- Brand container ends -->

    <!-- Sidebar profile starts -->
    <div class="sidebar-profile">
        <img src="{{ asset('assets/images/doctor5.png') }}"
             class="rounded-5 border border-primary border-3"
             alt="profile">
        <h6 class="mb-1 profile-name text-nowrap text-truncate text-primary">
            {{ $userName ?? 'John Doe' }}
        </h6>
        <small class="profile-name text-nowrap text-truncate text-black">
            {{ $userRole ?? 'Patient' }}
        </small>
    </div>
    <!-- Sidebar profile ends -->

    <!-- Sidebar menu starts -->
    <div class="sidebarMenuScroll">
        <ul class="sidebar-menu">
            <li class="{{ request()->is('patients') ? 'active current-page' : '' }}">
                <a href="{{ url('/patients') }}">
                    <i class="ri-team-line"></i>
                    <span class="menu-text">Patients</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- Sidebar menu ends -->

    <!-- Sidebar contact starts -->
    <div class="sidebar-contact">
        <p class="fw-light mb-1 text-nowrap text-truncate">Physiotherapist Contact</p>
        <h5 class="m-0 lh-1 text-nowrap text-truncate">040 - 202 50 87</h5>
        <i class="ri-phone-line"></i>
    </div>
    <!-- Sidebar contact ends -->

</nav>
<!-- Sidebar wrapper ends -->
