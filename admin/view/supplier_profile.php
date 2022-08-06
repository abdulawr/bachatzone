<?php 
$ID = DBHelper::escape($_GET["id"]);
$profile = DBHelper::get("SELECT * FROM `supplier` WHERE id = '{$ID}'")->fetch_assoc();

$product_pend = DBHelper::get("SELECT product.*,supplier.name as sup,company.name as company,product_category.name 
'cat' FROM `product` INNER JOIN product_category on product_category.id = categoryID
 INNER JOIN supplier on supplier.id = supplierID inner join company on company.id = cmpID where product.status = 99 and product.supplierID = '{$ID}'");
 
 
 $product = DBHelper::get("SELECT product.*,supplier.name as sup,company.name as company,product_category.name 
'cat' FROM `product` INNER JOIN product_category on product_category.id = categoryID
 INNER JOIN supplier on supplier.id = supplierID inner join company on company.id = cmpID where isdelete = 0 and product.status = 1 and product.supplierID = '{$ID}'");

$balance = DBHelper::get("SELECT amount FROM `saller_account` WHERE sall_ID = '{$ID}' ");
if($balance->num_rows > 0){
  $balance = $balance->fetch_assoc()["amount"];
}
else{
  $balance = '0';
}

$company_paable = DBHelper::get("SELECT amount FROM `buy_now_saller_account` WHERE sallID = '{$ID}' ");
if($company_paable->num_rows > 0){
  $company_paable = $company_paable->fetch_assoc()["amount"];
}
else{
  $company_paable = '0';
}

$bank = DBHelper::get("SELECT * FROM `bank_account` WHERE holder_id = '{$ID}' and type = 2")->fetch_assoc();

?>
    <!-- Main content -->
    <section class="content mt-3">
      <div class="container-fluid">

         <?php
            if(isset($_GET["msg"])){
              switch($_GET["msg"]){
                case 'error':
                  msg("Something went wrong try again",2);
                  break;
                  case 'success':
                    msg("Action perform successfully");
                    break;
                    case 'bal_zero':
                      msg("Seller account balance is zero, You can't perform sub action",2);
                      break;
                      case 'invalid_amount':
                        msg("Amount shouldn't be greater then account balance",2);
                        break;
                      case 'inval_ablss':
                        msg("Amount shouldn't be greater then or less then account balance",2);
                        break;
              }
            }
          ?>

        <div class="row">
          <div class="col-md-3">

<div class="modal fade" id="cusTran" data-backdrop="static" data-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cusTranTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <div class="modal-body">
       
       <form method="post" action="action/supplierTransaction">
      <div class="form-group">
        <label for="exampleInputEmail1">Amount</label>
        <input required type="number" name="amount" class="form-control"  aria-describedby="emailHelp" placeholder="Enter amount">
      </div>

      <div class="form-group">
    <label for="exampleFormControlTextarea1">Description</label>
    <textarea required name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
     </div>

      <input type="hidden" name="supID" value="<?php echo $ID; ?>">
      <?php if($profile["sallerType"] == '0') { ?>
      <input type="hidden" name="balance" value="<?php echo $balance; ?>">
      <?php } else { ?>
        <input type="hidden" name="balance" value="<?php echo $company_paable; ?>">
        <?php } ?>
      <input type="hidden" name="tranType" id="tranType1122">
 
      <button type="submit" class="btn btn-primary">Submit</button>
</form>

       </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

          <!-- Model -->
       
         

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">

                <div class="text-center">
                  
                  <img class="profile-user-img img-fluid img-circle"
                       src="../images/seller/<?php echo $profile["image"]; ?>"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $profile["name"];?></h3>

                <p class="text-muted text-center">
                  <?php
                  if($profile["sallerType"] == '0'){
                    echo '<span class="badge badge-info">Online</span>';
                  }
                  elseif($profile["sallerType"] == '1'){
                   echo '<span class="badge badge-secondary">Offline</span>';
                  }
                  ?>
                </p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Total earning</b> <a class="float-right"><?php echo $balance;?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Company payable</b> <a class="float-right"><?php echo $company_paable;?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Total products</b> <a class="float-right"><?php echo $product->num_rows + $product_pend->num_rows; ?></a>
                  </li>
                  <!-- <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li> -->
                </ul>

                <?php if($profile["sallerType"] == '0') { ?>
                <button onclick="per_Transaction(1)" href="#" class="btn btn-success btn-block"><b>Add Balance</b></button>
                <button onclick="per_Transaction(2)" href="#" class="btn btn-warning btn-block"><b>Sub Balance</b></button>
                <?php } elseif($profile["sallerType"] == '1') {
                  ?>
                      <button onclick="per_Transaction(3)" href="#" class="btn btn-success btn-block"><b>Receive amount</b></button>

                  <?php
                } ?>
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

                  <?php if($profile["sallerType"] == '1') { ?>
                  <li class="nav-item"><a class="nav-link" href="#buy_now" data-toggle="tab">Buy now</a></li>
                  <li class="nav-item"><a class="nav-link" href="#buy_now_tran" data-toggle="tab">Buy now Tran</a></li>
                  <?php } ?>
                  <li class="nav-item"><a class="nav-link" href="#tab2" data-toggle="tab">Active products</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab3" data-toggle="tab">Pending products</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab4" data-toggle="tab">Earning Trans</a></li>

                  <?php if($profile["sallerType"] == '0') { ?>
                  <li class="nav-item"><a class="nav-link" href="#tab44" data-toggle="tab">Transactions</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab5" data-toggle="tab">Orders</a></li>
                  <?php } ?>
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
                        <tr style="line-height: 25px;">  <th style="width:150px;">CNIC</th>  <td><?php echo $profile["cnic"]; ?></td>  </tr>
                        <tr style="line-height: 25px;">  <th style="width:150px;">Join Date</th>  <td><?php echo date('d-m-Y',strtotime($profile["date"])); ?></td>  </tr>
                    </table>


                    <?php
                    if($bank) {
                    ?>
                    <hr>
                    <h3 style="font-weight: bold; color:#707070;" class="mt-3">Bank Account</h3>
                    <table>
                        <tr style="line-height: 25px;">  <th style="width:150px;">Account No</th>  <td><?php echo $bank["ac_no"]; ?></td>  </tr>
                        <tr style="line-height: 25px;">  <th style="width:150px;">Account Title</th>  <td><?php echo $bank["ac_title"]; ?></td>  </tr>
                        <tr style="line-height: 25px;">  <th style="width:150px;">Bank Name</th>  <td><?php echo $bank["bank_name"]; ?></td>  </tr>
                    </table>
                   <?php } ?>
                  </div>
                  <!-- Tab 1 end -->


                  <div class="tab-pane" id="buy_now">
                 
                  <table id="ts_table" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                  <th scope="col">Order no</th>
                  <th scope="col">Prod no</th>
                  <th scope="col">Date</th>
                  <th scope="col">Qty</th>
                  <th title="Saller amount">Sall amount</th>
                  <th title="Customer payable">Cust amount</th>
                  <th scope="col">Discount</th>
                  <th scope="col">Status</th>
                  <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php
                 
                  $data = DBHelper::get("SELECT * FROM `buy_now_product` WHERE `suppID` = '{$ID}'");

                  if($data->num_rows > 0){
                      while($row = $data->fetch_assoc()){
                         
                          ?>
                                <tr style="vertical-align: middle;">
                                
                                <td><?php echo $row["id"]; ?></td>
                                <td><?php echo $row["prdID"]; ?></td>
                                <td><?php echo date('d-m-Y',strtotime($row["date"])); ?></td>
                                <td><?php echo $row["qty"]; ?></td>
                                <td>Rs. <?php echo $row["saller_payable"];?></td>
                                <td>Rs. <?php echo $row["customer_payable"];?></td>
                                <td>Rs. <?php echo $row["discount"]; ?></td>
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
                                    <a href="index?p=customer_profile&id=<?php echo $row["cusID"];?>" title="View customer"><i class="fas fa-user text-info"></i></a>
                                </td>

                            </tr>
                          <?php
                      }
                  }
                  ?>
                  
                  </tbody>
              
                </table>
                  </div>


          <div class="tab-pane" id="buy_now_tran">
            <table class="table table-bordered table-hover ts_table">
           <thead>
               <tr>
               <th scope="col">Order no</th>
               <th scope="col">Company payable</th>
               <th scope="col">Date</th>
              
              
               </tr>
           </thead>
           <tbody>
 
           <?php 
           $tran = DBHelper::get("SELECT * FROM `buy_now_saller_account_tran` WHERE `sellID` = '{$ID}' order by id desc");
           if($tran->num_rows > 0){
               while($row = $tran->fetch_assoc()){
         ?>
           <tr>
           <td><?php echo $row["buy_now_id"];?></td>
           <td>Rs. <?php echo $row["cmp_earning"];?></td>
           <td><?php echo date("d-m-Y",strtotime($row["date"]));?></td>
           </tr>

         <?php
               }
           }
          ?>
          
       </tbody>
       </table>
                  </div>
               
                  <!-- Tab 2 start -->
                  <div class="tab-pane" id="tab2">
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

         
                        if($product_pend->num_rows > 0){
                            while($row = $product_pend->fetch_assoc()){
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


                   <!-- Tab 4 start -->
                   <div class="tab-pane" id="tab4">
                   <table id="ts_table" class="table table-bordered table-hover mt-3 ts_table">
                    <thead>
                        <tr>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                        <th scope="col">Product ID</th>
                        <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $tran = DBHelper::get("SELECT * FROM `saller_account_transaction` WHERE `sall_ID` = '{$ID}' and pay_type = 0");
                        if($tran->num_rows > 0){
                            while($row = $tran->fetch_assoc()){
                                ?>
                                  <tr>
                                        <td><?php echo $row["amount"]; ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($row["date"])); ?></td>
                                        <td><?php echo $row["prdID"]; ?></td>
                                        <td><?php echo $row["order_qty"]; ?></td>
                                    
                                  </tr>
                                <?php
                            }
                        }
                       ?>
                    
                    </tbody>
                    </table>
                   </div>
                   <!-- Tab 4 end -->



                     <!-- Tab 4 start -->
                     <div class="tab-pane" id="tab44">
                   <table id="ts_table" class="table table-bordered table-hover mt-3 ts_table">
                    <thead>
                        <tr>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                        <th scope="col">Details</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $tran = DBHelper::get("SELECT * FROM `saller_account_transaction` WHERE `sall_ID` = '{$ID}' and pay_type != 0");
                        if($tran->num_rows > 0){
                            while($row = $tran->fetch_assoc()){
                                ?>
                                  <tr>
                                        <td><?php echo $row["amount"]; ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($row["date"])); ?></td>
                                        <td><?php echo $row["des"]; ?></td>
                                        <td>
                                          <?php
                                          if($row["pay_type"] == '1'){
                                            echo '<span class="badge badge-success">Added</span>';
                                          }
                                          elseif($row["pay_type"] == '2'){
                                            echo '<span class="badge badge-warning">Subtracted</span>';
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
                   <!-- Tab 4 end -->


                   <!-- Tab 5 start -->
                   <div class="tab-pane" id="tab5">
                   <table  class="table table-bordered table-hover mt-3 ts_table">
                  <thead>
                  <tr>
                    <th>Order no</th>
                    <th>Date</th>
                    <th>Quantity</th>
                    <th>Seller amount</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php
                  $data = DBHelper::get("SELECT orderlist.*,product.title,product.main_img 
                  FROM `orderlist` INNER JOIN
                   product on product.id = `prdID` WHERE `suppID` = '{$ID}' and orderlist.status = 0 ");


                  if($data->num_rows > 0){
                      while($row = $data->fetch_assoc()){
                         
                          ?>
                            <tr style="vertical-align: middle;">
                                <td><?php echo $row["orderID"]; ?></td>
                                <td><?php echo date('d-m-Y',strtotime($row["date"])); ?></td>           
                                <td><?php echo $row["qty"]; ?></td>
                                <td><?php echo $row["supplier_amont"]; ?></td>
                               
                                <td>
                                <?php
                                    if ($row["status"] == '0') {
                                        echo '<span class="badge badge-primary">Pending</span>';
                                    } elseif ($row["orderStatus"] == '1') {
                                        echo '<span class="badge badge-warning">Completed</span>';
                                    }  ?>
                                </td>
                               
                                <td>
                                    <a href="?p=orderDetails&id=<?php echo $row["orderID"];?>" title="Delete admin"><i class="fas fa-eye text-primary"></i></a>
                                </td>
                            </tr>
                          <?php
                      }
                  }
                  ?>
                  
                  </tbody>
              
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
    document.getElementById("p_title").innerText = "Seller profile";


    function per_Transaction(status){
      $('#cusTran').modal()

      $("#tranType1122").val(status)

      if(status == '1'){
       $("#cusTranTitle").text("Add balance in seller account")
      }
      else if(status == '3'){
        $("#cusTranTitle").text("Received amount from saller")
      }
      else{
        $("#cusTranTitle").text("Sub balance in seller account")
      }

    }

   </script>