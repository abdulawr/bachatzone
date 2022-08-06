<?php
include("include.php");

$qty = validateInput($_POST["qty"]);
$prdID = validateInput($_POST["prdID"]);
$type = validateInput($_POST["type"]);
$status = validateInput($_POST["status"]);
$color = (isset($_POST["color"])) ?  validateInput($_POST["color"]) : "";
$size = (isset($_POST["size"])) ? validateInput($_POST["size"]) : "";

if ($status == 0) {
    if (isset($_COOKIE["cusID"]) && verifyCustomer()) {
        $ID = Encryption::Decrypt($_COOKIE["cusID"]);
        $check = DBHelper::get("SELECT * FROM `tbl_customer_cart` WHERE prdID = '{$prdID}' and cusID = '{$ID}'");
        if ($check->num_rows > 0) {
            $data = $check->fetch_assoc();
            $qty = $qty + $data["qty"];
            DBHelper::set("UPDATE tbl_customer_cart SET qty = '{$qty}',color='{$color}',size='{$size}' WHERE id = '{$data["id"]}'");

            $cart_tot = DBHelper::get("SELECT COUNT(id) as total FROM `tbl_customer_cart` WHERE cusID = '{$ID}'")->fetch_assoc()["total"];
            echo json_encode(["status"=>1,"chat"=>$cart_tot]);
        } else {
            DBHelper::set("INSERT INTO `tbl_customer_cart`
   (`prdID`, `cusID`,`qty`,type,size,color) 
   VALUES ($prdID,$ID,$qty,$type,'$size','$color')");

            $cart_tot = DBHelper::get("SELECT COUNT(id) as total FROM `tbl_customer_cart` WHERE cusID = '{$ID}'")->fetch_assoc()["total"];
            echo json_encode(["status"=>1,"chat"=>$cart_tot]);
        }
    } else {
        // customer is not sign in
        if (isset($_SESSION["cart"])) {
            $cart = $_SESSION["cart"];
            if (isset($cart[$prdID])) {
                $cart[$prdID] = ["qty"=>$cart[$prdID]["qty"]+ $qty,"type"=>$type,"size"=>$size,"color"=>$color];
            } else {
                $cart[$prdID] = ["qty"=>$qty,"type"=>$type,"color"=>$color,'size'=>$size];
            }

            $_SESSION["cart"] = $cart;
        } else {
            $cart = [];
            $cart[$prdID] = ["qty"=>$qty,"type"=>$type,"color"=>$color,'size'=>$size];
            $_SESSION["cart"] = $cart;
        }

        echo json_encode(["status"=>1,"chat"=>count($_SESSION["cart"])]);
    }
}
else{
  // buy now
  
$ID = Encryption::Decrypt($_COOKIE["cusID"]);
$product = DBHelper::get("SELECT * FROM `product` WHERE id = '{$prdID}'")->fetch_assoc();
$row = $product;
$row["or_qty"] = $qty;
$discount = calculateDiscount($row);

$dis_totLa = $discount["discount"];
$prr = ($product["price"] - $dis_totLa) * $qty;
$price = $product["price"] * $qty;

$ID = Encryption::Decrypt($_COOKIE["cusID"]);
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


if($balance > $discount["customer"]){
    $customer_pay = abs($price - $discount["customer"]);
}
elseif($balance < $discount["customer"] && $balance > 0){
 $customer_pay =  $price - $balance;
 $discount["company"] = $discount["company"] + ($discount["customer"] - $balance);
 $discount["customer"] = $discount["customer"] - ($discount["customer"] - $balance);
}
else{
    $customer_pay = $price;
    $discount["company"] += $discount["customer"];
    $discount["customer"] = 0;
}

 $qry = DBHelper::set("INSERT INTO `buy_now_product`(
    `prdID`, 
    `cusID`, 
    `qty`, 
    `discount`,
    `suppID`,
    `company_earning`,
    customer_payable,
    saller_payable,
    color,
    size
    ) 
    VALUES (
        '{$prdID}',
        '{$ID}',
        '{$qty}',
        '{$discount["customer"]}',
        '{$product["supplierID"]}',
        '{$discount["company"]}',
        '{$customer_pay}',
        '{$prr}',
        '{$color}',
        '{$size}'
        )");

  $cart_tot = DBHelper::get("SELECT COUNT(id) as total FROM `tbl_customer_cart` WHERE cusID = '{$ID}'")->fetch_assoc()["total"];
  echo json_encode(["status"=>1,"chat"=>$cart_tot]);
}

?>