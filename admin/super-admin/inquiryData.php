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
    <title>Admin | All Inquiry Data</title>

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
                            <h1>All Inquiry Data</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">All Inquiry Data</li>
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
                                <!-- <div class="card-header">
                  <h3 class="card-title">List of all products</h3>
                </div> -->
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
                                                <th>Services</th>
                                                <th>GST or Pan no</th>
                                                <th>Image</th>
                                                <th>Address</th>
                                                <th>Message</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include("../config.php");
                                            $sql = "SELECT * FROM contactus";
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
                                                    <td><img src="<?php echo $row['image'] ?>" alt="" height="100px" class="full_img" data-toggle="modal" data-target="#modal-default" data-image=<?php echo $row['image']; ?>></td>
                                                    <td><?php echo $row['fullAddress'] ?></td>
                                                    <td><?php echo $row['message'] ?></td>
                                                    <td>
                                                        <span class="badge bg-danger delete-service" data-id=<?php echo $row['id']; ?>><a href="#"><i class="fas fa-trash"></i></a></span>
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
    <div class="modal fade" id="modal-default">
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


    </div>



    <!-- Page specific script -->

    <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": false,
        "scrollX": true,
        "lengthChange": false,
        "autoWidth": false,
        "searching": false,
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

            // delete service
            $('.delete-service').on('click', function() {
                var messageId = $(this).data('id');

                $.ajax({
                    url: 'query.php',
                    type: 'POST',
                    data: {
                        id: messageId,
                        action: 'deleteInquiry'
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
            });

            // open modal and fetch data
            $('.full_img').on('click', function() {
                var imgSrc = $(this).data('image');

                // Populate the modal fields
                $('#fullSizeImage').attr('src', imgSrc);
            });

        });
    </script>

</body>

</html>