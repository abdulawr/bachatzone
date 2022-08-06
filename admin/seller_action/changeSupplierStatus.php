<?php
include("include.php");
$ordlstID = DBHelper::escape($_GET["orderlsID"]);
$ords = DBHelper::get("SELECT product.*,qty as orderQty,orderlist.suppID,orderlist.prdID FROM `orderlist` INNER JOIN product on product.id = prdID WHERE orderlist.id = '{$ordlstID}'")->fetch_assoc();

DBHelper::set("UPDATE orderlist set `status` = 1,paid_status=1 where id = '{$ordlstID}'");

if ($ords["wallet_amount_status"] == '1') {
    if ($ords["wallet_amount_type"] == '1') {
        //percentage
        $prdPrice = ($ords["price"] / 100) * $ords["allow_wallet_per"];
        $prdPrice = $ords["price"] - $prdPrice;
    } else {
        //value
        $prdPrice = ($ords["price"] - $ords["allow_wallet_per"]) * $ords["orderQty"];
    }
}
else{
    $prdPrice = $ords["price"];
}

$sall_account = DBHelper::get("SELECT id from saller_account WHERE sall_ID = '{$ords["suppID"]}'");
if($sall_account->num_rows > 0){
 DBHelper::set("UPDATE saller_account set amount = amount + $prdPrice  WHERE sall_ID = '{$ords["suppID"]}'");
}
else{
 DBHelper::set("INSERT INTO `saller_account`(`amount`, `sall_ID`) VALUES ('{$prdPrice}','{$ords["suppID"]}')");
}

DBHelper::set("INSERT INTO `saller_account_transaction`(
    `amount`,
    `prdID`, 
    `order_qty`, 
    `orderlist_ID`,
    sall_ID)
    VALUES (
    '{$prdPrice}',
        '{$ords["prdID"]}',
        '{$ords["orderQty"]}',
        '{$ordlstID}',
        '{$ords["suppID"]}'
    )");

header("Location: ../seller/sell_dashboard?msg=del_suc");
?>