<?php
 include_once("../../include/HelperFunction.php");
 include_once("../../include/conn.php");
 include_once("../../include/DBHelper.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bachat Zone</title>

<link rel="apple-touch-icon" sizes="180x180" href="../../images/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../../images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../../images/favicon/favicon-16x16.png">
<link rel="manifest" href="../images/favicon/site.webmanifest">
<link rel="mask-icon" href="../images/favicon/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">

  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
        <h3 style="text-align:center"><b>Forgot Password</b></h3>
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

      <form action="../seller_action/forgot_password" method="post">

      <?php
                        if(isset($_GET["msg"])){
                            switch($_GET["msg"]){
                                case 'success':
                                    msg("Check your email for verification code",1);
                                    break;
                                    case 'success_otp':
                                        msg("OTP verified successfully!",1);
                                        break;
                                    case 'invalidEmail':
                                        msg("Email does not exist",2);
                                        break;
                                        case 'send_code_error':
                                            msg("Error occured while sending verification code try again",2);
                                            break;
                                            case 'wrgCode':
                                                msg("Invalid OTP, try again",2);
                                                break;
                            }
                        }
        ?>

<?php if(isset($_GET["type"]) && $_GET["type"] == "ver_code" && isset($_GET["s_ID"])) {
?>

<div class="input-group mb-3">
          <input maxlength="6" required name="OTP" type="number" class="form-control" placeholder="OTP">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-comment"></span>
            </div>
          </div>
</div>

        <input type="hidden" name="verify_email_code" value="verify_email_code">
        <input type="hidden" name="c_ID" value="<?php echo DBHelper::escape($_GET["s_ID"]); ?>">
          
       <div class="row">
        <div class="col-12">
        <button type="submit" class="btn btn-outline-info btn-block">Verify</button>
       </div>
          <!-- /.col -->
      </div>

<?php  } elseif(isset($_GET["type"]) && $_GET["type"] == "new_password" && isset($_GET["sd1"])) {?>

    <div class="input-group mb-3">
          <input  required name="password" type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-comment"></span>
            </div>
          </div>
</div>

<input type="hidden" name="new_password" value="new_password">
<input type="hidden" name="c_ID" value="<?php echo DBHelper::escape($_GET["sd1"]); ?>">
          
       <div class="row">
        <div class="col-12">
        <button type="submit" class="btn btn-outline-warning btn-block">Submit</button>
       </div>
          <!-- /.col -->
      </div>

<?php } else { ?>
        <div class="input-group mb-3">
          <input required name="email" type="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <input type="hidden" name="sendVerificationCode">
          
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
<?php } ?>

      </form>

      <p class="mt-3 mb-1">
        <a href="../seller_login.php">Login</a>
      </p>
      <p class="mb-0">
        <a href="seller_registration" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstr../bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
</body>
</html>
