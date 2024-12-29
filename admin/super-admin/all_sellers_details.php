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
                                                <th>Pincode</th>
                                                <th>Today</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            include("../config.php");

                                            // Fetch sellers and their order counts
                                            $sql = "
                                                SELECT
                                                    s.id,
                                                    s.fullName,
                                                    s.email,
                                                    s.phone,
                                                    s.pincode,
                                                    COUNT(o.id) AS total_orders,
                                                    SUM(CASE WHEN o.order_status != 'Delivered' THEN 1 ELSE 0 END) AS pending_orders,
                                                    SUM(CASE WHEN o.order_status = 'Delivered' THEN 1 ELSE 0 END) AS completed_orders,
                                                    SUM(CASE WHEN DATE(o.created_at) = CURDATE() THEN 1 ELSE 0 END) AS today_orders,
                                                    SUM(CASE WHEN DATE(o.created_at) = CURDATE() AND o.order_status != 'Delivered' THEN 1 ELSE 0 END) AS today_pending_orders,
                                                    SUM(CASE WHEN DATE(o.created_at) = CURDATE() AND o.order_status = 'Delivered' THEN 1 ELSE 0 END) AS today_completed_orders
                                                FROM
                                                    seller s
                                                LEFT JOIN
                                                    orders o ON s.id = o.seller_id
                                                GROUP BY
                                                    s.id
                                            ";
                                            $result = mysqli_query($conn, $sql);
                                            $index  = 1;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $index ?></td>
                                                    <td><?php echo $row['fullName'] ?></td>
                                                    <td><?php echo $row['email'] ?></td>
                                                    <td><?php echo $row['phone'] ?></td>
                                                    <td><?php echo $row['pincode'] ?></td>
                                                    <td>
                                                        <button class="btn btn-block bg-primary">Orders : <?php echo $row['today_orders'] ?></button></button>
                                                        <button class="btn btn-block bg-warning">Pending : <?php echo $row['today_pending_orders'] ?></button></button>
                                                        <!-- <button class="btn btn-block bg-info">Pickup : 105</button> -->
                                                        <button class="btn btn-block bg-success">completed : <?php echo $row['today_completed_orders'] ?></button>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-block bg-primary">Orders : <?php echo $row['total_orders'] ?></button>
                                                        <button class="btn btn-block bg-warning">Pending : <?php echo $row['pending_orders'] ?></button>
                                                        <!-- <button class="btn btn-block bg-info">Pickup : 105</button> -->
                                                        <button class="btn btn-block bg-success">completed : <?php echo $row['completed_orders'] ?></button>
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

    </div>



    <!-- Page specific script -->

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "scrollX": false,
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

</body>

</html>