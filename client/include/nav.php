	
	<?php
	$cat = DBHelper::get("SELECT * FROM `product_category`;");
	$cmp_info = DBHelper::get("SELECT * FROM `json_data` WHERE `status` = 'cmp_info'")->fetch_assoc()["content"];
	$cmp_info = json_decode($cmp_info, true);
    
	if (isset($_COOKIE["cusID"]) && verifyCustomer()) {
         $fav_tot = DBHelper::get("SELECT COUNT(id) as total FROM `fav_product` WHERE cusID = '{$ID}'")->fetch_assoc()["total"];
         $cart_tot = DBHelper::get("SELECT COUNT(id) as total FROM `tbl_customer_cart` WHERE cusID = '{$ID}'")->fetch_assoc()["total"];
    }
	else{
		if(isset($_SESSION["cart"])){
			$cart_tot = count($_SESSION["cart"]);
		}
		else{
			$cart_tot = 0;
		}
	}
	?>
	<!-- Header -->
	<header class="header-v4">
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<!-- Topbar -->
			<div class="top-bar">
				<div class="content-topbar flex-sb-m h-full container">
					<div class="left-top-bar">
						<!-- <?php echo $cmp_info["page_heading"]; ?> -->
					</div>

					<div class="right-top-bar flex-w h-full">

						

						<?php if(isset($_COOKIE["cusID"]) && verifyCustomer()) { ?>

						<a href="<?php if($page == 'index') echo "client/"; ?>wallet" class="flex-c-m trans-04 p-lr-25">
						Wallet
						</a>

						<a href="<?php if($page == 'index') echo "client/"; ?>profile" class="flex-c-m trans-04 p-lr-25">						
							Profile
						</a>

						<a href="<?php if($page == 'index') echo "client/"; ?>action/signout" class="flex-c-m trans-04 p-lr-25">
							Signout
						</a>
						<?php } else {
							?>
						<a href="<?php if($page != 'index') echo "../"; ?>login" class="flex-c-m trans-04 p-lr-25">
						Sign in
						</a>

						<a href="<?php if($page != 'index') echo "../"; ?>register" class="flex-c-m trans-04 p-lr-25">						
							Sign up
						</a>

						<a href="<?php if($page != 'index') echo "../"; ?>admin/seller_login" class="flex-c-m trans-04 p-lr-25">
							Become seller
						</a>
							<?php
						} ?>

					</div>
				</div>
			</div>

			<div class="wrap-menu-desktop how-shadow1">
				<nav class="limiter-menu-desktop container">
					
					<!-- Logo desktop -->		
					<a href="../index" class="logo">
						<img src="<?php if($page == 'index') echo "client/"; ?>images/icons/logo-01.png" alt="IMG-LOGO">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">

						<li >
					<a href="<?php if($page != 'index') echo "../"; ?>index" >Home</a>
				</li>

				
							<li>
								<a href="index">Categories </a>
								<ul class="sub-menu">
								   <?php
								     if($cat->num_rows > 0){
                                         while ($row = $cat->fetch_assoc()) {
                                             ?>
										     <li><a href="<?php if($page == 'index') echo "client/"; ?>product?catID=<?php echo $row["id"];?>"><?php echo ucwords($row["name"]);?></a></li>
										 <?php
                                         }
									 }  
								   ?>
									
								</ul>
							</li>

							<li>
								<a href="<?php if($page == 'index') echo "client/"; ?>product">Shop</a>
							</li>

					
							<li>
								<a href="<?php if($page == 'index') echo "client/"; ?>seller?type=on">Sellers</a>
							</li>

							<?php if(isset($_COOKIE["cusID"]) && verifyCustomer()) { ?>
							<li>
								<a href="<?php if($page == 'index') echo "client/"; ?>orders">Orders</a>
							</li>

							<li>
								<a href="<?php if($page == 'index') echo "client/"; ?>Buy_now">Buy now</a>
							</li>
							
							<?php } ?>

							<li class="label1" data-label1="<?php echo $cart_tot; ?>">
								<a href="<?php if($page == 'index') echo "client/"; ?>shoping-cart">Checkout</a>
							</li>

							<!-- <li>
								<a href="blog">Blog</a>
							</li> -->

							<!-- <li>
								<a href="<?php if($page == 'index') echo "client/"; ?>about">About</a>
							</li> -->

							<li>
								<a href="<?php if($page == 'index') echo "client/"; ?>contact">Contact</a>
							</li>
						</ul>
					</div>	

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>

						<div class="cart_total icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="<?php echo $cart_tot; ?>">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>

						<?php if(isset($_COOKIE["cusID"]) && verifyCustomer()) { ?>

						<a href="<?php if($page == 'index') echo "client/"; ?>product?fav=prod_favs" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="<?php echo $fav_tot; ?>">
							<i class="zmdi zmdi-favorite-outline"></i>
						</a>
                       <?php } ?>

					</div>
				</nav>
			</div>	
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="../index"><img src="<?php if($page == 'index') echo "client/"; ?>images/icons/logo-01.png" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>

				<div class="icon-header-item cart_total cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="<?php echo $cart_tot; ?>">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>

				<?php if(isset($_COOKIE["cusID"]) && verifyCustomer()) { ?>

				

				<a href="<?php if($page == 'index') echo "client/"; ?>product?fav=prod_favs" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="<?php echo $fav_tot; ?>">
					<i class="zmdi zmdi-favorite-outline"></i>
				</a>

				<?php } ?>

			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="topbar-mobile">
				<!-- <li>
					<div class="left-top-bar">
						Free shipping for standard order over $100
					</div>
				</li> -->

				<li style="padding: 8px 0px;;">
					<div class="right-top-bar flex-w h-full">

						<?php if(isset($_COOKIE["cusID"]) && verifyCustomer()) { ?>

						<a href="<?php if($page == 'index') echo "client/"; ?>wallet" style="width:33%; border-left:none; padding:0px;" class="flex-c-m p-lr-10 trans-04">
							Wallet
						</a>

						<a href="<?php if($page == 'index') echo "client/"; ?>profile" style="width:33%; padding:0px;" class="flex-c-m trans-04 p-lr-25">						
							Profile
						</a>

						<a href="<?php if($page == 'index') echo "client/"; ?>action/signout" style="width:34%; border-right:none; padding:0px;" class="flex-c-m trans-04 p-lr-25">
							Signout
						</a>
						<?php } else {
							?>
						<a href="<?php if($page != 'index') echo "../"; ?>login" style="width:31%; border-left:none; padding:0px;" class="flex-c-m trans-04 p-lr-25">
						Sign in
						</a>

						<a href="<?php if($page != 'index') echo "../"; ?>register" style="width:31%; padding:0px;" class="flex-c-m trans-04 p-lr-25">						
							Sign up
						</a>

						<a href="<?php if($page != 'index') echo "../"; ?>admin/seller_login" style="width:38%; border-right:none; padding:0px;" class="flex-c-m trans-04 p-lr-25">
							Become seller
						</a>
							<?php
						} ?>

					</div>
				</li>
			</ul>

			<ul class="main-menu-m">
		       	<li>
					<a href="<?php if($page != 'index') echo "../"; ?>index">Home</a>
				</li>

				<li>
					<a href="#">Categories</a>
					<ul class="sub-menu-m">
					       <?php
						      $cat = DBHelper::get("SELECT * FROM `product_category`;");
								     if($cat->num_rows > 0){
                                         while ($row = $cat->fetch_assoc()) {
                                             ?>
										    <li><a href="<?php if($page == 'index') echo "client/"; ?>product?catID=<?php echo $row["id"];?>"><?php echo ucwords($row["name"]);?></a></li>
										 <?php
                                         }
									 }  
								   ?>
					</ul>
					<span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span>
				</li>

				<li>
					<a href="<?php if($page == 'index') echo "client/"; ?>product">Shop</a>
				</li>

				<li>
					<a href="<?php if($page == 'index') echo "client/"; ?>seller?type=on">Sellers</a>
				</li>

				<?php if(isset($_COOKIE["cusID"]) && verifyCustomer()) { ?>
				<li>
					<a href="<?php if($page == 'index') echo "client/"; ?>orders">Orders</a>
				</li>

				<li>
				   <a href="<?php if($page == 'index') echo "client/"; ?>Buy_now">Buy now</a>
				</li>
				
				<?php } ?>

				<li>
					<a href="<?php if($page == 'index') echo "client/"; ?>shoping-cart" class="label1 rs1" data-label1="<?php echo $cart_tot; ?>">Checkout</a>
				</li>

				<!-- <li>
					<a href="blog">Blog</a>
				</li> -->

				<!-- <li>
					<a href="<?php if($page == 'index') echo "client/"; ?>about">About</a>
				</li> -->

				<li>
					<a href="<?php if($page == 'index') echo "client/"; ?>contact">Contact</a>
				</li>
			</ul>
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="<?php if($page == 'index') echo "client/"; ?>images/icons/icon-close2.png" alt="CLOSE">
				</button>

				<form action="<?php if($page == 'index') echo "client/"; ?>product" class="wrap-search-header flex-w p-l-15" method="post">
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input name="search_product_query" required class="plh3" type="text" name="search" placeholder="Search...">
				</form>
				
			</div>
		</div>
	</header>