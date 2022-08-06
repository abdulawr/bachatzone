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
  
      <div class="card">
       
        <div class="card-body">
 <form  method="post" enctype="multipart/form-data" action="../seller_action/add_product">
  
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

          case 'exist':
           msg("Duplicat product are not allowed",2);
           break;
      }
  }

  ?>

<div class="row">
<div class="form-group col">
   <label for="exampleInputEmail1">Title  <sup style="color:red;">*</sup></label>
   <input name="title" type="text" required class="form-control" >
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

 <input name="supplierID" type="hidden" value="<?php echo $_SESSION["data"]["id"];?>">


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
      <textarea required name="content" id="editor" > </textarea>
 </div>
 </div>


  <div class="form-group">
    <label for="exampleInputEmail1">Color eg(blue,green,red)</label>
    <input name="color" type="text" class="form-control" name="color">
    <small class="form-text text-muted">Only comma seperated values are accepted and color name should not contain comma (,)</small>
  </div>


  <div class="form-group">
    <label for="exampleInputEmail1">Size eg(42,43,41)</label>
    <input type="text" class="form-control" name="size">
    <small class="form-text text-muted">Only comma seperated values are accepted and size name should not contain comma (,)</small>
  </div>


 <div class="row">
 <div class="form-group col">
   <label for="exampleInputEmail1">Price  <sup style="color:red;">*</sup></label>
   <input name="price" type="number" required  class="form-control" >
 </div>

 <div class="form-group col">
   <label for="exampleInputEmail1">Quantity  <sup style="color:red;">*</sup></label>
   <input required name="quantity" type="number"  class="form-control">
 </div>

 </div>

 <div class="row">
     
 <div class="form-group col">
   <label for="exampleInputEmail1">Supporting Bonus Adjustable (%)</label>
   <input name="allow_wallet_percent" type="number"  class="form-control" >
 </div>
 </div>
 
 <div class="row">
 <div class="form-check col">
 <input name="wallet_amount_used" class="form-check-input" type="checkbox" value="1" id="defaultCheck1">
 <label class="form-check-label" for="defaultCheck1">
   Allow supporting bonus adjustable on this product?
 </label>
 </div>

 <div class="col">
 <input  value="1" name="wallet_amt_type" id="ds1" type="radio">
 <label for="ds1">
   Percentage
 </label>
 <input  style="margin-left: 10px;" value="2" name="wallet_amt_type" id="ds2" type="radio">
 <label for="ds2">
   Amount
 </label>
 </div>
 
 
 </div>
 <br>

 <div class="row">

 
 <div class="form-group">
   <label for="exampleFormControlFile1">Main image  <sup style="color:red;">* (jpg, png, jpeg, gif)</sup></label>
   <input name="main_img" type="file" class="form-control-file" id="exampleFormControlFile1">
 </div>


 <div class="form-group">
   <label for="exampleFormControlFile1">Other image  <sup style="color:red;">(jpg, png, jpeg, gif)</sup></label>
   <input  name="other_img[]" type="file" class="form-control-file" id="exampleFormControlFile1" multiple>
 </div>

 </div>


 <button type="submit" class="btn btn-outline-info">Submit</button>
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
    document.getElementById("p_title").innerText = "Add product";
</script>


<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then(function (editor) {
        
         })
        .catch( error => {
            console.error( error );
        } );

</script>


