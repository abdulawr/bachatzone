<?php
include("include/header.php");

$ID = $_SESSION["data"]["id"];
$total_balance = DBHelper::get("SELECT * FROM `saller_account` WHERE sall_ID = '{$ID}'");
if($total_balance->num_rows > 0){
  $total_balance = $total_balance->fetch_assoc()["amount"];
}
else{
  $total_balance = 0;
}

$company_balance = DBHelper::get("SELECT * FROM `buy_now_saller_account` WHERE sallID = '{$ID}'");
if($company_balance->num_rows > 0){
  $company_balance = $company_balance->fetch_assoc()["amount"];
}
else{
  $company_balance = 0;
}
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

    <div class="rounded row bg-white m-2" style="padding:10px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; border-right: 3px solid  #18537a ;">
             
             <div class="col-md-6 col-sm-12">
                 <h4><b>Total earning</b></h4>
                 <h4 class="mt-2"><?php echo $total_balance; ?> PKR</h4>
             </div>
               
             <div class="col-md-6 col-sm-12">
                 <h4><b>Payable to company</b></h4>
                 <h4 class="mt-2"><?php echo $company_balance; ?> PKR</h4>
             </div>

    </div>

      <div class="rounded row m-2 mt-3 bg-white" style="padding:10px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; border-right: 3px solid  #18537a ;">
             
             <div class="col-md-12 col-sm-12">
                 <h4><b>Earning history</b></h4>
            
                 <table class="table table-hover mt-3 ">
                <thead>
                    <tr>
                    <th scope="col">Amount</th>
                    <th scope="col">Product ID</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Date</th>
                    <th scope="col">Details</th>
                    <th scope="col">Payment Type</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
      
                <?php 
                $tran = DBHelper::get("SELECT * FROM `saller_account_transaction` WHERE `sall_ID` = '{$ID}' order by id desc");
                if($tran->num_rows > 0){
                    while($row = $tran->fetch_assoc()){
              ?>
                <tr>
                <td><?php echo $row["amount"];?></td>
                <td><?php if($row["pay_type"] == '0') { echo $row["prdID"]; } else{
                    echo "--";
                }?></td>
                <td> <?php if($row["pay_type"] == '0') { echo $row["order_qty"]; } else{
                    echo "--";
                }?></td>
                <td><?php echo date("d-m-Y",strtotime($row["date"]));?></td>
                <td><?php echo $row["des"];?></td>

                <td>
                 <?php
                 if($row["pay_type"] == '0'){
                  echo "----";
                 }
                else{
                  echo $row["des"];
                }
                 ?>
               </td>

                <td>
                 <?php
                 if($row["buy_now_id"] != 0){
                  echo '<span class="badge badge-success">Buy now earning</span>';
                 }
                 else{
                  if($row["pay_type"] == '0'){
                    echo '<span class="badge badge-secondary">Earning</span>';
                   }
                   elseif($row["pay_type"] == '1'){
                    echo '<span title="Amount added into you account by admin" class="badge badge-success">Amount added</span>';
                   }
                   elseif($row["pay_type"] == '2'){
                    echo '<span title="Amount subtracted into you account by admin" class="badge badge-warning">Amount sub</span>';
                  }
                   elseif($row["pay_type"] == '3'){
                    echo '<span title="Amount subtracted into you account by admin" class="badge badge-warning">Paid to company</span>';
                  }
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

            <?php
            if($_SESSION["data"]["sallerType"] == 1){
              ?>
              <br>
              <hr>
              <br>
          <h4><b>Company payable</b></h4>
            
            <table class="table table-hover mt-3 ">
           <thead>
               <tr>
               <th scope="col">Order no</th>
               <th scope="col">Company payable</th>
               <th scope="col">Date</th>
               <th scope="col"></th>
              
               <th></th>
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
           <td>
           <a href="order_details?ord_listID=<?php echo $row["buy_now_id"].'&ID='.$row["prdID"];?>" title="View order"><i class="fas fa-eye text-info"></i></a>
           </td>
           </tr>

         <?php
               }
           }
          ?>
          
       </tbody>
       </table>
              <?php
            }
            ?>

             </div>

           </div>
 

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include("include/footer.php"); ?>

<script>
    document.getElementById("p_title").innerText = "Wallet";
</script>

