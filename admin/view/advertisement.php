<div class="p-3">
<form id="form" class="bg-white p-3 rounded shadow" style="border-left: 4px solid #008693;" method="post" enctype="multipart/form-data" action="action/advertisement">

   <?php

   $supp_list = DBHelper::get("SELECT * FROM `advertisement` order by id desc");
   if($supp_list->num_rows >= 8 && !isset($_GET["ID"])){
      ?>
      <h6 class="text-danger">You can only add 8 ads. To add new you need to delete old one</h6>
      <?php
   }

   if(isset($_GET["ID"])){
     $ID = DBHelper::escape($_GET["ID"]);
     $data = DBHelper::get("SELECT * FROM `advertisement` WHERE id = '{$ID}'")->fetch_assoc();
     $update = true;
     $title = "Update ";

     echo "<input type='hidden' name='ID' value='".$ID."'>";
     echo "<input type='hidden' name='imageUrl' value='".$data["image"]."'>";
   }
   else{
     $update = false;
     $title = "Add ";
   }

   if(isset($_GET["msg"])){
       switch($_GET["msg"]){
           case 'success':
            msg("Advertisment added successfully",1);
            break;

           case 'sus_up':
            msg("Advertisment updated successfully",1);
            break;

           case 'del_succes':
            msg("Advertisment deleted successfully",1);
            break;

           case 'update':
            msg("Product category updated successfully",1);
            break;

           case 'uplo_error':
            msg("Error occurred while inserting data into db try again",2);
            break;

           case 'invalid':
            msg("Image size must 1920 x 930, try again",2);
            break;
       }
   }
   ?>

  <div class="row">
  <div class="form-group col-md-6 col-sm-12">
    <label for="exampleInputEmail1">Title <sup style="color:red;">* (30) character</sup></label>
    <input name="title" maxlength="30" type="text" required class="form-control" placeholder="Enter name..." value="<?php if($update) {echo $data["title"];}?>">
  </div>

  <div class="form-group col-md-6 col-sm-12">
    <label for="exampleInputEmail1">Sub title <sup style="color:red;">* (50) character</sup></label>
    <input name="sub_title" maxlength="50" type="text" required class="form-control" placeholder="Enter name..." value="<?php if($update) {echo $data["sub_title"];}?>">
  </div>

  </div>

 <div class="row">
  <div class="form-group col">
    <label for="exampleInputEmail1">Image <sup style="color:red;">* (jpg,png,jpeg)</sup></label>
    <input <?php if(!isset($_GET["ID"])){echo "required";} ?> name="file" type="file"   class="form-control">
  </div>

<div class="col">   
  <button type="submit" name="submit" class="btn btn-info" style="margin-top: 32px;"><?php echo $title;?></button>
</div>
</div>



  <table class="table table-hover mt-3">
  <thead>
    <tr>
      <th scope="col">Image</th>
      <th scope="col">Title</th>
      <th scope="col">Sub Title</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  <?php 
  if($supp_list->num_rows > 0){
      while($row = $supp_list->fetch_assoc()){
       $path = "../images/advertisement/".$row["image"]."?".rand(1,1000);
        ?>
        <tr>
        <td>
          <img class="rounded" width="50" height="50" onclick="fullView('<?php echo $path; ?>')" src="<?php echo $path; ?>" alt="Error">
        </td>
        <td><?php echo ucwords($row["title"]);?></td>
        <td><?php echo ucwords($row["sub_title"]);?></td>
        <td>
        <a href="?p=advertisement&ID=<?php echo $row["id"];?>" title="Edit advertisement"><i class="fas fa-pencil-alt text-warning"></i></a>
        <a href="action/advertisement?ID=<?php echo $row["id"];?>&type=delete_file" title="Delete advertisement"><i class="fas fa-trash text-danger"></i></a>
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
    document.getElementById("p_title").innerText = "<?php echo $title;?> advertisement";
</script>

<script src="plugins/jquery/jquery.min.js"></script>

<?php
  if($supp_list->num_rows >= 8 && !isset($_GET["ID"])){
    ?>
    <script>
    $("#form :input").prop("disabled", true);
    </script>
   
    <?php
 }
?>

