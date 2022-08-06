<!-- Cart -->
<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Your Cart
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			
			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">

				<?php
				    if(isset($_COOKIE["cusID"]) && verifyCustomer()){
						$cusID = Encryption::Decrypt($_COOKIE["cusID"]);
						$prds = DBHelper::get("SELECT product.*,tbl_customer_cart.qty as or_qty FROM `tbl_customer_cart` INNER JOIN product on product.id = prdID WHERE tbl_customer_cart.cusID = '{$cusID}'");
					}
					elseif(isset($_SESSION["cart"])){
				        $dis = '-1,';
						foreach($_SESSION["cart"] as $key=>$value)
						{
							$dis .= $key.",";
						}
						$dis = rtrim($dis,",");
				    	$prds = DBHelper::get("SELECT * from product where id in($dis)");
					}
					else{
				    	$prds = DBHelper::get("SELECT * from product where id in(-1)");
					}

				
					
				    $tt = 0;
					if($prds->num_rows > 0){
						while($row = $prds->fetch_assoc()){

                            if (isset($_SESSION["cart"])) {
                                $row["or_qty"] = $_SESSION["cart"][$row["id"]]["qty"];
                            }
							$tt += $row["or_qty"] * $row["price"];						
							?>
                          <li class="header-cart-item flex-w flex-t m-b-12">
								<div class="header-cart-item-img">
									<img src="<?php if($page != "index") echo "../"; ?>images/product/<?php echo $row["main_img"];?>" alt="IMG">
								</div>

								<div class="header-cart-item-txt p-t-8">
									<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
										White Shirt Pleat
									</a>

									<span class="header-cart-item-info">
										<?php echo $row["or_qty"];?> <b>x</b> <?php echo "<b>PKR</b> ".$row["price"];?>
									</span>
								</div>
							</li>

							<?php
						}
					}

				?>
				</ul>
				
				<div class="w-full">
					<div class="header-cart-total w-full p-tb-40">
						Total: <b>PKR </b> <?php echo $tt;?>
					</div>

					<div class="header-cart-buttons flex-w w-full">
						<!-- <a href="shoping-cart.html" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							View Cart
						</a> -->

						<a href="shoping-cart" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
							Check Out
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>