<?php 
$ID = DBHelper::escape($_GET["id"]);
$profile = DBHelper::get("SELECT * FROM `investor` WHERE id = '{$ID}'")->fetch_assoc();

if($profile["gender"] == "1"){
$gender = "Male";
}
elseif($profile["gender"] == "2"){
    $gender = "Female";
}
else{
    $gender = "Other";
}

$total_balance = DBHelper::get("SELECT * FROM `tbl_customer_credit_total` WHERE cusID = '{$ID}' and type = 2")->fetch_assoc()["amount"];
$refter = DBHelper::get("SELECT count(id) as total FROM `tbl_customer_credit_trans` WHERE cusID = '{$ID}' and type = 2 and tran_type = 2")->fetch_assoc()["total"];

if($profile["mobile_account_type"] == '1'){
  $pp_type ="Jazzcash";
}
elseif($profile["jazz_easy_mobi_type"] == '2'){
  $pp_type = "Easypaisa";
}
else{
    $pp_type ="Mobi cash";
}

$bank = DBHelper::get("SELECT * FROM `bank_account` WHERE holder_id = '{$ID}' and type = 0")->fetch_assoc();

?>
    <!-- Main content -->
    <section class="content mt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <!-- <div class="text-center">
                  
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?php echo $path; ?>"
                       alt="User profile picture">
                </div> -->

                <h3 class="profile-username text-center"><?php echo $profile["fname"]." ".$profile["lname"];?></h3>

                <p class="text-muted text-center">Investor</p>

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
                  <!-- <li class="nav-item"><a class="nav-link" href="#tab3" data-toggle="tab">Tab 3</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab4" data-toggle="tab">Tab 4</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab5" data-toggle="tab">Tab 5</a></li> -->
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
                        <tr style="line-height: 25px;">  <th style="width:150px;">Address</th>  <td><?php echo $profile["address"]; ?></td>  </tr>
                        <tr style="line-height: 25px;">  <th style="width:150px;">Join Date</th>  <td><?php echo date('d-m-Y',strtotime($profile["date"])); ?></td>  </tr>
                        <tr style="line-height: 25px;">  <th style="width:150px;">Gender</th>  <td><?php echo $gender; ?></td>  </tr>
                        <tr style="line-height: 25px;">  <th style="width:150px;"><?php echo $pp_type;?></th>  <td><?php echo $profile["mobile_account"]; ?></td>  </tr>
                    </table>

                    <hr>
                    <h3 style="font-weight: bold; color:#707070;" class="mt-3">Bank Account</h3>
                    <table>
                        <tr style="line-height: 25px;">  <th style="width:150px;">Account No</th>  <td><?php echo $bank["ac_no"]; ?></td>  </tr>
                        <tr style="line-height: 25px;">  <th style="width:150px;">Account Title</th>  <td><?php echo $bank["ac_title"]; ?></td>  </tr>
                        <tr style="line-height: 25px;">  <th style="width:150px;">Bank Name</th>  <td><?php echo $bank["bank_name"]; ?></td>  </tr>
                    </table>

                  </div>
                  <!-- Tab 1 end -->


               
                  <!-- Tab 2 start -->
                  <div class="tab-pane" id="tab2">
                  <table id="ts_table" class="table table-bordered table-hover mt-3">
                    <thead>
                        <tr>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                        <th scope="col">Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $tran = DBHelper::get("SELECT * FROM `tbl_customer_credit_trans` WHERE cusID = '{$ID}' and type = 2");
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
                                        else{
                                            echo "New account";
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
                  <h1>Tab 3</h1>
                   </div>
                   <!-- Tab 3 end -->


                   <!-- Tab 4 start -->
                   <div class="tab-pane" id="tab4">
                   <h1>Tab 4</h1>
                   </div>
                   <!-- Tab 4 end -->


                   <!-- Tab 5 start -->
                   <div class="tab-pane" id="tab5">
                   <h1>Tab 5</h1>
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
    document.getElementById("p_title").innerText = "Investor profile";
   </script>