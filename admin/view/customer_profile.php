<?php 
$ID = DBHelper::escape($_GET["id"]);
$profile = DBHelper::get("SELECT * FROM `tbl_customer` WHERE id = '{$ID}'")->fetch_assoc();

$product = DBHelper::get("SELECT product.*,supplier.name as sup,company.name as company,product_category.name 
'cat' FROM `product` INNER JOIN product_category on product_category.id = categoryID
 INNER JOIN supplier on supplier.id = supplierID inner join company on company.id = cmpID inner join fav_product on fav_product.productID = product.id where fav_product.cusID = '{$ID}'");

if(!empty($profile["image"])){
   $path = "../images/customer/".$profile["image"];
}
else{
    $path = "../images/no-img.jpg";
}

if($profile["gender"] == "1"){
$gender = "Male";
}
elseif($profile["gender"] == "2"){
    $gender = "Female";
}
else{
    $gender = "Other";
}

$total_balance = DBHelper::get("SELECT * FROM `tbl_customer_credit_total` WHERE cusID = '{$ID}' and type = 1")->fetch_assoc()["amount"];
$refter = DBHelper::get("SELECT count(id) as total FROM `tbl_customer_credit_trans` WHERE cusID = '{$ID}' and type = 1 and tran_type = 1")->fetch_assoc()["total"];

if($profile["jazz_easy_mobi_type"] == '1'){
  $pp_type ="Jazzcash";
}
elseif($profile["jazz_easy_mobi_type"] == '2'){
  $pp_type = "Easypaisa";
}
else{
    $pp_type ="Mobi cash";
}

$bank = DBHelper::get("SELECT * FROM `bank_account` WHERE holder_id = '{$ID}' and type = 1")->fetch_assoc();

$perment = DBHelper::get("SELECT * FROM `tbl_address` WHERE `type` = 1 and `status` = 1 and `holderID` = '{$ID}'")->fetch_assoc();
$present = DBHelper::get("SELECT * FROM `tbl_address` WHERE `type` = 1 and `status` = 2 and `holderID` = '{$ID}'")->fetch_assoc();

?>
    <!-- Main content -->
    <section class="content mt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?php echo $path; ?>"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $profile["name"];?></h3>

                <p class="text-muted text-center">Customer</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Total earning</b> <a class="float-right"><?php echo $total_balance; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Total refer</b> <a class="float-right"><?php echo $refter; ?></a>
                  </li>
                  <!-- <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li> -->
                </ul>

                <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#tab1" data-toggle="tab">Details</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab2" data-toggle="tab">Earning history</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab3" data-toggle="tab">Fav product</a></li>
                  <li class="nav-item"><a class="nav-link" href="#buy_now" data-toggle="tab">Buy now</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab4" data-toggle="tab">Orders</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab5" data-toggle="tab">Draft Order</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">

                <!-- Tab 1 start -->
                  <div class="active tab-pane" id="tab1">
                    <h3 style="font-weight: bold; color:#707070;">Personal details</h3>
                    <table>
                        <tr style="line-height: 25px;">  <th style="width:150px;">Email</th>  <td><?php echo $profile["email"]; ?></td>  </tr>
                        <tr style="line-height: 25px;">  <th style="width:150px;">Mobile</th>  <td><?php echo $profile["mobile"]; ?></td>  </tr>
                        <tr style="line-height: 25px;">  <th style="width:150px;">Username</th>  <td><?php echo $profile["username"]; ?></td>  </tr>
                        <tr style="line-height: 25px;">  <th style="width:150px;">Join Date</th>  <td><?php echo date('d-m-Y',strtotime($profile["date"])); ?></td>  </tr>
                        <tr style="line-height: 25px;">  <th style="width:150px;">Gender</th>  <td><?php echo $gender; ?></td>  </tr>
                        <tr style="line-height: 25px;">  <th style="width:150px;"><?php echo $pp_type;?></th>  <td><?php echo $profile["jazz_easy_mobi_no"]; ?></td>  </tr>
                    </table>

                    <hr>
                    <h3 style="font-weight: bold; color:#707070;" class="mt-3">Bank Account</h3>
                    <table>
                        <tr style="line-height: 25px;">  <th style="width:150px;">Account No</th>  <td><?php echo $bank["ac_no"]; ?></td>  </tr>
                        <tr style="line-height: 25px;">  <th style="width:150px;">Account Title</th>  <td><?php echo $bank["ac_title"]; ?></td>  </tr>
                        <tr style="line-height: 25px;">  <th style="width:150px;">Bank Name</th>  <td><?php echo $bank["bank_name"]; ?></td>  </tr>
                    </table>

                    <hr>
                    <h3 style="font-weight: bold; color:#707070;" class="mt-3">Permanent Address</h3>
                    <table>
                        <tr style="line-height: 25px;">  <th style="width:150px;">House No</th>  <td><?php echo $perment["house_no"]; ?></td>  </tr>
                        <tr style="line-height: 25px;">  <th style="width:150px;">Street No</th>  <td><?php echo $perment["street_no"]; ?></td>  </tr>
                        <tr style="line-height: 25px;">  <th style="width:150px;">City</th>  <td><?php echo $perment["city"]; ?></td>  </tr>
                        <tr style="line-height: 25px;">  <th style="width:150px;">Tehsil</th>  <td><?php echo $perment["tehsil"]; ?></td>  </tr>
                        <tr style="line-height: 25px;">  <th style="width:150px;">District</th>  <td><?php echo $perment["district"]; ?></td>  </tr>
                        <tr style="line-height: 25px;">  <th style="width:150px;">Postal code</th>  <td><?php echo $perment["postal_code"]; ?></td>  </tr>
                    </table>


                    <hr>
                    <h3 style="font-weight: bold; color:#707070;" class="mt-3">Present Address</h3>
                    <table>
                        <tr style="line-height: 25px;">  <th style="width:150px;">House No</th>  <td><?php echo $present["house_no"]; ?></td>  </tr>
                        <tr style="line-height: 25px;">  <th style="width:150px;">Street No</th>  <td><?php echo $present["street_no"]; ?></td>  </tr>
                        <tr style="line-height: 25px;">  <th style="width:150px;">City</th>  <td><?php echo $present["city"]; ?></td>  </tr>
                        <tr style="line-height: 25px;">  <th style="width:150px;">Tehsil</th>  <td><?php echo $present["tehsil"]; ?></td>  </tr>
                        <tr style="line-height: 25px;">  <th style="width:150px;">District</th>  <td><?php echo $present["district"]; ?></td>  </tr>
                        <tr style="line-height: 25px;">  <th style="width:150px;">Postal code</th>  <td><?php echo $present["postal_code"]; ?></td>  </tr>
                    </table>

                  </div>
                  <!-- Tab 1 end -->


               
                  <!-- Tab 2 start -->
                  <div class="tab-pane" id="tab2">
                  <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                        <th scope="col">Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $tran = DBHelper::get("SELECT * FROM `tbl_customer_credit_trans` WHERE cusID = '{$ID}' and type = 1");
                        if($tran->num_rows > 0){
                            while($row = $tran->fetch_assoc()){
                                ?>
                                  <tr>
                                        <td><?php echo $row["amount"]; ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($row["date"])); ?></td>
                                        <td>
                                        <?php if($row["tran_type"] == "0") {
                                        echo "Account creation";
                                        } 
                                        elseif($row["tran_type"] == "6") {
                                          echo "Shopping reffered";
                                          } 
                                        else{
                                            echo "Refer amount";
                                        }
                                        ?>
                                        </td>
                                  </tr>
                                <?php
                            }
                        }
                       ?>
                    
                    </tbody>
                    </table>
                  </div>
                  <!-- Tab 2 end -->


                  <!-- Tab 3 start -->
                  <div class="tab-pane" id="tab3">

                  <table id="ts_table" class="table table-bordered table-hover mt-3">
                    <thead>
                        <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                        if($product->num_rows > 0){
                            while($row = $product->fetch_assoc()){
                                $pp = "../images/product/".$row["main_img"];
                                ?>
                                  <tr>
                                  <td>
                                   <img onclick="fullView('<?php echo $pp; ?>')" width="40" height="40" class="rounded" src="<?php echo $pp; ?>" alt="">
                                </td>
                                        <td><?php echo $row["title"]; ?></td>
                                        <td><?php echo $row["price"]; ?></td>
                                        <td><?php echo $row["quantity"]; ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($row["date"])); ?></td>
                                        <td>
                                        <a href="?p=product_details&ID=<?php echo $row["id"];?>" title="View"><i class="fas fa-eye text-info"></i></a>
                                        </td>
                                  </tr>
                                <?php
                            }
                        }
                       ?>
                    
                    </tbody>
                    </table>
                   </div>
                   <!-- Tab 3 end -->



                   <div class="tab-pane" id="buy_now">
                   <table id="ts_table" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th scope="col">Order no</th>
                    <th scope="col">Prod no</th>
                    <th scope="col">Date</th>
                   <th scope="col">Qty</th>
                   <th scope="col">Amount</th>
                   <th scope="col">Discount</th>
                   <th scope="col">Total</th>
                   <th scope="col">Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php
                 
                  $data = DBHelper::get("SELECT * FROM `buy_now_product` WHERE `cusID` = '{$ID}'");

                  if($data->num_rows > 0){
                      while($row = $data->fetch_assoc()){
                         
                          ?>
                                <tr style="vertical-align: middle;">
                                
                                <td><?php echo $row["id"]; ?></td>
                                <td><?php echo $row["prdID"]; ?></td>
                                <td><?php echo date('d-m-Y',strtotime($row["date"])); ?></td>
                                <td><?php echo $row["qty"]; ?></td>
                                <td>Rs. <?php echo $row["amount"]; ?></td>
                                <td>Rs. <?php echo $row["discount"]; ?></td>
                                <td>Rs. <?php echo $row["price_after_discount"]; ?></td>
                                <td>
                                 <?php
                                    if ($row["status"] == '0') {
                                        echo '<span class="badge badge-primary">Pending</span>';
                                    } elseif ($row["status"] == '1') {
                                        echo '<span class="badge badge-warning">Completed</span>';
                                    } ?>
                               </td>
                               
                              
                                <td>
                                    <a href="index?p=product_details&ID=<?php echo $row["prdID"];?>" title="View product"><i class="fas fa-eye text-info"></i></a>
                                    <a href="index?p=supplier_profile&id=<?php echo $row["suppID"];?>" title="View supplier"><i class="fas fa-user text-info"></i></a>
                                </td>

                            </tr>
                          <?php
                      }
                  }
                  ?>
                  
                  </tbody>
              
                </table>
                   </div>


                   <!-- Tab 4 start -->
                   <div class="tab-pane" id="tab4">
                   <table id="ts_table" class="table table-bordered table-hover mt-3 ts_table">
                  <thead>
                  <tr>
                    <th>Order no</th>
                    <th>Total Amount</th>
                    <th>Disount</th>
                    <th>Shipment</th>
                    <th>Total payable</th>
                    <th>Payment Type</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php
                  $data = DBHelper::get("SELECT * FROM `orders` WHERE  cusID = '{$ID}' and orderStatus != 99");

                  if($data->num_rows > 0){
                      while($row = $data->fetch_assoc()){
                         
                          ?>
                            <tr style="vertical-align: middle;">
                                <td><?php echo date('d-m-Y',strtotime($row["date"])); ?></td>
                                <td><?php echo $row["total"]; ?></td>
                                <td><?php echo $row["disount"]; ?></td>
                                <td><?php echo $row["shipment_charges"]; ?></td>
                                <td><?php echo $row["total_with_disount"]; ?></td>
                                <td>
                                <?php
                                    if ($row["orderStatus"] == '1') {
                                        echo '<span class="badge badge-primary">Placed by customer</span>';
                                    } elseif ($row["orderStatus"] == '2') {
                                        echo '<span class="badge badge-secondary">Under process</span>';
                                    } elseif ($row["orderStatus"] == '3') {
                                        echo '<span class="badge badge-info">On way to delivery</span>';
                                    } elseif ($row["orderStatus"] == '4') {
                                        echo '<span class="badge badge-success">Received by customer</span>';
                                    } elseif ($row["orderStatus"] == '5') {
                                        echo '<span class="badge badge-warning">Completed</span>';
                                    }
                                    
                                     ?>
                                </td>
                                <td>
                                <?php
                                    if ($row["payment_Type"] == '1') {
                                        echo '<span class="badge badge-secondary" style="margin-bottom:8px">Jazzcash</span>';
                                        if($row["paymentStatus"] == '1'){
                                          echo '<span class="badge badge-success">Amount Paid</span>';
                                        }
                                        else{
                                          echo '<span class="badge badge-success">Amount Pending</span>';
                                        }
                                    } elseif ($row["payment_Type"] == '2') {
                                        echo '<span class="badge badge-warning">Cash on delivery</span>';
                                    }  ?>
                                </td>
                                <td>
                                    <a href="?p=orderDetails&id=<?php echo $row["id"];?>" title="Delete admin"><i class="fas fa-eye text-primary"></i></a>
                                </td>
                            </tr>
                          <?php
                      }
                  }
                  ?>
                  
                  </tbody>
                   </table>
                   </div>
                   <!-- Tab 4 end -->


                   <!-- Tab 5 start -->
                   <div class="tab-pane" id="tab5">
                   <table id="ts_table" class="table table-bordered table-hover mt-3 ts_table">
                  <thead>
                  <tr>
                    <th>Order no</th>
                    <th>Total Amount</th>
                    <th>Disount</th>
                    <th>Shipment</th>
                    <th>Total payable</th>
                    <th>Payment Type</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php
                  $data = DBHelper::get("SELECT * FROM `orders` WHERE  cusID = '{$ID}' and orderStatus = 99");

                  if($data->num_rows > 0){
                      while($row = $data->fetch_assoc()){
                         
                          ?>
                            <tr style="vertical-align: middle;">
                                <td><?php echo date('d-m-Y',strtotime($row["date"])); ?></td>
                                <td><?php echo $row["total"]; ?></td>
                                <td><?php echo $row["disount"]; ?></td>
                                <td><?php echo $row["shipment_charges"]; ?></td>
                                <td><?php echo $row["total_with_disount"]; ?></td>
                                <td>
                                <?php
                                    if ($row["orderStatus"] == '1') {
                                        echo '<span class="badge badge-primary">Placed by customer</span>';
                                    } elseif ($row["orderStatus"] == '2') {
                                        echo '<span class="badge badge-secondary">Under process</span>';
                                    } elseif ($row["orderStatus"] == '3') {
                                        echo '<span class="badge badge-info">On way to delivery</span>';
                                    } elseif ($row["orderStatus"] == '4') {
                                        echo '<span class="badge badge-success">Received by customer</span>';
                                    } elseif ($row["orderStatus"] == '5') {
                                        echo '<span class="badge badge-warning">Completed</span>';
                                    } elseif ($row["orderStatus"] == '99') {
                                        echo '<span class="badge badge-primary">Draf order</span>';
                                    } ?>
                                </td>
                                <td>
                                <?php
                                    if ($row["payment_Type"] == '1') {
                                        echo '<span class="badge badge-secondary" style="margin-bottom:8px">Jazzcash</span>';
                                        if($row["paymentStatus"] == '1'){
                                          echo '<span class="badge badge-success">Amount Paid</span>';
                                        }
                                        else{
                                          echo '<span class="badge badge-success">Amount Pending</span>';
                                        }
                                    } elseif ($row["payment_Type"] == '2') {
                                        echo '<span class="badge badge-warning">Cash on delivery</span>';
                                    }  ?>
                                </td>
                                <td>
                                    <a href="?p=orderDetails&id=<?php echo $row["id"];?>" title="Delete admin"><i class="fas fa-eye text-primary"></i></a>
                                </td>
                            </tr>
                          <?php
                      }
                  }
                  ?>
                  
                  </tbody>
                   </table>
                   </div>
                    <!-- Tab 5 end -->
                  

                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <script>
    document.getElementById("p_title").innerText = "Customer profile";
   </script>