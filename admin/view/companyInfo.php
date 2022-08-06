<?php
$data = DBHelper::get("SELECT * FROM json_data WHERE status = 'cmp_info'")->fetch_assoc();
$data = json_decode($data["content"],true);
?>
<div class="p-3">
<form class="bg-white p-3 rounded shadow" style="border-left: 4px solid #008693;" method="post" enctype="multipart/form-data" action="action/companyInfo">

   <?php
   if(isset($_GET["msg"])){
       switch($_GET["msg"]){
           case '1':
            msg("Company info updated successfully",1);
            break;

           case '0':
            msg("Error occurred while updating data",2);
            break;
       }
   }
   ?>

  <div class="row">
  <div class="form-group col">
    <label for="exampleInputEmail1">Name <sup style="color:red;">*</sup></label>
    <input name="name" type="text" required class="form-control" placeholder="Enter name..." value="<?php echo $data["name"];?>">
  </div>

  <div class="form-group col">
    <label for="exampleInputEmail1">Contact No <sup style="color:red;">* (unique)</sup></label>
    <input  name="contact" type="number" class="form-control" required placeholder="Enter mobile..." value="<?php echo $data["contact"];?>">
  </div>

  </div>

  <div class="row">
  <div class="form-group col">
    <label for="exampleInputPassword1">Email</label>
    <input name="email" type="text" class="form-control" placeholder="Enter email..." value="<?php echo $data["email"];?>">
  </div>

  </div>

  <div class="row">
  <div class="form-group col">
    <label for="exampleInputPassword1">Address</label>
    <input name="address" type="text" class="form-control" placeholder="Enter address..." value="<?php echo $data["address"];?>">
  </div>
  </div>

  <div class="row">
  <div class="form-group col">
    <label for="exampleInputPassword1">Main page heading</label>
    <input name="page_heading" type="text" class="form-control" placeholder="Enter page heading..." value="<?php echo $data["page_heading"];?>">
  </div>
  </div>
  
  <button type="submit" class="btn btn-info">Update</button>
</form>

</div>

<script>
    document.getElementById("p_title").innerText = "Company Information";
</script>