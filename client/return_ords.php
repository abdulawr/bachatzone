<?php
if(!isset($_COOKIE["cusID"]) && verifyCustomer()){
	?>
	<script>
		location.replace("../login?msg=invalid_access")
	</script>
	<?php
}

include("include/header.php"); 

$data = json_decode(DBHelper::get("SELECT * FROM `json_data` WHERE status = 'cmp_info'")->fetch_assoc()["content"],true);
?>
<body class="animsition">
	
<?php
 include("include/nav.php");
 include("include/cart.php");
 ?>

	<!-- Content page -->
	<section class="bg0 p-t-40 p-b-50">
		<div class="container">

        <div class="rounded" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px; border-left: 4px solid #707070; padding:20px">
  

        <table>
                <tr>
                    <th style="width: 120px;">Order no:</th>
                    <td><?php echo Encryption::Decrypt($_GET["orderID"]);?></td>
                </tr>

                <tr>
                    <th style="width: 120px;">Title:</th>
                    <td> <?php echo $data["name"];?></td>
                </tr>

                <tr>
                    <th style="width: 120px;">Return address:</th>
                    <td> <?php echo $data["address"];?></td>
                </tr>

                
                <tr>
                    <th style="width: 120px;">Contact:</th>
                    <td> <?php echo $data["contact"];?></td>
                </tr>

               
               
            </table>

            <br><br>

<form action="action/return_order.php" method="post">

<div class="form-group">
    <label for="exampleFormControlTextarea1"><b>Description</b></label>
    <textarea name="cus_desc" required class="form-control" id="exampleFormControlTextarea1" rows="6"></textarea>
  </div>

  <input type="hidden" name="orderID" value="<?php echo  Encryption::Decrypt(DBHelper::escape($_GET["orderID"])) ?>">

  <button type="submit" class="btn btn-info">Submit</button>
</form>

	
</div>

		</div>
	</section>	
	

    <?php
   include("include/footer.php");
   include("include/links.php");
    ?>

</body>
</html>