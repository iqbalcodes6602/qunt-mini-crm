<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD App Laravel 8 & Ajax</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />

    <style>
        .nav-tabs .nav-link {
            color: #333;
            /* Set the text color for non-active tabs */
            background-color: #f8f9fa;
            /* Set the background color for non-active tabs */
            border-color: #ddd;
            /* Set the border color for non-active tabs */
        }

        .nav-tabs .nav-link.active {
            color: #fff;
            /* Set the text color for the active tab */
            background-color: #007bff;
            /* Set the background color for the active tab */
            border-color: #007bff;
            /* Set the border color for the active tab */
        }
    </style>
</head>

{{-- add new company modal start --}}
<div class="modal fade" id="addCompanyModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New company</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" id="add_company_form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4 bg-light">
                    <div class="my-2">
                        <label for="fname">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name of Company" required>
                    </div>
                    <div class="my-2">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                    </div>
                    <div class="my-2">
                        <label for="website">Website</label>
                        <input type="text" name="website" class="form-control" placeholder="Website" required>
                    </div>
                    <div class="my-2">
                        <label for="City">City</label>
                        <input type="text" name="city" class="form-control" placeholder="Location of Company" required>
                    </div>
                    <div class="my-2">
                        <label for="logo">Select Logo</label>
                        <input type="file" name="logo" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="add_company_btn" class="btn btn-primary">Add company</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- add new company modal end --}}

{{-- edit company modal start --}}
<div class="modal fade" id="editCompanyModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit company</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" id="edit_company_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="comp_id" id="comp_id">
                <input type="hidden" name="comp_logo" id="comp_logo">
                <div class="modal-body p-4 bg-light">
                    <div class="my-2">
                        <label for="fname">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name of comp" required>
                    </div>
                    <div class="my-2">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required>
                    </div>
                    <div class="my-2">
                        <label for="website">Website</label>
                        <input type="text" name="website" id="website" class="form-control" placeholder="Website" required>
                    </div>
                    <div class="my-2">
                        <label for="city">City</label>
                        <input type="text" name="city" id="city" class="form-control" placeholder="Location of city" required>
                    </div>
                    <div class="my-2">
                        <label for="logo">Select Logo</label>
                        <input type="file" name="logo" class="form-control">
                    </div>
                    <div class="mt-2" id="logo">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="edit_company_btn" class="btn btn-success">Update company</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- edit company modal end --}}




{{-- add new employee modal start --}}
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" id="add_employee_form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4 bg-light">
                    <div class="row">
                        <div class="col-lg">
                            <label for="fname">First Name</label>
                            <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="col-lg">
                            <label for="lname">Last Name</label>
                            <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                    </div>
                    <div class="my-2">
                        <label for="phone">Phone</label>
                        <input type="tel" name="phone" class="form-control" placeholder="Phone" required>
                    </div>
                    <div class="my-2">
                        <label for="company">company</label>
                        <input type="text" name="company" class="form-control" placeholder="company" required>
                    </div>
                    <div class="my-2">
                        <label for="avatar">Select Avatar</label>
                        <input type="file" name="avatar" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="add_employee_btn" class="btn btn-primary">Add Employee</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- add new employee modal end --}}

{{-- edit employee modal start --}}
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" id="edit_employee_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="emp_id" id="emp_id">
                <input type="hidden" name="emp_avatar" id="emp_avatar">
                <div class="modal-body p-4 bg-light">
                    <div class="row">
                        <div class="col-lg">
                            <label for="fname">First Name</label>
                            <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="col-lg">
                            <label for="lname">Last Name</label>
                            <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required>
                    </div>
                    <div class="my-2">
                        <label for="phone">Phone</label>
                        <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone" required>
                    </div>
                    <div class="my-2">
                        <label for="company">company</label>
                        <input type="text" name="company" id="company" class="form-control" placeholder="company" required>
                    </div>
                    <div class="my-2">
                        <label for="avatar">Select Avatar</label>
                        <input type="file" name="avatar" class="form-control">
                    </div>
                    <div class="mt-2" id="avatar">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="edit_employee_btn" class="btn btn-success">Update Employee</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- edit employee modal end --}}





<body>
    <nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: #e3f2fd;">
        <div class="container">
            <a class="navbar-brand mr-auto" href="#">Mini-CRM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('signout') }}">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')


    <!-- tabs-->
    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Company</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Employee</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <!--company tab-->
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="container">
                <div class="row my-5">
                    <div class="col-lg-12">
                        <div class="card shadow">
                            <div class="card-header bg-danger d-flex justify-content-between align-items-center">
                                <h3 class="text-light">Manage Companies</h3>
                                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addCompanyModal"><i class="bi-plus-circle me-2"></i>Add New Comany</button>
                            </div>
                            <div class="card-body" id="show_all_companys">
                                <h1 class="text-center text-secondary my-5">Loading...</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--company tab closed-->



        <!-- employee tab -->
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="container">
                <div class="row my-5">
                    <div class="col-lg-12">
                        <div class="card shadow">
                            <div class="card-header bg-danger d-flex justify-content-between align-items-center">
                                <h3 class="text-light">Manage Employees</h3>
                                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addEmployeeModal"><i class="bi-plus-circle me-2"></i>Add New Employee</button>
                            </div>
                            <div class="card-body" id="show_all_employees">
                                <h1 class="text-center text-secondary my-5">Loading...</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- employee tab closed -->
    </div>
    <!-- tabs -->




