 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="?p=dashboard" class="brand-link">
      <img src="../images/logo.png" alt="Bachat Zone" class="brand-image img-circle elevation-3" style="opacity: .8">
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
                <a href="?p=dashboard" class="nav-link <?php echo ($p == 'dashboard') ? 'active': '';?> ">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Orders</p>
                </a>
              </li>
              
            </ul>
          </li>


          <!-- ADMIN SECTION -->
          <?php
          $admin_arr = ["add_admin","update_profile","admin_list","companyInfo","advertisement"];
          ?>
          <li class="nav-item">
            <a href="#" class="nav-link <?php if(in_array($page,$admin_arr)){echo "active";}?>">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Admin Section
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="?p=add_admin" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add admin</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="?p=update_profile" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Profile</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="?p=admin_list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin List</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="?p=companyInfo" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Company Info</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="?p=shipment_charges" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Shipment Charges</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="?p=advertisement" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Advertisement</p>
                </a>
              </li>
              
            </ul>
          </li>



             <!-- Investor SECTION -->
          <?php
          $investor_arr = ["add_investor","invest_list","investor_profile"];
          ?>
             <!-- <li class="nav-item">
             <a href="#" class="nav-link <?php if(in_array($page,$investor_arr)){echo "active";}?>">
              <i class="nav-icon fas fa-money-bill-wave-alt"></i>
              <p>
                Investor Section
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="?p=add_investor" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Investor</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="?p=invest_list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Investor List</p>
                </a>
              </li>
              
            </ul>
          </li> -->



             <!-- Master Team SECTION -->
             <?php
          $master_team_arr = ["add_master_team","master_team_list","master_team_profile"];
          ?>
             <!-- <li class="nav-item">
             <a href="#" class="nav-link <?php if(in_array($page,$master_team_arr)){echo "active";}?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Master Team
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="?p=add_master_team" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Master Team</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="?p=master_team_list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Team List</p>
                </a>
              </li>
              
            </ul>
          </li> -->




           <!-- Customer SECTION -->
           <?php
          $customer_arr = ['customer_list','messages'];
          ?>
             <li class="nav-item">
             <a href="#" class="nav-link <?php if(in_array($page,$customer_arr)){echo "active";}?>">
              <i class="nav-icon fas fa-user-injured"></i>
              <p>
                Customer Section
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="?p=customer_list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer List</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="?p=messages" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Messages</p>
                </a>
              </li>
              
            </ul>
          </li>



          <!-- Customer SECTION -->
          <?php
          $product_arr = ['add_product','product_list','product_details'];
          ?>
             <li class="nav-item">
             <a href="#" class="nav-link <?php if(in_array($page,$product_arr)){echo "active";}?>">
              <i class="nav-icon fas fa-align-left"></i>
              <p>
                Product Section
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="?p=category" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="?p=companies" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Companies</p>
                </a>
              </li>

              
              <li class="nav-item">
                <a href="?p=add_product" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Product</p>
                </a>
              </li>


              <li class="nav-item">
                <a href="?p=product_list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product List</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="?p=orderHistory" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Order history</p>
                </a>
              </li>

             

              <li class="nav-item">
                <a href="?p=return_prd" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Return orders</p>
                </a>
              </li>
              
            </ul>
          </li>




          <!-- Seller SECTION -->
          <?php
          $product_arr = ['add_supplier','supplier_list','supplier_profile'];
          ?>
             <li class="nav-item">
             <a href="#" class="nav-link <?php if(in_array($page,$product_arr)){echo "active";}?>">
              <i class="nav-icon fas fa-align-right"></i>
              <p>
                Seller Section
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="?p=add_supplier" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add seller</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="?p=supplier_list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Seller List</p>
                </a>
              </li>

              
            </ul>
          </li>


      <!-- Buy now section -->
      <?php
          $buy_arr = ['buy_now_requests','buy_now_history','buy_now_earning'];
      ?>
       <li class="nav-item">
             <a href="#" class="nav-link <?php if(in_array($page,$buy_arr)){echo "active";}?>">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Buy Now Section
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="?p=buy_now_requests" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Requests</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="?p=buy_now_history" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>History</p>
                </a>
              </li>

              
              <li class="nav-item">
                <a href="?p=buy_now_earning" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Earning</p>
                </a>
              </li>
              
            </ul>
          </li> 


          <li class="nav-header"></li>
         
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>