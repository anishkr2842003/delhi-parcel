<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin_email'])) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Add Delivery Boy</title>

    <?php include("inc/links.php") ?>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include("inc/topbar.php") ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include("inc/sidebar.php") ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Add Delivery Boy</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Add Delivery Boy</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Add new delivery here</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form id="deliveryForm">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="fullName">Name</label>
                                                    <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter Name">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="fullAddress">Address</label>
                                                    <input type="text" class="form-control" id="fullAddress" name="fullAddress" placeholder="Enter Address">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="phone">Phone No.</label>
                                                    <input type="number" class="form-control" id="phone" name="phone" placeholder="Enter Phone No.">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="pinCode">Pin code</label>
                                                    <input type="number" class="form-control" id="pinCode" name="pinCode" placeholder="Enter Pin code">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="text" class="form-control" id="password" name="password" placeholder="Enter Password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Add Delivery Boy</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php include("inc/footer.php") ?>


        <!-- ./wrapper -->
        <script>
            $(document).ready(function() {

                // add inquiry 
                $('#deliveryForm').on('submit', function(event) {
                    event.preventDefault();

                    // Front-end validation
                    var fullName = $('#fullName').val()
                    var email = $('#email').val()
                    var fullAddress = $('#fullAddress').val()
                    var phone = $('#phone').val()
                    var pinCode = $('#pinCode').val()
                    var password = $('#password').val()

                    if (!fullName) {
                        Toast("error", "Name is required");
                        return;
                    }
                    if (!email) {
                        Toast("error", "email is required");
                        return;
                    }
                    if (!fullAddress) {
                        Toast("error", "Address is required");
                        return;
                    }
                    if (!phone) {
                        Toast("error", "phone is required");
                        return;
                    }
                    if (!pinCode) {
                        Toast("error", "PinCode is required");
                        return;
                    }
                    if (!password) {
                        Toast("error", "Password is required");
                        return;
                    }
                    if (pinCode.length != 6) {
                        Toast("error", "Enter valid pincode");
                        return;
                    }

                    var formData = new FormData(this);
                    formData.append('action', 'adddelivery');

                    $.ajax({
                        url: 'query.php',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            const data = typeof response === 'string' ? JSON.parse(response) : response;
                            // console.log(data);
                            if (data.status === 'success') {
                                Toast('success', response.message);
                                $('#deliveryForm')[0].reset();
                            } else {
                                Toast('error', response.message)
                            }
                        },
                        error: function(error) {
                            // console.log(error)
                            Toast('error', 'An error occurred. Please try again.')
                            // alert('An error occurred. Please try again.');
                        }
                    });
                });

            });
        </script>
</body>

</html>