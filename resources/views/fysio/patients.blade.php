<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clove Dental Care Admin Template</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/remix/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bs5.css') }}">
</head>

<body>

<div class="page-wrapper">
    <div class="main-container">

        <!-- Sidebar wrapper starts -->
        <nav id="sidebar" class="sidebar-wrapper">

            <!-- Brand container starts -->
            <div class="brand-container d-flex align-items-center justify-content-between">

                <!-- App brand starts -->
                <div class="app-brand ms-3">
                    <a href="{{ url('/homepage') }}">
                        <img src="assets/images/logo.png" class="logo" alt="Dental Care Admin Template">
                    </a>
                </div>
                <!-- App brand ends -->

            </div>
            <!-- Brand container ends -->

            <!-- Sidebar profile starts -->
            <div class="sidebar-profile">
                <img src="{{ asset('assets/images/doctor5.png') }}" class="rounded-5 border border-primary border-3"
                     alt="Dentist Admin Templates">
                <h6 class="mb-1 profile-name text-nowrap text-truncate text-primary">Sarah Smith</h6>
                <small class="profile-name text-nowrap text-truncate">Physiotherapist</small>
            </div>
            <!-- Sidebar profile ends -->

            <!-- Sidebar menu starts -->
            <div class="sidebarMenuScroll">
                <ul class="sidebar-menu">
                    <li>
                        <a href="{{ url('/homepage') }}">
                            <i class="ri-home-6-line"></i>
                            <span class="menu-text">Homepage</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Sidebar menu ends -->

            <!-- Sidebar contact starts -->
            <div class="sidebar-contact">
                <p class="fw-light mb-1 text-nowrap text-truncate">Emergency Contact</p>
                <h5 class="m-0 lh-1 text-nowrap text-truncate">0987654321</h5>
                <i class="ri-phone-line"></i>
            </div>
            <!-- Sidebar contact ends -->

        </nav>
        <!-- Sidebar wrapper ends -->

        <!-- App container -->
        <div class="app-container">

            <!-- Header -->
            <div class="app-header d-flex align-items-center">
                <!-- Header content -->
            </div>

            <!-- Hero Header -->
            <div class="app-hero-header d-flex align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/homepage') }}"><i class="ri-home-3-line"></i></a></li>
                    <li class="breadcrumb-item text-primary">Patients</li>
                </ol>
            </div>

            <!-- Body -->
            <div class="app-body">
                <div class="row gx-4">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body pt-0">

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
                                            <td><img src="{{ asset('assets/images/doctor.png') }}" class="img-2x rounded-5 me-1">Jane</td>
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
                                            <td><img src="{{ asset('assets/images/doctor1.png') }}" class="img-2x rounded-5 me-1">John</td>
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
                                            <td><img src="{{ asset('assets/images/doctor.png') }}" class="img-2x rounded-5 me-1">Jet</td>
                                            <td>Sanders</td>
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

                                <!-- Add Patient Button -->
                                <div class="d-flex justify-content-end mb-3">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPatientModal">Add Patient</button>
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
                    <div class="mb-3"><label>First Name</label><input type="text" id="editFirstName" class="form-control"></div>
                    <div class="mb-3"><label>Last Name</label><input type="text" id="editLastName" class="form-control"></div>
                    <div class="mb-3"><label>Patient Number</label><input type="text" id="editPatientNum" class="form-control"></div>
                    <div class="mb-3"><label>Gender</label>
                        <select id="editGender" class="form-select">
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3"><label>Date of Birth</label><input type="date" id="editDob" class="form-control"></div>
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
                    <div class="mb-3"><label>First Name</label><input type="text" id="addFirstName" class="form-control" required></div>
                    <div class="mb-3"><label>Last Name</label><input type="text" id="addLastName" class="form-control" required></div>
                    <div class="mb-3"><label>Patient Number (from dossier)</label><input type="text" id="addPatientNumber" class="form-control"></div>
                    <div class="mb-3"><label>Gender</label>
                        <select id="addGender" class="form-select">
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3"><label>Date of Birth</label><input type="date" id="addDob" class="form-control" required></div>
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

        // Edit button
        $(document).on("click", ".editBtn", function(){
            rowToEdit = $(this).closest("tr");
            $("#editFirstName").val($(this).data("firstname"));
            $("#editLastName").val($(this).data("lastname"));
            $("#editPatientNum").val($(this).data("number"));
            $("#editGender").val($(this).data("gender"));
            $("#editDob").val($(this).data("dob"));
        });

        // Save edited patient
        $("#savePatientBtn").click(function(){
            if(rowToEdit){
                rowToEdit.find("td:eq(1)").html('<img src="{{ asset('assets/images/doctor.png') }}" class="img-2x rounded-5 me-1">'+$("#editFirstName").val());
                rowToEdit.find("td:eq(2)").text($("#editLastName").val());
                rowToEdit.find("td:eq(3)").text($("#editPatientNum").val());
                rowToEdit.find("td:eq(4)").text($("#editGender").val());
                rowToEdit.find("td:eq(5)").text($("#editDob").val());

                rowToEdit.find(".editBtn")
                    .data("firstname", $("#editFirstName").val())
                    .data("lastname", $("#editLastName").val())
                    .data("number", $("#editPatientNum").val())
                    .data("gender", $("#editGender").val())
                    .data("dob", $("#editDob").val());
            }
            $("#editPatientModal").modal("hide");
        });

        // Delete button
        $(document).on("click", ".deleteBtn", function(){
            rowToDelete = $(this).closest("tr");
            $("#deletePatientModal").modal("show");
        });

        // Confirm delete
        $("#confirmDeleteBtn").click(function(){
            if(rowToDelete) rowToDelete.remove();
        });

        // View Profile button
        $(document).on("click", ".viewBtn", function(){
            const patientNumber = $(this).data("number");
            window.location.href = `/report/${patientNumber}`;
        });

        // Add patient
        $("#saveNewPatient").click(function(){
            const first = $("#addFirstName").val().trim();
            const last = $("#addLastName").val().trim();
            const number = $("#addPatientNumber").val().trim();
            const gender = $("#addGender").val();
            const dob = $("#addDob").val();

            if(!first || !last || !dob){
                alert("Please fill in First Name, Last Name, and Date of Birth.");
                return;
            }

            const tbody = $("#patientsTable tbody");
            const rowCount = tbody.find("tr").length;
            const newId = '#' + String(rowCount+1).padStart(4,'0');

            const newRow = `<tr>
            <td>${newId}</td>
            <td><img src="assets/images/doctor.png" class="img-2x rounded-5 me-1">${first}</td>
            <td>${last}</td>
            <td>${number}</td>
            <td>${gender}</td>
            <td>${dob}</td>
            <td>
                <button class="btn btn-outline-success btn-sm editBtn" data-firstname="${first}" data-lastname="${last}" data-number="${number}" data-gender="${gender}" data-dob="${dob}" data-bs-toggle="modal" data-bs-target="#editPatientModal"><i class="ri-edit-box-line"></i></button>
                <button class="btn btn-outline-info btn-sm viewBtn" data-number="${number}"><i class="ri-eye-line"></i></button>
                <button class="btn btn-outline-danger btn-sm deleteBtn"><i class="ri-delete-bin-line"></i></button>
            </td>
        </tr>`;

            tbody.append(newRow);
            $("#addPatientModal").modal("hide");
            $("#addPatientForm")[0].reset();
        });
    });
</script>

</body>
</html>
