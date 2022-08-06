<?php include("include/header.php"); ?>
<body class="animsition">

<style>
	.ps11:hover{
      cursor: pointer;
	  color: white !important;
	}

	.btn-addwish-b2:hover{
		opacity: 1 !important;
	}
	.js-addedwish-b2:hover{
		opacity: 1 !important;
	}
	.btn-addwish-b2:hover{
		opacity: 1 !important;
	}
</style>
	
<?php 
$pg = 'index';
include("include/nav.php"); 
 $prd = DBHelper::get("SELECT * FROM `fav_product` WHERE cusID = '{$ID}'");
 $fav_array = [];
 if($prd->num_rows > 0){
   while($row = $prd->fetch_assoc()){
	   array_push($fav_array,$row["productID"]);
   }
 }
?>

	<?php include("include/cart.php");?>


	<!-- Slider -->
	<section class="section-slide">
		<div class="wrap-slick1 rs1-slick1">
			<div class="slick1">

			<?php 
			$header_image = DBHelper::get("SELECT * FROM `advertisement`  ORDER by id desc");
			if($header_image->num_rows > 0){
				while($rps = $header_image->fetch_assoc()){
					?>

				<div class="item-slick1" style="background-image: url('../images/advertisement/<?php echo $rps['image'];?>');">
					<div class="container h-full">

						<div class="flex-col-l-m h-full p-t-100 p-b-30">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-202 cl2 respon2">
								<?php echo $rps["sub_title"];?>
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
								<h2 class="ltext-104 cl2 p-t-19 p-b-43 respon1">
									<?php echo $rps["title"];?>
								</h2>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
								<a href="product.php" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
									Shop Now
								</a>
							</div>
						</div>
						
					</div>
				</div>

				<?php
				}
			}
			?>



			</div>
		</div>
	</section>


	<!-- Banner -->
	<div class="sec-banner bg0">
		<div class="flex-w flex-c-m">

		</div>
	</div>




	<!-- Product -->
	<section class="sec-product bg0 p-t-40 p-b-40">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-80 cl5 txt-center respon1" style="font-weight: bold; font-size:5.2vh">
					Newely Added
				</h3>
			</div>

			<!-- Tab01 -->
			<div class="tab01">
				<div class="tab-content p-t-10">		
					<!-- - -->
					<div class="tab-pane fade show active" id="best-seller" role="tabpanel">
						<!-- Slide2 -->
						<div class="wrap-slick2">							
							<div class="slick2">



							<?php
							   $prd_IDS = [];
							   $product = DBHelper::get("SELECT * FROM product WHERE status = 1 and views < 1000 and order_no < 50 ORDER by id DESC LIMIT 20");
							   if($product->num_rows > 0){
								   while($row = $product->fetch_assoc()){
									$pt = "product-detail?ID=".$row["id"];
									  array_push($prd_IDS,$row["id"]);
									   ?>
									   <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
									<!-- Block2 -->
									<div class="block2">
										<div class="block2-pic hov-img0">
										<img height="350" class="rounded-top" src="../images/product/<?php echo $row["main_img"];?>" alt="IMG-PRODUCT">

										<a onclick="openLink('<?php echo $pt;?>')" class="ps11 block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
											View
										</a>
										</div>

										<div class="block2-txt flex-w flex-t p-t-14">
											<div class="block2-txt-child1 flex-col-l ">
											<a href="<?php echo $pt; ;?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
												<?php echo $row["title"];?>
											</a>

											<span class="stext-105 cl3">
											<?php echo $row["price"]." PKR";?>
											</span>
											</div>

											<div class="block2-txt-child2 flex-r p-t-3">
								<button class="btn-addwish-b2 dis-block pos-relative ">
									<div id="spot_<?php echo $row['id'];?>">
									<?php
									  if(in_array($row["id"],$fav_array)){
                                       ?>
									   <img onclick="addFav('1','<?php echo $row['id'];?>')" style="opacity:1;" class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-02.png" alt="ICON">
									   <?php
									  }
									  else{
										?>
										<img onclick="addFav('0','<?php echo $row['id'];?>')" style="opacity:1;" class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
										<?php
									  }
									?>	
									</div>							
								</button>
							</div>

										</div>
									</div>
								</div>
									   <?php
								   }
							   }
							?>


							</div>
						</div>
					</div>

				</div>
			</div>


		</div>
	</section>





