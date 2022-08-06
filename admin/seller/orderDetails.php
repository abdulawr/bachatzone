<?php
include("include/header.php");
?>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

<?php include("include/nav.php"); ?>

<?php include("include/slider.php");
$ID = $_SESSION["data"]["id"];
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
    <section class="content-header" style="padding: 8px 0px;"></section>

   
    <!-- Main content -->
    <section class="content mt-2">

      <!-- Default box -->
      <div class="card" style="border-left:4px solid #46775c;">
       
        <div class="card-body">

         <?php
          $ordID = $_GET["id"];

         
          $order = DBHelper::get("SELECT * FROM `orders` WHERE id = '{$ordID}'")->fetch_assoc();
          $customer = DBHelper::get("SELECT * FROM `tbl_customer` WHERE id = '{$order["cusID"]}'")->fetch_assoc();
          $products = DBHelper::get("SELECT orderlist.*,product.title,product.main_img FROM `orderlist` INNER JOIN product on product.id = `prdID` WHERE `orderID` = '{$ordID}' and suppID = '{$ID}'");    
        
          if($order["orderStatus"] == '1'){
            DBHelper::set("UPDATE orders set `orderStatus` = 2 WHERE id = '{$ordID}'");
          }      

    $add_per = $order["del_address"];

     if(isset($_GET["msg"]) && $_GET["msg"] == "success"){
          msg("Action perform successfully");
     }
     elseif(isset($_GET["msg"]) && $_GET["msg"] == "error"){
        msg("Something went wrong try again",2);
     }
        
        ?>



             <table>
                <tr style="line-height: 25px;">
                    <th style="width: 120px;">Order no:</th>
                    <td><?php echo $order["id"];?></td>
                </tr>

                <tr style="line-height: 25px;">
                    <th style="width: 120px;">Date:</th>
                    <td><?php echo date('d/m/Y',strtotime($order["date"]));?></td>
                </tr>


                <tr style="line-height: 25px;">
                    <th style="width: 120px;">Status:</th>
                    <td>
                    <?php
                                    if ($order["orderStatus"] == '1') {
                                        echo '<span class="badge badge-primary">Placed by customer</span>';
                                    } elseif ($order["orderStatus"] == '2') {
                                        echo '<span class="badge badge-secondary">Under process</span>';
                                    } elseif ($order["orderStatus"] == '3') {
                                        echo '<span class="badge badge-info">On way to del
                                        ivery</span>';
                                    } elseif ($order["orderStatus"] == '4') {
                                        echo '<span class="badge badge-success">Received by customer</span>';
                                    } elseif ($order["orderStatus"] == '5') {
                                        echo '<span class="badge badge-warning">Completed</span>';
                                    } ?>
                    </td>
                </tr>


                <tr style="line-height: 25px;">
                    <th style="width: 120px;">Payment Type:</th>
                    <td>
                    <?php
                                    if ($order["payment_Type"] == '1') {
                                        echo '<span class="badge badge-success">JazzCash</span>';
                                    } elseif ($order["payment_Type"] == '2') {
                                        echo '<span class="badge badge-info">Cash on delivery</span>';
                                    }  ?>
                    </td>
                </tr>


                <tr style="line-height: 25px;">
                    <th style="width: 120px;">Payment status:</th>
                    <td>
                    <?php
                                    if ($order["paymentStatus"] == '99') {
                                        echo '<span class="badge badge-primary">Pending</span>';
                                    } elseif ($order["paymentStatus"] == '1') {
                                        echo '<span class="badge badge-success">Paid</span>';
                                    }  ?>
                    </td>
                </tr>

               
            </table>

            <hr>

            <h3>Order Products</h3>
            <table class="table" style="margin-top: 20px;">
  <thead class="thead-light">
    <tr>
      <th scope="col">Poduct no</th>
      <th scope="col">Image</th>
      <th scope="col">Title</th>
      <th scope="col">Color</th>
      <th scope="col">Size</th>
      <th scope="col">Amount</th>
      <th scope="col">Quantity</th>
      <th>Discount</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  <?php
  if($products->num_rows > 0){
      while($row = $products->fetch_assoc()){
          ?>
           <tr>
                <th scope="row"><?php echo $row['id'];?></th>
                <td>
                    <img width="60" height="80" class="img-thumbnail rounded" src="../../images/product/<?php echo $row['main_img'];?>" alt="">
                </td>
                <td><?php echo $row['title'];?></td>
                <td><?php echo ucwords($row['color']);?></td>
                <td><?php echo $row['size'];?></td>
                <td><b>Rs. <?php echo $row['supplier_amont'];?></b></td>
                <td><?php echo $row['qty'];?></td>
                <td>Rs. <?php echo $row['customer_discount'];?></td>
                <td>
                <?php if ($row["status"] == '0') {
                                        echo '<span class="badge badge-primary">Pending</span>';
                                    } elseif ($row["status"] == '1') {
                                        echo '<span class="badge badge-secondary">Delivered</span>';
                                    } elseif ($row["status"] == '3') {
                                        echo '<span class="badge badge-info">Received by customer</span>';
                                    } elseif ($row["status"] == '4') {
                                        echo '<span class="badge badge-success">Waiting admin approval</span>';
                                    } elseif ($row["status"] == '5') {
                                        echo '<span class="badge badge-warning">Completed</span>';
                                    } 
                                    elseif ($row["status"] == '2') {
                                        echo '<span class="badge badge-danger">Return by customer</span>';
                                    } ?>
                </td>
                <td>
                <a href="product_details?ID=<?php echo $row["prdID"];?>" title="View Product"><i class="fas fa-eye text-info"></i></a>
                </td>
                </tr>
         </tr>
          <?php
      }
  }
  ?>
    
  </tbody>
