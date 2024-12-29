<?php
session_start();
if (!isset($_SESSION['delivery_boy_email'])) {
  header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Delivery Boy | Dashboard</title>

  <?php include("inc/links.php"); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <?php include("inc/topbar.php"); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include("inc/sidebar.php"); ?>

    <?php
    include("../config.php");

    // fetching all sellers
    $total_seller_query = "SELECT COUNT(*) AS count FROM seller";
    $total_seller_result = mysqli_query($conn, $total_seller_query);
    $total_seller = mysqli_fetch_assoc($total_seller_result)['count'];
    // fetching all sellers
    $total_sellerWorking_query = "SELECT COUNT(*) AS count FROM seller";
    $total_sellerWorking_result = mysqli_query($conn, $total_sellerWorking_query);
    $total_sellerWorking = mysqli_fetch_assoc($total_sellerWorking_result)['count'];

    // fetching all pincode
    $total_pincode_query = "SELECT COUNT(*) AS count FROM pincodes";
    $total_pincode_result = mysqli_query($conn, $total_pincode_query);
    $total_pincode = mysqli_fetch_assoc($total_pincode_result)['count'];
    // fetching working pincode
    $total_pincodeWorking_query = "SELECT COUNT(*) AS count FROM pincodes WHERE status = 1";
    $total_pincodeWorking_result = mysqli_query($conn, $total_pincodeWorking_query);
    $total_pincodeWorking = mysqli_fetch_assoc($total_pincodeWorking_result)['count'];

    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
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
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-box"></i></span>
                <?php
                $deliveryBoyEmail = $_SESSION['delivery_boy_email'];
                // echo $deliveryBoyEmail;
                $deliveryBoyId = $_SESSION['delivery_boy_id'];
                // echo $deliveryBoyId;
                $today = date('Y-m-d');
                $total_todayOrder = "SELECT COUNT(*) AS count FROM orders WHERE DATE(updated_at) = '$today' AND assign_to = '$deliveryBoyId'";
                $total_todayOrder_result = mysqli_query($conn, $total_todayOrder);
                $total_todayOrder = mysqli_fetch_assoc($total_todayOrder_result)['count'];
                ?>
                <div class="info-box-content">
                  <span class="info-box-text"><strong>Today Order</strong></span>
                  <span class="info-box-number"><?php echo $total_todayOrder ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-hourglass"></i></span>
                <?php
                $today = date('Y-m-d');
                $total_todayPending = "SELECT COUNT(*) AS count FROM orders WHERE DATE(updated_at) = '$today' && order_status != 'Delivered' AND assign_to = '$deliveryBoyId'";
                $total_todayPending_result = mysqli_query($conn, $total_todayPending);
                $total_todayPending = mysqli_fetch_assoc($total_todayPending_result)['count'];
                ?>
                <div class="info-box-content">
                  <span class="info-box-text"><strong>Today Pending</strong></span>
                  <span class="info-box-number"><?php echo $total_todayPending; ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="far fa-check-circle"></i></span>
                <?php
                $today = date('Y-m-d');
                $total_todayComplete = "SELECT COUNT(*) AS count FROM orders WHERE DATE(updated_at) = '$today' && order_status = 'Delivered' AND assign_to = '$deliveryBoyId'";
                $total_todayComplete_result = mysqli_query($conn, $total_todayComplete);
                $total_todayComplete = mysqli_fetch_assoc($total_todayComplete_result)['count'];
                ?>
                <div class="info-box-content">
                  <span class="info-box-text"><strong>Today Complete</strong></span>
                  <span class="info-box-number"><?php echo $total_todayComplete; ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fas fa-money-bill"></i></span>
                <?php
                $total_todayCOD = "SELECT SUM(amount) AS total_amount FROM delivery_history WHERE delivery_boy_id = '$deliveryBoyId'";
                $total_todayCOD_result = mysqli_query($conn, $total_todayCOD);
                if ($total_todayCOD_result) {
                  $row = mysqli_fetch_assoc($total_todayCOD_result);
                  $total_todayCOD = $row['total_amount'] ?? 0;
                } else {
                  $total_todayCOD = 0;
                  // echo "Error: " . mysqli_error($conn);
                }
                ?>
                <div class="info-box-content">
                  <span class="info-box-text"><strong>Today COD</strong></span>
                  <span class="info-box-number"><?php echo $total_todayCOD; ?></span>
                </div>
              </div>
            </div>
            <!-- /.col -->
          </div>

                
          <div <?php echo $total_todayCOD == 0 ? 'hidden' : ''?>>
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1>COD History</h1>
                  </div>
                  <!-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                      <li class="breadcrumb-item active">All Order</li>
                    </ol>
                  </div> -->
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
                              <th>Amount</th>
                              <th>Date</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            include("../config.php");
                            $delivery_boy_id = $_SESSION['delivery_boy_id'];
                            $sql = "SELECT * FROM delivery_history WHERE delivery_boy_id = '$delivery_boy_id'";
                            $result = mysqli_query($conn, $sql);
                            $index = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                              // var_dump($row);
                            ?>
                              <tr>
                                <td><?php echo $index; ?></td>
                                <td><?php echo $row['order_id']; ?></td>
                                <td><?php echo $row['amount']; ?></td>
                                <td><?php echo date('j M Y', strtotime($row['created_at'])); ?></td>
                              </tr>
                            <?php
                              $index++;
                            } ?>
                          </tbody>
                          <tfoot>
                            <?php
                            $total_sql = "SELECT SUM(amount) AS total_amount FROM delivery_history WHERE delivery_boy_id = '$delivery_boy_id'";
                            $total_result = mysqli_query($conn, $total_sql);
                            $total_row = mysqli_fetch_assoc($total_result);
                            $total_amount = $total_row['total_amount'] ? $total_row['total_amount'] : 0;
                            ?>
                            <tr>
                              <td colspan="2"><b>Total</b></td>
                              <td colspan="2"><b><?php echo $total_amount; ?></b></td>
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

          <!-- <h5 class="mt-4 mb-2">Last 7 days</h5>
          <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box bg-info">
                <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Bookmarks</span>
                  <span class="info-box-number">41,410</span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box bg-success">
                <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Likes</span>
                  <span class="info-box-number">41,410</span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box bg-warning">
                <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Events</span>
                  <span class="info-box-number">41,410</span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box bg-danger">
                <span class="info-box-icon"><i class="fas fa-comments"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Comments</span>
                  <span class="info-box-number">41,410</span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
                </div>
              </div>
            </div>
          </div> -->

          <!-- Small boxes (Stat box) -->
          <!-- <h5 class="mt-4 mb-2">Total</h5>
          <div class="row">
            <div class="col-lg-3 col-6">
              <?php
              $total_todayOrder = "SELECT COUNT(*) AS count FROM orders";
              $total_todayOrder_result = mysqli_query($conn, $total_todayOrder);
              $total_todayOrder = mysqli_fetch_assoc($total_todayOrder_result)['count'];

              $today = date('Y-m-d');
              $total_totalComplete = "SELECT COUNT(*) AS count FROM orders WHERE order_status = 'Delivered'";
              $total_totalComplete_result = mysqli_query($conn, $total_totalComplete);
              $total_totalComplete = mysqli_fetch_assoc($total_totalComplete_result)['count'];
              ?>
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?php echo $total_todayOrder; ?></h3>
                  <p>Total Orders</p>
                  <span class="badge badge-dark navbar-badge">Completed <?php echo $total_totalComplete; ?></span>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?php echo $total_seller ?></h3>

                  <p>Total Sellers</p>
                  <span class="badge badge-dark navbar-badge">Active <?php echo $total_sellerWorking; ?></span>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="all_sellers.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <?php
              $total_deliveryBoy = "SELECT COUNT(*) AS count FROM delivery";
              $total_deliveryBoy_result = mysqli_query($conn, $total_deliveryBoy);
              $total_deliveryBoy = mysqli_fetch_assoc($total_deliveryBoy_result)['count'];

              $total_activeDeliveryBoy = "SELECT COUNT(*) AS count FROM delivery WHERE status = 1";
              $total_activeDeliveryBoy_result = mysqli_query($conn, $total_activeDeliveryBoy);
              $total_activeDeliveryBoy = mysqli_fetch_assoc($total_activeDeliveryBoy_result)['count'];
              ?>
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?php echo $total_deliveryBoy ?></h3>

                  <p>Total Delivery Boys</p>
                  <span class="badge badge-dark navbar-badge">Active <?php echo $total_activeDeliveryBoy; ?></span>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3><?php echo $total_pincode; ?></h3>
                  <p>Total Pin Codes</p>
                  <span class="badge badge-dark navbar-badge">Active <?php echo $total_pincodeWorking; ?></span>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="pincodes.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div> -->



        </div>
      </section>
    </div>
    <?php include("inc/footer.php") ?>
  </div>


</body>

</html>