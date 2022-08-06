<?php
include("include/conn.php");
include("include/DBHelper.php");
include("include/Encryption.php");
include("include/HelperFunction.php");

if(isset($_COOKIE["cusID"]) && verifyCustomer()){
header("Location: client/index");
}

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

				<form class="login100-form validate-form" method="post" action="client/action/login.php">

				<?php
				if(isset($_GET["msg"])){
					switch($_GET["msg"]){
						case 'pasChanged':
							msg("Password changed successfully",1);
							break;
						case 'failNPass':
							msg("Error occured, try again",2);
							break;
							case 'invalid_access':
								msg("Direct access is not allowed",2);
								break;
					}
				}
				?>

				<div id="success" class="alert alert-success" style="display: none;" role="alert">
                This is a success alert—check it out!
                </div>
                <div id="error" class="alert alert-danger" style="display: none;" role="alert">
                This is a danger alert—check it out!
                </div>

					<span class="login100-form-title">
						Member Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Value is required">
						<input class="input100" type="text" name="email" placeholder="Email / Mobile">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<?php if(isset($_GET["pr"])) {
                        echo '<input name="pr" type="hidden" value="'.$_GET["pr"].'">';
					} ?>
					
					<div class="container-login100-form-btn">
						<button name="submit" class="login100-form-btn">
							Sign In
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="forgotPass">
							Password?
						</a>
					</div>

					<div class="text-center p-t-40">
						<a class="txt2" href="register.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>

					<div class="text-center p-t-40">
						<a class="txt2" href="admin/seller_login" target="_blank">
							Become seller
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
                       <!-- <br>
						<a class="txt2" href="admin/login" target="_blank">
							Company system
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a> -->

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

