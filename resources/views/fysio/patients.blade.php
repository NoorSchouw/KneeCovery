<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Select patients - Physiotherapist page </title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/remix/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bs5.css') }}">
</head>

<body>

<div class="page-wrapper">

    <div class="main-container">

        <!-- Sidebar Component -->
        <x-sidebar-physio/>

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
                    <li class="breadcrumb-item text-primary">Patients</li>
                </ol>

                <!-- Search container starts -->
                <div class="search-container d-xl-block d-none">
                    <input type="text" class="form-control" id="searchId" placeholder="Search"
                           style="border: 2px solid lightgray; border-radius: 5px;">
                    <i class="ri-search-line"></i>
                </div>
                <!-- Search container ends -->

                <!-- Add Patient Button -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPatientModal">
                    Add Patient
                </button>

            </div>

            <!-- Body -->
            <div class="app-body">
                <div class="row gx-4">
                    <div class="col-sm-12">
                        <!-- Card met afgeronde hoeken -->
                        <div class="card" style="border-radius: 12px; overflow: hidden;">

                            <div class="card-body pt-0 p-0">

                                <div class="table-responsive">
                                    <table class="table truncate m-0 align-middle" id="patientsTable">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Patient Number</th>
                                            <th>Gender</th>
                                            <th>Date of Birth</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>#0001</td>
                                            <td>Jane</td>
                                            <td>Doe</td>
                                            <td>349157</td>
                                            <td>Female</td>
                                            <td>1982-06-15</td>
                                            <td>
                                                <button class="btn btn-outline-success btn-sm editBtn" data-firstname="Jane" data-lastname="Doe" data-number="349157" data-gender="Female" data-dob="1982-06-15" data-bs-toggle="modal" data-bs-target="#editPatientModal"><i class="ri-edit-box-line"></i></button>
                                                <button class="btn btn-outline-info btn-sm viewBtn" data-number="349157"><i class="ri-eye-line"></i></button>
                                                <button class="btn btn-outline-danger btn-sm deleteBtn"><i class="ri-delete-bin-line"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#0002</td>
                                            <td>John</td>
                                            <td>Doe</td>
                                            <td>648515</td>
                                            <td>Male</td>
                                            <td>1964-07-19</td>
                                            <td>
                                                <button class="btn btn-outline-success btn-sm editBtn" data-firstname="John" data-lastname="Doe" data-number="648515" data-gender="Male" data-dob="1964-07-19" data-bs-toggle="modal" data-bs-target="#editPatientModal"><i class="ri-edit-box-line"></i></button>
                                                <button class="btn btn-outline-info btn-sm viewBtn" data-number="648515"><i class="ri-eye-line"></i></button>
                                                <button class="btn btn-outline-danger btn-sm deleteBtn"><i class="ri-delete-bin-line"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#0003</td>
                                            <td>Baby</td>
                                            <td>Doe</td>
                                            <td>852146</td>
                                            <td>Female</td>
                                            <td>1985-03-27</td>
                                            <td>
                                                <button class="btn btn-outline-success btn-sm editBtn" data-firstname="Jane" data-lastname="Doe" data-number="349157" data-gender="Female" data-dob="1982-06-15" data-bs-toggle="modal" data-bs-target="#editPatientModal"><i class="ri-edit-box-line"></i></button>
                                                <button class="btn btn-outline-info btn-sm viewBtn" data-number="349157"><i class="ri-eye-line"></i></button>
                                                <button class="btn btn-outline-danger btn-sm deleteBtn"><i class="ri-delete-bin-line"></i></button>
                                            </td>
                                        </tr>
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

