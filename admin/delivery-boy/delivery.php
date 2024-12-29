<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['delivery_boy_email'])) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | All Order List</title>

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
                            <h1>Order for Delivery</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Order for Delivery</li>
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
                                                <th>Sr&nbsp;No.</th>
                                                <th>Order&nbsp;id</th>
                                                <th>Sender</th>
                                                <th>Receiver</th>
                                                <th>Pickup&nbsp;Pincode</th>
                                                <th>Delivery&nbsp;Pincode</th>
                                                <th>Service</th>
                                                <th>Weight&nbsp;/&nbsp;Distance</th>
                                                <th>Payment&nbsp;Mode</th>
                                                <th>Order&nbsp;Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include("../config.php");
                                            $delivery_boy_id = $_SESSION['delivery_boy_id'];
                                            $sql = "SELECT * FROM orders WHERE parcel_type = 'delivery' AND assign_to = '$delivery_boy_id'";
                                            $result = mysqli_query($conn, $sql);
                                            $index = 1;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                // var_dump($row);
                                            ?>
                                                <tr>
                                                    <td><?php echo $index; ?></td>
                                                    <td><?php echo $row['order_id']; ?></td>
                                                    <td><b>Name:</b> <?php echo $row['sender_name']; ?> <br><br><b>Email:</b> <?php echo $row['sender_email']; ?> <br><br><b>Number:</b> <?php echo $row['sender_number']; ?><br><br><b>Address:</b> <?php echo $row['sender_address']; ?> </td>
                                                    <td><b>Name:</b> <?php echo $row['receiver_name']; ?> <br><br><b>Email:</b> <?php echo $row['receiver_email']; ?> <br><br><b>Number:</b> <?php echo $row['receiver_number']; ?><br><br><b>Address:</b> <?php echo $row['receiver_address']; ?> </td>
                                                    <td><b>Pincode:</b><br><?php echo $row['sender_pincode']; ?></td>
                                                    <td><b>Pincode:</b><br><?php echo $row['receiver_pincode']; ?></td>
                                                    <td><?php echo $row['service_type']; ?></td>
                                                    <td><?php echo $row['service_title']; ?></td>
                                                    <td>
                                                        <div class="btn <?php echo $row['payment_mode'] == 'online' ? 'bg-success' : 'bg-danger' ?>"><?php echo $row['payment_mode']; ?></div>
                                                    </td>
                                                    <td><button type="button" class="btn btn-block btn-primary order_status" data-toggle="modal" data-target="#modal-default" data-orderid=<?php echo $row['order_id'] ?>><?php echo $row['order_status'] ?></button></td>
                                                    <td>
                                                        <span class="badge bg-primary"><a href="invoice.php?ordId=<?php echo $row['order_id'] ?>"><i class="far fa-eye"></i></a></span>
                                                        <!-- <span class="badge bg-danger"><a href="#"><i class="fas fa-trash"></i></a></span> -->
                                                    </td>
                                                </tr>
                                            <?php
                                                $index++;
                                            } ?>
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
                    <h4 class="modal-title">Order Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="statusForm">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="orderIdedit">Order id</label>
                                <input type="text" class="form-control" id="orderIdedit" name="orderIdedit" placeholder="Enter Message" readonly>
                            </div>
                            <div class="form-group">
                                <label for="orderStatus">Select Order Status</label>
                                <select class="custom-select rounded-0" id="orderStatus" name="orderStatus">
                                    <option selected disabled> Chooese order status</option>
                                    <!-- <option value="Item Picked Up">Item Picked Up</option>
                                    <option value="Returned">Returned</option> -->
                                    <option value="In Transist">In Transist</option>
                                    <option value="Arrived at Destination">Arrived at Destination</option>
                                    <option value="Out of Delivery">Out of Delivery</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Not Delivered">Not Delivered</option>
                                    <option value="Returing to Origin">Returing to Origin</option>
                                    <option value="Out of Delivery to Origin">Out of Delivery to Origin</option>
                                    <option value="Returned">Returned</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="messageedit">Message</label>
                                <input type="text" class="form-control" id="messageedit" name="messageedit" placeholder="Enter Message">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update Order Status</button>
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
                // "buttons": ["excel", "pdf", "print"]
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

            $('.order_status').on('click', function() {
                const orderId = $(this).data('orderid');
                // openEditModal(jobId);
                $('#orderIdedit').val(orderId);
                $('#modal-default').modal('show');
            });

            // update job
            $('#statusForm').on('submit', function(event) {
                event.preventDefault();
                // console.log('hello')

                if (!($('#orderIdedit').val())) {
                    Toast('error', 'Id is required');
                    return;
                }

                if (!($('#orderStatus').val())) {
                    Toast('error', 'Order Status is required');
                    return;
                }

                const formData = new FormData(this);
                formData.append('action', 'changeOrderStatus')

                // formData.forEach((value, key) => {
                //   console.log(key, value);
                // });

                // Send the form data via AJAX
                $.ajax({
                    url: 'query.php',
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(response) {
                        // console.log(response)
                        var res = JSON.parse(response);
                        if (res.status == 'success') {
                            Toast('success', res.message);
                            $('#modal-default').modal('hide');
                            location.reload();
                        } else {
                            Toast('error', res.message)
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('An error occurred while updating the job.');
                    }
                });
            });
        });
    </script>

</body>

</html>