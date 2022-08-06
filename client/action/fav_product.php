<?php
include("include.php");

$prdID = DBHelper::escape($_POST["ID"]);
$status = $_POST["status"];
$ID = Encryption::Decrypt($_COOKIE["cusID"]);

if($status == "1"){
 // delete product
 DBHelper::set("DELETE FROM `fav_product` WHERE `productID` = '{$prdID}' and `cusID` = '{$ID}'");
 echo '1';
}
else{
    // product
    DBHelper::set("INSERT INTO `fav_product`(`cusID`, `productID`) VALUES ('{$ID}','{$prdID}')");
    echo '1';
}

?>