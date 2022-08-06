<?php
include("include/header.php"); 

if(!isset($_COOKIE["cusID"]) && verifyCustomer()){
	?>
	<script>
		location.replace("../login?msg=invalid_access")
	</script>
	<?php
}

if(isset($_COOKIE["cusID"]) && verifyCustomer()){
	$ID = Encryption::Decrypt($_COOKIE["cusID"]);
	$data = DBHelper::get("SELECT * FROM `tbl_customer` WHERE `id` = '{$ID}'")->fetch_assoc();
	$balance = DBHelper::get("SELECT * FROM `tbl_customer_credit_total` WHERE `cusID` = '{$ID}'")->fetch_assoc()["amount"];
    
	$checkOrder = DBHelper::get("SELECT SUM(disount) as tot FROM `orders` WHERE cusID = '{$ID}' and orderStatus not in (5,6)");
	if($checkOrder->num_rows > 0){
		$checkOrder = $checkOrder->fetch_assoc()["tot"];
		if($checkOrder > 0 && $balance > 0){
           $balance -= $checkOrder;

		   if($balance < 0){
			   $balance = 0;
		   }
		}
	}
}
else{
	$balance = 0;
}

$sub_total = 0;
$customer_discount_total = 0;
$company_discount_total = 0;

?>
<body class="animsition">
	
<?php
 include("include/nav.php");
 include("include/cart.php");
