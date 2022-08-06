<?php
include("include.php");

if(isset($_GET["tps"])){
if (isset($_COOKIE["cusID"]) && verifyCustomer()) {
    $ID = DBHelper::escape($_GET["ID"]);
    DBHelper::set("DELETE FROM `tbl_customer_cart` WHERE id = '{$ID}'");
}else{
   $prID = $_GET["prID"];
   $cart = $_SESSION["cart"];
   unset($cart[$prID]);
   $_SESSION["cart"] = $cart;
}

header("Location: ../shoping-cart?msg=deleted");
exit;
}

else{
    $cusID = Encryption::Decrypt($_COOKIE["cusID"]);
 
    $prdIDs = $_POST["prdID"];
    $prd_qty = $_POST["qty"];
    $prd_color = $_POST["color"];
    $prd_size = $_POST["size"];

    for ($i = 0; $i < count($prdIDs); $i++) {
        $qq = "UPDATE tbl_customer_cart SET qty = $prd_qty[$i],
        color = '{$prd_color[$i]}',
        size = '{$prd_size[$i]}'
         WHERE prdID = '{$prdIDs[$i]}' and cusID = '{$cusID}'";
        
        DBHelper::set($qq);
    }

    header("Location: ../shoping-cart?msg=sucss");
}

?>