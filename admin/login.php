<?php
session_start();
if (isset($_SESSION['start']) && (time() - $_SESSION['start'] > 5400)) {
    session_unset(); 
    session_destroy(); 
    header("Location: login?msg=expired");
    exit;
}
$_SESSION['start'] = time();
 include_once("../include/HelperFunction.php");

 if(isset($_SESSION["isLogin"])){
  ?>
  <script>location.replace("index?p=dashboard");</script>
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
    <div style="text-align:center;">
    <img width="130" height="130" class="img-thumbnail rounded-circle" style="margin-top: -65px"  src="../images/logo.png" alt="">
    </div>
    <div class="card-body login-card-body">
      
      <?php
      if(isset($_GET["msg"]) && !empty($_GET["msg"])){
        $msg = $_GET["msg"];
        switch($msg){
            case 'direct_access':
              echo msg("Direct access is not allowed!",2);
              break;

              case 'expired':
                echo msg("Session expired login again!",2);
                break;

              case 'invalid_record':
                echo msg("Invalid username or password try again",2);
                break;

              case 'signout':
                echo msg("Account signout successfully!",1);
                break;
        }
      }
      ?>

      <p class="login-box-msg">Sign in to start your session</p>

      <form action="action/login" method="post">
        <div class="input-group mb-3">
          <input name="username" required type="text" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="password" required type="password" class="form-control" placeholder="Password">
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

      <!-- /.social-auth-links -->

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
