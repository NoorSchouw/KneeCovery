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

    <!-- Uploader CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/dropzone/dropzone.min.css') }}">

    <!-- Quill Editor -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/quill/quill.core.css') }}">
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

            <!-- Header Component -->
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
                        Personal Information
                    </li>
                </ol>
                <!-- Breadcrumb ends -->

            </div>
            <!-- App Hero header ends -->

            <!-- App body starts -->
            <div class="app-body">

                <!-- Row starts -->
                <div class="row gx-4">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">

                                <!-- Custom tabs starts -->
                                <div class="custom-tabs-container">

                                    <!-- Nav tabs starts -->
                                    <ul class="nav nav-tabs" id="customTab2" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="tab-oneA" data-bs-toggle="tab" href="#oneA" role="tab"
                                               aria-controls="oneA" aria-selected="true"><i class="ri-briefcase-4-line"></i> Personal
                                                Details</a>
                                        </li>

                                    </ul>
                                    <!-- Nav tabs ends -->

                                    <!-- Tab content starts -->
                                    <div class="tab-content h-350">
                                        <div class="tab-pane fade show active" id="oneA" role="tabpanel">

                                            <!-- Row starts -->
                                            <div class="row gx-4">
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="a1">First Name <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                  <span class="input-group-text">
                                    <i class="ri-account-circle-line"></i>
                                  </span>
                                                            <input type="text" class="form-control" id="a1" placeholder="Enter First Name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="a2">Last Name <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                  <span class="input-group-text">
                                    <i class="ri-account-circle-line"></i>
                                  </span>
                                                            <input type="text" class="form-control" id="a2" placeholder="Enter Last Name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="a3">Date of Birth <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                         <span class="input-group-text">
                                    <i class="ri-flower-line"></i>
                                  </span>
                                                            <input type="date" id="dob" name="dob" class="form-control">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="selectGender1">Gender<span
                                                                class="text-danger">*</span></label>
                                                        <div class="m-0">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="selectGenderOptions"
                                                                       id="selectGender1" value="male">
                                                                <label class="form-check-label" for="selectGender1">Male</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="selectGenderOptions"
                                                                       id="selectGender2" value="female">
                                                                <label class="form-check-label" for="selectGender2">Female</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="a5">Email ID <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                  <span class="input-group-text">
                                    <i class="ri-mail-open-line"></i>
                                  </span>
                                                            <input type="email" class="form-control" id="a5" placeholder="Enter Email ID">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="a6">Mobile Number <span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group">
                                  <span class="input-group-text">
                                    <i class="ri-phone-line"></i>
                                  </span>
                                                            <input type="text" class="form-control" id="a6" placeholder="Enter Mobile Number">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="a11">Address <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                  <span class="input-group-text">
                                    <i class="ri-projector-line"></i>
                                  </span>
                                                            <input type="text" class="form-control" id="a11" placeholder="Enter Address">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="a12">Country <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                  <span class="input-group-text">
                                    <i class="ri-flag-line"></i>
                                  </span>
                                                            <input type="text" class="form-control" id="a14" placeholder="Enter Country">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="a14">City <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                  <span class="input-group-text">
                                    <i class="ri-scan-line"></i>
                                  </span>
                                                            <input type="text" class="form-control" id="a14" placeholder="Enter City">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="a15">Postal Code <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                  <span class="input-group-text">
                                    <i class="ri-qr-scan-line"></i>
                                  </span>
                                                            <input type="text" class="form-control" id="a15" placeholder="Enter Postal Code">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Row ends -->

                                        </div>
                                        <!-- Tab content ends -->

                                    </div>
                                    <!-- Custom tabs ends -->

                                    <!-- Card actions starts -->
                                    <div class="d-flex gap-2 justify-content-end mt-4">
                                        <a href="#" class="btn btn-outline-secondary">
                                            Cancel
                                        </a>
                                        <a href="#" class="btn btn-primary">
                                            Save
                                        </a>
                                    </div>
                                    <!-- Card actions ends -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row ends -->

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

    <!-- Dropzone JS -->
    <script src="{{ asset('assets/vendor/dropzone/dropzone.min.js') }}"></script>

    <!-- Quill Editor JS -->
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/custom.js') }}"></script>

    <!-- Custom JS files -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>
