<?php
include("include/header.php");
?>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

<?php include("include/nav.php"); ?>

<?php include("include/slider.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
    <section class="content-header" style="padding: 8px 0px;"></section>

    <!-- Main content -->
    <section class="content">

    
    <div class="p-3">
<form class="bg-white p-3 rounded shadow" style="border-left: 4px solid #008693;" method="post" enctype="multipart/form-data" action="../seller_action/add_prdCateg">

   <?php

   if(isset($_GET["ID"])){
     $ID = DBHelper::escape($_GET["ID"]);
     $data = DBHelper::get("SELECT * FROM `product_category` WHERE id = '{$ID}'")->fetch_assoc();
     $update = true;
     $title = "Update ";

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
            msg("Product category updated successfully",1);
            break;

           case 'fail':
            msg("Error occurred while creating account try again",2);
            break;

           case 'exist':
            msg("Category already exist",2);
            break;
       }
   }
   ?>

  <div class="row">
  <div class="form-group col-md-6 col-sm-8">
    <label for="exampleInputEmail1">Name <sup style="color:red;">*</sup></label>
    <input name="name" type="text" required class="form-control" placeholder="Enter name..." value="<?php if($update) {echo $data["name"];}?>">
  </div>

   <div class="col">   
  <button type="submit" name="submit" class="btn btn-info" style="margin-top: 32px;"><?php echo $title;?></button>
   </div>

  </div>


  <table class="table table-hover mt-3">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  <?php 
  $ID = $_SESSION["data"]["id"];
  $supp_list = DBHelper::get("SELECT * FROM `product_category` where addedBy = '{$ID}'");
  
  if($supp_list->num_rows > 0){
      while($row = $supp_list->fetch_assoc()){
        ?>
        <tr>
        <td><?php echo ucwords($row["name"]);?></td>
        <td>
        <a href="?p=companies&ID=<?php echo $row["id"];?>" title="Edit category"><i class="fas fa-pencil-alt text-warning"></i></a>
        </td>
        </tr>
      <?php
      }
  }
  else{

  }
  ?>
  
  </tbody>
</table>

</form>

</div>

<script>
    document.getElementById("p_title").innerText = "<?php echo $title;?>company";
</script>



    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include("include/footer.php"); ?>

<script>
    document.getElementById("p_title").innerText = "Add product category";
</script>

