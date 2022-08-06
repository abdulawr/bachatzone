<?php include("include/header.php");
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

$prdID = DBHelper::escape($_GET["ID"]);
 $data = DBHelper::get("SELECT product.*,supplier.name as sup,company.name as company,product_category.name 
  'cat' FROM `product` INNER JOIN product_category on product_category.id = categoryID
  INNER JOIN supplier on supplier.id = supplierID inner join company on company.id = cmpID  where product.id = '{$prdID}'")->fetch_assoc();
 
 $other_image = json_decode($data['other_images'],true);

 DBHelper::set("UPDATE product set views = views+1 WHERE id = '{$prdID}'");

 $review = DBHelper::get("SELECT product_review.*,name,image FROM `product_review` INNER JOIN tbl_customer on tbl_customer.id  = cusID WHERE prdID = {$prdID}");
 $saller = DBHelper::get("SELECT * FROM `supplier` WHERE id = '{$data["supplierID"]}'")->fetch_assoc();

 $fav_array = [];
 if (isset($_COOKIE["cusID"]) && verifyCustomer()) {
	 $prd = DBHelper::get("SELECT * FROM `fav_product` WHERE cusID = '{$ID}'");
	 if ($prd->num_rows > 0) {
		 while ($row = $prd->fetch_assoc()) {
			 array_push($fav_array, $row["productID"]);
		 }
	 }

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


 $dis_totLa = 0;
 if(trim($data["wallet_amount_status"]) == "1"){  
	 
	 if($data["wallet_amount_type"] == "1"){
		 // percentage
		 $dis_tt = ($data["allow_wallet_per"] / 100) * 70;									
		 $dis_tt =  ($data["price"] / 100) * $dis_tt;
							 
		 $dis_totLa += $dis_tt;
	 }
	 else{
		// valeu
		$dis_tt = ($data["allow_wallet_per"] / 100) * 70;
		$dis_totLa += $dis_tt;
	 }
 }
 else{
	 $dis_totLa = 0;
 }

?>
<head>
<meta property="og:title" content="<?php echo $data["title"]; ?>">
<meta property="og:description" content="<?php echo $data["title"]; ?>">
<meta property="og:image" content="https://bachatzone.com/images/product/<?php echo $data['main_img'];?>">
</head>
<body class="animsition">

<style>
	.movie_img{
		transition: transform .2s;
	}
	.movie_img:hover{
		transform: scale(1.5);
		cursor: pointer;
	}
</style>
	
<?php
 include("include/nav.php");
 include("include/cart.php");
?>


	
	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-65 p-b-60">
		<div class="container">
		<?php
	      if(isset($_GET["msg"])){
			  switch($_GET["msg"]){
				  case 'success':
					msg("Review submited successfully");
					break;
					case 'error':
						msg("Error occured while submitting review",2);
						break;
			  }
		  }
	    ?>
			<div class="row">
				
				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

							<div class="slick3 gallery-lb">
								
							 <div class="item-slick3" data-thumb="../images/product/<?php echo $data['main_img'];?>">
									<div class="wrap-pic-w pos-relative">
										<img src="../images/product/<?php echo $data['main_img'];?>" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="../images/product/<?php echo $data['main_img'];?>">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>

								<?php
               
								foreach($other_image as $url){
									?>
									<div class="item-slick3" data-thumb="../images/product/<?php echo $url;?>">
									<div class="wrap-pic-w pos-relative">
										<img src="../images/product/<?php echo $url;?>" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="../images/product/<?php echo $url;?>">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
							
									<?php
								}
								?>
								

							</div>
						</div>
					</div>
				</div>
					
				<div class="col-md-6 col-lg-5 p-b-30">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<h4 class="mtext-105 cl2 js-name-detail p-b-14">
							<?php echo $data["title"];?> <img style="display: none;" id="loading_images" src="../images/loading.gif" width="50" height="50" alt="">
						</h4>
						<?php if(!empty($dis_totLa) && $dis_totLa > 0 && ($balance > 0) || !verifyCustomer()){ ?>
						<span class="mtext-106 cl2">
						  <span style="text-decoration: line-through; padding-right: 10px;">Rs. <?php echo $data["price"];?></span>
						  Rs. <?php echo $data["price"]-$dis_totLa;?>
						</span>
						<?php } else {?>
							Rs. <?php echo $data["price"];?>
						<?php } ?>

				<table class="mt-2">
                  <tr style="line-height: 25px;;">
                      <th style="width:150px;">Category</th>
                      <td><?php echo ucwords($data["cat"]);?></td>
                  </tr>
                  <tr style="line-height: 25px;;">
                      <th style="width:150px;">Seller</th>
                      <td><?php echo $data["sup"];?></td>
                  </tr>

                  <tr style="line-height: 25px;;">
                      <th style="width:150px;">Company</th>
                      <td><?php echo ucwords($data["company"]);?></td>
                  </tr>


                  <tr style="line-height: 25px;;">
                      <th style="width:150px;">Bonus adjusted </th>
                      <td><?php 
						echo 'Rs. '.$dis_totLa;
					 ?></td>
                  </tr>
                 
                  <tr style="line-height: 25px;;">
                      <th style="width:150px;">Status</th>
                      <td>
                      <?php 
                                if($data["quantity"] > 0){
                                      echo '<span class="badge badge-success">In stock</span>';
                                    }
                                    else{
                                        echo '<span class="badge badge-info">Out of stock</span>';
                                    }
                                    ?>
                      </td>
                  </tr>


				  <tr style="line-height: 25px;;">
                      <th style="width:150px;">Type</th>
                      <td>
                      <?php 
                                if($saller["sallerType"] == 0){
                                      echo '<span class="badge badge-info">Online</span>';
                                 }
                                else{
                                        echo '<span class="badge badge-primary">Offline</span>';
                                }
                                    ?>
                      </td>
                  </tr>

				  <?php
				   if($saller["sallerType"] == 1){
                     ?>

                   <tr style="line-height: 25px;;">
                      <th style="width:150px;">Shop name</th>
                      <td>
                      <?php 
                            echo $saller["shop_name"];   
						?>
                      </td>
                    </tr>

					<tr style="line-height: 25px;;">
                      <th style="width:150px;">Shop address</th>
                      <td>
                      <?php 
                       echo $saller["shop_add"];       
                      ?>
                      </td>
                  </tr>

					 <?php
				   } 
				  ?>

         
               <?php if(!empty($data["size"])) { ?>
                   <tr style="line-height: 25px;;">
                      <th style="width:150px;">Size </th>
                      <td>
					   <select id="sel_size" name="sel_size" class="form-control" id="exampleFormControlSelect1">
							<?php
                              $size = explode(",", $data["size"]);
                              foreach ($size as $ss) {
                                  echo " <option value='".$ss."'>".$ss."</option>";
                              }
                            ?>
						</select>
					  </td>
                  </tr>
				  <?php } ?>


				  <?php if(!empty($data["color"])) { ?>
                   <tr style="line-height: 25px;;">
                      <th style="width:150px;">Color </th>
                      <td>
					   <select style="margin-top: 10px;" name="sel_color" id="sel_color" class="form-control" id="exampleFormControlSelect1">
							<?php
                              $size = explode(",", $data["color"]);
                              foreach ($size as $ss) {
                                  echo " <option value='".$ss."'>".ucwords($ss)."</option>";
                              }
                            ?>
						</select>
					  </td>
                  </tr>
				  <?php } ?>


                 
              </table>

						
						<!--  -->

						<?php
						 $lnk = $actual_link  . "/client/product-detail?ID=".$prdID;
						 ?>
					
						<div class="p-t-33">

						<div style="display: flex; flex-direction:row; margin:10px 0px;">
						<a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo $lnk;?>" target="_blank"> 
						<img id="facesharelink" class="movie_img" title="Share it on Whats`app"  style="width: 35px; height:35px" src="images/facebook.png" alt="">
						</a> 
                          <img onclick="shareLink(2)" class="movie_img" title="Share it on Facebook"  style="width: 35px; height:35px; margin-left:12px" src="images/whatsapp.png" alt="">
					
					    
						  <a href="mailto:?subject=Product shared link&amp;body=Access the product details on the following link: <?php echo  $lnk;?>">
                          <img class="movie_img" title="Share it on email" style="width: 35px; height:35px; margin-left:12px" src="images/email.png" alt="">
						  </a>
						  
                          <img onclick="shareLink(4)" class="movie_img" title="Copy product link" style="width: 35px; height:35px; margin-left:12px" src="images/copy.png" alt="">
						</div>


						
							<div class="flex-w flex-r-m p-b-10">
								<div class="size-204 flex-w flex-m respon6-next">

								<?php  //if(($saller["sallerType"] == 0) || (isset($_COOKIE["cusID"]) && verifyCustomer())) { ?>
									<div class="wrap-num-product flex-w m-r-20 m-tb-10">
										<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-minus"></i>
										</div>

										<input id="prd_qty" class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

										<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-plus"></i>
										</div>
									</div>
									<?php   //} ?>
									
                                        <div>
										
										<?php if($saller["sallerType"] == 0) { ?>
										<button onclick="addToCart(0)" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 ">
											Add to cart
										</button>
										<?php  } elseif($saller["sallerType"] != 0 && isset($_COOKIE["cusID"]) && verifyCustomer()){ ?>
										<button onclick="addToCart(1)" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 ">
											Buy now
										</button>
										<?php } else{ ?>
											<a href="../login?pr=<?php echo $data['id']; ?>" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 " style="color:white">
											Buy now
										    </a>
											<?php } ?>
										</div>


									
									
								</div>
							</div>	
							
						</div>
					

						
					</div>
				</div>
			</div>

			<div class="bor10 m-t-50 p-t-43 p-b-40">
				<!-- Tab01 -->
				<div class="tab01">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item p-b-10">
							<a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
						</li>


						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews (<?php echo $review->num_rows;?>)</a>
						</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content p-t-43">
						<!-- - -->
						<div class="tab-pane fade show active" id="description" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6">
									<?php echo $data["content"]; ?>
								</p>
							</div>
						</div>

					

						<!-- - -->
						<div class="tab-pane fade" id="reviews" role="tabpanel">
							<div class="row">
								<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
									<div class="p-b-30 m-lr-15-sm">
										<!-- Review -->

										<?php
										 if($review->num_rows > 0){
											 while($row = $review->fetch_assoc()){
                                               ?>
											   <div class="flex-w flex-t p-b-68">
											<div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
												<?php
												if(!empty($row["image"])){
                                                  echo '<img src="../images/customer/'.$row["image"].'" alt="AVATAR">';
												}
												else{
													echo '<img style="border:2px solid grey" src="../images/no-img.jpg" alt="AVATAR">';
												}
												?>
												
											</div>

											<div class="size-207">
												<div class="flex-w flex-sb-m p-b-17">
													<span class="mtext-107 cl2 p-r-20">
														<?php echo $row["name"]; ?>
													</span>

													<span class="fs-18 cl11">
														<?php
														for($i = 0; $i < $row["rating"]; $i++){
														 echo '<i class="zmdi zmdi-star"></i>';
														}

														for($i = 0; $i < (5-$row["rating"]); $i++){
															echo '<i class="zmdi zmdi-star-outline"></i>';
														}
														?>
														
													</span>
												</div>

												<p class="stext-102 cl6">
													<?php echo $row["review"];?>
												</p>
											</div>
										</div>
											   <?php
											 }
										 }
										?>


                                       <?php if(verifyCustomer()) { ?>
										<!-- Add review -->
										<form class="w-full" method="post" action="action/product_review">
											<h5 class="mtext-108 cl2 p-b-7">
												Add a review
											</h5>

											<div class="flex-w flex-m p-t-50 p-b-23">
												<span class="stext-102 cl3 m-r-16">
													Your Rating
												</span>

												<span class="wrap-rating fs-18 cl11 pointer">
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<input required class="dis-none" type="number" name="rating">
												</span>
											</div>

											<input type="hidden" name="prdID" value="<?php echo $prdID; ?>">

											<div class="row p-b-25">
												<div class="col-12 p-b-5">
													<label class="stext-102 cl3" for="review">Your review <sup class="text-danger">*</sup></label>
													<textarea required class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
												</div>
											</div>

											<button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
												Submit
											</button>
										</form>
										<?php } ?>


									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
			<span class="stext-107 cl6 p-lr-25">
				SKU: JAK-01
			</span>

			<span class="stext-107 cl6 p-lr-25">
				Categories: Jacket, Men
			</span>
		</div> -->
	</section>

	<?php
	 $products = DBHelper::get("SELECT * FROM `product` WHERE (`title` LIKE '%".$data["title"]."%' or `categoryID` = '{$data["categoryID"]}' or `supplierID` = '{$data["supplierID"]}' or `cmpID` = '{$data["cmpID"]}') and isdelete = 0 LIMIT 50 ");
	?>

	<!-- Related Products -->
	<section class="sec-relate-product bg0 p-t-45 p-b-105">
		<div class="container">
			<div class="p-b-45">
				<h3 class="ltext-106 cl5 txt-center">
					Related Products
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">
 
				<?php
                if ($products->num_rows > 0) {
                    while ($row = $products->fetch_assoc()) {
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

								
								<span class="stext-104 cl3">
						         Market Price:  Rs. <?php echo $row["price"];?>
						       </span>

								<?php 
								$dis_totLa = 0;
								if(trim($row["wallet_amount_status"]) == "1"){  
									
									if($row["wallet_amount_type"] == "1"){
										// percentage
										$dis_tt = ($row["allow_wallet_per"] / 100) * 70;									
										$dis_tt =  ($row["price"] / 100) * $dis_tt;
															
										$dis_totLa += $dis_tt;
									}
									else{
									// valeu
									$dis_tt = ($row["allow_wallet_per"] / 100) * 70;
									$dis_totLa += $dis_tt;
									}
								}
								else{
									$dis_totLa = 0;
								}

								if($dis_totLa > 0)
								{
									echo '	<span class="stext-104 cl3">Bonus Adjusted: ';
									echo 'Rs. '.$dis_totLa;
									echo '</span>'; 

									echo '	<span class="stext-104 cl3" style="color:  #1c287b "><b>BZ Price: ';
									echo 'Rs. '.($row["price"] - $dis_totLa);
									echo '</b></span>'; 
								}
								?>


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
                } ?>

			</div>
		</div>
	</section>
		

	<?php include("include/footer.php");?>

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


 function addToCart(status11){
	 var qty = $("#prd_qty").val();
	 var prdID = "<?php echo $data['id']; ?>";
     var loading_images = $("#loading_images");
	 var type = "<?php echo $saller["sallerType"]; ?>";
	 var size =  $("#sel_size :selected").val();;
	 var color =  $("#sel_color :selected").val();;

  loading_images.show();
  $.post("action/addToCart.php",
  {
    qty: qty,
    prdID: prdID,
	type:type,
	status:status11,
	size:size,
	color:color
  },
  function(data, status){

	loading_images.hide();
	var json = JSON.parse(data);
	console.log(json)
    if(json.status == '1'){
		var x = document.querySelectorAll(".cart_total");
		var i = 0;
		for (i = 0; i < x.length; i++) {
		x[i].setAttribute("data-notify",json.chat);
		}
		if(status11 == 0)
		alert("Item added successfully into cart")
		else
		alert("Request has been placed successfully")
	}
  });

 }


 function shareLink(status){

	var  prdID = "<?php echo  $prdID; ?>";
	var  actual_link = "<?php echo  $actual_link; ?>";
	var url = actual_link  + "/client/product-detail?ID="+prdID;

	if(status == 1){
     //facebook
	 window.open("https://www.facebook.com/sharer/sharer.php?u="+url, '_blank').focus();
	}
	else if(status == 2){
     //whatsapp
	 window.open("https://api.whatsapp.com/send?text="+url, '_blank').focus();
	}
	else if(status == 4){
	   navigator.clipboard.writeText(url);
	   alert("Copied the text: " + url);
	}

 }

</script>
 