<!-- Edit Patient Modal -->
<div class="modal fade" id="editPatientModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Edit Patient Details</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="editPatientForm">

                    <div class="mb-3"><label>First Name</label>
                        <input type="text" id="editFirstName" class="form-control">
                    </div>

                    <div class="mb-3"><label>Last Name</label>
                        <input type="text" id="editLastName" class="form-control">
                    </div>

                    <div class="mb-3"><label>Patient Number</label>
                        <input type="text" id="editPatientNum" class="form-control">
                    </div>

                    <div class="mb-3"><label>Gender</label>
                        <select id="editGender" class="form-select">
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="mb-3"><label>Date of Birth</label>
                        <input type="date" id="editDob" class="form-control">
                    </div>

                    <!-- EXTRA FIELDS -->
                    <div class="mb-3"><label>Email</label>
                        <input type="email" id="editEmail" class="form-control">
                    </div>

                    <div class="mb-3"><label>Mobile Number</label>
                        <input type="text" id="editMobile" class="form-control">
                    </div>

                    <div class="mb-3"><label>Address</label>
                        <input type="text" id="editAddress" class="form-control">
                    </div>

                    <div class="mb-3"><label>Country</label>
                        <input type="text" id="editCountry" class="form-control">
                    </div>

                    <div class="mb-3"><label>City</label>
                        <input type="text" id="editCity" class="form-control">
                    </div>

                    <div class="mb-3"><label>Postal Code</label>
                        <input type="text" id="editPostal" class="form-control">
                    </div>

                    <div class="mb-3"><label>Injured Knee</label>
                        <select id="editInjuredKnee" class="form-select">
                            <option value="Left">Left</option>
                            <option value="Right">Right</option>
                        </select>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" id="savePatientBtn">Save Changes</button>
            </div>

        </div>
    </div>
</div>


<!-- Add Patient Modal -->
<div class="modal fade" id="addPatientModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Add Patient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addPatientForm">

                    <div class="mb-3"><label>First Name</label>
                        <input type="text" id="addFirstName" class="form-control" required>
                    </div>

                    <div class="mb-3"><label>Last Name</label>
                        <input type="text" id="addLastName" class="form-control" required>
                    </div>

                    <div class="mb-3"><label>Patient Number (from dossier)</label>
                        <input type="text" id="addPatientNumber" class="form-control">
                    </div>

                    <div class="mb-3"><label>Gender</label>
                        <select id="addGender" class="form-select">
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="mb-3"><label>Date of Birth</label>
                        <input type="date" id="addDob" class="form-control" required>
                    </div>

                    <!-- EXTRA FIELDS -->
                    <div class="mb-3"><label>Email</label>
                        <input type="email" id="addEmail" class="form-control">
                    </div>

                    <div class="mb-3"><label>Mobile Number</label>
                        <input type="text" id="addMobile" class="form-control">
                    </div>

                    <div class="mb-3"><label>Address</label>
                        <input type="text" id="addAddress" class="form-control">
                    </div>

                    <div class="mb-3"><label>Country</label>
                        <input type="text" id="addCountry" class="form-control">
                    </div>

                    <div class="mb-3"><label>City</label>
                        <input type="text" id="addCity" class="form-control">
                    </div>

                    <div class="mb-3"><label>Postal Code</label>
                        <input type="text" id="addPostal" class="form-control">
                    </div>

                    <div class="mb-3"><label>Injured Knee</label>
                        <select id="addInjuredKnee" class="form-select">
                            <option value="Left">Left</option>
                            <option value="Right">Right</option>
                        </select>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-success" id="saveNewPatient">Add Patient</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Patient Modal -->
