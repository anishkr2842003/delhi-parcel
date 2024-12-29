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
    <title>Admin | All COD List</title>

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
                            <h1>All COD</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">All COD</li>
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
                                                <th>Delivery&nbsp;Boy</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include("../config.php");
                                            $delivery_boy_id = $_SESSION['delivery_boy_id']; // Ensure this session variable is set
                                            $sql = "SELECT dh.*, db.name FROM delivery_history dh JOIN delivery db ON dh.delivery_boy_id = db.id WHERE dh.delivery_boy_id = $delivery_boy_id";
                                            $result = mysqli_query($conn, $sql);
                                            $index = 1;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $index; ?></td>
                                                    <td><?php echo $row['order_id']; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['amount']; ?></td>
                                                    <td><?php echo date('j M Y', strtotime($row['created_at'])); ?></td>
                                                    <td>
                                                        <span class="badge bg-danger delete-cod" data-order_id="<?php echo $row['order_id']; ?>"><a href="#"><i class="fas fa-trash"></i> Clear Balance</a></span>
                                                    </td>
                                                </tr>
                                            <?php
                                                $index++;
                                            } ?>
                                        </tbody>
                                        <tfoot>
                                            <?php
                                            $total_sql = "SELECT SUM(amount) AS total_amount FROM delivery_history WHERE delivery_boy_id = $delivery_boy_id";
                                            $total_result = mysqli_query($conn, $total_sql);
                                            $total_row = mysqli_fetch_assoc($total_result);
                                            $total_amount = $total_row['total_amount'] ? $total_row['total_amount'] : 0;
                                            ?>
                                            <tr>
                                                <td colspan="3"><b>Total</b></td>
                                                <td colspan="3"><b><?php echo $total_amount; ?></b></td>
                                            </tr>
                                        </tfoot>
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
        // delete delivery
        $('.delete-cod').on('click', function() {
            var codOrderId = $(this).data('order_id');
            if (confirm("Are you sure you want to delete this cod?")) {

                $.ajax({
                    url: 'query.php',
                    type: 'POST',
                    data: {
                        id: codOrderId,
                        action: 'deleteCODHistory'
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response)
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
    </script>

</body>

</html>
