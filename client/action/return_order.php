<?php
include("include.php");
$cus_desc = DBHelper::escape($_POST['cus_desc']);
$orderID = DBHelper::escape($_POST['orderID']);
$cusID =   Encryption::Decrypt($_COOKIE["cusID"]);

if(DBHelper::set("INSERT INTO `order_return`(`cusID`, `orderID`, `comment`, `status`, `company_response`) VALUES (
    '{$cusID}',
         '{$orderID}',
   '{$cus_desc}',
    0,
    ''
)")){

    header("Location: ../orders?msg=sucess&orderID=".$orderID);
}
else{
 header("Location: ../orders?msg=fail&orderID=".$orderID);
}

?>