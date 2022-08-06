 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="sell_dashboard" class="brand-link">
      <img src="../../images/logo.png" alt="Bachat Zone" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Bachat Zone</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">

            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="sell_dashboard" class="nav-link <?php echo ($p == 'dashboard') ? 'active': '';?> ">
                  <i class="nav-icon fas fa-store"></i>
                  <p>
                    <?php 
                     echo ($_SESSION["data"]["sallerType"] == '1') ? "Buy now" : "Orders";
                    ?>
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="ord_history" class="nav-link <?php echo ($p == 'ord_history') ? 'active': '';?> ">
                  <i class="nav-icon fas fa-store"></i>
                  <p>
                    <?php 
                     echo ($_SESSION["data"]["sallerType"] == '1') ? "Buy now history" : "Orders history";
                    ?>
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="sell_add_product" class="nav-link <?php echo ($p == 'dashboard') ? 'active': '';?> ">
                  <i class="nav-icon fas fa-tags"></i>
                  <p>Add product</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="product_list" class="nav-link <?php echo ($p == 'dashboard') ? 'active': '';?> ">
                  <i class="nav-icon fas fa-list"></i>
                  <p>Product list</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="sell_profile" class="nav-link <?php echo ($p == 'dashboard') ? 'active': '';?> ">
                  <i class="nav-icon fas fa-user"></i>
                  <p>Profile</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="wallet" class="nav-link">
                  <i class="nav-icon fas fa-wallet"></i>
                  <p>Wallet</p>
                </a>
              </li>


              <li class="nav-item">
                <a href="product_category" class="nav-link">
                  <i class="nav-icon fas fa-atom"></i>
                  <p>Product category</p>
                </a>
              </li>


              <li class="nav-item">
                <a href="product_company" class="nav-link">
                  <i class="nav-icon fas fa-atom"></i>
                  <p>Product company</p>
                </a>
              </li>


              <!-- <?php if($_SESSION["data"]["sallerType"] == '1') { ?>
              <li class="nav-item">
                <a href="buy_now" class="nav-link">
                  <i class="nav-icon fas fa-dolly"></i>
                  <p>Buy now</p>
                </a>
              </li>


              <li class="nav-item">
                <a href="buy_now_history" class="nav-link">
                  <i class="nav-icon fas fa-dolly"></i>
                  <p>Buy now history</p>
                </a>
              </li>
              <?php } ?> -->
              
            </ul>
          </li>


          <li class="nav-header"></li>   
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>