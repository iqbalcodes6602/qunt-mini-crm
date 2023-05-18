<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD App Laravel 8 & Ajax</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />

</head>

<body class="bg-light">
    <div class="container" style="width:40%; min-width:300px">
        <form action="#" method="POST" id="registration_form" enctype="multipart/form-data">
            @csrf
            <div class="modal-body p-4 bg-light">
                <div class="my-4">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                </div>
                <div class="my-4">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                </div>
                <div class="my-4">
                    <label for="phone">Password</label>
                    <input type="tel" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="my-4">
                    <label for="post">Website</label>
                    <input type="text" name="website" class="form-control" placeholder="Website" required>
                </div>
                <div class="my-4">
                    <label for="avatar">Select Logo</label>
                    <input type="file" name="logo" class="form-control" required>
                </div>
                <div class="my-4">
                    <button type="submit" id="register_account_btn" class="btn btn-primary">Register</button>
                </div>
        </form>
    </div>
    </div>
</body>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function() {
        // add new Account ajax request
        $("#registration_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#register_account_btn").text('Adding...');
            $.ajax({
                url: '{{route("add_account")}}',
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
                            response.message,
                            'success'
                        );
                        $("#registration_form")[0].reset();
                    }
                    if (response.status == 409) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                    $("#register_account_btn").text('Register Account');
                }
            });
        });
    });
</script>

</html>