<!-- Product -->
<section class="sec-product bg0 p-b-40">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-80 cl5 txt-center respon1" style="font-weight: bold; font-size:5.2vh">
					Trending Product
				</h3>
			</div>

			<!-- Tab01 -->
			<div class="tab01">
				<div class="tab-content p-t-10">		
					<!-- - -->
					<div class="tab-pane fade show active" id="best-seller" role="tabpanel">
						<!-- Slide2 -->
						<div class="wrap-slick2">							
							<div class="slick2">



							<?php
							 $idss = rtrim(implode(",",$prd_IDS),",");
							   $product = DBHelper::get("SELECT * FROM product WHERE status = 1 and order_no != 0 and views != 0 and id not in($idss) ORDER by order_no desc,views DESC LIMIT 20");
							   if($product->num_rows > 0){
								   while($row = $product->fetch_assoc()){
									$pt = "product-detail?ID=".$row["id"];
									array_push($prd_IDS,$row["id"]);
									   ?>
									   <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
									<!-- Block2 -->
									<div class="block2">
										<div class="block2-pic hov-img0">
										<img height="350" class="rounded-top" src="../images/product/<?php echo $row["main_img"];?>" alt="IMG-PRODUCT">

										<a onclick="openLink('<?php echo $pt;?>')" class="ps11 block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
											View
										</a>
										</div>

										<div class="block2-txt flex-w flex-t p-t-14">
											<div class="block2-txt-child1 flex-col-l ">
											<a href="<?php echo $pt; ;?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
												<?php echo $row["title"];?>
											</a>

											<span class="stext-105 cl3">
											<?php echo $row["price"]." PKR";?>
											</span>
											</div>

											<div class="block2-txt-child2 flex-r p-t-3">
								<button class="btn-addwish-b2 dis-block pos-relative ">
									<div id="spot_<?php echo $row['id'];?>">
									<?php
									  if(in_array($row["id"],$fav_array)){
                                       ?>
									   <img onclick="addFav('1','<?php echo $row['id'];?>')" style="opacity:1;" class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-02.png" alt="ICON">
									   <?php
									  }
									  else{
										?>
										<img onclick="addFav('0','<?php echo $row['id'];?>')" style="opacity:1;" class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
										<?php
									  }
									?>	
									</div>							
								</button>
							</div>

										</div>
									</div>
								</div>
									   <?php
								   }
							   }
							?>



							</div>
						</div>
					</div>

				</div>
			</div>


		</div>
	</section>




<!-- Product -->
<section class="sec-product bg0  p-b-40">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-80 cl5 txt-center respon1" style="font-weight: bold; font-size:5.2vh">
					Top Rated
				</h3>
			</div>

			<!-- Tab01 -->
			<div class="tab01">
				<div class="tab-content p-t-10">		
					<!-- - -->
					<div class="tab-pane fade show active" id="best-seller" role="tabpanel">
						<!-- Slide2 -->
						<div class="wrap-slick2">							
							<div class="slick2">

							<?php
							  $idss11 = rtrim(implode(",",$prd_IDS),",");
                               
							   $product = DBHelper::get("SELECT * FROM product WHERE  status = 1 and rating != 0 ORDER by rating DESC LIMIT 20");
							   if($product->num_rows > 0){
								   while($row = $product->fetch_assoc()){
									$pt = "product-detail?ID=".$row["id"];
									   ?>
									   <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
									<!-- Block2 -->
									<div class="block2">
										<div class="block2-pic hov-img0">
										<img height="350" class="rounded-top" src="../images/product/<?php echo $row["main_img"];?>" alt="IMG-PRODUCT">

										<a onclick="openLink('<?php echo $pt;?>')" class="ps11 block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
											View
										</a>
										</div>

										<div class="block2-txt flex-w flex-t p-t-14">
											<div class="block2-txt-child1 flex-col-l ">
											<a href="<?php echo $pt; ;?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
												<?php echo $row["title"];?>
											</a>

											<span class="stext-105 cl3">
											<?php echo $row["price"]." PKR";?>
											</span>
											</div>

											<div class="block2-txt-child2 flex-r p-t-3">
								<button class="btn-addwish-b2 dis-block pos-relative ">
									<div id="spot_<?php echo $row['id'];?>">
									<?php
									  if(in_array($row["id"],$fav_array)){
                                       ?>
									   <img onclick="addFav('1','<?php echo $row['id'];?>')" style="opacity:1;" class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-02.png" alt="ICON">
									   <?php
									  }
									  else{
										?>
										<img onclick="addFav('0','<?php echo $row['id'];?>')" style="opacity:1;" class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
										<?php
									  }
									?>	
									</div>							
								</button>
							</div>

										</div>
									</div>
								</div>
									   <?php
								   }
							   }
							?>

							</div>
						</div>
					</div>

				</div>
			</div>


		</div>
	</section>






