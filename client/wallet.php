<?php
if(!isset($_COOKIE["cusID"]) && verifyCustomer()){
	?>
	<script>
		location.replace("../login?msg=invalid_access")
	</script>
	<?php
}
include("include/header.php"); ?>
<body class="animsition">
	
<?php
 include("include/nav.php");
 include("include/cart.php");

 $total_balance = DBHelper::get("SELECT * FROM `tbl_customer_credit_total` WHERE cusID = '{$ID}' and type = 1")->fetch_assoc()["amount"];

 ?>

	<!-- Content page -->
	<section class="bg0 p-t-40 p-b-50">
		<div class="container">
				
             <div class="rounded row" style="padding:10px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; border-right: 3px solid  #18537a ;">
             
               <div class="col-md-12 col-sm-12">
                   <h3><b>Total earning</b></h3>
                   <h3 class="mt-2"><?php echo $total_balance; ?> PKR</h3>
               </div>

             </div>

             <div class="rounded row mt-5" style="padding:10px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; border-right: 3px solid  #18537a ;">
             
             <div class="col-md-12 col-sm-12">
                 <h3><b>Earning history</b></h3>
            
                 <table class="table table-hover mt-3">
                <thead>
                    <tr>
                    <th scope="col">Amount</th>
                    <th scope="col">Type</th>
                    <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
      
                <?php 
                $tran = DBHelper::get("SELECT * FROM `tbl_customer_credit_trans` WHERE type = 1 and cusID = '{$ID}'");
                if($tran->num_rows > 0){
                    while($row = $tran->fetch_assoc()){
              ?>
                <tr>
                <td><?php echo $row["amount"];?></td>
                <td>
                    <?php if($row["tran_type"] == "0") {
                      echo "Account creation";
                    } 
                    elseif($row["tran_type"] == "5"){
                      echo "Discount amount";
                    }
                    elseif($row["tran_type"] == "6"){
                      echo "Shopping reffered";
                    }
                    else{
                        echo "Refer amount";
                    }
                    ?>
                </td>
                <td><?php echo date("d-m-Y",strtotime($row["date"]));?></td>
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
	</section>	
	

    <?php
   include("include/footer.php");
   include("include/links.php");
    ?>

</body>
</html>