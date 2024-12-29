<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
} ?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="dashboard.php" class="brand-link">
    <!-- <img src="../dist/img/logo.png" alt="Admin Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
    <!-- <img src="dist/img/AdminLTELogo.png" alt="Admin Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
    <i class="fas fa-user fa-2x" style="color: black;"></i>
    <span class="brand-text font-weight-light"><b style="color: black;"><?php echo $_SESSION['delivery_name'] ? $_SESSION['delivery_name'] : 'Delivery panel' ?></b></span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <!-- Dashboard -->
        <li class="nav-item">
          <a href="dashboard.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <!-- Pickup -->
        <!-- <li class="nav-item">
          <a href="add_order.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'add_order.php' ? 'active' : ''; ?>">
          <i class="nav-icon fas fa-box"></i>
            <p>
              Add order
            </p>
          </a>
        </li> -->

        <!-- Delivery -->
        <li class="nav-item">
          <a href="all_orders.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'all_orders.php' ? 'active' : ''; ?>">
          <i class="nav-icon fas fa-list"></i>
            <p>
              All order
            </p>
          </a>
        </li>

        <!-- COD History -->
        <!-- <li class="nav-item">
          <a href="cod_history.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'cod_history.php' ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-shipping-fast"></i>
            <i class="nav-icon fas fa-wallet"></i>
            <p>
              COD History
            </p>
          </a>
        </li> -->

        <!-- Manage Orders -->
        <!-- <li class="nav-item <?php
                                  $currentPage = basename($_SERVER['PHP_SELF']);
                                  echo ($currentPage == 'add_order.php' || $currentPage == 'all_orders.php') ? 'menu-open' : '';
                                  ?>">
          <a href="" class="nav-link <?php
                                      $currentPage = basename($_SERVER['PHP_SELF']);
                                      echo ($currentPage == 'add_order.php' || $currentPage == 'all_orders.php') ? 'active' : '';
                                      ?>">
            <i class="nav-icon fas fa-box"></i>
            <p>
              Manage Orders
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="add_order.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'add_order.php' ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Order</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="all_orders.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'all_orders.php' ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>All Orders</p>
              </a>
            </li>
          </ul>
        </li> -->

        <li class="nav-item">
          <a href="logout.php" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Log out
            </p>
          </a>
        </li>


      </ul>
    </nav>
  </div>
</aside>