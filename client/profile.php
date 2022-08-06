<?php 
if(!isset($_COOKIE["cusID"])){
	?>
	<script>
		location.replace("../login?msg=invalid_access")
	</script>
	<?php
}

include("include/header.php"); ?>
<body class="animsition">
	
<?php
 include("include/nav.php");
 include("include/cart.php");

 $ID = Encryption::Decrypt($_COOKIE["cusID"]);
 $data = DBHelper::get("SELECT * FROM `tbl_customer` WHERE `id` = '{$ID}'")->fetch_assoc();


 if($data["profile_status"] == 1){
	 $perment_adds = DBHelper::get("SELECT * FROM `tbl_address` WHERE `holderID` = '{$ID}' and `type` = 1 and status = 1")->fetch_assoc();
	 $present_adds = DBHelper::get("SELECT * FROM `tbl_address` WHERE `holderID` = '{$ID}' and `type` = 1 and status = 2")->fetch_assoc();
     $bank_acc = DBHelper::get("SELECT * FROM `bank_account` WHERE `holder_id` = '{$ID}' and `type` = 1")->fetch_assoc();
	}
 else{
	$perment_adds = [];
	$present_adds = [];
	$bank_acc = [];
 }

 ?>

 <style>
	     fieldset 
	{
		border: 1px solid #ddd !important;
		margin: 0;
		xmin-width: 0;
		padding: 10px;       
		position: relative;
		border-radius:4px;
		
		padding-left:10px!important;
	}	
	
		legend
		{
			font-size:14px;
			font-weight:bold;
			margin-bottom: 0px; 
			width: 35%; 
			border: 1px solid #ddd;
			border-radius: 4px; 
			padding: 5px 5px 5px 10px; 
			background-color: #ffffff;
		}
 </style>

	<!-- Content page -->
	<section class="bg0 p-t-40 p-b-50 ">
		<div class="container rounded"">

		<?php 
		  if(isset($_GET["msg"]) and $_GET["msg"] == "success"){
			  msg("Profile updated successfully");
		  }

		  if(!empty($data["image"])){
			  $path = "../images/customer/".$data["image"];
		  }
		  else{
			  $path = 'images/choose.jpg';
		  }
		?>

		<form class="rounded" style="padding:10px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); border-top: 3px solid  #18537a ;" method="post" enctype="multipart/form-data" action="action/update_cus_profile">
		<button type="submit" class="btn btn-info mb-3">Submit</button>
		<button type="button" class="btn btn-warning mb-3 invLinkBtn">Copy invitation link</button>
		<div class="row shadow rounded">

		<div class="col-md-6  col-sm-6">
		    
				<fieldset>
				<legend class="float-none w-auto">Personal Info</legend>
                <div class="row">
				<input type="file" name="file" id="pic1" style="display:none;"/>
				<label for="pic1">
				<img src="<?php echo $path; ?>" class="img-thumbnail rounded-circle  mb-3" style="margin-left: 20px;" width="140" height="140" alt="">
				</label>
				</div>

				<div class="row">
					<div class="col-md-6 col-sm-12 mt-md-2">
					<label for="">Name <sup class="text-danger">*</sup></label>
					<input name="name" required type="text" class="form-control" value="<?php echo $data['name']; ?>">
					</div>
					<div class="col-md-6 col-sm-12 mt-sm-2">
					<label for="">Email <sup class="text-danger">*</sup></label>
					<input type="email" required name="email" class="form-control" value="<?php echo $data['email']; ?>">
					</div>
				</div>

				<div class="row mt-3">
					<div class="col-md-6 col-sm-12 mt-sm-2">
					<label for="">Mobile <sup class="text-danger">*</sup></label>
					<input required name="mobile" type="text" class="form-control" value="<?php echo $data['mobile']; ?>">
					</div>
					<div class="col-md-6 col-sm-12 mt-sm-2">
					<label for="exampleFormControlSelect1">Gender</label>
					<select name="gender" class="form-control" id="exampleFormControlSelect1">
						<?php
						$op = ["1"=>"Male","2"=>"Female","3"=>"Other"];
						foreach($op as $key=>$value){
						
							if($key == $data["gender"]){
								echo '<option selected value="'.$key.'">'.$value.'</option>';
							}
							else{
								echo '<option value="'.$key.'">'.$value.'</option>';
							}
						}
						?>
					<!-- <option value="1">Male</option>
					<option value="2">Female</option>
					<option value="3">Other</option> -->
					</select>
					</div>
				</div>

				<div class="row mt-3">
				
					<div class="col-md-6 col-sm-12 mt-sm-2">
					<label for="">Password <sup class="text-danger">*</sup></label>
					<input required name="password" type="password" class="form-control" value="<?php echo Encryption::Decrypt($data['password']); ?>">
					</div>
				</div>


				</fieldset>  

				<fieldset style="margin-top: 20px;">
				<legend class="float-none w-auto">Permanent Address</legend>
				
				<div class="row mt-3">
					<div class="col-md-6 col-sm-12 mt-sm-2">
					<label for="">House Number <sup class="text-danger">*</sup></label>
					<input value="<?php if(count($perment_adds) > 0) echo $perment_adds['house_no']; ?>" id="per_h_number" name="per_h_number" required type="text" class="form-control">
					</div>
					<div class="col-md-6 col-sm-12 mt-sm-2">
					<label for="">Street Number</label>
					<input value="<?php if(count($perment_adds) > 0) echo $perment_adds['street_no']; ?>" id="per_street_no" name="per_street_no" type="text" class="form-control">
					</div>
				</div>

				<div class="row mt-3">
					<div class="col-md-6 col-sm-12 mt-sm-2">
					<label for="">Village/City <sup class="text-danger">*</sup></label>
					<input value="<?php if(count($perment_adds) > 0) echo $perment_adds['city']; ?>" id="per_city" required name="per_city" type="text" class="form-control">
					</div>
					<div class="col-md-6 col-sm-12 mt-sm-2">
					<label for="">Tehsil</label>
					<input value="<?php if(count($perment_adds) > 0) echo $perment_adds['tehsil']; ?>" id="per_tehsil" name="per_tehsil" type="text" class="form-control">
					</div>
				</div>


				<div class="row mt-3">
					<div class="col-md-6 col-sm-12 mt-sm-2">
					<label for="">District <sup class="text-danger">*</sup></label>
					<input value="<?php if(count($perment_adds) > 0) echo $perment_adds['district']; ?>" id="per_district" name="per_district"  type="text" class="form-control">
					</div>
					<div class="col-md-6 col-sm-12 mt-sm-2">
					<label for="">Postal Code</label>
					<input value="<?php if(count($perment_adds) > 0) echo $perment_adds['postal_code']; ?>" id="per_postal_code" name="per_postal_code" type="text" class="form-control">
					</div>
				</div>


				</fieldset>
			  
		</div>

		<input name="account_status" type="hidden" value="<?php echo $data['profile_status']; ?>">
		<input name="ID" type="hidden" value="<?php echo $ID; ?>">
		<input name="imageLink" type="hidden" value="<?php echo $data["image"]; ?>">

		<div class="col-md-6 col-sm-6 mt-3">
		<fieldset>
				<legend class="float-none w-auto">Bank/Mobile Account</legend>

				<div class="row mt-3">
					<div class="col-md-6 col-sm-12 mt-sm-2">
					<label for="">Easy Paisa/Jazz Cash/Mobi Cash No <sup class="text-danger">*</sup></label>
					<input required name="jazz_easy_mobi_no"  type="text" class="form-control" value="<?php echo $data["jazz_easy_mobi_no"]; ?>">
					</div>
				
					<div class="col-md-6 col-sm-12 mt-sm-2">
					<label for="exampleFormControlSelect1">Account Type <sup class="text-danger">*</sup></label>
					<select name="jazz_easy_mobi_type" class="form-control" id="exampleFormControlSelect1">
					
					<?php
						$op = ["1"=>"Easy Paisa","2"=>"Jazz Cash","3"=>"Mobi Cash"];
						foreach($op as $key=>$value){
						
							if($key == $data["jazz_easy_mobi_type"]){
								echo '<option selected value="'.$key.'">'.$value.'</option>';
							}
							else{
								echo '<option value="'.$key.'">'.$value.'</option>';
							}
						}
						?>
				
					</select>
					</div>

				</div>


				<div class="row mt-3">
					<div class="col-md-12 col-sm-12 mt-sm-2">
					<label for="">Bank Account No</label>
					<input  value="<?php if(count($bank_acc) > 0) echo $bank_acc['ac_no']; ?>" name="bank_ac_no" type="text" class="form-control">
					</div>
				</div>

				<div class="row mt-3">
					<div class="col-md-6 col-sm-12 mt-sm-2">
					<label for="">Bank Name</label>
					<input  value="<?php if(count($bank_acc) > 0) echo $bank_acc['bank_name']; ?>" name="bank_name" type="text" class="form-control">
					</div>
					<div class="col-md-6 col-sm-12 mt-sm-2">
					<label for="">Account Title</label>
					<input  value="<?php if(count($bank_acc) > 0) echo $bank_acc['ac_title']; ?>" name="bank_account_title" type="text" class="form-control">
					</div>
				</div>



				</fieldset>


				<fieldset style="margin-top: 20px;">
				<legend class="float-none w-auto">Present Address</legend>

				<div class="row mt-3">
					<div class="col-md-6 col-sm-12 mt-sm-2">
					<label for="">House Number  <sup class="text-danger">*</sup></label>
					<input value="<?php if(count($present_adds) > 0) echo $present_adds['house_no']; ?>" id="pre_h_no" name='pre_h_no' required type="text" class="form-control">
					</div>
					<div class="col-md-6 col-sm-12 mt-sm-2">
					<label for="">Street Number</label>
					<input value="<?php if(count($present_adds) > 0) echo $present_adds['street_no']; ?>" id="pre_st_no" name="pre_st_no" type="text" class="form-control">
					</div>
				</div>

				<div class="row mt-3">
					<div class="col-md-6 col-sm-12 mt-sm-2">
					<label for="">Village/City  <sup class="text-danger">*</sup></label>
					<input value="<?php if(count($present_adds) > 0) echo $present_adds['city']; ?>" id="pre_city" name="pre_city" required type="text" class="form-control">
					</div>
					<div class="col-md-6 col-sm-12 mt-sm-2">
					<label for="">Tehsil </label>
					<input value="<?php if(count($present_adds) > 0) echo $present_adds['tehsil']; ?>" id="pre_tehsil" name="pre_tehsil" type="text" class="form-control">
					</div>
				</div>


				<div class="row mt-3">
					<div class="col-md-6 col-sm-12 mt-sm-2">
					<label for="">District <sup class="text-danger">*</sup></label>
					<input value="<?php if(count($present_adds) > 0) echo $present_adds['district']; ?>" id="pre_district" name="pre_district" required type="text" class="form-control">
					</div>
					<div class="col">
					<label for="">Postal Code</label>
					<input value="<?php if(count($present_adds) > 0) echo $present_adds['postal_code']; ?>" id="prr_postal_code" name="prr_postal_code" type="text" class="form-control">
					</div>
		
				</div>

				<div style="margin-top:10px">
				<label for="assss">
				<input id="assss" type="checkbox" style="display:inline-block">
				 Both are same
				</label>
				</div>
				
				</fieldset>

				<?php
				$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
				?>

				<div class="row mt-3">
					<div class="col">
					<label style="font-weight: bold;" for="">Invitation link</label>
					<input type="text" id="invLink" value="<?php echo $actual_link."/register?ID=".Encryption::Encrypt($ID);?>" readonly class="form-control">
					</div>
				</div>

		</div>

		</div>

		<button type="submit" class="btn btn-info mt-3">Submit</button>
		<button type="button" class="btn btn-warning mt-3 invLinkBtn">Copy invitation link</button>
			
		</form>
		</div>
	</section>	
	

    <?php
     include("include/footer.php");
     include("include/links.php");
    ?>

