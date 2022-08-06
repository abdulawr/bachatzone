<?php
 include_once("../../include/HelperFunction.php");
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

  <style>
	.pss{
		text-align: left; 
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
<body class="hold-transition register-page">
<div class="register-box">

  <div class="card">
    <div class="card-body register-card-body">
    <h3 style="font-weight: bold; text-align:center">Seller Signup</h3>
      <p class="login-box-msg">Register a new membership</p>

      <form id="user_form" action="../seller_action/signup_seller" enctype="multipart/form-data" method="post">

      <?php
      if(isset($_GET["msg"])){
        switch($_GET["msg"]){

          case 'already':
            msg("Account already exist",2);
            break;

          case 'success':
            msg("Your has been created successfully",1);
            break;

          case 'img_error':
            msg("Error occured while uploading image try again",2);
            break;

          case 'invalid_img':
            msg('Invalid image, You can only upload(jpg,png,jpeg,gif)',2);
            break;
        }
       
      }
     
      ?>

       <div class="row">

       <div class="input-group mb-3 col-md-6 col-sm-12">
          <input required name="name" type="text" class="form-control" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3 col-md-6 col-sm-12">
          <input id="usemail" required name="email" type="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-comment"></span>
            </div>
          </div>
        </div>

        <input type="hidden" value="0" name="opt_ver_status" id="opt_ver_status">
        <input type="hidden" name="submit">

       </div>


  <div class="load_div row">
    <div class="col">
    <p  style="display: inline-block;" id="sendOTP" class="pss">Send OTP</p>
					   <img style="display: none;" id="loading_br" width="40" height="40" src="../../images/load.gif" alt="">
    </div>
	</div>
       
<div class="row">

  <div  id="otp_div" style="display: none;" class="wrap-input100 validate-input col" data-validate = "Enter OTP">
    <input id="opt_val" name="otp" class="form-control" type="password" placeholder="OTP">						
  </div>

  <div class="load_div col" style="display: none; text-align:left" id="verif_opt_div">
     <p  style="display: inline-block;" id="ver_OTP" class="pss">Verify OTP</p>
     <img style="display: none;" id="verf_loading_br" width="40" height="40" src="../../images/load.gif" alt="">
  </div>

</div>


       <div class="row">

      <div class="input-group mb-3 col-md-6 col-sm-12">
        <input required name="mobile" type="mobile" maxlength="11" class="form-control" placeholder="Mobile">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-list-ol"></span>
          </div>
        </div>
      </div>

      <div class="input-group mb-3 col-md-6 col-sm-12">
        <input required type="number" maxlength="13" name="cnic" class="form-control" placeholder="CNIC">
        <div class="input-group-append">
          <div class="input-group-text">
          <span class="fas fa-list-ol"></span>
          </div>
        </div>
      </div>

      </div>
        

      


        <div class="row">

          <div class="input-group mb-3 col-md-12 col-sm-12">
            <input required name="password" type="text" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-key"></span>
              </div>
            </div>
          </div>

          </div>


<div class="row">
<div class="input-group mb-3 col-md-12 col-sm-12">
  <input required name="shop_name" type="text" class="form-control" placeholder="Shop name">
  <div class="input-group-append">
    <div class="input-group-text">
      <span class="fas fa-home"></span>
    </div>
  </div>
</div>
</div>

<div class="row">
<div class="input-group mb-3 col-md-12 col-sm-12">
  <input required name="shop_add" type="text" class="form-control" placeholder="Shop address">
  <div class="input-group-append">
    <div class="input-group-text">
      <span class="fas fa-home"></span>
    </div>
  </div>
</div>
</div>

          <div class="form-group">
             <label for="exampleFormControlFile1">Profile image</label>
             <input required name="file" type="file" class="form-control-file" id="exampleFormControlFile1">
          </div>

          <input type="hidden" name="type" value="create_account">

        <div class="row">
          <div class="col-6">
            
          </div>
          <!-- /.col -->
          <div class="col-6">
            <button type="submit"  class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <br>
      <a href="../seller_login" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
</body>
</html>


<script>

function validEmail(email){
  const regex = /^((?!\.)[\w\-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/;
  return regex.test(email);
}


	$("#sendOTP").click(function(){
 
	     var email = $("#usemail").val();
         var loading_br = $("#loading_br");

		 if (email && email.length !== 0) {
			
			if(validEmail(email)){
                loading_br.show();
				$("#sendOTP").hide();

				$.post("../seller_action/sendOTP.php",
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


	$("#ver_OTP").click(function(){

		var opt_val = $("#opt_val").val();
		var email = $("#usemail").val();
		var verf_loading_br = $("#verf_loading_br");
	  
        if (opt_val && opt_val.length !== 0) {
			verf_loading_br.show();
			$("ver_OTP").hide();
			$.post("../seller_action/sendOTP.php",
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
          $("#opt_val").css("margin-bottom","10px");

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


  $("#user_form").submit(function (e) { 
 // e.preventDefault();
  inputs={};
  input_serialized =  $(this).serializeArray();

  if(input_serialized[2].value == '1'){
    console.log("Done")
  }
  else{
    e.preventDefault();
    alert("Please verify your email first");
    console.error("alert")
  }

});

</script>
