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
<?php  include("include/header.php"); 

?>
<body class="animsition">
	
<?php 
 include("include/nav.php");
 include("include/cart.php");

 $fav_array = [];
 if (isset($_COOKIE["cusID"]) && verifyCustomer()) {
	 $prd = DBHelper::get("SELECT * FROM `fav_product` WHERE cusID = '{$ID}'");
	 if ($prd->num_rows > 0) {
		 while ($row = $prd->fetch_assoc()) {
			 array_push($fav_array, $row["productID"]);
		 }
	 }
 }


?>

	<!-- Product -->
	<div class="bg0 m-t-23">
		<div class="container">
			<div class="flex-w flex-sb-m p-b-52">
				
				<div class="flex-w flex-c-m m-tb-10">
					<div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
						<i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
						<i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						 Filter
					</div>

					<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
						<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
						<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						Search
					</div>
				</div>
				
				<!-- Search product -->
				<form class="dis-none panel-search w-full p-t-10 p-b-15" method="post">
					<div class="bor8 dis-flex p-l-15">
						<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>

						<input required class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search_product_query" placeholder="Search">
					</div>	
				</form>

				<!-- Filter -->
				<div class="dis-none panel-filter w-full p-t-10">
					<div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
						<div class="filter-col1 p-r-15 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								Sort By
							</div>

							<ul>
								<li class="p-b-6">
									<a href="?p=product&sort=d" class="filter-link stext-106 trans-04 <?php if(isset($_GET["sort"]) && $_GET["sort"] == 'd') {echo "filter-link-active";}?> <?php if(!isset($_GET["sort"])) {echo "filter-link-active";}?>">
										Default
									</a>
								</li>


								<li class="p-b-6">
									<a href="?p=product&sort=online" class="filter-link stext-106 trans-04 <?php if(isset($_GET["sort"]) && $_GET["sort"] == 'online') {echo "filter-link-active";}?>">
										Online products
									</a>
								</li>

								<li class="p-b-6">
									<a href="?p=product&sort=offline" class="filter-link stext-106 trans-04 <?php if(isset($_GET["sort"]) && $_GET["sort"] == 'offline') {echo "filter-link-active";}?>">
										Offline products
									</a>
								</li>


								<li class="p-b-6">
									<a href="?p=product&sort=pop" class="filter-link stext-106 trans-04 <?php if(isset($_GET["sort"]) && $_GET["sort"] == 'pop') {echo "filter-link-active";}?>">
										Popularity
									</a>
								</li>

								<li class="?p=product&sort=rat">
									<a href="?p=product&sort=avg" class="filter-link stext-106 trans-04 <?php if(isset($_GET["sort"]) && $_GET["sort"] == 'avg') {echo "filter-link-active";}?>">
										Average rating
									</a>
								</li>

								<li class="p-b-6">
									<a href="?p=product&sort=new" class="filter-link stext-106 trans-04 <?php if(isset($_GET["sort"]) && $_GET["sort"] == 'new') {echo "filter-link-active";}?>">
										Newness
									</a>
								</li>

								<li class="p-b-6">
									<a href="?p=product&sort=pl" class="filter-link stext-106 trans-04 <?php if(isset($_GET["sort"]) && $_GET["sort"] == 'pl') {echo "filter-link-active";}?>">
										Price: Low to High
									</a>
								</li>

								<li class="p-b-6">
									<a href="?p=product&sort=ph" class="filter-link stext-106 trans-04 <?php if(isset($_GET["sort"]) && $_GET["sort"] == 'ph') {echo "filter-link-active";}?>">
										Price: High to Low
									</a>
								</li>
							</ul>
						</div>


						<div class="filter-col6 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								Tags
							</div>

							<div class="flex-w p-t-4 m-r--5">
							
							<?php
							 $cat = DBHelper::get("SELECT * FROM `product_category`");
                             if (!$con->error && $cat->num_rows > 0) {
                                 while ($row = $cat->fetch_assoc()) {
									 ?>
									 <a href="?product&catID=<?php echo $row["id"];?>" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
									<?php echo $row["name"]; ?>
								</a>
									 <?php
                                 }
                             }
							?>
							   

							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row isotope-grid">

			<?php

             // **************** Search start ***********************
			  $search = "";
              if(isset($_GET["catID"])){
			   $catID = DBHelper::escape($_GET["catID"]);
               $search .= " and product.categoryID = '{$catID}'";
			  }


			  if(isset($_REQUEST["search_product_query"])){
				$sea_qry = DBHelper::escape($_REQUEST["search_product_query"]);
				$search .= " and product.title like '%".$sea_qry."%'";
			   }

			   if(isset($_REQUEST["seller"])){
				$cat_qry = DBHelper::escape($_REQUEST["seller"]);
				$search .= " and product.supplierID = '{$cat_qry}' ";
			   }


			   if(isset($_REQUEST["company"])){
				$companyID = DBHelper::escape($_REQUEST["company"]);
				$search .= " and product.cmpID = '{$companyID}' ";
			   }

			   
			   if(isset($_REQUEST["sort"]) && $_REQUEST["sort"] == "online"){
				$search .= " and supplier.sallerType = '0' ";
			   }

			   
			   if(isset($_REQUEST["sort"]) && $_REQUEST["sort"] == "offline"){
				$search .= " and supplier.sallerType = '1' ";
			   }

			   


			    // **************** Search end ***********************


				//################# Sorting start #######################
				$sort = "";
                if(isset($_GET["sort"])){
					$se = DBHelper::escape($_GET["sort"]);
					switch($se){
						case 'd':
							$sort = '';
							break;
							case 'pop':
								$sort = ' order by product.views,product.order_no DESC ';
								break;
								case 'avg':
									$sort = ' order by product.rating DESC ';
									break;
									case 'new':
										$sort = ' order by product.id DESC ';
										break;
										case 'pl':
											$sort = ' order by product.price ASC ';
											break;
											case 'ph':
												$sort = ' order by product.price DESC ';
												break;												
					}
		
				}
				//################# Sorting end #######################

				$fav_search = "";
				if(isset($_GET["fav"]) && $_GET["fav"] == "prod_favs"){
					$cusID = Encryption::Decrypt($_COOKIE["cusID"]);
                    $fav_ids = DBHelper::get("SELECT productID FROM `fav_product` WHERE cusID = '{$cusID}'");
					
					$idds = [];
					if($fav_ids->num_rows > 0){
						while($rr = $fav_ids->fetch_assoc()){
                         array_push($idds,$rr["productID"]);
						}
					}
                    $idds = implode(', ', $idds);

					if(!empty($idds))
					$fav_search = " and product.id in($idds) ";
				}
			 
			  $products = DBHelper::get("SELECT product.* FROM `product` INNER JOIN supplier on supplier.id = `supplierID` WHERE isdelete = 0 and product.status = 1 $search $sort $fav_search");
             
			  if(!$con->error && $products->num_rows > 0){
                while($row = $products->fetch_assoc()){
					 $pt = "product-detail?ID=".$row["id"];
					?>
					<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item " >
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							<img height="300" class="rounded-top" src="../images/product/<?php echo $row["main_img"];?>" alt="IMG-PRODUCT">

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
									echo 'RS. '.($row["price"] - $dis_totLa);
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
			  }
			  else{
				echo "<div></div><h1 style='text-align:center;'>No product found</h1></div><br><br>";
			  }
			  
			?>

			</div>

			<!-- Load more -->
			<!-- <div class="flex-c-m flex-w w-full p-t-45">
				<a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
					Load More
				</a>
			</div> -->
		</div>
	</div>


	<div class="content" style="padding: 30px 0px;">
    
    <div class="site-section bg-left-half mb-5">
      <div class="container owl-2-style">
        <div class="owl-carousel owl-2">

          <?php
           $companies = DBHelper::get("SELECT * FROM company");
           if($companies->num_rows > 0){
               while($row = $companies->fetch_assoc()){
                   ?>
                     <div class="media-29101 rounded mt-2 mb-2 ml-2 mr-2" style="box-shadow: rgba(67, 71, 85, 0.27) 0px 0px 0.25em, rgba(90, 125, 188, 0.05) 0px 0.25em 1em; background:white; height:70px; ">
                        <div style="display: grid; place-items: center; height: 70px;">
                        <h3><a href="product?company=<?php echo $row["id"]; ?>"><?php echo ucwords($row["name"]);?></a></h3>
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
</script>