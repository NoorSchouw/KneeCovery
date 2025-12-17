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

    <!-- ************ CSS Files ************ -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/remix/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/daterange/daterange.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/dropzone/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/quill/quill.core.css') }}">
</head>

<body>

<div class="page-wrapper">
    <div class="main-container">

        <x-sidebar-patient/>

        <div class="app-container">
            <x-header/>

            <div class="app-hero-header d-flex align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/homepage"><i class="ri-home-3-line"></i></a>
                    </li>
                    <li class="breadcrumb-item text-primary">Personal Information</li>
                </ol>
            </div>

            <div class="app-body">
                <div class="row gx-4">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="custom-tabs-container">

                                    <ul class="nav nav-tabs" id="customTab2" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="tab-oneA" data-bs-toggle="tab" href="#oneA"
                                               role="tab" aria-controls="oneA" aria-selected="true">
                                                <i class="ri-briefcase-4-line"></i> Personal Details
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content h-350">
                                        <div class="tab-pane fade show active" id="oneA" role="tabpanel">

                                            <form action="{{ route('patient.information.update') }}" method="POST">
                                                @csrf
                                                <div class="row gx-4">

                                                    <!-- First Name -->
                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">First Name</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="ri-account-circle-line"></i></span>
                                                                <input type="text" class="form-control" name="first_name" value="{{ $patient->user->first_name }}" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Last Name -->
                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Last Name</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="ri-account-circle-line"></i></span>
                                                                <input type="text" class="form-control" name="last_name" value="{{ $patient->user->last_name }}" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Date of Birth -->
                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Date of Birth</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="ri-flower-line"></i></span>
                                                                <input type="date" class="form-control" value="{{ $patient->date_of_birth }}" readonly>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Gender -->
                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Gender</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="ri-genderless-line"></i></span>
                                                                <select class="form-select" name="gender" required>
                                                                    <option value="male" {{ $patient->user->gender == 'male' ? 'selected' : '' }}>Male</option>
                                                                    <option value="female" {{ $patient->user->gender == 'female' ? 'selected' : '' }}>Female</option>
                                                                    <option value="other" {{ $patient->user->gender == 'other' ? 'selected' : '' }}>Other</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Email -->
                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Email</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="ri-mail-open-line"></i></span>
                                                                <input type="email" class="form-control" name="email" value="{{ $patient->user->email }}" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Phone Number -->
                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Mobile Number</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="ri-phone-line"></i></span>
                                                                <input type="text" class="form-control" name="phone_number" value="{{ $patient->phone_number }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Patient Number -->
                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Patient Number</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="ri-file-list-3-line"></i></span>
                                                                <input type="text" class="form-control" value="{{ $patient->patient_number }}" readonly>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Injured Knee -->
                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Injured Knee</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="ri-hospital-line"></i></span>
                                                                <input type="text" class="form-control" value="{{ optional($patient->injury)->affected_area ?? 'N/A' }}" readonly>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Medical Notes -->
                                                    <div class="col-xxl-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Medical Notes</label>
                                                            <textarea class="form-control" readonly>{{ $patient->medical_notes ?? 'None' }}</textarea>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="d-flex gap-2 justify-content-end mt-4">
                                                    <a href="/homepage" class="btn btn-outline-secondary">Back</a>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
<script src="{{ asset('assets/vendor/dropzone/dropzone.min.js') }}"></script>
<script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
<script src="{{ asset('assets/vendor/quill/custom.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

</body>
</html>
