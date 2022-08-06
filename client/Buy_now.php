<style>
@media only screen and (max-width: 500px) {
    #chktbla{
        width:auto 
    }
}
   
</style>

<?php

include("include/header.php");
if(!isset($_COOKIE["cusID"]) && !verifyCustomer()){
	?>
	<script>
		location.replace("../login?msg=invalid_access")
	</script>
	<?php
}
?>
<body class="animsition">
	
<?php
 include("include/nav.php");
 include("include/cart.php");
 ?>

	<!-- Content page -->
	<section class="bg0 p-t-40 p-b-50">
		<div class="container">
			<div class="flex-w flex-tr">

<br>

</div>
            <table class="table rounded"  style="padding:20px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; border-right: 3px solid  #18537a ;  ">
          
           
            <thead>
                <tr>
                <th scope="col">Order no</th>
                <th scope="col">Date</th>
                <th scope="col">Qty</th>
                <th scope="col">Amount</th>
                <th scope="col">Discount</th>
                <th scope="col">Status</th>
                <th scope="col">Color</th>
                <th scope="col">Size</th>
                <th scope="col">View Product</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>

            <?php
            $orders = DBHelper::get("SELECT * FROM `buy_now_product` WHERE `cusID` = '{$ID}' order by id desc");
            if ($orders->num_rows > 0) {
                while ($row = $orders->fetch_assoc()) {
                    ?>
                      <tr>
                            <th scope="row"><?php echo $row["id"]; ?></th>
                            <td><?php echo date('d-m-Y', strtotime($row["date"])); ?></td>
                            <td><?php echo $row["qty"]; ?></td>
                            <td>Rs. <?php echo $row["customer_payable"]; ?></td>
                            <td>Rs. <?php echo $row["discount"]; ?></td>
                           
                            <td>
                                 <?php
                                    if ($row["status"] == '0') {
                                        echo '<span class="badge badge-primary">Pending</span>';
                                    } elseif ($row["status"] == '1') {
                                        echo '<span class="badge badge-warning">Completed</span>';
                                    } ?>
                            </td>
                            <td><?php echo ucwords($row["color"]); ?></td>
                            <td><?php echo $row["size"]; ?></td>

                            <td>
                                <a href="product-detail?ID=<?php echo $row['prdID']; ?>" class="btn btn-info btn-sm">Details</a>
                            </td>
                     </tr>
                    <?php
                }
            }
            ?>
   
         </tbody>
       </table>


       
			
			</div>

		

		</div>
	</section>	
	

    <?php
   include("include/footer.php");
   include("include/links.php");
    ?>

</body>
</html>