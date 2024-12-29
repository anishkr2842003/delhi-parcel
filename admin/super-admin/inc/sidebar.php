<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="dashboard.php" class="brand-link">
    <!-- <img src="../dist/img/logo.png" alt="Admin Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
    <img src="dist/img/AdminLTELogo.png" alt="Admin Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Admin</span>
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

        <!-- Manage services -->
        <li class="nav-item <?php
                            $currentPage = basename($_SERVER['PHP_SELF']);
                            echo ($currentPage == 'super_express_services.php' || $currentPage == 'express_services.php' || $currentPage == 'standred_services.php') ? 'menu-open' : '';
                            ?>">
          <a href="" class="nav-link <?php
                                      $currentPage = basename($_SERVER['PHP_SELF']);
                                      echo ($currentPage == 'super_express_services.php' || $currentPage == 'express_services.php' || $currentPage == 'standred_services.php') ? 'active' : '';
                                      ?>">
            <i class="nav-icon fas fa-briefcase"></i>
            <p>
              Manage Services
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <!-- <li class="nav-item">
              <a href="super_express_services.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'super_express_services.php' ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Super Express Service</p>
              </a>
            </li> -->
            <li class="nav-item">
              <a href="express_services.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'express_services.php' ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Express Service</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="standred_services.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'standred_services.php' ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Standred Service</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Manage Pincodes -->
        <li class="nav-item">
          <a href="pincodes.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'pincodes.php' ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-map-marker-alt"></i>
            <p>
              Manage Pincodes
            </p>
          </a>
        </li>

        <!-- Manage Categories -->
        <li class="nav-item">
          <a href="category.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'category.php' ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-tags"></i>
            <p>
              Manage Categories
            </p>
          </a>
        </li>

        <!-- Manage Sellers -->
        <li class="nav-item <?php
                            $currentPage = basename($_SERVER['PHP_SELF']);
                            echo ($currentPage == 'add_sellers.php' || $currentPage == 'all_sellers.php' || $currentPage == 'add_frenchies.php' || $currentPage == 'all_frenchies.php') ? 'menu-open' : '';
                            ?>">
          <a href="" class="nav-link <?php
                                      $currentPage = basename($_SERVER['PHP_SELF']);
                                      echo ($currentPage == 'add_sellers.php' || $currentPage == 'all_sellers.php' || $currentPage == 'add_frenchies.php' || $currentPage == 'all_frenchies.php') ? 'active' : '';
                                      ?>">
            <i class="nav-icon fas fa-store"></i>
            <p>
              Manage Branch
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="add_sellers.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'add_sellers.php' ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Branch</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="all_sellers.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'all_sellers.php' ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>All Branch</p>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a href="add_frenchies.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'add_frenchies.php' ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Frenchies</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="all_frenchies.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'all_frenchies.php' ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>All Frenchies</p>
              </a>
            </li> -->
          </ul>
        </li>

        <!-- Manage Orders -->
        <li class="nav-item <?php
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
            <!-- <li class="nav-item">
              <a href="add_order.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'add_order.php' ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Order</p>
              </a>
            </li> -->
            <li class="nav-item">
              <a href="all_orders.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'all_orders.php' ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>All Orders</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Manage Delivery Boy -->
        <li class="nav-item <?php
                            $currentPage = basename($_SERVER['PHP_SELF']);
                            echo ($currentPage == 'add_delivery.php' || $currentPage == 'all_delivery.php') ? 'menu-open' : '';
                            ?>">
          <a href="" class="nav-link <?php
                                      $currentPage = basename($_SERVER['PHP_SELF']);
                                      echo ($currentPage == 'add_delivery.php' || $currentPage == 'all_delivery.php') ? 'active' : '';
                                      ?>">
            <i class="nav-icon fas fa-shipping-fast"></i>
            <p>
              Manage Delivery Boy
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="add_delivery.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'add_delivery.php' ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Delivery Boy</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="all_delivery.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'all_delivery.php' ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>All Delivery Boy</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- COD History -->
        <li class="nav-item">
          <a href="cod_history.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'cod_history.php' ? 'active' : ''; ?>">
            <!-- <i class="nav-icon fas fa-shipping-fast"></i> -->
            <i class="nav-icon fas fa-wallet"></i>
            <p>
              COD History
            </p>
          </a>
        </li>

        <!-- Manage Inquiry data -->
        <li class="nav-item">
          <a href="inquiryData.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'inquiryData.php' ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-question-circle"></i>
            <p>
              Inquiry Messages
            </p>
          </a>
        </li>

        <!-- Manage Reviews -->
        <li class="nav-item">
          <a href="clientReview.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'clientReview.php' ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-comments"></i>
            <p>
              Manage Reviews
            </p>
          </a>
        </li>

        <!-- Setting -->
        <li class="nav-item">
          <a href="profile.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'clientReview.php' ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Settings
            </p>
          </a>
        </li>


      </ul>
    </nav>
  </div>
</aside>