<?php include("include/footer.php");?>


	<!-- Modal1 -->
	<div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
		<div class="overlay-modal1 js-hide-modal1"></div>

		<div class="container">
			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
				<button class="how-pos3 hov3 trans-04 js-hide-modal1">
					<img src="images/icons/icon-close.png" alt="CLOSE">
				</button>

				<div class="row">
					<div class="col-md-6 col-lg-7 p-b-30">
						<div class="p-l-25 p-r-30 p-lr-0-lg">
							<div class="wrap-slick3 flex-sb flex-w">
								<div class="wrap-slick3-dots"></div>
								<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

								<div class="slick3 gallery-lb">
									<div class="item-slick3" data-thumb="images/product-detail-01.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="images/product-detail-01.jpg" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-01.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>

									<div class="item-slick3" data-thumb="images/product-detail-02.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="images/product-detail-02.jpg" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-02.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>

									<div class="item-slick3" data-thumb="images/product-detail-03.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="images/product-detail-03.jpg" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-03.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-6 col-lg-5 p-b-30">
						<div class="p-r-50 p-t-5 p-lr-0-lg">
							<h4 class="mtext-105 cl2 js-name-detail p-b-14">
								Lightweight Jacket
							</h4>

							<span class="mtext-106 cl2">
								$58.79
							</span>

							<p class="stext-102 cl3 p-t-23">
								Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.
							</p>
							
							<!--  -->
							<div class="p-t-33">
								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Size
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="time">
												<option>Choose an option</option>
												<option>Size S</option>
												<option>Size M</option>
												<option>Size L</option>
												<option>Size XL</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Color
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="time">
												<option>Choose an option</option>
												<option>Red</option>
												<option>Blue</option>
												<option>White</option>
												<option>Grey</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-204 flex-w flex-m respon6-next">
										<div class="wrap-num-product flex-w m-r-20 m-tb-10">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>

										<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
											Add to cart
										</button>
									</div>
								</div>	
							</div>

							<!--  -->
							<div class="flex-w flex-m p-l-100 p-t-40 respon7">
								<div class="flex-m bor9 p-r-10 m-r-11">
									<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
										<i class="zmdi zmdi-favorite"></i>
									</a>
								</div>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
									<i class="fa fa-facebook"></i>
								</a>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
									<i class="fa fa-twitter"></i>
								</a>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
									<i class="fa fa-google-plus"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	
  <?php
   include("include/links.php");
  ?>

</body>
</html>


<script>
	function openLink(link){
		location.href = link;
	}

	function addFav(status,prdID){
      // status 0 -> add fav && 1 -> unfav
	  var div_bo = $("#spot_"+prdID);
	   $.post("action/fav_product.php",
		{
			status: status,
			ID: prdID
		},
		function(data, status11){
			if(data == '1'){
              if(status == '1'){
				div_bo.replaceWith('<div id="spot_'+prdID+'"><img onclick="addFav(0,'+prdID+')" style="opacity:1;" class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON"></div>')
			  }
			  else{
				div_bo.replaceWith('<div id="spot_'+prdID+'"><img onclick="addFav(1,'+prdID+')" style="opacity:1;" class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-02.png" alt="ICON"></div>')
			  }
			}
		});
	}
</script>