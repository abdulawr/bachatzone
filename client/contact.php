<?php include("include/header.php"); ?>
<body class="animsition">
	
<?php
 include("include/nav.php");
 include("include/cart.php");

 $data = json_decode(DBHelper::get("SELECT * FROM `json_data` WHERE status = 'cmp_info'")->fetch_assoc()["content"],true);

 ?>

	<!-- Content page -->
	<section class="bg0 p-t-104 p-b-116">
		<div class="container">
			<div class="flex-w flex-tr">

			<?php if(isset($_COOKIE["cusID"]) && verifyCustomer()) { ?>
				<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
					<?php
                      if (isset($_GET["msg"])) {
                          switch ($_GET["msg"]) {
                              case 'success':
                                msg("Message send successfully", 1);
                                break;
                              case 'fail':
                                msg("Something went wrong try again", 2);
                                break;
                          }
                      }
                    ?>
					<form method="post" action="action/contact">
						<h4 class="mtext-105 cl2 txt-center p-b-30">
							Send Us A Message
						</h4>

						<input type="hidden" name="ID" value="<?php echo $ID;?>">

						<div class="bor8 m-b-20 how-pos4-parent">
							<input required class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="subject" placeholder="Subject..">
							<img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON">
						</div>

						<div class="bor8 m-b-30">
							<textarea required class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="msg" placeholder="How Can We Help?"></textarea>
						</div>

						<button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
							Send
						</button>
					</form>
				</div>
				<?php } ?>

				<div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-map-marker"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Address
							</span>

							<p class="stext-115 cl6 size-213 p-t-18">
								<?php echo $data["address"]; ?>
							</p>
						</div>
					</div>

					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-phone-handset"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Lets Talk
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
							<?php echo $data["contact"]; ?>
							</p>
						</div>
					</div>

					<div class="flex-w w-full">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-envelope"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Sale Support
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
							<?php echo $data["email"]; ?>
							</p>
						</div>
					</div>
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