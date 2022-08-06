<?php
include("include/header.php");
?>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

<?php include("include/nav.php"); ?>

<?php include("include/slider.php"); 

   $ID = DBHelper::escape($_GET["ID"]);
   $data = DBHelper::get("SELECT product.*,supplier.name as sup,company.name as company,product_category.name 
   'cat' FROM `product` left JOIN product_category on product_category.id = categoryID
   left JOIN supplier on supplier.id = supplierID left join company on company.id = cmpID  where product.id = '{$ID}'")->fetch_assoc();

     $other_image = json_decode($data['other_images'],true);
?>

  <!-- Content Wrapper. Contains page content -->
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
               
                 foreach($other_image as $url){
                     ?>
                       <div class="product-image-thumb" ><img src="../../images/product/<?php echo $url;?>" alt="Product Image"></div>
                     <?php
                 }
                ?>
            
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3"><?php echo $data["title"];?></h3>
             
              <table>
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
                      <th style="width:150px;">Quantity</th>
                      <td><?php echo $data["quantity"];?></td>
                  </tr>
                  <tr style="line-height: 25px;;">
                      <th style="width:150px;">Status</th>
                      <td>
                      <?php 
                                    if($data["status"] == 1){
                                      echo '<span class="badge badge-success">Approved</span>';
                                    }
                                    elseif($data["status"] == 99){
                                        echo '<span class="badge badge-info">Pending</span>';
                                    }
                                    ?>
                      </td>
                  </tr>
                  <tr style="line-height: 25px;;">
                      <th style="width:150px;">Added By</th>
                      <td>
                      <?php 
                                    if($data["addedBy"] == 0){
                                      echo '<span class="badge badge-secondary">Admin</span>';
                                    }
                                    elseif($data["addedBy"] == 1){
                                        echo '<span class="badge badge-warning">Seller</span>';
                                    }
                                    ?>
                      </td>
                  </tr>
                  <tr style="line-height: 25px;;">
                      <th style="width:150px;">Date</th>
                      <td><?php echo date('d-m-Y',strtotime($data["date"]));?></td>
                  </tr>
                  <tr style="line-height: 25px;;">
                      <th style="width:150px;">Views</th>
                      <td><?php echo $data["views"];?></td>
                  </tr>
                  <tr style="line-height: 25px;;">
                      <th style="width:150px;">Orders</th>
                      <td><?php echo $data["order_no"];?></td>
                  </tr>
                  <tr style="line-height: 25px;;">
                      <th style="width:150px;">Wallet $(status)</th>
                      <td><?php echo ($data["wallet_amount_status"]) ? "Allowed":"Not allowed";?></td>
                  </tr>
                  <tr style="line-height: 25px;;">
                      <th style="width:150px;">Supporting Bonus Adjustable (%)</th>
                      <td><?php echo $data["allow_wallet_per"];?></td>
                  </tr>
              </table>

              <hr>
              
              <div class="bg-gray py-2 px-3 mt-4">
                <h2 class="mb-0">
                  <?php echo 'PKR '.$data["price"]; ?>
                </h2>
               
              </div>


            </div>
          </div>
          <div class="row mt-4">
            <nav class="w-100">
              <div class="nav nav-tabs" id="product-tab" role="tablist">
                <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
 
                <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Rating</a>
              </div>
            </nav>
            <div class="tab-content p-3" id="nav-tabContent" style="width: 100%;">
              <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> 
                  <?php echo $data["content"]; ?>
              </div>
             
              <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-comments-tab">
              <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Rating (5)</th>
                        <th scope="col">Review</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $review = DBHelper::get("SELECT product_review.*,name,image,email FROM `product_review` INNER JOIN tbl_customer on tbl_customer.id  = cusID WHERE prdID = {$ID}");
                        if($review->num_rows > 0){
                            while($row = $review->fetch_assoc()){
                                ?>
                                  <tr>
                                        <td><?php echo $row["name"]; ?></td>
                                        <td><?php echo $row["email"]; ?></td>
                                        <td><?php echo $row["rating"]; ?></td>
                                        <td><?php echo $row["review"]; ?></td>
                                  </tr>
                                <?php
                            }
                        }
                       ?>
                    
                    </tbody>
                    </table>
              </div>
           
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
  <!-- /.content-wrapper -->

<?php include("include/footer.php"); ?>

<script>
    document.getElementById("p_title").innerText = "Product Details";
</script>

