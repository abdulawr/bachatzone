<div class="p-3">
<form class="bg-white p-3 rounded shadow" style="border-left: 4px solid #008693;" method="post" enctype="multipart/form-data" action="action/add_supplier">

   <?php

   if(isset($_GET["ID"])){
     $ID = DBHelper::escape($_GET["ID"]);
     $data = DBHelper::get("SELECT * FROM `supplier` WHERE id = '{$ID}'")->fetch_assoc();
     $update = true;
     $title = "Update ";

     $bank = DBHelper::get("SELECT * FROM `bank_account` WHERE `holder_id` = '{$ID}' and type = 2")->fetch_assoc();

     echo "<input type='hidden' name='ID' value='".$ID."'>";
   }
   else{
     $update = false;
     $title = "Add ";
   }

   if(isset($_GET["msg"])){
       switch($_GET["msg"]){
           case 'success':
            msg("Supplier account created successfully",1);
            break;

           case 'update':
            msg("Supplier account updated successfully",1);
            break;

           case 'fail':
            msg("Error occurred while creating account try again",2);
            break;

           case 'exist':
            msg("Account already exist",2);
            break;
       }
   }
   ?>

  <div class="row">
  <div class="form-group col-md-4 col-sm-12">
    <label for="exampleInputEmail1">Name <sup style="color:red;">*</sup></label>
    <input name="name" type="text" required class="form-control" placeholder="Enter name..." value="<?php if($update) {echo $data["name"];}?>">
  </div>

  <div class="form-group col-md-4 col-sm-12">
    <label for="exampleInputEmail1">Mobile <sup style="color:red;">* (unique)</sup></label>
    <input  name="mobile" type="number" class="form-control" required placeholder="Enter mobile..." value="<?php if($update) {echo $data["mobile"];}?>">
  </div>

  <div class="form-group col-md-4 col-sm-12">
    <label for="exampleInputEmail1">CNIC  <sup style="color:red;">* (unique)</sup></label>
    <input required name="cnic" type="number" class="form-control" placeholder="CNIC" value="<?php if($update) {echo $data["cnic"];}?>">
  </div>

  </div>

  <div class="row">

  <div class="form-group col-md-12 col-sm-12">
    <label for="exampleInputPassword1">Password  <sup style="color:red;">*</sup></label>
    <input required name="password" type="text" class="form-control" placeholder="Enter password..." value="<?php if($update) {echo Encryption::Decrypt($data["password"]);}?>">
  </div>

  </div>

  <div class="row">


  <div class="form-group col-md-12 col-sm-12">
    <label for="exampleInputPassword1">Email  <sup style="color:red;">* (unique)</sup></label>
    <input name="email" type="text" class="form-control" placeholder="Enter email..." value="<?php if($update) {echo $data["email"];}?>">
  </div>

  </div>


  <div class="row">
  <div class="form-group col-md-6 col-sm-12">
    <label for="exampleInputPassword1">Shop name <sup style="color:red;">*</sup></label>
    <input required name="shop_name" type="text" class="form-control" placeholder="Enter shop name..." value="<?php if($update) {echo $data["shop_name"];}?>">
  </div>

  <div class="form-group col-md-6 col-sm-12">
    <label for="exampleInputPassword1">Shop address <sup style="color:red;">*</sup></label>
    <input required name="shop_add" type="text" class="form-control" placeholder="Enter shop address..." value="<?php if($update) {echo $data["shop_add"];}?>">
  </div>

  </div>


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


<div class="form-check">
  <input checked class="form-check-input" type="radio" name="sallerType" id="sallerType" value="0">
  <label class="form-check-label" for="exampleRadios1">
    Online saller
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="radio" name="sallerType" id="sallerType" value="1">
  <label class="form-check-label" for="exampleRadios1">
    Offline saller
  </label>
</div>

<br>


  <div class="form-group">
             <label for="exampleFormControlFile1">Profile image</label>
             <input <?php if(!$update) {echo "required";}?>  type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
  </div>
 
  <?php if($update) {echo "<input type='hidden' name='update_link' value='".$data["image"]."'>";}?>


  <button type="submit" class="btn btn-info"><?php echo $title;?> saller</button>
</form>

</div>

<script>
    document.getElementById("p_title").innerText = "<?php echo $title;?>supplier";
</script>