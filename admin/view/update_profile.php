<div class="p-3">
  <?php
  $data = DBHelper::get("SELECT * FROM `admin` WHERE `id` = '{$_SESSION["data"]["id"]}'");
  $data = $data->fetch_assoc();

  ?>
<form class="bg-white p-3 rounded shadow" style="border-left: 4px solid #ffa500" method="post" enctype="multipart/form-data" action="action/add_admin">

   <?php
   if(isset($_GET["msg"])){
       switch($_GET["msg"]){
           case 'success':
            msg("Admin account updated successfully",1);
            break;

           case 'fail':
            msg("Error occurred while creating account try again",2);
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
   ?>

  <div class="row">
  <div class="form-group col">
    <label for="exampleInputEmail1">Name <sup style="color:red;">*</sup></label>
    <input name="name" type="text" required class="form-control" value="<?php echo $data["name"];?>">
  </div>

  <div class="form-group col">
    <label for="exampleInputEmail1">Mobile <sup style="color:red;">* (unique)</sup></label>
    <input  name="mobile" type="number" class="form-control" required value="<?php echo $data["mobile"];?>">
  </div>

  <div class="form-group col">
    <label for="exampleInputEmail1">CNIC  <sup style="color:red;">* (unique)</sup></label>
    <input required name="cnic" type="number" class="form-control" value="<?php echo $data["cnic"];?>">
  </div>

  </div>

  <div class="row">
  <div class="form-group col">
    <label for="exampleInputPassword1">Email</label>
    <input name="email" type="text" class="form-control" value="<?php echo $data["email"];?>">
  </div>

  <div class="form-group col">
    <label for="exampleInputPassword1">Username <sup style="color:red;">* (unique)</sup></label>
    <input readonly name="username" required type="text" class="form-control" value="<?php echo $data["username"];?>">
  </div>
  </div>

  <input type="hidden" name="update_profile" value="update_profile">
  <input type="hidden" name="id" value="<?php echo $data["id"];?>">
  <input type="hidden" name="img" value="<?php echo $data["image"];?>">

  <div class="row">
  <div class="form-group col">
    <label for="exampleInputPassword1">Address</label>
    <input name="address" type="text" class="form-control" value="<?php echo $data["address"];?>">
  </div>

  <div class="form-group col">
    <label for="exampleInputPassword1">Password  <sup style="color:red;">*</sup></label>
    <input  name="password" required type="password" class="form-control" value="<?php echo Encryption::Decrypt($data["password"]);?>">
  </div>
  </div>

  <div class="form-group">
    <img width="120" height="120" src="../images/admin/<?php echo $data["image"];?>" alt="">
    <label for="exampleFormControlFile1">Profile image  <sup style="color:red;">* (jpg, png, jpeg, gif)</sup></label>
    <input name="file"  type="file" class="form-control-file" id="exampleFormControlFile1">
  </div>

  <button type="submit" class="btn btn-warning">Update</button>
</form>

</div>

<script>
    document.getElementById("p_title").innerText = "Update Profile";
</script>