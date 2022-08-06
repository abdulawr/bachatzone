<?php 
if(isset($_REQUEST["ID"])){
$ID = DBHelper::escape($_GET["ID"]);
$data = DBHelper::get("SELECT * FROM `investor` WHERE id = '{$ID}'")->fetch_assoc();
$bank = DBHelper::get("SELECT * FROM `bank_account` WHERE `holder_id` = '{$ID}'")->fetch_assoc();
$update = true;
}
else{
$update = false;
}
?>
<div class="p-3">
<form class="bg-white p-3 rounded shadow" style="border-left: 4px solid #707070;" method="post" enctype="multipart/form-data" action="action/add_master_team">
  <h5 style="background-color: #707070; color:white; padding:3px 10px;">Personal Information</h5>
   <?php
   
   if(isset($_GET["msg"])){
       switch($_GET["msg"]){

            case 'succ_updated':
            msg("Master team profile updated successfully!",1);
            break;

           case 'succ_insert':
            msg("Master team account created successfully",1);
            break;

           case 'already_exist':
            msg("Master team account already exist!",2);
            break;

           case 'img_uploading_error':
            msg("Error occured in image uploading try again",2);
            break;

           case 'invalid_file':
            msg("Invalid image type",2);
            break;

           case 'already_exist':
            msg("Account already exist",2);
            break;
       }
   }
   

   if($update){
     echo '<input type="hidden" name="ID" value="'.$data['id'].'" >';
     echo '<input type="hidden" name="update_row" value="update_row" >';
   }
   ?>

  <div class="row">
  <div class="form-group col">
    <label for="exampleInputEmail1">First Name <sup style="color:red;">*</sup></label>
    <input name="f_name" type="text" required class="form-control" value="<?php if($update) {echo $data["fname"];}?>">
  </div>

  <div class="form-group col">
    <label for="exampleInputEmail1">Last Name <sup style="color:red;">*</sup></label>
    <input  name="l_name" type="text" class="form-control" required value="<?php if($update) {echo $data["lname"];}?>" >
  </div>

  <div class="form-group col">
    <label for="exampleInputEmail1">Email  <sup style="color:red;">* (unique)</sup></label>
    <input required name="email" type="text" class="form-control" value="<?php if($update) {echo $data["email"];}?>">
  </div>

  </div>


  <div class="row">
  <div class="form-group col">
    <label for="exampleInputEmail1">Mobile <sup style="color:red;">* (unique)</sup></label>
    <input name="mobile" type="text" required class="form-control" value="<?php if($update) {echo $data["mobile"];}?>">
  </div>

  <div class="form-group col">
    <label for="exampleInputEmail1">Gender</label>
    <select name="gender" class="form-control">
       <option value="1" <?php if($update && $data["gender"] == "1") {echo "selected";}?>>Male</option>
       <option value="2" <?php if($update && $data["gender"] == "2") {echo "selected";}?>>Female</option>
       <option value="3" <?php if($update && $data["gender"] == "3") {echo "selected";}?>>Other</option>
   </select>
  </div>

  <div class="form-group col">
    <label for="exampleInputEmail1">Age <sup style="color:red;">*</sup></label>
    <input required name="age" type="number" class="form-control" value="<?php if($update) {echo $data["age"];}?>">
  </div>

  </div>


  <div class="row">
  <div class="form-group col">
    <label for="exampleInputPassword1">Address</label>
    <input name="address" type="text" class="form-control" value="<?php if($update) {echo $data["address"];}?>">
  </div>

  <div class="form-group col">
    <label for="exampleInputPassword1">CNIC <sup style="color:red;">*</sup></label>
    <input required name="cnic" type="text" class="form-control" value="<?php if($update) {echo $data["cnic"];}?>">
  </div>

  </div>

  <div class="form-group">
    <label for="exampleFormControlFile1">Profile image  <sup style="color:red;">* (jpg, png, jpeg, gif)</sup></label>
    <input name="file" type="file" class="form-control-file" id="exampleFormControlFile1">
  </div>

  <!-- <div class="form-group">
    <label for="exampleFormControlFile1">Profile image  <sup style="color:red;">* (jpg, png, jpeg, gif)</sup></label>
    <input name="file" required type="file" class="form-control-file" id="exampleFormControlFile1">
  </div> -->

  <h5 class="mt-3 mb-3" style="background-color: #707070; color:white; padding:3px 10px;">Accounts Information</h5>
  <div class="row">
  <div class="form-group col">
    <label for="exampleInputEmail1">Easy Paisa/Jazz Cash/Mobi Cash No <sup style="color:red;">*</sup></label>
    <input name="mobile_account" type="text" required class="form-control" placeholder="Enter no..." value="<?php if($update) {echo $data["mobile_account"];}?>">
  </div>

  <div class="form-group col">
    <label for="exampleInputEmail1">Type <sup style="color:red;">* (Payment number type)</sup></label>
   <select name="mobile_account_type" class="form-control">
       <option value="1" <?php if($update && $data["mobile_account_type"] == "1") {echo "selected";}?> >Easy Paisa</option>
       <option value="2" <?php if($update && $data["mobile_account_type"] == "2") {echo "selected";}?> >Jazz Cash</option>
       <option value="3" <?php if($update && $data["mobile_account_type"] == "3") {echo "selected";}?> >Mobi Cash</option>
   </select>
  </div>

  </div>


  <h5 class="mt-3 mb-3" style="background-color: #707070; color:white; padding:3px 10px;">Bank Account</h5>
  <div class="row">
  <div class="form-group col">
    <label for="exampleInputEmail1">Account No</label>
    <input name="account_no" type="text"  class="form-control" value="<?php if($update) {echo $bank["ac_no"];}?>">
  </div>

  <div class="form-group col">
    <label for="exampleInputEmail1">Account Title</sup></label>
    <input name="account_title" type="text"  class="form-control" value="<?php if($update) {echo $bank["ac_title"];}?>">
  </div>

  <div class="form-group col">
    <label for="exampleInputEmail1">Bank name</label>
    <input name="bank_name" type="text"  class="form-control" value="<?php if($update) {echo $bank["bank_name"];}?>">
  </div>

  </div>


  <button type="submit" class="btn btn-outline-info">
    <?php 
    if($update){
      echo "Update";
    }
    else{
      echo "Submit";
    }
    ?>
  </button>
</form>

</div>

<script>
    document.getElementById("p_title").innerText = "Add master team";
</script>