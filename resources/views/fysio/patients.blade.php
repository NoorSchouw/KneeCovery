<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Select patients - Physiotherapist page</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/remix/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css') }}">
</head>
<body>

<div class="page-wrapper">
    <div class="main-container">
        <x-sidebar-physio/>
        <div class="app-container">
            <x-header/>

            <div class="app-hero-header d-flex justify-content-between align-items-center">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/homepage') }}"><i class="ri-home-3-line"></i></a>
                    </li>
                    <li class="breadcrumb-item text-primary">Patients</li>
                </ol>

                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPatientModal">
                    Add Patient
                </button>
            </div>

            <div class="app-body">
                <div class="row gx-4">
                    <div class="col-sm-12">
                        <div class="card" style="border-radius: 12px; overflow: hidden;">
                            <div class="card-body pt-0 p-0">
                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        <thead>
                                        <tr class="table-header-pink">
                                            <th>ID</th>
                                            <th>First name</th>
                                            <th>Last name</th>
                                            <th>Patient number</th>
                                            <th>Gender</th>
                                            <th>Date of birth</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($patients as $patient)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $patient->user->first_name }}</td>
                                                <td>{{ $patient->user->last_name }}</td>
                                                <td>{{ $patient->patient_number }}</td>
                                                <td>{{ ucfirst($patient->user->gender) }}</td>
                                                <td>{{ $patient->date_of_birth }}</td>

                                                <td class="text-center">

                                                    <!-- EDIT BUTTON -->
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-success btn-sm editBtn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editPatientModal"

                                                        data-id="{{ $patient->user_id }}"
                                                        data-first_name="{{ $patient->user->first_name }}"
                                                        data-last_name="{{ $patient->user->last_name }}"
                                                        data-email="{{ $patient->user->email }}"
                                                        data-gender="{{ $patient->user->gender }}"
                                                        data-dob="{{ $patient->date_of_birth }}"
                                                        data-phone="{{ $patient->phone_number }}"
                                                        data-injured="{{ optional($patient->injury)->affected_area }}"
                                                        data-notes="{{ $patient->medical_notes }}"
                                                    >
                                                        <i class="ri-edit-box-line"></i>
                                                    </button>

                                                    <!-- DELETE BUTTON -->
                                                    <form action="{{ route('patients.destroy', $patient->user_id) }}"
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-outline-danger btn-sm"
                                                                onclick="return confirm('Are you sure you want to delete this patient?')">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </button>
                                                    </form>

                                                    <!-- REPORT BUTTON -->
                                                    <a href="{{ route('patients.report', $patient->user_id) }}"
                                                       class="btn btn-outline-info btn-sm"
                                                       title="View Report">
                                                        <i class="ri-file-list-3-line"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- ADD PATIENT MODAL -->
<div class="modal fade" id="addPatientModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('patients.store') }}">
                @csrf
                <div class="modal-header">
                    <h5>Add Patient</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>First Name *</label>
                        <input type="text" name="first_name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Last Name *</label>
                        <input type="text" name="last_name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Patient Number *</label>
                        <input type="text" name="patient_number" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Gender *</label>
                        <select name="gender" class="form-select" required>
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Date of Birth *</label>
                        <input type="date" name="dob" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Phone Number</label>
                        <input type="text" name="phone_number" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Injured Knee *</label>
                        <select name="injured_knee" class="form-select" required>
                            <option value="left knee">Left</option>
                            <option value="right knee">Right</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Medical Notes</label>
                        <textarea name="medical_notes" class="form-control"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add Patient</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- EDIT PATIENT MODAL -->
<div class="modal fade" id="editPatientModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editPatientForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5>Edit Patient</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>First Name</label>
                        <input type="text" name="edit_first_name" id="editFirstName" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Last Name</label>
                        <input type="text" name="edit_last_name" id="editLastName" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="edit_email" id="editEmail" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Gender</label>
                        <select name="edit_gender" id="editGender" class="form-select" required>
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Date of Birth</label>
                        <input type="date" name="edit_dob" id="editDob" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Phone Number</label>
                        <input type="text" name="edit_phone_number" id="editPhoneNumber" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Injured Knee</label>
                        <select name="edit_injured_knee" id="editInjuredKnee" class="form-select" required>
                            <option value="left knee">Left</option>
                            <option value="right knee">Right</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Medical Notes</label>
                        <textarea name="edit_medical_notes" id="editMedicalNotes" class="form-control"></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<script>
    $(document).ready(function () {

        $('.editBtn').on('click', function () {

            const btn = $(this);

            $('#editFirstName').val(btn.data('first_name'));
            $('#editLastName').val(btn.data('last_name'));
            $('#editEmail').val(btn.data('email') || '');
            $('#editGender').val(btn.data('gender'));
            $('#editDob').val(btn.data('dob'));
            $('#editPhoneNumber').val(btn.data('phone') || '');
            $('#editInjuredKnee').val(btn.data('injured'));
            $('#editMedicalNotes').val(btn.data('notes') || '');

            $('#editPatientForm').attr('action', '/patients/' + btn.data('id'));
        });

    });
</script>

</body>
</html>
