
    <!-- Main content -->
    <section class="content mt-2">

      <!-- Default box -->
      <div class="card" style="border-left:4px solid #46775c;">
       
        <div class="card-body">

         <?php
          $ordID = $_GET["id"];
         
          $order = DBHelper::get("SELECT * FROM `orders` WHERE id = '{$ordID}'")->fetch_assoc();
          $customer = DBHelper::get("SELECT * FROM `tbl_customer` WHERE id = '{$order["cusID"]}'")->fetch_assoc();
          $products = DBHelper::get("SELECT orderlist.*,product.title,product.main_img FROM `orderlist` INNER JOIN product on product.id = `prdID` WHERE `orderID` = '{$ordID}'");    
        
          if($order["orderStatus"] == '1'){
            DBHelper::set("UPDATE orders set `orderStatus` = 2 WHERE id = '{$ordID}'");
          }   
          
          $check = DBHelper::get("SELECT COUNT(id) as tot FROM `orderlist` WHERE orderID = '{$ordID}' and status in (4,2)");
          $check22 = DBHelper::get("SELECT COUNT(id) as tot FROM `orderlist` WHERE orderID = '{$ordID}' and status = 2");
          
          $adm_status = 0;
          if($check->num_rows > 0){
              if($order["prod_count"] == $check->fetch_assoc()["tot"]){
                  // enable complete button
                  $adm_status = 1;
              }
          }

          if($check22->num_rows > 0){
            if($order["prod_count"] == $check22->fetch_assoc()["tot"]){
                // enable return order
                $adm_status = 2;
            }
        }
         

    // $add_per = DBHelper::get("SELECT * FROM `tbl_address` WHERE `holderID` = '{$order["cusID"]}' and status = '2' and type = '1'")->fetch_assoc();

    //  $add_per = 
    //  '<b>Hourse:  </b>'.$add_per["house_no"]."<br>"
    //  ."<b>Street no:  </b>".$add_per["street_no"]."<br>"
    //  ."<b>CIty:  </b>".$add_per["city"]."<br>"
    //  ."<b>Tehsil:  </b> ".$add_per["tehsil"]."<br>"
    //  ."<b>District:  </b> ".$add_per["district"]."<br>"
    //  ."<b>Postal code:  </b>".$add_per["postal_code"];

    $add_per = $order["del_address"];

     if(isset($_GET["msg"]) && $_GET["msg"] == "succ"){
         echo msg("Action perform successfully");
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
                    <th style="width: 120px;">Sub-Total:</th>
                    <td>PKR <?php echo $order["total"];?></td>
                </tr>


                <tr style="line-height: 25px;">
                    <th style="width: 120px;">Discount:</th>
                    <td>PKR <?php echo $order["disount"];?></td>
                </tr>

                <tr style="line-height: 25px;">
                    <th class="text-primary" style="width: 150px;">Company earned:</th>
                    <td class="text-primary">PKR <?php echo $order["company_earning"];?></td>
                </tr>

                <tr style="line-height: 25px;">
                    <th style="width: 120px;">Shipment:</th>
                    <td>PKR <?php echo $order["shipment_charges"];?></td>
                </tr>

                <tr style="line-height: 25px;">
                    <th style="width: 120px;">Total:</th>
                    <td>PKR <?php echo $order["total_with_disount"];?></td>
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
                     if ($order["orderStatus"] == '5'){
                        echo '<span class="badge badge-danger">Order canceled</span>';
                    }
                    else{
                        if ($order["paymentStatus"] == '99') {
                            echo '<span class="badge badge-primary">Pending</span>';
                        } elseif ($order["paymentStatus"] == '1') {
                            echo '<span class="badge badge-success">Paid</span>';
                        } 
                    }
                 ?>
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
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
      <th>Company earn</th>
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
                    <img width="60" height="80" class="img-thumbnail rounded" src="../images/product/<?php echo $row['main_img'];?>" alt="">
                </td>
                <td><?php echo $row['title'];?></td>
                <td><?php echo $row['color'];?></td>
                <td><?php echo $row['size'];?></td>
                <td><b>Rs. <?php echo $row['price'];?></b></td>
                <td><?php echo $row['qty'];?></td>
                <td>Rs. <?php echo $row['company_earning'];?></td>
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
                <a href="?p=product_details&ID=<?php echo $row["prdID"];?>" title="View Product"><i class="fas fa-eye text-info"></i></a>
                <a href="?p=supplier_profile&id=<?php echo $row["suppID"];?>" title="Seller Profile"><i class="fas fa-user text-warning"></i></a>
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
      <?php 
          if(!empty($customer["image"])){
            $path = "../../images/customer/".$customer["image"];
        }
         else{
            $path = '../../images/choose.jpg';
          }
         ?>

          <img width="100" height="100" src="<?php echo $path; ?>" alt="">
          
          <table>
              <tr style="line-height: 25px;">
                  <th style="width: 120px;">Name</th>
                  <td><?php echo ucwords($customer["name"]); ?>  <a href="?p=customer_profile&id=<?php echo $customer["id"];?>" title="Customer Profile"><i class="fas fa-user text-warning"></i></a></td>
              </tr>

              <tr style="line-height: 25px;">
                  <th style="width: 120px; line-height: 25px;">Email</th>
                  <td><?php echo $customer["email"]; ?></td>
              </tr>

              <br><br>


              <tr style="line-height: 25px;">
                  <th style="width: 120px; vertical-align:top">Address</th>
                  <td><?php echo  $add_per; ?></td>
              </tr>


          </table>

          <br>

          <?php if($adm_status == 1) { ?>
         <a href="action/orderAction.php?id=<?php echo $order["id"]; ?>&type=completed" class="btn btn-warning btn-sm">Order completed</a>
         <?php } elseif($adm_status == 2 && $order["orderStatus"] != '5') { ?>
         <a href="action/orderAction.php?id=<?php echo $order["id"]; ?>&type=orderReturn" class="btn btn-danger btn-sm">Order return</a>
         <?php } elseif($order["orderStatus"] == '1') { ?>
          <p class="bg-info p-2">Order placed by customer</p>
          <?php } elseif($order["orderStatus"] == '4') { ?>
            <p class="bg-warning p-2">Order completed</p>
            <?php } elseif($order["orderStatus"] == '5') { ?>
                <p class="bg-danger p-2">Order canceled</p>
         <?php } ?>

     </div>


        </div>
       
      </div>
      <!-- /.card -->

    </section>


<script>
    document.getElementById("p_title").innerText = "Order detail";
</script>


