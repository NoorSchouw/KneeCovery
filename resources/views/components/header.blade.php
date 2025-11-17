<!-- App header starts -->
<div class="app-header d-flex align-items-center">

    <!-- Brand container for mobile -->
    <div class="brand-container-sm d-xl-none d-flex align-items-center">
        <div class="app-brand">
            <a href="{{ url('/homepage') }}">
                <img src="{{ asset('assets/images/logo.png') }}" class="logo" alt="KneeCovery">
            </a>
        </div>
    </div>

    <!-- Search -->
    <div class="search-container d-xl-block d-none">
        <input type="text" class="form-control" placeholder="Search">
        <i class="ri-search-line"></i>
    </div>

    <div class="header-actions">

        <!-- User dropdown -->
        <div class="dropdown ms-3">
            <a class="dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                <div class="avatar-box">
                    <img src="{{ asset('assets/images/icons/account.png') }}"
                         class="img-3xx rounded-5" alt="account">
                </div>
            </a>

            <div class="dropdown-menu dropdown-menu-end dropdown-300 shadow-lg">
                <div class="d-flex align-items-center justify-content-between p-3">
                    <div>
                        <span class="small">{{ $userRole ?? 'Patient' }}</span>
                        <h6 class="m-0">{{ $userName ?? 'John Doe' }}</h6>
                    </div>
                </div>

                <div class="mx-3 my-2 d-grid">
                    <a href="/patient/information" class="btn btn-primary">
                        Account information
                    </a>
                </div>

                <div class="mx-3 my-2 d-grid">
                    <a href="/logout" class="btn btn-secondary">
                        Logout
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- App header ends -->
