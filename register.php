<?php
include("include/conn.php");
include("include/DBHelper.php");
include("include/Encryption.php");
include("include/HelperFunction.php");
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

<style>
	.pss{
		text-align: right; 
		padding:5px 0px; 
		padding-bottom:10px;
		 padding-right:10px;
		 color: royalblue;
	}
	.pss:hover{
		cursor: pointer;
	}
	.load_div{
		display: flex;
		flex-direction: row;
		justify-content: end;
	}
</style>

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100 bg-secondary">
            
			<div class="wrap-login100" style="padding-top:33px !important;">
                            
				<div class="login100-pic js-tilt" data-tilt>
                <img src="main_asset/images/img-01.png" alt="IMG">
				</div>

				<form id="reg_form" class="login100-form validate-form" action="" enctype="multipart/form-data" method="post">
                <div id="success" class="alert alert-success" style="display: none;" role="alert">
                This is a success alert—check it out!
                </div>
                <div id="error" class="alert alert-danger" style="display: none;" role="alert">
                This is a danger alert—check it out!
                </div>
					<span class="login100-form-title">
						Member Sign Up
					</span>

					<?php
					 if(isset($_GET["ID"])){
						 $referID = Encryption::Decrypt($_GET["ID"]);
						 $refName = DBHelper::get("SELECT name FROM `tbl_customer` WHERE id = '{$referID}'");
						 if($refName->num_rows > 0){
							 $refName = $refName->fetch_assoc()["name"];
							 echo '<h6><b>Refer by: </b>'.$refName.'</h6><br>';
						 }
					 }
					?>

					<div class="wrap-input100 validate-input" data-validate = "Name is required">
						<input name="name" class="input100" type="text" name="name" placeholder="Name">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-address-book-o" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input id="usemail" name="email" class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="load_div">
					   <p  style="display: inline-block;" id="sendOTP" class="pss">Send OTP</p>
					   <img style="display: none;" id="loading_br" width="40" height="40" src="images/load.gif" alt="">
					</div>
					

                    <div class="wrap-input100 validate-input" data-validate = "Mobile is required">
						<input maxlength="11" name="mobile" class="input100" type="text"  placeholder="Mobile">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input name="password" class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<input type="hidden" value="0" name="opt_ver_status" id="opt_ver_status">

					<div id="otp_div" style="display: none;" class="wrap-input100 validate-input" data-validate = "Enter OTP">
						<input id="opt_val" name="otp" class="input100" style="padding: 0; padding-left:30px" type="password" placeholder="OTP">						
					</div>

					<div class="load_div" style="display: none;" id="verif_opt_div">
					   <p  style="display: inline-block;" id="ver_OTP" class="pss">Verify OTP</p>
					   <img style="display: none;" id="verf_loading_br" width="40" height="40" src="images/load.gif" alt="">
					</div>

					<input type="hidden" name="submit">
					
					<div class="container-login100-form-btn">
						<button onclick="submitForm()" name="button" class="login100-form-btn">
							Sign Up
						</button>
					</div>

                    <div class="text-center p-t-40">
						<a class="txt2" href="login">
							Login page
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


