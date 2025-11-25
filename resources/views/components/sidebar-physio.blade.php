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
            <li class="{{ request()->is('report') ? 'active current-page' : '' }}">
                <a href="{{ url('/report') }}">
                    <i class="ri-file-chart-line"></i>
                    <span class="menu-text">Report</span>
                </a>
            </li>
            <li class="{{ request()->is('upload-exercises') ? 'active current-page' : '' }}">
                <a href="{{ url('/upload-exercises') }}">
                    <i class="ri-add-line"></i>
                    <span class="menu-text">Add exercise</span>
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