?>


	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				Shoping Cart
			</span>
		</div>
	</div>
		

	<!-- Shoping Cart -->
	<form id="testing_form" class="bg0 p-t-75 p-b-85" method="post" action="action/placedOrder">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						
						<div class="wrap-table-shopping-cart">
							<?php
							if(isset($_GET["msg"]) && $_GET["msg"] == "sucss"){
								echo msg("Cart updated successfully");
							}
							elseif(isset($_GET["msg"]) && $_GET["msg"] == "ss1"){
								echo msg("You order has been placed successfully");
							}
							elseif(isset($_GET["msg"]) && $_GET["msg"] == "deleted"){
								echo msg("Item deleted successfully");
							}
							elseif(isset($_GET["msg"]) && $_GET["msg"] == "inv_add"){
								echo msg("Update your present address in profile in order to proced with this order");
							}
							?>
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">Product</th>
									<th class="column-2"></th>
									<th class="column-3">Price</th>
									<th class="column-4">Quantity</th>
									<th class="column-5">Total</th>
									<th></th>
								</tr>

					<?php	

					if(isset($_COOKIE["cusID"]) && verifyCustomer()){
						$cusID = Encryption::Decrypt($_COOKIE["cusID"]);
						$prds = DBHelper::get("SELECT tbl_customer_cart.id as orsID, product.*,tbl_customer_cart.qty as or_qty,tbl_customer_cart.color as c_color,tbl_customer_cart.size as c_size  FROM `tbl_customer_cart` INNER JOIN product on product.id = prdID WHERE tbl_customer_cart.cusID = '{$cusID}'");
					}

					elseif(isset($_SESSION["cart"])){
						$balance = 0;
						$dis = '-1,';
						foreach($_SESSION["cart"] as $key=>$value)
						{
							$dis .= $key.",";
						}
						$dis = rtrim($dis,",");
						$prds = DBHelper::get("SELECT * from product where id in($dis)");
					}
					else{
					$balance = 0;
					$prds = DBHelper::get("SELECT * from product where id in(-1)");
					}
			

					if($prds->num_rows > 0){
                        while ($row = $prds->fetch_assoc()) {
                            if (isset($_SESSION["cart"])) {
                                $row["or_qty"] = $_SESSION["cart"][$row["id"]]["qty"];
                            }

                            $discount = calculateDiscount($row);
                            $customer_discount = $discount["customer"];
                            $company_discount = $discount["company"];
                             
                            if ($customer_discount_total <= $balance) {
                                $customer_discount_total += $customer_discount;
                                $company_discount_total += $company_discount;
                                $cmp_discount = $company_discount;
                                $cc_discoutn = $customer_discount;

                                if ($customer_discount_total > $balance) {
                                    $company_discount_total += abs($customer_discount_total - $balance);
                                    $cmp_discount += abs($customer_discount_total - $balance);
                                    $customer_discount_total = abs($balance);
                                    $cc_discoutn = $balance;
                                    $balance = 0;
                                }
                            } else {
                                $company_discount_total += $company_discount;
                                // discount is greater then customer balance
                                $company_discount_total += $customer_discount;
                                $cmp_discount = $company_discount + $customer_discount;
                                $cc_discoutn = 0;
                            }

                            
                            $sub_total += ($row["or_qty"] * $row["price"]);
                            echo '<input name="prdID[]" value="'.$row["id"].'" type="hidden">';
                            echo '<input name="dis_price[]" value="'.$cc_discoutn.'" type="hidden">';
                            echo '<input name="company_ear[]" value="'.$cmp_discount.'" type="hidden">';
                            echo '<input name="titles[]" value="'.$row["title"].'" type="hidden">'; ?>

                                 <tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1">
											<img src="../images/product/<?php echo $row["main_img"]; ?>" alt="IMG">
										</div>
									</td>
									<input name="price[]" type="hidden" value="<?php echo $row["price"]; ?>">
									<input name="supplier_price[]" type="hidden" value="<?php echo abs($row["price"] - $discount["discount"]); ?>">
									<td class="column-2"><?php echo $row["title"]; ?></td>
									<td class="column-3">Rs. <?php echo $row["price"]; ?></td>
									<td class="column-4">
										<div class="wrap-num-product flex-w m-l-auto m-r-0">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input name="qty[]" class="mtext-104 cl3 txt-center num-product" type="number" name="num-product2" value="<?php echo $row["or_qty"]; ?>">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>

										<?php if(!empty($row["c_color"])) { ?>
										<select name="color[]" title="Color" class="form-control" style="margin-top: 10px;">
										  <?php
                                            $color = explode(",", $row["color"]);
                            foreach ($color as $rr) {
                                $selected = ($row["c_color"] == $rr) ? 'selected' : "";
                                echo ' <option '.$selected.' value='.$rr.'>'.ucwords($rr).'</option>';
                            } ?>
										</select>
										<?php
                        } ?>

										<?php if(!empty($row["c_size"])) { ?>
										<select name="size[]" title="Size" class="form-control" style="margin-top: 10px;">
										  <?php
                                            $color = explode(",", $row["size"]);
                            foreach ($color as $rr) {
                                $selected = ($row["c_size"] == $rr) ? 'selected' : "";
                                echo ' <option '.$selected.' value='.$rr.'>'.ucwords($rr).'</option>';
                            } ?>
										</select>
										<?php
                        } ?>


									</td>
									<td class="column-5">Rs. <?php echo $row["or_qty"] * $row["price"]; ?></td>
								    
									<?php
									if(isset($_COOKIE["cusID"]) && verifyCustomer()){
                                       $pt = "action/update_checkout.php?tps=ch&ID=".$row["orsID"];
									}
									else{
										$pt = "action/update_checkout.php?tps=ch&prID=".$row["id"];
									}
									?>
									<td>
										<a href="<?php echo $pt; ?>" class="btn btn-danger btn-sm text-white">Delete</a>
									</td>

								</tr>

							<?php
                        } 
						$empt = true;
					}
						else{
							$empt = false;
						}
						?>

							


							</table>
						</div>
						

						<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
							<div class="flex-w flex-m m-r-20 m-tb-5">
								<!-- <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">
									
								<div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
									Apply coupon
								</div>  -->
							</div>

							<div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
							  <button onclick="submitForm()" type="button">Update Cart</button> 
							</div>
						</div>

					</div>
				</div>

				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">

					<?php
                        if ($empt) {
						
                            ?>
						<h4 class="mtext-109 cl2 p-b-30">
							Cart Totals
						</h4>

						

						<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="stext-110 cl2">
									Subtotal:
								</span>
							</div>

							<div class="size-209">
								<span class="mtext-110 cl2">
							    	Rs. <?php echo $sub_total; ?>
								</span>
							</div>
						</div>


						<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="stext-110 cl2">
								Bonus adjusted:
								</span>
							</div>

							<div class="size-209">
								<span class="mtext-110 cl2">
									Rs. <?php echo $customer_discount_total; ?>
								</span>
							</div>
						</div>


<div class="form-group mt-3 mb-2">
    <label for="shp_change"><b>Shipment city</b></label>
    <select required  class="form-control" id="shp_change">
      <option value="">Choose city</option>

       <?php
	     $ch = DBHelper::get("SELECT * FROM `shipment_charges`");  
		 while($row = $ch->fetch_assoc()){
			 ?>
			  <option value="<?php echo $row["charges"]; ?>"><?php echo ucwords($row["city_name"]); ?></option>
			 <?php
		 }
	   ?>
    </select>
  </div>


						<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="stext-110 cl2">
									Shipment:
								</span>
							</div>

							<div class="size-209">
								<span id="shp_charge_disp" class="mtext-110 cl2">
									0
								</span>
							</div>
						</div>


						<!-- <div class="flex-w flex-t bor12 p-t-15 p-b-30">
							<div class="size-208 w-full-ssm">
								<span class="stext-110 cl2">
									Shipping Address:
								</span>
							</div>

							<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
						    	<textarea style="border: 1px solid grey;"  name=""  rows="3"><?php echo $data["address"]; ?></textarea>								
							</div>
						</div> -->

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span id="show_total" data-charge='<?php echo($sub_total - $customer_discount_total) ?>' class="mtext-110 cl2">
								Rs. <?php echo($sub_total - $customer_discount_total); ?>
								</span>
							</div>
						</div>
						
						<input id="tot_after_discount" name="tot_after_discount" type="hidden" value="<?php echo($sub_total - $dis); ?>">
						<input name="shipment" id="shipment_hid" type="hidden" value="0">
						<input name="total" type="hidden" value="<?php echo $sub_total; ?>">
						<input name="discount" type="hidden" value="<?php echo $customer_discount_total; ?>">
						<input name="company_earning" type="hidden" value="<?php echo $company_discount_total; ?>">
						

						<div>
						<input style="display: inline-block;" title="Comming soon" disabled value="1"  id="jazzcash" type="radio" name="paymnet">
						<label style="display: inline-block;"  for="jazzcash">JazzCash</label>
						</div>

						<div style="margin-bottom: 15px;">
						<input style="display: inline-block;" checked value="2" id="jazzcash" type="radio" name="paymnet">
						<label style="display: inline-block;" for="jazzcash">Cash on delivery</label>
						</div>

						<div class="form-group">
							<label style="font-weight: bold;" for="exampleFormControlTextarea1">Delivery address</label>
							<textarea required name="del_address" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
						</div>


						<button type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
					      Placed order
						</button>
						
						<?php
                        } ?>
						
						 <!-- <button onclick="ProcedORder('<?php echo $data['profile_status'];?>')" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
					      Placed order
						</button> -->

					</div>
				</div>
			</div>
		</div>
	</form>
		
	
		

<?php include("include/footer.php");?>

<?php
   include("include/links.php");
?>

</body>
</html>

<script>
	function submitForm(){
	    $("#testing_form").attr("action","action/update_checkout");
		$("#testing_form").submit();
	}

	function ProcedORder(stat){
		if(stat == "1")
		{
			$("#testing_form").attr("action","action/placedOrder");
		    $("#testing_form").submit();
		}
		else{
			alert("First complete your profile");
			//location.href = "profile";
		}
	    
	}

$("#shp_change").change(function(){
	var val = $(this).val();
	
   $("#shp_charge_disp").text("Rs. "+val);
   $("#shipment_hid").val(val);

   var show_total = $("#show_total");
   var total = show_total.attr("data-charge");

   show_total.text("Rs. "+Math.abs(parseInt(total) + parseInt(val)));
   $("#tot_after_discount").val(Math.abs(parseInt(total) + parseInt(val)));

})

</script>