</body>



<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- employee ajax -->
<script>
    $(function() {

        // add new employee ajax request
        $("#add_employee_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#add_employee_btn").text('Adding...');
            $.ajax({
                url: '{{route("emp_store")}}',
                method: 'post',
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 200) {
                        Swal.fire(
                            'Added!',
                            'Employee Added Successfully!',
                            'success'
                        )
                        fetchAllEmployees();
                    }
                    $("#add_employee_btn").text('Add Employee');
                    $("#add_employee_form")[0].reset();
                    $("#addEmployeeModal").modal('hide');
                }
            });
        });

        // edit employee ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route("emp_edit") }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $("#fname").val(response.first_name);
                    $("#lname").val(response.last_name);
                    $("#email").val(response.email);
                    $("#phone").val(response.phone);
                    $("#company").val(response.company);
                    $("#avatar").html(
                        `<img src="storage/images/${response.avatar}" width="100" class="img-fluid img-thumbnail">`);
                    $("#emp_id").val(response.id);
                    $("#emp_avatar").val(response.avatar);
                }
            });
        });

        // update employee ajax request
        $("#edit_employee_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#edit_employee_btn").text('Updating...');
            $.ajax({
                url: '{{ route("emp_update") }}',
                method: 'post',
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 200) {
                        Swal.fire(
                            'Updated!',
                            'Employee Updated Successfully!',
                            'success'
                        )
                        fetchAllEmployees();
                    }
                    $("#edit_employee_btn").text('Update Employee');
                    $("#edit_employee_form")[0].reset();
                    $("#editEmployeeModal").modal('hide');
                }
            });
        });

        // delete employee ajax request
        $(document).on('click', '.deleteIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            let csrf = '{{ csrf_token() }}';
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("emp_delete") }}',
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function(response) {
                            console.log(response);
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            fetchAllEmployees();
                        }
                    });
                }
            })
        });

        // fetch all employees ajax request
        fetchAllEmployees();

        function fetchAllEmployees() {
            $.ajax({
                url: '{{ route("emp_fetchAll") }}',
                method: 'get',
                success: function(response) {
                    $("#show_all_employees").html(response);
                    $("table").DataTable({
                        order: [0, 'desc']
                    });
                }
            });
        }
    });
</script>
<!-- employee ajax end-->



<!-- company ajax -->
<script>
    $(function() {

        // add new company ajax request
        $("#add_company_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#add_company_btn").text('Adding...');
            $.ajax({
                url: '{{route("comp_store")}}',
                method: 'post',
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 200) {
                        Swal.fire(
                            'Added!',
                            'company Added Successfully!',
                            'success'
                        )
                        fetchAllCompanys();
                    }
                    $("#add_company_btn").text('Add company');
                    $("#add_company_form")[0].reset();
                    $("#addcompanyModal").modal('hide');
                }
            });
        });

        // edit company ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route("comp_edit") }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $("#name").val(response.name);
                    $("#lname").val(response.last_name);
                    $("#email").val(response.email);
                    $("#website").val(response.website);
                    $("#city").val(response.city);
                    $("#logo").html(
                        `<img src="storage/images/${response.logo}" width="100" class="img-fluid img-thumbnail">`);
                    $("#comp_id").val(response.id);
                    $("#comp_logo").val(response.logo);
                }
            });
        });

        // update company ajax request
        $("#edit_company_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#edit_company_btn").text('Updating...');
            $.ajax({
                url: '{{ route("comp_update") }}',
                method: 'post',
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 200) {
                        Swal.fire(
                            'Updated!',
                            'company Updated Successfully!',
                            'success'
                        )
                        fetchAllCompanys();
                    }
                    $("#edit_company_btn").text('Update company');
                    $("#edit_company_form")[0].reset();
                    $("#editcompanyModal").modal('hide');
                }
            });
        });

        // delete company ajax request
        $(document).on('click', '.deleteIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            let csrf = '{{ csrf_token() }}';
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("comp_delete") }}',
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function(response) {
                            console.log(response);
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            fetchAllCompanys();
                        }
                    });
                }
            })
        });

        // fetch all companys ajax request
        fetchAllCompanys();

        function fetchAllCompanys() {
            $.ajax({
                url: '{{ route("comp_fetchAll") }}',
                method: 'get',
                success: function(response) {
                    $("#show_all_companys").html(response);
                    $("table").DataTable({
                        order: [0, 'desc']
                    });
                }
            });
        }
    });
</script>
<!-- company ajax end-->

</html>