<?php
if(isset($_POST["submit"])){

  include_once("mail/sendMail.php");
  $email = validateInput($_POST["email"]);
  $name = validateInput($_POST["name"]);
  $mobile = validateInput($_POST["mobile"]);
  $password = Encryption::Encrypt($_POST["password"]);


  $search = DBHelper::get("SELECT email FROM tbl_customer WHERE email = '{$email}'");
  if($search->num_rows > 0){

    ?>
    <script>
        $("#error").show().text("Account with this email already exist");
    </script>
    <?php
  }
  else{
    $search = DBHelper::get("SELECT email FROM tbl_customer WHERE mobile = '{$mobile}'");
    if($search->num_rows > 0){
        ?>
        <script>
            $("#error").show().text("Mobile no already exist");
        </script>
        <?php

		
    }  
    else{
		
		$referID = (isset($_GET["ID"])) ? Encryption::Decrypt($_GET["ID"]) : 0;

        $qry = "INSERT INTO `tbl_customer`(
            `mobile`,
            `email`, 
            `name`, 
            `password`,
			`referby_ID`
			)
            VALUES (
                '{$mobile}',
                '{$email}',
                '{$name}',
                '{$password}',
				'{$referID}'
            )";

        if(DBHelper::set($qry)){
            $cusID = $con->insert_id;
            DBHelper::set("INSERT INTO tbl_customer_credit_trans(cusID,amount,type) VALUES({$cusID},1000,1)");
            DBHelper::set("INSERT INTO `tbl_customer_credit_total`
			(`amount`, `cusID`,type) VALUES ('1000','{$cusID}',1)");

            if(isset($_GET["ID"])){
				$ID = DBHelper::escape(Encryption::Decrypt($_GET["ID"]));
				DBHelper::set("INSERT INTO tbl_customer_credit_trans(cusID,amount,tran_type,type) VALUES({$ID},300,1,1)");
		      
				$check = DBHelper::get("SELECT * FROM `tbl_customer_credit_total` WHERE cusID = {$ID} && type = 1");
		        if($check->num_rows > 0){
                  DBHelper::set("UPDATE tbl_customer_credit_total set amount = amount + 300 WHERE `cusID` = {$ID} and type = 1");
				}
				else{
					DBHelper::set("INSERT INTO `tbl_customer_credit_total`
					(`amount`, `cusID`,type) VALUES ('300','{$cusID}',1)");
				}
			}

			$member = DBHelper::get("SELECT id,`type` FROM `investor`;");
			if($member->num_rows > 0){
				while($row = $member->fetch_assoc()){
                   if($row["type"] == "0"){
                     // investor  (Rs. 2)
					 DBHelper::set("INSERT INTO `tbl_customer_credit_trans`(
						 `amount`,
						 `cusID`,
						 `tran_type`,
						 `type`) VALUES (
						 '2',
							 '{$row["id"]}',
							 '2',
							 '2')");

						DBHelper::set("UPDATE tbl_customer_credit_total set amount = amount + 2 where cusID = {$row["id"]} and type = 2");
				   }
				   else{
                     // master team (Rs. 5)
					 DBHelper::set("INSERT INTO `tbl_customer_credit_trans`(
						`amount`,
						`cusID`,
						`tran_type`,
						`type`) VALUES (
						'5',
							'{$row["id"]}',
							'2',
							'3')");

                     DBHelper::set("UPDATE tbl_customer_credit_total set amount = amount + 5 where cusID = {$row["id"]} and type = 3");
				   }
				}
			}

			$subject = "Welcome to Bachat Zone";
			$msg = "<b>Dear ".$name."</b><br> Your account has been created successfully and 1000 credit has been added into your account.";
			$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
			<head>
				<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
				<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
				<meta http-equiv="X-UA-Compatible" content="IE=edge" />
				<meta name="format-detection" content="date=no" />
				<meta name="format-detection" content="address=no" />
				<meta name="format-detection" content="telephone=no" />
				<meta name="x-apple-disable-message-reformatting" />
				<!--[if !mso]><!-->
				<link href="https://fonts.googleapis.com/css?family=Muli:400,400i,700,700i" rel="stylesheet" />
				
			
				<style type="text/css" media="screen">
					/* Linked Styles */
					body { padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#001736; -webkit-text-size-adjust:none }
					a { color:#66c7ff; text-decoration:none }
					p { padding:0 !important; margin:0 !important } 
					img { -ms-interpolation-mode: bicubic; /* Allow smoother rendering of resized image in Internet Explorer */ }
					.mcnPreviewText { display: none !important; }
			
							
					/* Mobile styles */
					@media only screen and (max-device-width: 480px), only screen and (max-width: 480px) {
						.mobile-shell { width: 100% !important; min-width: 100% !important; }
						.bg { background-size: 100% auto !important; -webkit-background-size: 100% auto !important; }
						
						.text-header,
						.m-center { text-align: center !important; }
						
						.center { margin: 0 auto !important; }
						.container { padding: 20px 10px !important }
						
						.td { width: 100% !important; min-width: 100% !important; }
			
						.m-br-15 { height: 15px !important; }
						.p30-15 { padding: 30px 15px !important; }
			
						.m-td,
						.m-hide { display: none !important; width: 0 !important; height: 0 !important; font-size: 0 !important; line-height: 0 !important; min-height: 0 !important; }
			
						.m-block { display: block !important; }
			
						.fluid-img img { width: 100% !important; max-width: 100% !important; height: auto !important; }
			
						.column,
						.column-top,
						.column-empty,
						.column-empty2,
						.column-dir-top { float: left !important; width: 100% !important; display: block !important; }
			
						.column-empty { padding-bottom: 10px !important; }
						.column-empty2 { padding-bottom: 30px !important; }
			
						.content-spacing { width: 15px !important; }
					}
				</style>
			</head>
			<body class="body" style="padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#001736; -webkit-text-size-adjust:none;">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#001736">
					<tr>
						<td align="center" valign="top">
							<table width="650" style="width: 70%;" border="0" cellspacing="0" cellpadding="0" class="mobile-shell">
								<tr>
									<td class="td container" style="width:650px; min-width:650px; font-size:0pt; line-height:0pt; margin:0; font-weight:normal; padding:20px 0px;">
										<!-- Header -->
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td class="p30-15" >
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															
															<th class="column-empty" width="1" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;"></th>
															<th class="column" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal;">
																
															</th>
														</tr>
													</table>
												</td>
											</tr>
										</table>
										<!-- END Header -->
			
										<!-- Intro -->
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td style="padding-bottom: 10px;">
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td class="tbrr p30-15" style="padding: 60px 30px; border-radius:26px 26px 0px 0px;" bgcolor="#12325c">
																<table width="100%" border="0" cellspacing="0" cellpadding="0">
																	<tr>
																		<td class="h1 pb25" style="color:#ffffff; font-family:\'Muli\', Arial,sans-serif; font-size:40px; line-height:46px; text-align:center; padding-bottom:25px;">Welcome to Bachatzone</td>
																	</tr>
																	<tr>
																		<td class="text-center pb25" style="color:#c1cddc; font-family:\'Muli\', Arial,sans-serif; font-size:16px; line-height:30px; text-align:center; padding-bottom:25px;">
																		 '.$msg.'
																	</td>
																	</tr>
																	<!-- Button -->
																	<tr>
																		<td align="center">
																			<table class="center" border="0" cellspacing="0" cellpadding="0" style="text-align:center;">
																				<tr>
																					<td class="pink-button text-button" style="background:#ff6666; color:#c1cddc; font-family:\'Muli\', Arial,sans-serif; font-size:14px; line-height:18px; padding:12px 30px; text-align:center; border-radius:0px 22px 22px 22px; font-weight:bold;"><a href="https://bachatzone.com/login" target="_blank" class="link-white" style="color:#ffffff; text-decoration:none;"><span class="link-white" style="color:#ffffff; text-decoration:none;">CLICK HERE LOGIN</span></a></td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																	<!-- END Button -->
																</table>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
										<!-- END Intro -->
			
										
										<!-- END Footer -->
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</body>
			</html>
			';
			sendMail($email,$subject,$message);

            ?>
            <script>
                $("#success").show().text("Account created successfully");
            </script>
            <?php
        }
        else{ 
			
        ?>
        <script>
            $("#error").show().text("Somthing went wrong try again");
        </script>
        <?php
        }
    }
  }

}
?>


<script>

function validEmail(email){
  const regex = /^((?!\.)[\w\-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/;
  return regex.test(email);
}

	$("#sendOTP").on("click",function(){
	     var email = $("#usemail").val();
         var loading_br = $("#loading_br");

		 if (email && email.length !== 0) {
			
			if(validEmail(email)){
                loading_br.show();
				$("#sendOTP").hide();

				$.post("client/action/sendOTP.php",
				{
					email: email
				},
				function(data, status){
					loading_br.hide();
					var json = JSON.parse(data);
					if(json.status == '1'){
					  alert("OTP has been sent to you email");
                      $("#usemail").attr('readonly', true);
					  $("#sendOTP").show();
					  $("#sendOTP").text("Resend code");
					  $("#otp_div").show();
					  $("#verif_opt_div").show();
					}
					else{
						alert("Error occured try again");
					}
					
				});

			}
			else{
				alert("Enter valid email first");
			}
		}
		else{
			alert("Enter email first");
		}

	})


	$("#ver_OTP").on("click",function(){

		var opt_val = $("#opt_val").val();
		var email = $("#usemail").val();
		var verf_loading_br = $("#verf_loading_br");
	  
        if (opt_val && opt_val.length !== 0) {
			verf_loading_br.show();
			$("ver_OTP").hide();
			$.post("client/action/sendOTP.php",
			{
				email: email,
				opt: opt_val,
				type:"otp_ver"
			},
			function(data, status){
				verf_loading_br.hide();
				if(data == 'success'){
					$("#ver_OTP").hide();		
					$("#sendOTP").hide();
					$("#opt_ver_status").val('1');
					$("#opt_val").attr('readonly', true);

					alert("Your email has been verified successfully, Now you can proceed with your account")
				}
				else{
					$("ver_OTP").show();
					alert("Invalid OTP")
				}
			});

        }
		else{
			alert("Enter OTP first");
		}
	})


	function submitForm(){
		var form = $("#reg_form");
		var opt_ver_status = $("#opt_ver_status").val();

		if(opt_ver_status == '1'){
			form.submit();
		}
		else{
			alert("Please verify your email first");
		}
	}

</script>