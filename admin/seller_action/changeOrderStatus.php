<?php
include("include.php");
$ID = $_SESSION["data"]["id"];
$orderID = DBHelper::escape($_GET["id"]);
$status = DBHelper::escape($_GET["status"]);
$order = DBHelper::get("select * from orders where id = '{$orderID}'")->fetch_assoc();
$prod_count = $order["prod_count"];

if($status == '4'){
    // completed by customer
    $check = DBHelper::get("SELECT id FROM `orderlist` WHERE orderID = '{$orderID}' and status in(4,2)");
    $cnt = $check->num_rows + 1;
    if($cnt == $prod_count){
        DBHelper::set("UPDATE orders set orderStatus = 3 WHERE id = '{$orderID}'");
    }
}
elseif($status == '2'){
    // completed by customer
    $check = DBHelper::get("SELECT id FROM `orderlist` WHERE orderID = '{$orderID}' and status = 2");
    $cnt = $check->num_rows + 1;
    if($cnt == $prod_count){
        DBHelper::set("UPDATE orders set orderStatus = 5 WHERE id = '{$orderID}'"); 
    }
}

if(DBHelper::set("UPDATE orderlist SET status = '{$status}' WHERE orderID = '{$orderID}' and suppID = '{$ID}'")){
    header("Location: ../seller/sell_dashboard?msg=success");
}
else{
    header("Location: ../seller/sell_dashboard?msg=error");
}
?>