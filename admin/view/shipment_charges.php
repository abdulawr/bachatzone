
<div class="p-3">
<form class="bg-white p-3 rounded" style="border-left: 4px solid #008693; box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;" method="post" enctype="multipart/form-data" action="action/shipment_charges">

   <?php

   if(isset($_GET["ID"])){
     $ID = DBHelper::escape($_GET["ID"]);
     $data = DBHelper::get("SELECT * FROM `shipment_charges` WHERE id = '{$ID}'")->fetch_assoc();
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
            msg("Action performed successfully",1);
            break;

           case 'update':
            msg("Data updated successfully",1);
            break;

           case 'fail':
            msg("Error occurred while inserting data",2);
            break;

           case 'exist':
            msg("Data already exist",2);
            break;
       }
   }
   ?>

  <div class="row">
  <div class="form-group col-md-4 col-sm-12">
    <label for="exampleInputEmail1">City name <sup style="color:red;">*</sup></label>
    <input name="name" type="text" required class="form-control" placeholder="Enter city name..." value="<?php if($update) {echo $data["city_name"];}?>">
  </div>

  <div class="form-group col-md-4 col-sm-12">
    <label for="exampleInputEmail1">Charges <sup style="color:red;">*</sup></label>
    <input name="charges" type="number" required class="form-control" placeholder="Enter charges..." value="<?php if($update) {echo $data["charges"];}?>">
  </div>

   <div class="col-md-4 col-sm-12">   
  <button type="submit" name="submit" class="btn btn-info" style="margin-top: 32px;"><?php echo $title;?></button>
   </div>

  </div>


  <table class="table table-hover mt-3">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Charges</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  <?php 
  $supp_list = DBHelper::get("SELECT * FROM `shipment_charges`");
  if($supp_list->num_rows > 0){
      while($row = $supp_list->fetch_assoc()){
        ?>
        <tr>
        <td><?php echo ucwords($row["city_name"]);?></td>
        <td><?php echo ucwords($row["charges"]);?></td>
        <td>
        <a href="?p=shipment_charges&ID=<?php echo $row["id"];?>" title="Edit"><i class="fas fa-pencil-alt text-warning"></i></a>
        <a href="action/shipment_charges?ID=<?php echo $row["id"];?>&type=deleted" title="Delete"><i class="fas fa-trash-alt text-danger ml-2"></i></a>
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
    document.getElementById("p_title").innerText = "Add shipment charges";
</script>

