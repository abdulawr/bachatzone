 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

      <h3 id="p_title" style="text-align:center; font-weight:bold; margin-bottom:0px; color:#707070">Bachat Zone</h2>

    </ul>

    <!-- SEARCH FORM -->

    <?php
    $suppID = $_SESSION["data"]["id"];
    $prd = DBHelper::get("SELECT count(id) as total FROM `product` WHERE status = 99")->fetch_assoc()['total'];

    if($_SESSION["data"]["sallerType"] == 0){
      $msg11 = DBHelper::get("SELECT count(id) as total FROM `orderlist` WHERE status not in(5,2) and suppID = '{$suppID}' group by orderID")->fetch_assoc()['total'];

    }
    else{
      $msg11 = DBHelper::get("SELECT count(id) as total FROM `buy_now_product` WHERE status = 0 and suppID = '{$suppID}'")->fetch_assoc()['total'];
    }
    
    ?>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->

      <li class="nav-item dropdown">
        <a class="nav-link" href="sell_dashboard" title="Penidng orders">
          <i class="fas fa-shopping-cart"></i>
          <span class="badge badge-danger navbar-badge"><?php echo $msg11;?></span>
        </a>    
      </li>

     
      
      
      <li class="nav-item">
        <a class="nav-link" title="Sign out" data-widget="fullscreen" href="../seller_action/login_seller?logout=logout" role="button">
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