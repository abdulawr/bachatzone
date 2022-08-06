<style>
    .ck {
        height: 250px;
    }

</style>

<?php 
if(isset($_REQUEST["ID"])){
$ID = DBHelper::escape($_GET["ID"]);
$data = DBHelper::get("SELECT * FROM `product` WHERE id = '{$ID}'")->fetch_assoc();
$update = true;
$title = "Update ";
$content = $data["content"];
}
else{
$update = false;
$title = "Add ";
$content = '';
}
?>
<div class="p-3">
<form class="bg-white p-3 rounded shadow" style="border-left: 4px solid #008693;" method="post" enctype="multipart/form-data" action="action/add_product">
  
   <?php
   if(isset($_GET["msg"])){
       switch($_GET["msg"]){
           case 'updated':
            msg("Profile updated successfully!",1);
            break;

           case 'success':
            msg("Product added successfully",1);
            break;

           case 'fail':
            msg("Something went wrong try again",2);
            break;
       }
   }

   if($update){
     echo '<input type="hidden" name="ID" value="'.$data['id'].'" >';
     echo '<input type="hidden" name="update_row" value="update_row" >';
     echo '<input type="hidden" name="imag_link" value="'.$data["main_img"].'" >';
   }
   ?>

<div class="row">
<div class="form-group col">
    <label for="exampleInputEmail1">Title  <sup style="color:red;">*</sup></label>
    <input name="title" type="text" required class="form-control" value="<?php if($update) {echo $data["title"];}?>">
  </div>
</div>

  <div class="row">


  <div class="form-group col">
    <label for="cmpID">Company <sup style="color:red;">*</sup></label>
    <select class="form-control" name="cmpID" id="cmpID">
        <?php 
        $supplier = DBHelper::get("SELECT id,name FROM `company` order by name asc");
        if($supplier->num_rows > 0){
            while($row = $supplier->fetch_assoc()){
              if($update && $row["id"] == $data["cmpID"]){
                $select = "selected = 'selected'";
              }
              else{
                $select = "";
              }
              echo "<option ". $select." value='".$row["id"]."'>".ucwords($row["name"])."</option>";
            }
        }
        ?>

    </select>
  </div>
  

  <div class="form-group col">
    <label for="supplierID">Seller <sup style="color:red;">*</sup></label>
    <select class="form-control" name="supplierID" id="supplierID">
        <?php 
        $supplier = DBHelper::get("SELECT id,name FROM `supplier` order by name asc");
        if($supplier->num_rows > 0){
            while($row = $supplier->fetch_assoc()){
              if($update && $row["id"] == $data["supplierID"]){
                $select = "selected = 'selected'";
              }
              else{
                $select = "";
              }
              echo "<option ". $select." value='".$row["id"]."'>".ucwords($row["name"])."</option>";
            }
        }
        ?>

    </select>
  </div>

  <div class="form-group col">
    <label for="categoryID">Category  <sup style="color:red;">*</sup></label>
    <select class="form-control" name="prdCategory" id="categoryID">
        <?php 
        $supplier = DBHelper::get("SELECT id,name FROM `product_category` order by name asc");
        if($supplier->num_rows > 0){
            while($row = $supplier->fetch_assoc()){
              if($update && $row["id"] == $data["categoryID"]){
                $select = "selected='selected'";
              }
              else{
                $select = "";
              }
              echo "<option ".$select." value='".$row["id"]."'>".ucwords($row["name"])."</option>";
            }
        }
        ?>

    </select>
  </div>

  </div>

  <div class="row">
  <div class="form-group col">
    <label for="editor">Description <sup style="color:red;">*</sup></label>
       <textarea required name="content" id="editor" > value="<?php if($update) {echo $data["content"];}?>"</textarea>
  </div>
  </div>


  <div class="form-group">
    <label for="exampleInputEmail1">Color eg(blue,green,red)</label>
    <input name="color" type="text" class="form-control" name="color" value="<?php if($update) {echo $data["color"];}?>">
    <small class="form-text text-muted">Only comma seperated values are accepted and color name should not contain comma (,)</small>
  </div>


  <div class="form-group">
    <label for="exampleInputEmail1">Size eg(42,43,41)</label>
    <input type="text" class="form-control" name="size" value="<?php if($update) {echo $data["size"];}?>">
    <small class="form-text text-muted">Only comma seperated values are accepted and size name should not contain comma (,)</small>
  </div>


  <div class="row">
  <div class="form-group col">
    <label for="exampleInputEmail1">Price  <sup style="color:red;">*</sup></label>
    <input name="price" type="number" required  class="form-control" value="<?php if($update) {echo $data["price"];}?>">
  </div>

  <div class="form-group col">
    <label for="exampleInputEmail1">Quantity  <sup style="color:red;">*</sup></label>
    <input required name="quantity" type="number"  class="form-control" value="<?php if($update) {echo $data["quantity"];}?>">
  </div>

  </div>

  <div class="row">
      
  <div class="form-group col">
    <label for="exampleInputEmail1">Supporting Bonus Adjustable (%)</label>
    <input name="allow_wallet_percent" type="number"  class="form-control" value="<?php if($update) {echo $data["allow_wallet_per"];}?>">
  </div>
  </div>
  
  <div class="row">
  <div class="form-check col">
  <input <?php if($update && $data["wallet_amount_status"] == 1) echo 'checked';?> name="wallet_amount_used" class="form-check-input" type="checkbox" value="1" id="defaultCheck1">
  <label class="form-check-label" for="defaultCheck1">
    Allow supporting bonus adjustable on this product?
  </label>
  </div>

  <div class="col">
  <input <?php if($update && $data["wallet_amount_type"] == 1) echo 'checked';?> value="1" name="wallet_amt_type" id="ds1" type="radio">
  <label for="ds1">
    Percentage
  </label>
  <input <?php if($update && $data["wallet_amount_type"] == 2) echo 'checked';?> style="margin-left: 10px;" value="2" name="wallet_amt_type" id="ds2" type="radio">
  <label for="ds2">
    Amount
  </label>
  </div>
  
  
  </div>
  <br>

  <div class="row">

  
  <div class="form-group">
    <label for="exampleFormControlFile1">Main image  <sup style="color:red;">* (jpg, png, jpeg, gif)</sup></label>
    <input <?php if(!$update) echo "required"; ?> name="main_img" type="file" class="form-control-file" id="exampleFormControlFile1">
  </div>
 

  <?php if(!$update) { ?>
  <div class="form-group">
    <label for="exampleFormControlFile1">Other image  <sup style="color:red;">(jpg, png, jpeg, gif)</sup></label>
    <input  name="other_img[]" type="file" class="form-control-file" id="exampleFormControlFile1" multiple>
  </div>
  <?php } ?>
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

<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>

<script>
    document.getElementById("p_title").innerText = "<?php echo $title; ?>Product";

    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then(function (editor) {
        editor.setData("<?php echo $content;?>");
         })
        .catch( error => {
            console.error( error );
        } );

</script>