</table>

<hr>

     <div>
     <h3>Customer Info</h3>
          
          <table>
              <tr style="line-height: 25px;">
                  <th style="width: 120px;">Name</th>
                  <td><?php echo ucwords($customer["name"]); ?>  </td>
              </tr>

              <tr style="line-height: 25px;">
                  <th style="width: 120px; line-height: 25px;">Mobile</th>
                  <td><?php echo $customer["mobile"]; ?></td>
              </tr>

              <br><br>


              <tr style="line-height: 25px;">
                  <th style="width: 120px; vertical-align:top">Address</th>
                  <td><?php echo  $add_per; ?></td>
              </tr>


          </table>

          <br>

          <?php if($order["orderStatus"] == '5') { ?>
            <p class="bg-warning p-2"><b>Order completed</b></p>
          <?php } elseif($_GET["status"] == '0') { ?>
              <a href="../seller_action/changeOrderStatus.php?id=<?php echo $order["id"]; ?>&status=1" class="btn btn-info btn-sm">Deliver to customer</a>
         <?php } elseif($_GET["status"] == '1') { ?>
             <a href="../seller_action/changeOrderStatus.php?id=<?php echo $order["id"]; ?>&status=3" class="btn btn-success btn-sm">Received by customer</a>
             <a href="../seller_action/changeOrderStatus.php?id=<?php echo $order["id"]; ?>&status=2" class="btn btn-danger btn-sm">Order return</a> 
         <?php } elseif($_GET["status"] == '3') { ?>
            <a href="../seller_action/changeOrderStatus.php?id=<?php echo $order["id"]; ?>&status=4" class="btn btn-warning btn-sm">Order completed</a>
            <a href="../seller_action/changeOrderStatus.php?id=<?php echo $order["id"]; ?>&status=2" class="btn btn-danger btn-sm">Order return</a> 
            <?php } elseif($_GET["status"] == '3') { ?>
                <p class="bg-success p-2"><b>Waiting for admin approval</b></p>
                <?php } elseif($_GET["status"] == '2') { ?>
                <p class="bg-danger p-2"><b>Return by customer</b></p>
            <?php } elseif($_GET["status"] == '5'){ ?>
            <p class="bg-warning p-2"><b>Order completed</b></p>
         <?php } ?>

         
          


      

     </div>


        </div>
       
      </div>
      <!-- /.card -->

    </section>


<script>
    document.getElementById("p_title").innerText = "Order detail";
</script>



    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include("include/footer.php"); ?>

<script>
    document.getElementById("p_title").innerText = "Order details";
</script>

