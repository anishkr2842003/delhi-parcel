<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['delivery_email'])) {
    header('Location: index.php');
}

if (isset($_SESSION['delivery_id'])) {
    $deliveryId = $_SESSION['delivery_id'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | All Delivery List</title>

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
                            <h1>All Delivery Boys</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">All Delivery Boys</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone No</th>
                                                <th>Address</th>
                                                <th>Pincode</th>
                                                <th>Login Password</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include("../config.php");
                                            $sql = "SELECT * FROM delivery WHERE added_by = '$deliveryId'";
                                            $result = mysqli_query($conn, $sql);
                                            $index  = 1;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $index ?></td>
                                                    <td><?php echo $row['name'] ?></td>
                                                    <td><?php echo $row['email'] ?></td>
                                                    <td><?php echo $row['mobile'] ?></td>
                                                    <td><?php echo $row['address'] ?></td>
                                                    <td><?php echo $row['pincode'] ?></td>
                                                    <td><?php echo $row['password'] ?></td>
                                                    <td>
                                                        <label class="switch">
                                                            <input type="checkbox" class="status-toggle" <?php echo $row['status'] ? 'checked' : ''; ?> data-id="<?php echo $row['id']; ?>">
                                                            <div class="slider">
                                                                <div class="circle">
                                                                    <svg class="cross" xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 365.696 365.696" y="0" x="0" height="6" width="6" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                                        <g>
                                                                            <path data-original="#000000" fill="currentColor" d="M243.188 182.86 356.32 69.726c12.5-12.5 12.5-32.766 0-45.247L341.238 9.398c-12.504-12.503-32.77-12.503-45.25 0L182.86 122.528 69.727 9.374c-12.5-12.5-32.766-12.5-45.247 0L9.375 24.457c-12.5 12.504-12.5 32.77 0 45.25l113.152 113.152L9.398 295.99c-12.503 12.503-12.503 32.769 0 45.25L24.48 356.32c12.5 12.5 32.766 12.5 45.247 0l113.132-113.132L295.99 356.32c12.503 12.5 32.769 12.5 45.25 0l15.081-15.082c12.5-12.504 12.5-32.77 0-45.25zm0 0"></path>
                                                                        </g>
                                                                    </svg>
                                                                    <svg class="checkmark" xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 24 24" y="0" x="0" height="10" width="10" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                                        <g>
                                                                            <path class="" data-original="#000000" fill="currentColor" d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z"></path>
                                                                        </g>
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-primary edit-seller" data-toggle="modal" data-target="#editModal" data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-loginemail="<?php echo $row['email']; ?>" data-loginpassword="<?php echo $row['password']; ?>" data-editMobile="<?php echo $row['mobile']; ?>" data-editAddress="<?php echo $row['address']; ?>" data-editPincode="<?php echo $row['pincode']; ?>"><a href="#"><i class="fas fa-edit"></i></a></span>
                                                        <span class="badge bg-danger delete-seller" data-id="<?php echo $row['id']; ?>"><a href="#"><i class="fas fa-trash"></i></a></span>
                                                    </td>
                                                </tr>
                                            <?php
                                                $index++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php include("inc/footer.php")   ?>
    </div>
    <!-- ./wrapper -->

    <!-- modal -->
    <!-- modal for edit login details -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Delivery Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateSellerLoginForm">
                        <input type="hidden" id="loginId" name="loginId">
                        <div class="form-group">
                            <label for="editName">Name</label>
                            <input type="text" class="form-control" id="editName" name="editName" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="loginEmail2">Email</label>
                            <input type="email" class="form-control" id="loginEmail2" name="loginEmail2" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label for="editMobile">Phone</label>
                            <input type="number" class="form-control" id="editMobile" name="editMobile" placeholder="Enter Phone">
                        </div>
                        <div class="form-group">
                            <label for="editAddress">Address</label>
                            <input type="text" class="form-control" id="editAddress" name="editAddress" placeholder="Enter Address">
                        </div>
                        <div class="form-group">
                            <label for="editPincode">Pincode</label>
                            <input type="number" class="form-control" id="editPincode" name="editPincode" placeholder="Enter Pincode">
                        </div>
                        <div class="form-group">
                            <label for="loginPassword2">Login Password</label>
                            <input type="text" class="form-control" id="loginPassword2" name="loginPassword2" placeholder="Enter Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Delivery</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    </div>



    <!-- Page specific script -->

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            // update seller status
            $('.status-toggle').on('change', function() {
                var sellerId = $(this).data('id');
                var status = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: 'query.php',
                    type: 'POST',
                    data: {
                        id: sellerId,
                        status: status,
                        action: 'updateDeliveryStatus'
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            Toast('success', response.message);
                        } else {
                            Toast('error', response.message);
                        }
                    },
                    error: function() {
                        Toast('error', 'An error occurred. Please try again.');
                    }
                });
            });

            // Open edit modal and fill data
            $(document).on('click', '.edit-seller', function() {
                var data = $(this).data();
                $('#loginId').val(data.id);
                $('#editName').val(data.name);
                $('#loginEmail2').val(data.loginemail);
                $('#editMobile').val(data.editmobile);
                $('#editAddress').val(data.editaddress);
                $('#editPincode').val(data.editpincode);
                $('#loginPassword2').val(data.loginpassword);
                $('#editModal').modal('show');
            });

            // update delivery details
            $('#updateSellerLoginForm').on('submit', function(event) {
                event.preventDefault();

                // Front-end validation
                var loginEmail2 = $('#loginEmail2').val()
                var loginPassword2 = $('#loginPassword2').val()

                var loginId = $('#loginId').val();
                var editName = $('#editName').val();
                var loginEmail2 = $('#loginEmail2').val();
                var editMobile = $('#editMobile').val();
                var editAddress = $('#editAddress').val();
                var editPincode = $('#editPincode').val();
                var loginPassword2 = $('#loginPassword2').val();

                if (!editName) {
                    Toast("error", "Name is required");
                    return;
                }
                if (!loginEmail2) {
                    Toast("error", "Email is required");
                    return;
                }
                if (!editMobile) {
                    Toast("error", "Mobile is required");
                    return;
                }
                if (!editAddress) {
                    Toast("error", "Address is required");
                    return;
                }
                if (!editPincode) {
                    Toast("error", "Pincode is required");
                    return;
                }
                if (!loginPassword2) {
                    Toast("error", "Password is required");
                    return;
                }

                var formData = new FormData(this);
                formData.append('action', 'updateDelivery');

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
                        console.log(data);
                        if (data.status === 'success') {
                            Toast('success', response.message);
                            $('#updateSellerLoginForm')[0].reset();
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        } else {
                            Toast('error', response.message)
                        }
                    },
                    error: function(error) {
                        console.log(error)
                        Toast('error', 'An error occurred. Please try again.')
                        // alert('An error occurred. Please try again.');
                    }
                });
            });

            // delete delivery
            $('.delete-seller').on('click', function() {
                var sellerId = $(this).data('id');
                if (confirm("Are you sure you want to delete this seller?")) {

                    $.ajax({
                        url: 'query.php',
                        type: 'POST',
                        data: {
                            id: sellerId,
                            action: 'deleteDelivery'
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                Toast('success', response.message);
                                window.location.reload();
                            } else {
                                Toast('error', response.message);
                            }
                        },
                        error: function() {
                            Toast('error', 'An error occurred. Please try again.');
                        }
                    });

                }
            });


        });
    </script>

</body>

</html>