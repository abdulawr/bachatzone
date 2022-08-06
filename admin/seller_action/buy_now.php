<?php
include("include.php");
$ordlstID = DBHelper::escape($_GET["orderlsID"]);
$buy_now = DBHelper::get("SELECT * FROM `buy_now_product` where id = '{$ordlstID}'")->fetch_assoc();
$sallerID = $buy_now["suppID"];
$amount = $buy_now["saller_payable"];

DBHelper::set("UPDATE buy_now_product set `status` = 1 where id = '{$ordlstID}'");

$check = DBHelper::get("SELECT * FROM `saller_account` WHERE sall_ID = '{$sallerID}' and type = 1");
if($check->num_rows > 0){
  DBHelper::set("UPDATE `saller_account` SET amount = amount + {$amount} where sall_ID = '{$sallerID}' and type = 1");
}
else{
  DBHelper::set("INSERT INTO `saller_account`(`amount`, `sall_ID`, `type`) VALUES ('{$amount}','{$sallerID}',1)");
}

DBHelper::set("INSERT INTO `saller_account_transaction`
(`amount`, `prdID`, `order_qty`, `orderlist_ID`,`sall_ID`,`des`, `buy_now_id`)
VALUES (
   '{$amount}',
    '{$buy_now["prdID"]}',
    '{$buy_now["qty"]}',
     0,
    '{$sallerID}',
    'Supplier earning through buy now',
    '{$ordlstID}'
)");

$cmp_earning = $buy_now["company_earning"];
$check = DBHelper::get("SELECT * FROM `buy_now_saller_account` WHERE sallID = '{$sallerID}'");
if($check->num_rows > 0){
  DBHelper::set("UPDATE `buy_now_saller_account` SET amount = amount + {$cmp_earning} where sallID = '{$sallerID}'");
}
else{
  DBHelper::set("INSERT INTO `buy_now_saller_account`(`amount`, `sallID`) VALUES ('{$cmp_earning}','{$sallerID}')");
}

DBHelper::set("INSERT INTO `buy_now_saller_account_tran`(`cmp_earning`, `buy_now_id`,sellID,prdID)
VALUES ('{$cmp_earning}','{$ordlstID}','{$sallerID}','{$buy_now["prdID"]}')");



header("Location: ../seller/sell_dashboard?msg=del_suc");
?>