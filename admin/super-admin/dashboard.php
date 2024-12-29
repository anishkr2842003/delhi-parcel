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
  <title>Admin | Dashboard</title>

  <?php include("inc/links.php"); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <?php include("inc/topbar.php"); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include("inc/sidebar.php"); ?>

    <?php include("../config.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Admin Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          <h5 class="mb-2">Today</h5>
          <div class="row">
            <!-- Today Order -->
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-box"></i></span>
                <?php
                $today = date('Y-m-d');
                $total_todayOrder = "SELECT COUNT(*) AS count FROM orders WHERE DATE(created_at) = '$today'";
                $total_todayOrder_result = mysqli_query($conn, $total_todayOrder);
                $total_todayOrder = mysqli_fetch_assoc($total_todayOrder_result)['count'];
                ?>
                <div class="info-box-content">
                  <span class="info-box-text"><strong>Today Order</strong></span>
                  <span class="info-box-number"><?php echo $total_todayOrder ?></span>
                </div>
              </div>
            </div>
            <!-- Today Pending -->
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-hourglass"></i></span>
                <?php
                $today = date('Y-m-d');
                $total_todayPending = "SELECT COUNT(*) AS count FROM orders WHERE DATE(created_at) = '$today' && order_status != 'Success'";
                $total_todayPending_result = mysqli_query($conn, $total_todayPending);
                $total_todayPending = mysqli_fetch_assoc($total_todayPending_result)['count'];
                ?>
                <div class="info-box-content">
                  <span class="info-box-text"><strong>Today Pending</strong></span>
                  <span class="info-box-number"><?php echo $total_todayPending; ?></span>
                </div>
              </div>
            </div>
            <!-- Today Complete -->
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="far fa-check-circle"></i></span>
                <?php
                $today = date('Y-m-d');
                $total_todayComplete = "SELECT COUNT(*) AS count FROM orders WHERE DATE(updated_at) = '$today' && order_status = 'Delivered'";
                $total_todayComplete_result = mysqli_query($conn, $total_todayComplete);
                $total_todayComplete = mysqli_fetch_assoc($total_todayComplete_result)['count'];
                ?>
                <div class="info-box-content">
                  <span class="info-box-text"><strong>Today Complete</strong></span>
                  <span class="info-box-number"><?php echo $total_todayComplete; ?></span>
                </div>
              </div>
            </div>
            <!-- Remaining COD -->
            <div class="col-md-3 col-sm-6 col-12">
              <a href="cod_history.php" style="color: black;">
                <div class="info-box">
                  <span class="info-box-icon bg-danger"><i class="fas fa-money-check-alt"></i></span>
                  <?php
                  $total_sql = "SELECT SUM(amount) AS total_amount FROM delivery_history";
                  $total_result = mysqli_query($conn, $total_sql);
                  $total_row = mysqli_fetch_assoc($total_result);
                  $total_amount = $total_row['total_amount'] ? $total_row['total_amount'] : 0;
                  ?>
                  <div class="info-box-content">
                    <span class="info-box-text"><strong>Remaining COD</strong></span>
                    <span class="info-box-number"><?php echo $total_amount; ?></span>
                  </div>
                </div>
              </a>
            </div>
          </div>

          <!-- Small boxes (Stat box) -->
          <h5 class="mt-4 mb-2">Total</h5>
          <div class="row">
            <!-- Total Orders -->
            <div class="col-lg-3 col-6">
              <?php
              $total_todayOrder = "SELECT COUNT(*) AS count FROM orders";
              $total_todayOrder_result = mysqli_query($conn, $total_todayOrder);
              $total_todayOrder = mysqli_fetch_assoc($total_todayOrder_result)['count'];
              ?>
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?php echo $total_todayOrder; ?></h3>
                  <p>Total Orders</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="all_orders.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- Total Sellers -->
            <div class="col-lg-3 col-6">
              <?php
              $total_seller_query = "SELECT COUNT(*) AS count FROM seller";
              $total_seller_result = mysqli_query($conn, $total_seller_query);
              $total_seller = mysqli_fetch_assoc($total_seller_result)['count'];
              ?>
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?php echo $total_seller ?></h3>

                  <p>Total Sellers</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="all_sellers.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- Total Delivery Boys -->
            <div class="col-lg-3 col-6">
              <?php
              $total_deliveryBoy = "SELECT COUNT(*) AS count FROM delivery";
              $total_deliveryBoy_result = mysqli_query($conn, $total_deliveryBoy);
              $total_deliveryBoy = mysqli_fetch_assoc($total_deliveryBoy_result)['count'];
              ?>
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?php echo $total_deliveryBoy ?></h3>

                  <p>Total Delivery Boys</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="all_delivery.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- Total Pin Codes -->
            <div class="col-lg-3 col-6">
              <?php
              $total_pincode_query = "SELECT COUNT(*) AS count FROM pincodes";
              $total_pincode_result = mysqli_query($conn, $total_pincode_query);
              $total_pincode = mysqli_fetch_assoc($total_pincode_result)['count'];
              ?>
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3><?php echo $total_pincode; ?></h3>
                  <p>Total Pin Codes</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="pincodes.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>

          <h5>All sellers</h5>

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
    <?php include("inc/footer.php") ?>
  </div>

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