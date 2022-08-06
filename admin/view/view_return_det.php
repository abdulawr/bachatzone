
    <!-- Main content -->
    <section class="content mt-2">

      <!-- Default box -->
      <div class="card" style="border-left:4px solid #46775c;">
       
        <div class="card-body">

         <?php
         
         $comp = DBHelper::get("SELECT * FROM `order_return` WHERE `id` = '{$_GET["cmpID"]}'")->fetch_assoc();
       
         if($comp["status"] == 0){
          
            DBHelper::set("UPDATE order_return set `status` = 1 WHERE id = '{$_GET["cmpID"]}'");
         }
        
         $ordID = $comp["orderID"]; // $_GET["id"];
         
          $order = DBHelper::get("SELECT * FROM `orders` WHERE id = '{$ordID}'")->fetch_assoc();
          $customer = DBHelper::get("SELECT * FROM `tbl_customer` WHERE id = '{$order["cusID"]}'")->fetch_assoc();
          $products = DBHelper::get("SELECT orderlist.*,product.title,product.main_img FROM `orderlist` INNER JOIN product on product.id = `prdID` WHERE `orderID` = '{$ordID}'");    
        
          if($order["orderStatus"] == '1'){
            DBHelper::set("UPDATE orders set `orderStatus` = 2 WHERE id = '{$ordID}'");
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

     if(isset($_GET["msg"]) && $_GET["msg"] == "success"){
         echo msg("Action perform successfully");
     }
     elseif(isset($_GET["msg"]) && $_GET["msg"] == "fail"){
        echo msg("Something went wrong try again",2);
    }


     $comp = DBHelper::get("SELECT * FROM `order_return` WHERE `id` = '{$_GET["cmpID"]}'")->fetch_assoc();
        
        ?>


<div class="rounded" style="width:100%; border:1px solid #7b241c ; padding:20px">

<h4 class="mb-2">Return request</h4>
 <table >

   <tr>
        <th style="width: 150px;">Complain no:</th>
        <td><?php echo $comp["id"];?></td>
    </tr>

    <tr>
        <th style="width: 150px;">Order no:</th>
        <td><?php echo $comp["orderID"];?></td>
    </tr>

    <tr>
        <th style="width: 150px;">Date:</th>
        <td><?php echo date('d/m/Y', strtotime($comp["date"]));?></td>
    </tr>

    <tr>
        <th style="width: 150px;">Description (customer):</th>
        <td><?php echo $comp["comment"];?></td>
    </tr>


    <tr>
        <th style="width: 150px;">Status:</th>
        <td><?php
         if($comp["status"] == '0'){
            echo '<span class="badge badge-info">Pending</span>';
         }
         elseif($comp["status"] == '1'){
            echo '<span class="badge badge-warning">Viewed by admin</span>';
         }
         elseif($comp["status"] == '2'){
            echo '<span class="badge badge-success">Approved</span>';
         }
         ?></td>
    </tr>

    <?php if($comp["status"] != 2 ) { ?>
    <tr style="line-height: 15;">
        <th style="width: 150px;">Description (admin):</th>
        <td style="width: 70%;">
            <form action="action/approvd_complain" method="post">
            <div class="form-group">
                <textarea name="desc" style="width: 100%;" class="form-control" id="exampleFormControlTextarea1" rows="6"></textarea>
            </div>

            <input type="hidden" name="compID" value="<?php echo $_GET["cmpID"]; ?>">

            <button class="btn btn-success">Approve</button>
            </form>
        </td>
    </tr>
    <?php } else { ?>
        <tr>
        <th style="width: 150px;">Description (admin):</th>
        <td><?php echo $comp["company_response"];?></td>
        </tr>
        <?php } ?>

   
</table>
</div>

<br>



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
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
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
                <td><b>PKR <?php echo $row['price'];?></b></td>
                <td><?php echo $row['qty'];?></td>
                <td>
                <?php
                                    if ($row["status"] == '0') {
                                        echo '<span class="badge badge-info">Pending</span>';
                                    } elseif ($row["status"] == '1') {
                                        echo '<span class="badge badge-warning">Delivered</span>';
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

    

     </div>


        </div>
       
      </div>
      <!-- /.card -->

    </section>


<script>
    document.getElementById("p_title").innerText = "Return order detail";
</script>


