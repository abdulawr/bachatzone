<?php
include("include/header.php");
?>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

<?php include("include/nav.php"); ?>

<?php include("include/slider.php"); 
   $ID = DBHelper::escape($_GET["ID"]);
?>

<?php 
  
  $data = DBHelper::get("SELECT product.*,supplier.name as sup,company.name as company,product_category.name 
  'cat' FROM `product` INNER JOIN product_category on product_category.id = categoryID
  INNER JOIN supplier on supplier.id = supplierID inner join company on company.id = cmpID  where product.id = '{$ID}'")->fetch_assoc();

    $other_image = json_decode($data['other_images'],true);

    $order_data = DBHelper::get("SELECT * FROM `buy_now_product` where id = '{$_GET["ord_listID"]}'")->fetch_assoc();

    $customer = DBHelper::get("SELECT * FROM `tbl_customer` where id = '{$order_data["cusID"]}'")->fetch_assoc();
  
  ?>

  <div class="content-wrapper">
  
  <section class="content-header" style="padding: 8px 0px;"></section>

  <!-- Main content -->
  <section class="content">

  
    <div class="card">
     
      <div class="card-body">
             
      <div class="card card-solid">
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-sm-6">
            <h3 class="d-inline-block d-sm-none">LOWA Men’s Renegade GTX Mid Hiking Boots Review</h3>
            <div class="col-12">
              <img src="../../images/product/<?php echo $data['main_img'];?>" class="product-image" alt="Product Image">
            </div>
            <div class="col-12 product-image-thumbs">
              <div class="product-image-thumb active"><img src="../../images/product/<?php echo $data['main_img'];?>" alt="Product Image"></div>
              <?php
             
               foreach ($other_image as $url) {
                   ?>
                     <div class="product-image-thumb" ><img src="../../images/product/<?php echo $url; ?>" alt="Product Image"></div>
                   <?php
               }
              ?>
          
            </div>
          </div>
          <div class="col-12 col-sm-6">
            <h3 class="my-3"><?php echo $data["title"];?></h3>
           
            <table>

              <tr style="line-height: 25px;;">
                   <th style="width:150px;">Product ID</th>
                   <td><?php echo $data["id"];?></td>
               </tr>

                <tr style="line-height: 25px;;">
                    <th style="width:150px;">Category</th>
                    <td><?php echo ucwords($data["cat"]);?></td>
                </tr>
                <tr style="line-height: 25px;;">
                    <th style="width:150px;">Seller</th>
                    <td><?php echo $data["sup"];?></td>
                </tr>
                <tr style="line-height: 25px;;">
                    <th style="width:150px;">Company</th>
                    <td><?php echo ucwords($data["company"]);?></td>
                </tr>
              
                <tr style="line-height: 25px;;">
                    <th style="width:150px;">Orders no.</th>
                    <td><?php echo $order_data["id"];?></td>
                </tr>
              

             <hr>

                <tr style="line-height: 25px;;">
                    <th style="width:150px;">Order Data</th>
                    <td><?php echo date('d-m-Y', strtotime($order_data["date"]));?></td>
                </tr>

                <?php if(!empty($order_data["color"])) { ?>
                <tr style="line-height: 25px;;">
                    <th class="text-primary" style="width:150px;">Color</th>
                    <td class="text-primary"><?php echo ucwords($order_data["color"]);?></td>
                </tr>
                <?php } ?>

                <?php if(!empty($order_data["size"])) { ?>
                <tr style="line-height: 25px;;">
                    <th class="text-primary" style="width:150px;">Size</th>
                    <td class="text-primary"><?php echo $order_data["size"];?></td>
                </tr>
                <?php } ?>

                <tr style="line-height: 25px;;">
                    <th style="width:150px;">Order quantity</th>
                    <td><?php echo $order_data["qty"];?></td>
                </tr>

                <tr style="line-height: 25px;;">
                    <th style="width:150px;">Your amount</th>
                    <td>Rs. <?php echo $order_data["saller_payable"];?></td>
                </tr>

                <tr style="line-height: 25px;;">
                    <th style="width:150px;">Payable to company</th>
                    <td>Rs. <?php echo $order_data["company_earning"];?></td>
                </tr>

                <tr style="line-height: 25px;;">
                    <th style="width:150px;">Discount</th>
                    <td>Rs. <?php echo $order_data["discount"];?></td>
                </tr>

                <tr style="line-height: 25px;;">
                    <th class="text-primary" style="width:150px;">Payable amount</th>
                    <td><b class="text-primary">Rs. <?php echo $order_data["customer_payable"];?></b></td>
                </tr>

            </table>

            <hr>
            
         
            <h3 class="my-3"><?php echo "Customer Info";?></h3>
           
           <table>
              
               <tr style="line-height: 25px;;">
                   <th style="width:150px;">Name</th>
                   <td><?php echo $customer["name"];?></td>
               </tr>
               <tr style="line-height: 25px;;">
                   <th style="width:150px;">Mobile</th>
                   <td><?php echo $customer["mobile"];?></td>
               </tr>
              
              
             <hr>
           </table>

           <?php if ($order_data["status"] == 0) { ?>
           <a href="../seller_action/buy_now?orderlsID=<?php echo $order_data["id"];?>" class="btn btn-success mt-3" href="">Approve it</a>
           <?php } else { ?>
            <div class="bg-warning">Order completed</div>
            <?php } ?>

          </div>
        </div>
      
      </div>
      <!-- /.card-body -->
    </div>

      </div>
          
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>


<?php include("include/footer.php"); ?>

<script>
    document.getElementById("p_title").innerText = "Product Details";
</script>


