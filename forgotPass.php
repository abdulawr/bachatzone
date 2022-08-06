<?php
include("include/conn.php");
include("include/DBHelper.php");
include("include/Encryption.php");
include("include/HelperFunction.php");
include("mail/sendMail.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Bachat Zone</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
<link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
<link rel="manifest" href="images/favicon/site.webmanifest">
<link rel="mask-icon" href="images/favicon/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="main_asset/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="main_asset/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="main_asset/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="main_asset/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="main_asset/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="main_asset/css/util.css">
	<link rel="stylesheet" type="text/css" href="main_asset/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100 bg-secondary">
			<div class="wrap-login100" style="padding-top:33px !important;">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="main_asset/images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="post" action="client/action/forgotPass">

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
                       <span class="login100-form-title">
						Verification Code
				     	</span>

                         <input type="hidden" name="verify_email_code" value="verify_email_code">
                         <input type="hidden" name="c_ID" value="<?php echo DBHelper::escape($_GET["s_ID"]); ?>">

                            <div class="wrap-input100 validate-input" data-validate = "Enter otp first">
                                <input maxlength="6" class="input100" type="number" name="OTP" placeholder="OTP">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </span>
                            </div>

                    <?php
                    } elseif(isset($_GET["type"]) && $_GET["type"] == "new_password" && isset($_GET["sd1"])) {
                        ?>
                         <input type="hidden" name="new_password" value="new_password">
                         <input type="hidden" name="c_ID" value="<?php echo DBHelper::escape($_GET["sd1"]); ?>">
                       
                         <span class="login100-form-title">
						  New Password
				       	</span>

                        <div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input name="password" class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
                       
                       <?php
                    } else { ?>
					<span class="login100-form-title">
						Forgot Password
					</span>

                    <input type="hidden" name="sendVerificationCode" value="sendVerificationCode">

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
                    <?php } ?>
					
					<div class="container-login100-form-btn">
						<button  class="login100-form-btn">
							Submit
						</button>
					</div>


					<div class="text-center p-t-40">
						<a class="txt2" href="login">
							Login
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="main_asset/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="main_asset/vendor/bootstrap/js/popper.js"></script>
	<script src="main_asset/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="main_asset/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="main_asset/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="main_asset/js/main.js"></script>

</body>
</html>


