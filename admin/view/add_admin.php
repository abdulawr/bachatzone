<div class="p-3">
<form class="bg-white p-3 rounded shadow" style="border-left: 4px solid #008693;" method="post" enctype="multipart/form-data" action="action/add_admin">

   <?php
   if(isset($_GET["msg"])){
       switch($_GET["msg"]){
           case 'success':
            msg("Admin account created successfully",1);
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
    <input name="name" type="text" required class="form-control" placeholder="Enter name...">
  </div>

  <div class="form-group col">
    <label for="exampleInputEmail1">Mobile <sup style="color:red;">* (unique)</sup></label>
    <input  name="mobile" type="number" class="form-control" required placeholder="Enter mobile...">
  </div>

  <div class="form-group col">
    <label for="exampleInputEmail1">CNIC  <sup style="color:red;">* (unique)</sup></label>
    <input required name="cnic" type="number" class="form-control" placeholder="CNIC">
  </div>

  </div>

  <div class="row">
  <div class="form-group col">
    <label for="exampleInputPassword1">Email</label>
    <input name="email" type="text" class="form-control" placeholder="Enter email...">
  </div>

  <div class="form-group col">
    <label for="exampleInputPassword1">Username <sup style="color:red;">* (unique)</sup></label>
    <input  name="username" required type="text" class="form-control" placeholder="Enter username...">
  </div>
  </div>

  <div class="row">
  <div class="form-group col">
    <label for="exampleInputPassword1">Address</label>
    <input name="address" type="text" class="form-control" placeholder="Enter address...">
  </div>

  <div class="form-group col">
    <label for="exampleInputPassword1">Password  <sup style="color:red;">*</sup></label>
    <input  name="password" required type="password" class="form-control" placeholder="Enter password...">
  </div>
  </div>

  <div class="form-group">
    <label for="exampleFormControlFile1">Profile image  <sup style="color:red;">* (jpg, png, jpeg, gif)</sup></label>
    <input name="file" required type="file" class="form-control-file" id="exampleFormControlFile1">
  </div>

  <button type="submit" class="btn btn-info">Submit</button>
</form>

</div>

<script>
    document.getElementById("p_title").innerText = "Add new admin";
</script>