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
				
            <?php if(isset($_GET["orderID"])) {
                $ordID = DBHelper::escape($_GET["orderID"]);
                $order = DBHelper::get("SELECT * FROM `orders` WHERE id = '{$ordID}'")->fetch_assoc();
                $products = DBHelper::get("SELECT orderlist.*,product.title,product.main_img FROM `orderlist` INNER JOIN product on product.id = `prdID` WHERE `orderID` = '{$ordID}'");
              // print_data($order);
          ?>
           <div class="rounded w-100" style="padding:10px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; border-right: 3px solid  #18537a ; overflow:auto">
           
           <?php
           if(isset($_GET["msg"])){
             if($_GET["msg"] == "sucess"){
                 msg("Return request has been place successfully");
             }  
             elseif($_GET["msg"] == "fail"){
                msg("Something went wrong try again",2);
             }  
           }
           ?>
           
           <table>
                <tr>
                    <th style="width: 120px;">Order no:</th>
                    <td><?php echo $order["id"];?></td>
                </tr>

                <tr>
                    <th style="width: 120px;">Date:</th>
                    <td><?php echo date('d/m/Y',strtotime($order["date"]));?></td>
                </tr>

                <tr>
                    <th style="width: 120px;">Discount:</th>
                    <td>PKR <?php echo $order["disount"];?></td>
                </tr>

                <tr>
                    <th style="width: 120px;">Shipment:</th>
                    <td>PKR <?php echo $order["shipment_charges"];?></td>
                </tr>

                <tr>
                    <th style="width: 120px;">Total:</th>
                    <td>PKR <?php echo $order["total_with_disount"];?></td>
                </tr>

                <tr>
                    <th style="width: 120px;">Status:</th>
                    <td>
                    <?php
                                    if ($order["orderStatus"] == '1') {
                                        echo '<span class="badge badge-primary">Placed</span>';
                                    } elseif ($order["orderStatus"] == '2') {
                                        echo '<span class="badge badge-secondary">Under process</span>';
                                    } elseif ($order["orderStatus"] == '3') {
                                        echo '<span class="badge badge-info">On way to delivery</span>';
                                    } elseif ($order["orderStatus"] == '4') {
                                        echo '<span class="badge badge-warning">Completed</span>';
                                    } elseif ($order["orderStatus"] == '5') {
                                        echo '<span class="badge badge-danger">Order return</span>';
                                    } ?>
                    </td>
                </tr>

               
            </table>

            <br>

            <?php

?>


<br>

<table class="table" id="chktbla" style="margin-top: 20px;">
  <thead class="thead-light">
    <tr>
      <th scope="col">Poduct no</th>
      <th scope="col">Image</th>
      <th scope="col">Title</th>
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Status</th>
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
                                    } elseif ($row["status"] == '4') {
                                        echo '<span class="badge badge-warning">Delivered by saller</span>';
                                    } 
                                    elseif ($row["status"] == '2') {
                                        echo '<span class="badge badge-danger">Product returned</span>';
                                    }
                                    elseif ($row["status"] == '5') {
                                        echo '<span class="badge badge-success">Completed by admin</span>';
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

            <?php
            } else{ ?>
            
            <table class="table rounded"  style="padding:10px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; border-right: 3px solid  #18537a ; padding:15px; ">
          
           
            <thead>
                <tr>
                <th scope="col">Order no</th>
                <th scope="col">Date</th>
                <th scope="col">Total</th>
                <th scope="col">Status</th>
                <th scope="col">Payment Type</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>

            <?php
            $orders = DBHelper::get("SELECT * FROM `orders` WHERE `cusID` = '{$ID}' and orderStatus in (1,2,3,4,5)");
            if ($orders->num_rows > 0) {
                while ($row = $orders->fetch_assoc()) {
                   
                    ?>
                      <tr>
                            <th scope="row"><?php echo $row["id"]; ?></th>
                            <td><?php echo date('d-m-Y', strtotime($row["date"])); ?></td>
                            <td>PKR <?php echo $row["total_with_disount"]; ?></td>
                            <td>
                                 <?php
                                     if ($row["orderStatus"] == '1') {
                                        echo '<span class="badge badge-primary">Placed</span>';
                                    } elseif ($row["orderStatus"] == '2') {
                                        echo '<span class="badge badge-secondary">Under process</span>';
                                    } elseif ($row["orderStatus"] == '3') {
                                        echo '<span class="badge badge-info">On way to delivery</span>';
                                    } elseif ($row["orderStatus"] == '4') {
                                        echo '<span class="badge badge-warning">Completed</span>';
                                    } elseif ($row["orderStatus"] == '5') {
                                        echo '<span class="badge badge-danger">Order return</span>';
                                    } ?>
                            </td>
                            <td>
                                <a href="orders?orderID=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Details</a>
                            </td>
                     </tr>
                    <?php
                }
            }
            ?>
   
         </tbody>
       </table>
       <?php } ?>

       
			
			</div>

		

		</div>
	</section>	
	

    <?php
   include("include/footer.php");
   include("include/links.php");
    ?>

</body>
</html>