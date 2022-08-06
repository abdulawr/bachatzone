<?php
//exit("Testing");
session_start();
if (isset($_SESSION['start']) && (time() - $_SESSION['start'] > 5400)) {
    session_unset(); 
    session_destroy(); 
    header("Location: seller_login?msg=expired");
    exit;
}

$_SESSION['start'] = time();
 include_once("../include/HelperFunction.php");

 if(isset($_SESSION["supplier_login"])){
  ?>
  <script>location.replace("seller/sell_dashboard");</script>
  <?php
  exit;
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bachat Zone</title>

<link rel="apple-touch-icon" sizes="180x180" href="../images/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../images/favicon/favicon-16x16.png">
<link rel="manifest" href="../images/favicon/site.webmanifest">
<link rel="mask-icon" href="../images/favicon/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
 
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <h3 style="font-weight: bold; text-align:center">Seller Login</h3>
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="seller_action/login_seller" method="post">

        <?php
        if(isset($_GET["msg"])){
          switch($_GET["msg"]){

            case "invalid_record":
              msg("Invalid username or password",2);
              break;

              case "signout":
                msg("Account signout successfully!",1);
                break;

            case "expired":
              msg("Direct access not allowed",2);
              break;

              case 'pasChanged':
                msg("Password changed successfully",1);
                break;
              case 'failNPass':
                msg("Error occured, try again",2);
                break;

          }
        }
        ?>

        <div class="input-group mb-3">
          <input required name="username" type="text" class="form-control" placeholder="Email / Mobile">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input required name="password" type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
           
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="seller/forgot_password">Forgot password</a>
      </p>
      <p class="mb-0">
        <a href="seller/seller_registration" class="text-center">Register seller</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