<div class="modal fade" id="deletePatientModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Confirm</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">Are you sure you want to delete this patient?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button class="btn btn-danger" id="confirmDeleteBtn" data-bs-dismiss="modal">Yes</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<script>
    $(document).ready(function(){

        let rowToEdit = null;
        let rowToDelete = null;

        // -------------------------------
        // EDIT BUTTON
        // -------------------------------
        $(document).on("click", ".editBtn", function(){
            rowToEdit = $(this).closest("tr");

            $("#editFirstName").val($(this).data("firstname"));
            $("#editLastName").val($(this).data("lastname"));
            $("#editPatientNum").val($(this).data("number"));
            $("#editGender").val($(this).data("gender"));
            $("#editDob").val($(this).data("dob"));

            // New fields
            $("#editEmail").val($(this).data("email"));
            $("#editMobile").val($(this).data("mobile"));
            $("#editAddress").val($(this).data("address"));
            $("#editCountry").val($(this).data("country"));
            $("#editCity").val($(this).data("city"));
            $("#editPostal").val($(this).data("postal"));
            $("#editInjuredKnee").val($(this).data("injuredleg"));
        });

        // -------------------------------
        // SAVE EDITED PATIENT
        // -------------------------------
        $("#savePatientBtn").click(function(){

            if(rowToEdit){

                rowToEdit.find("td:eq(1)").text($("#editFirstName").val());
                rowToEdit.find("td:eq(2)").text($("#editLastName").val());
                rowToEdit.find("td:eq(3)").text($("#editPatientNum").val());
                rowToEdit.find("td:eq(4)").text($("#editGender").val());
                rowToEdit.find("td:eq(5)").text($("#editDob").val());

                // Update button data
                rowToEdit.find(".editBtn")
                    .data("firstname", $("#editFirstName").val())
                    .data("lastname", $("#editLastName").val())
                    .data("number", $("#editPatientNum").val())
                    .data("gender", $("#editGender").val())
                    .data("dob", $("#editDob").val())
                    .data("email", $("#editEmail").val())
                    .data("mobile", $("#editMobile").val())
                    .data("address", $("#editAddress").val())
                    .data("country", $("#editCountry").val())
                    .data("city", $("#editCity").val())
                    .data("postal", $("#editPostal").val());

                // Save on row as well
                rowToEdit
                    .data("email", $("#editEmail").val())
                    .data("mobile", $("#editMobile").val())
                    .data("address", $("#editAddress").val())
                    .data("country", $("#editCountry").val())
                    .data("city", $("#editCity").val())
                    .data("postal", $("#editPostal").val());
            }

            $("#editPatientModal").modal("hide");
        });


        // -------------------------------
        // DELETE BUTTON
        // -------------------------------
        $(document).on("click", ".deleteBtn", function(){
            rowToDelete = $(this).closest("tr");
            $("#deletePatientModal").modal("show");
        });

        $("#confirmDeleteBtn").click(function(){

            const id = rowToDelete.find("td:eq(0)").text().replace("#","");

            $.post(`/patients/${id}`, {
                _token: "{{ csrf_token() }}",
                _method: "DELETE"
            })
                .done(function(){
                    rowToDelete.remove();
                })
                .fail(function(){
                    alert("Error deleting patient.");
                });
        });

        // -------------------------------
        // VIEW PROFILE
        // -------------------------------
        $(document).on("click", ".viewBtn", function(){
            const patientNumber = $(this).data("number");
            window.location.href = `/report/${patientNumber}`;
        });

        // -------------------------------
        // ADD NEW PATIENT
        // -------------------------------
        $("#saveNewPatient").click(function(){

            const first = $("#addFirstName").val().trim();
            const last = $("#addLastName").val().trim();
            const number = $("#addPatientNumber").val().trim();
            const gender = $("#addGender").val();
            const dob = $("#addDob").val();

            const email = $("#addEmail").val().trim();
            const mobile = $("#addMobile").val().trim();
            const address = $("#addAddress").val().trim();
            const country = $("#addCountry").val().trim();
            const city = $("#addCity").val().trim();
            const postal = $("#addPostal").val().trim();

            if(!first || !last || !dob){
                alert("Please fill in First Name, Last Name, and Date of Birth.");
                return;
            }

            const tbody = $("#patientsTable tbody");
            const rowCount = tbody.find("tr").length;
            const newId = '#' + String(rowCount+1).padStart(4,'0');

            const newRow = `
        <tr
            data-email="${email}"
            data-mobile="${mobile}"
            data-address="${address}"
            data-country="${country}"
            data-city="${city}"
            data-postal="${postal}"
        >
            <td>${newId}</td>
            <td><img src="assets/images/doctor.png" class="img-2x rounded-5 me-1">${first}</td>
            <td>${last}</td>
            <td>${number}</td>
            <td>${gender}</td>
            <td>${dob}</td>

            <td>
                <button class="btn btn-outline-success btn-sm editBtn"
                    data-firstname="${first}"
                    data-lastname="${last}"
                    data-number="${number}"
                    data-gender="${gender}"
                    data-dob="${dob}"
                    data-email="${email}"
                    data-mobile="${mobile}"
                    data-address="${address}"
                    data-country="${country}"
                    data-city="${city}"
                    data-postal="${postal}"
                    data-bs-toggle="modal"
                    data-bs-target="#editPatientModal">
                    <i class="ri-edit-box-line"></i>
                </button>

                <button class="btn btn-outline-info btn-sm viewBtn" data-number="${number}">
                    <i class="ri-eye-line"></i>
                </button>

                <button class="btn btn-outline-danger btn-sm deleteBtn">
                    <i class="ri-delete-bin-line"></i>
                </button>
            </td>
        </tr>`;

            tbody.append(newRow);
            $("#addPatientModal").modal("hide");
            $("#addPatientForm")[0].reset();
        });

    });

    // ADD NEW PATIENT (SAVE TO DATABASE)
    $("#saveNewPatient").click(function(){

        const payload = {
            first_name: $("#addFirstName").val(),
            last_name: $("#addLastName").val(),
            patient_number: $("#addPatientNumber").val(),
            gender: $("#addGender").val(),
            dob: $("#addDob").val(),
            email: $("#addEmail").val(),
            mobile: $("#addMobile").val(),
            address: $("#addAddress").val(),
            country: $("#addCountry").val(),
            city: $("#addCity").val(),
            postal_code: $("#addPostal").val(),
            injured_knee: $("#addInjuredKnee").val(),
            _token: "{{ csrf_token() }}"
        };

        $.post("/patients", payload)
            .done(function(response){

                // Voeg nieuwe row toe (jouw bestaande code)
                const tbody = $("#patientsTable tbody");
                const rowCount = tbody.find("tr").length;
                const newId = '#' + String(rowCount+1).padStart(4,'0');

                const newRow = `
                <tr>
                    <td>${newId}</td>
                    <td>${payload.first_name}</td>
                    <td>${payload.last_name}</td>
                    <td>${payload.patient_number}</td>
                    <td>${payload.gender}</td>
                    <td>${payload.dob}</td>
                    <td>
                        <button class="btn btn-outline-success btn-sm editBtn"
                            data-firstname="${payload.first_name}"
                            data-lastname="${payload.last_name}"
                            data-number="${payload.patient_number}"
                            data-gender="${payload.gender}"
                            data-dob="${payload.dob}"
                            data-email="${payload.email}"
                            data-mobile="${payload.mobile}"
                            data-address="${payload.address}"
                            data-country="${payload.country}"
                            data-city="${payload.city}"
                            data-postal="${payload.postal}">
                            <i class="ri-edit-box-line"></i>
                        </button>

                        <button class="btn btn-outline-info btn-sm viewBtn" data-number="${payload.patient_number}">
                            <i class="ri-eye-line"></i>
                        </button>

                        <button class="btn btn-outline-danger btn-sm deleteBtn">
                            <i class="ri-delete-bin-line"></i>
                        </button>
                    </td>
                </tr>`;

                tbody.append(newRow);

                $("#addPatientModal").modal("hide");
                $("#addPatientForm")[0].reset();
            })
            .fail(function(){
                alert("Error saving patient.");
            });
    });


    const updatePayload = {
        first_name: $("#editFirstName").val(),
        last_name: $("#editLastName").val(),
        patient_number: $("#editPatientNum").val(),
        gender: $("#editGender").val(),
        dob: $("#editDob").val(),
        email: $("#editEmail").val(),
        mobile: $("#editMobile").val(),
        address: $("#editAddress").val(),
        country: $("#editCountry").val(),
        city: $("#editCity").val(),
        postal_code: $("#editPostal").val(),
        injured_knee: $("#editInjuredKnee").val(),
        _token: "{{ csrf_token() }}",
        _method: "PUT"
    };

    const id = rowToEdit.find("td:eq(0)").text().replace("#","");

    $.post(`/patients/${id}`, updatePayload)
        .fail(function(){
            alert("Error updating patient.");
        });
</script>


</body>
</html>
