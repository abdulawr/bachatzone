 <!-- Navbar -->
 
 <?php
    $msg = DBHelper::get("SELECT count(id) as total FROM `message` WHERE status = 0")->fetch_assoc()['total'];
    $returns = DBHelper::get("SELECT count(id) as total FROM `order_return` WHERE status = 0")->fetch_assoc()['total'];
    $prd = DBHelper::get("SELECT count(id) as total FROM `product` WHERE status = 99")->fetch_assoc()['total'];
    $orders = DBHelper::get("SELECT count(id) as total FROM `orders` WHERE orderStatus not in(99,5,4)")->fetch_assoc()['total'];
    $buy_now = DBHelper::get("SELECT count(id) as total FROM `buy_now_product` WHERE status = 0")->fetch_assoc()['total'];
    
?>

 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    
    <ul class="navbar-nav">
      <li class="nav-item">
        <a href="#" class="nav-link" data-widget="pushmenu"  type="button" role="button"><i class="fas fa-bars"></i></a>
      </li>
<!-- 
      <div class="user-panel  d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> -->

      <h3 id="p_title" style="text-align:center; font-weight:bold; margin-bottom:0px; color:#707070">Bachat Zone</h2>

      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- SEARCH FORM -->



    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->

      <li class="nav-item dropdown">
        <a class="nav-link" href="?p=buy_now_requests" title="Buy now requests">
          <i class="fas fa-bell"></i>
          <span class="badge badge-danger navbar-badge"><?php echo $buy_now;?></span>
        </a>    
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link" href="?p=dashboard" title="Penidng orders">
          <i class="fas fa-shopping-cart"></i>
          <span class="badge badge-danger navbar-badge"><?php echo $orders;?></span>
        </a>    
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link" href="?p=messages" title="Customer Queries">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge"><?php echo $msg;?></span>
        </a>    
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link" href="?p=product_list" title="Pending products">
          <i class="fas fa-ad"></i>
          <span class="badge badge-danger navbar-badge"><?php echo $prd;?></span>
        </a>    
      </li>

      <!-- <li class="nav-item dropdown">
        <a class="nav-link" href="?p=return_prd" title="Customer order">
          <i class="fas fa-flag"></i>
          <span class="badge badge-danger navbar-badge"><?php echo $returns;?></span>
        </a>    
      </li> -->

      <li class="nav-item">
        <a class="nav-link" title="Sign out" data-widget="fullscreen" href="action/login?logout=logout" role="button">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
      
    </ul>



  </nav>
  <!-- /.navbar -->