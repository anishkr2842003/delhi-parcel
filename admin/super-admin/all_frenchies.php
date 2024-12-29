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
    <title>Admin | All Seller List</title>

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
                            <h1>All Sellers</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">All Sellers</li>
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
                                                <th>No of Items</th>
                                                <th>Category</th>
                                                <th>GST or Pan no</th>
                                                <th>Image</th>
                                                <th>Address</th>
                                                <th>Pincode</th>
                                                <th>Login Email</th>
                                                <th>Login Password</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include("../config.php");
                                            $sql = "SELECT * FROM seller";
                                            $result = mysqli_query($conn, $sql);
                                            $index  = 1;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $index ?></td>
                                                    <td><?php echo $row['fullName'] ?></td>
                                                    <td><?php echo $row['email'] ?></td>
                                                    <td><?php echo $row['phone'] ?></td>
                                                    <td><?php echo $row['itemsCount'] ?></td>
                                                    <td><?php echo $row['category'] ?></td>
                                                    <td><?php echo $row['panNo'] ?></td>
                                                    <td><img src="<?php echo $row['image'] ?>" alt="" height="100px" class="full_img" data-toggle="modal" data-target="#imageModal" data-image=<?php echo $row['image']; ?>></td>
                                                    <td><?php echo $row['fullAddress'] ?></td>
                                                    <td><?php echo $row['pincode'] ?></td>
                                                    <td><?php echo $row['login_email'] ?></td>
                                                    <td><?php echo $row['login_password'] ?></td>
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
                                                        <span class="badge bg-primary edit-seller" data-toggle="modal" data-target="#editModal" data-id="<?php echo $row['id']; ?>" data-loginemail="<?php echo $row['login_email']; ?>" data-loginpassword="<?php echo $row['login_password']; ?>"><a href="#"><i class="fas fa-edit"></i></a></span>
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
    <!-- modal for full size image -->
    <div class="modal fade" id="imageModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pan or GST Image</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="" alt="" id="fullSizeImage" style="height: 100%; width: 100%; object-fit: cover;">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- modal -->
    <!-- modal for edit login details -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Seller login details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateSellerLoginForm">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="loginEmail2">Login Email</label>
                                <input type="text" class="form-control" id="loginId" name="loginId" placeholder="Enter Product Name" hidden>
                                <input type="text" class="form-control" id="loginEmail2" name="loginEmail2" placeholder="Enter Product Name">
                            </div>
                            <div class="form-group">
                                <label for="loginPassword2">Login Password</label>
                                <input type="text" class="form-control" id="loginPassword2" name="loginPassword2" placeholder="Enter Product Category">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update seller</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    </div>



    <!-- Page specific script -->

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": false,
                "scrollX": true,
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

            // open image modal and show image in full size
            $('.full_img').on('click', function() {
                var imgSrc = $(this).data('image');
                $('#fullSizeImage').attr('src', imgSrc);
                $('#imageModal').modal('show');
            });

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
                        action: 'updateSellerStatus'
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

            // open edit modal and edit seller login details
            $(document).on('click', '.edit-seller', function() {
                var loginId = $(this).data('id');
                var loginEmail = $(this).data('loginemail');
                var loginPassword = $(this).data('loginpassword');
                $('#loginId').val(loginId);
                $('#loginEmail2').val(loginEmail);
                $('#loginPassword2').val(loginPassword);
                $('#editModal').modal('show');
            });

            // update seller login details
            $('#updateSellerLoginForm').on('submit', function(event) {
                event.preventDefault();

                // Front-end validation
                var loginEmail2 = $('#loginEmail2').val()
                var loginPassword2 = $('#loginPassword2').val()

                if (!loginEmail2) {
                    Toast("error", "Email is required");
                    return;
                }
                if (!loginPassword2) {
                    Toast("error", "Password is required");
                    return;
                }

                var formData = new FormData(this);
                formData.append('action', 'updateSellerLogin');

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

            // delete service
            $('.delete-seller').on('click', function() {
                var sellerId = $(this).data('id');
                if (confirm("Are you sure you want to delete this seller?")) {

                    $.ajax({
                        url: 'query.php',
                        type: 'POST',
                        data: {
                            id: sellerId,
                            action: 'deleteSeller'
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