<?php
include("include/header.php");
?>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

<?php include("include/nav.php"); ?>

<?php include("include/slider.php");
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
    <section class="content-header" style="padding: 8px 0px;"></section>

    <!-- Main content -->
    <section class="content">

    
      <div class="card">
       
        <div class="card-body">
               <?php
                  $ID = $_SESSION["data"]["id"];
                  $data = DBHelper::get("select * from supplier where id = '{$ID}'")->fetch_assoc();
                  
                  $bank = DBHelper::get("SELECT * FROM `bank_account` WHERE `holder_id` = '{$ID}' and type = 2");
                  if($bank->num_rows > 0){
                    $bank = $bank->fetch_assoc();
                  }
                  else{
                      $bank = [
                        'ac_no' => '',
                        'ac_title' => '',
                        'bank_name' => ''
                      ];
                  }

                  $path = "../../images/seller/".$data["image"];
                  if(empty($data["image"])){
                    $path = "../../images/no-img.jpg";
                  }
                 
               ?>
        <form method="post" enctype="multipart/form-data" action="../seller_action/signup_seller">

          <img class="img-thumbnail rounded mb-2" width="120" height="120" src="<?php echo $path; ?>" alt="">

          
          <div>
                <?php
                if($data["sallerType"] == '0'){
                  echo '<span class="badge badge-info">Online</span>';
                }
                elseif($data["sallerType"] == '1'){
                 echo '<span class="badge badge-secondary">Offline</span>';
                }
                ?>
            </div>

          <?php
          if(isset($_GET["msg"])  && $_GET["msg"] == "success"){
              echo msg("Account updated successfully",1);
          }
          ?>


            
                <div class="form-row">

                <input type="hidden" name="ID" value="<?php echo $data["id"]; ?>">
                <input type="hidden" name="type" value="update_acction">
                <input type="hidden" name="imageURL" value="<?php echo $data["image"]; ?>">

            
                    <div class="form-group col-md-4 col-sm-12">
                    <label for="inputEmail4">Name</label>
                    <input required name="name" type="text" class="form-control" placeholder="Name" value="<?php echo $data["name"]; ?>">
                    </div>

                    <div class="form-group col-md-4 col-sm-12">
                    <label for="inputEmail4">Email</label>
                    <input required name="email" type="email" class="form-control" placeholder="Email" value="<?php echo $data["email"]; ?>">
                    </div>

                    <div class="form-group col-md-4 col-sm-12">
                    <label for="inputPassword4">Mobile</label>
                    <input required name="mobile" type="number" class="form-control" placeholder="Mobile" value="<?php echo $data["mobile"]; ?>">
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-4 col-sm-12">
                    <label for="inputEmail4">CNIC</label>
                    <input required name="cnic" type="number" maxlength="14" class="form-control" placeholder="CNIC" value="<?php echo $data["cnic"]; ?>">
                    </div>
     

                    <div class="form-group col-md-4 col-sm-12">
                    <label for="inputPassword4">Password</label>
                    <input required name="password" type="password" class="form-control" placeholder="Password" value="<?php echo Encryption::Decrypt($data["password"]); ?>">
                    </div>

              </div>


                <div class="form-group">
                    <label for="inputAddress">Shop name</label>
                    <input required name="shop_name" type="text" class="form-control" id="inputAddress" placeholder="Shop name" value="<?php echo $data["shop_name"]; ?>">
                </div>

                <div class="form-group">
                    <label for="inputAddress">Shop address</label>
                    <input required name="shop_add" type="text" class="form-control" id="inputAddress" placeholder="Shop address" value="<?php echo $data["shop_add"]; ?>">
                </div>


                <h5 class="mt-3 mb-3" style="background-color: #707070; color:white; padding:3px 10px;">Accounts Information</h5>
  <div class="row">
  <div class="form-group col">
    <label for="exampleInputEmail1">Easy Paisa/Jazz Cash/Mobi Cash No <sup style="color:red;">*</sup></label>
    <input name="mobile_account" type="text" required class="form-control" placeholder="Enter no..." value="<?php echo $data["mobile_account"];?>">
  </div>

  <div class="form-group col">
    <label for="exampleInputEmail1">Type <sup style="color:red;">* (Payment number type)</sup></label>
   <select name="mobile_account_type" class="form-control">
       <option value="1" <?php if($data["mobile_account_type"] == "1") {echo "selected";}?> >Easy Paisa</option>
       <option value="2" <?php if($data["mobile_account_type"] == "2") {echo "selected";}?> >Jazz Cash</option>
       <option value="3" <?php if($data["mobile_account_type"] == "3") {echo "selected";}?> >Mobi Cash</option>
   </select>
  </div>

  </div>


  <h5 class="mt-3 mb-3" style="background-color: #707070; color:white; padding:3px 10px;">Bank Account</h5>
  <div class="row">
  <div class="form-group col">
    <label for="exampleInputEmail1">Account No</label>
    <input name="account_no" type="text"  class="form-control" value="<?php echo $bank["ac_no"];?>">
  </div>

  <div class="form-group col">
    <label for="exampleInputEmail1">Account Title</sup></label>
    <input name="account_title" type="text"  class="form-control" value="<?php echo $bank["ac_title"]; ?>">
  </div>

  <div class="form-group col">
    <label for="exampleInputEmail1">Bank name</label>
    <input name="bank_name" type="text"  class="form-control" value="<?php echo $bank["bank_name"]; ?>">
  </div>

  </div>


                <div class="form-group">
                    <label for="exampleFormControlFile1">Profile Image</label>
                    <input name="file" type="file" class="form-control-file" id="exampleFormControlFile1">
                </div>

        
                <button type="submit" class="btn btn-outline-warning">Update</button>
            </form>

        </div>
            
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include("include/footer.php"); ?>

<script>
    document.getElementById("p_title").innerText = "Profile";
</script>

