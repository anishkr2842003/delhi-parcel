<?php
session_start();
if (!isset($_SESSION['delivery_email'])) {
  header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Delivery Panel | Dashboard</title>

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
              <h1 class="m-0">Delivery Dashboard</h1>
            </div>
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
      <!-- <section class="content">
        <div class="container-fluid">

          <h5 class="mb-2">Today</h5>
          <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-box"></i></span>
                <?php
                $sellerEmail = $_SESSION['booking_email'];
                $sellerId = $_SESSION['booking_id'];
                $today = date('Y-m-d');
                $total_todayOrder = "SELECT COUNT(*) AS count FROM orders WHERE DATE(updated_at) = '$today' AND seller_id = '$sellerId'";
                $total_todayOrder_result = mysqli_query($conn, $total_todayOrder);
                $total_todayOrder = mysqli_fetch_assoc($total_todayOrder_result)['count'];
                ?>
                <div class="info-box-content">
                  <span class="info-box-text"><strong>Today Order</strong></span>
                  <span class="info-box-number"><?php echo $total_todayOrder ?></span>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-hourglass"></i></span>
                <?php
                $today = date('Y-m-d');
                $total_todayPending = "SELECT COUNT(*) AS count FROM orders WHERE DATE(updated_at) = '$today' && order_status != 'Delivered' AND seller_id = '$sellerId'";
                $total_todayPending_result = mysqli_query($conn, $total_todayPending);
                $total_todayPending = mysqli_fetch_assoc($total_todayPending_result)['count'];
                ?>
                <div class="info-box-content">
                  <span class="info-box-text"><strong>Today Pending</strong></span>
                  <span class="info-box-number"><?php echo $total_todayPending; ?></span>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="far fa-check-circle"></i></span>
                <?php
                $today = date('Y-m-d');
                $total_todayComplete = "SELECT COUNT(*) AS count FROM orders WHERE DATE(updated_at) = '$today' && order_status = 'Delivered' AND seller_id = '$sellerId'";
                $total_todayComplete_result = mysqli_query($conn, $total_todayComplete);
                $total_todayComplete = mysqli_fetch_assoc($total_todayComplete_result)['count'];
                ?>
                <div class="info-box-content">
                  <span class="info-box-text"><strong>Today Complete</strong></span>
                  <span class="info-box-number"><?php echo $total_todayComplete; ?></span>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fas fa-money-bill"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text"><strong>Wallet</strong></span>
                  <span class="info-box-number">0</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section> -->
    </div>
    <?php include("inc/footer.php") ?>
  </div>


</body>

</html>