</body>
</html>

<script>
	$('.invLinkBtn').click(function(){
	 var link = $("#invLink").val();
	 var copyText = document.getElementById("invLink");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

   /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);

  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
    });


$("#assss").click(function(){

	var per_h_number = $("#per_h_number");
	var per_street_no = $("#per_street_no");
	var per_city = $("#per_city");
	var per_tehsil = $("#per_tehsil");
	var per_district = $("#per_district");
	var per_postal_code = $("#per_postal_code");

	var pre_h_no = $("#pre_h_no");
	var pre_st_no = $("#pre_st_no");
	var pre_city = $("#pre_city");
	var pre_tehsil = $("#pre_tehsil");
	var pre_district = $("#pre_district");
	var prr_postal_code = $("#prr_postal_code");
	
 if($(this).is(":checked")){
   //true
   pre_h_no.val(per_h_number.val());
   pre_st_no.val(per_street_no.val());
   pre_city.val(per_city.val());
   pre_tehsil.val(per_tehsil.val());
   pre_district.val(per_district.val());
   prr_postal_code.val(per_postal_code.val());
  
   pre_h_no.attr('readonly', true);
   pre_st_no.attr('readonly', true);
   pre_city.attr('readonly', true);
   pre_tehsil.attr('readonly', true);
   pre_district.attr('readonly', true);
   prr_postal_code.attr('readonly', true);

 }
 else{
   pre_h_no.val('');
   pre_st_no.val('');
   pre_city.val('');
   pre_tehsil.val('');
   pre_district.val('');
   prr_postal_code.val('');

   pre_h_no.attr('readonly', false);
   pre_st_no.attr('readonly', false);
   pre_city.attr('readonly', false);
   pre_tehsil.attr('readonly', false);
   pre_district.attr('readonly', false);
   prr_postal_code.attr('readonly', false);

 }

})

</script>