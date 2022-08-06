<?php
// if(!isset($_COOKIE["cusID"])){
// 	header("Location: ../login?msg=invalid_access");
// 	exit;
// }

session_start();

if (isset($page) && $page == "index") {
    $page = 'index';
    include("include/conn.php");
    include("include/DBHelper.php");
    include("include/Encryption.php");
    include("include/HelperFunction.php");
}
else{
	include("../include/conn.php");
    include("../include/DBHelper.php");
    include("../include/Encryption.php");
    include("../include/HelperFunction.php");
}

if (isset($_COOKIE["cusID"]) && verifyCustomer() && isset($_SESSION["cart"])) {
   
	$ID =   Encryption::Decrypt($_COOKIE["cusID"]);
	if(isset($_SESSION["cart"])){
		$cart = $_SESSION["cart"];
		foreach($cart as $key=>$value){
			$qty  = $value["qty"];
			$type  = $value["type"];
			$color  = $value["color"];
			$size  = $value["size"];
			
			$check = DBHelper::get("SELECT * FROM `tbl_customer_cart` WHERE prdID = '{$key}' and cusID = '{$ID}'");
			if ($check->num_rows > 0) {
				$data = $check->fetch_assoc();
				$qty = $qty + $data["qty"];
				DBHelper::set("UPDATE tbl_customer_cart SET qty = '{$qty}',color='$color',size='$size' WHERE id = '{$data["id"]}'");
				$cart_tot = DBHelper::get("SELECT COUNT(id) as total FROM `tbl_customer_cart` WHERE cusID = '{$ID}'")->fetch_assoc()["total"];
				
			} else {
				
				DBHelper::set("INSERT INTO `tbl_customer_cart` (`prdID`, `cusID`,`qty`,type,color,size) 
		   VALUES ($key,$ID,$qty,$type,'$color','$size')");
		   
				$cart_tot = DBHelper::get("SELECT COUNT(id) as total FROM `tbl_customer_cart` WHERE cusID = '{$ID}'")->fetch_assoc()["total"];
				
			}
		}
		unset($_SESSION["cart"]);
	}
	else{
		unset($_SESSION["cart"]);
	}
}

if(isset($page) && $page == "index"){
	$page = 'index';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>BachatZone</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
<link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
<link rel="manifest" href="images/favicon/site.webmanifest">
<link rel="mask-icon" href="images/favicon/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="client/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="client/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="client/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="client/fonts/linearicons-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="client/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="client/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="client/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="client/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="client/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="client/vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="client/vendor/MagnificPopup/magnific-popup.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="client/vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="client/css/util.css">
	<link rel="stylesheet" type="text/css" href="client/css/main.css">
	<link rel="stylesheet" type="text/css" href="client/css/style.css">
	<link rel="stylesheet" type="text/css" href="client/css/owl.carousel.min.css">
<!--===============================================================================================-->
</head>
<?php

}
else{
	$page = 'null';

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>BachatZone</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

<!--===============================================================================================-->	
<link rel="apple-touch-icon" sizes="180x180" href="../images/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../images/favicon/favicon-16x16.png">
<link rel="manifest" href="../images/favicon/site.webmanifest">
<link rel="mask-icon" href="../images/favicon/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/MagnificPopup/magnific-popup.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
<!--===============================================================================================-->
</head>
<?php
} 

if (isset($_COOKIE["cusID"]) && verifyCustomer()) {
	$ID =   Encryption::Decrypt($_COOKIE["cusID"]);
}
?>