<?php
include("include.php");
$type = DBHelper::escape($_GET["type"]);
$orderID = DBHelper::escape($_GET["id"]);

if($type == 'completed'){

$orderList = DBHelper::get("SELECT * FROM `orderlist` WHERE `orderID` = '{$orderID}'");
$i = 0;
while($row = $orderList->fetch_assoc()){
if($row["status"] == 2){
    $i++;
}
if($row["paid_status"] == '0' && $row["status"] == 4){

   $prds = DBHelper::get("SELECT product.*,qty as orderQty,orderlist.suppID,orderlist.supplier_amont,orderlist.prdID FROM `orderlist` INNER JOIN product on product.id = prdID WHERE orderlist.id = '{$row["id"]}'")->fetch_assoc(); 
   $prdPrice = $prds["supplier_amont"];

$sall_account = DBHelper::get("SELECT id from saller_account WHERE sall_ID = '{$row["suppID"]}'");
if($sall_account->num_rows > 0){
 DBHelper::set("UPDATE saller_account set amount = amount + $prdPrice  WHERE sall_ID = '{$row["suppID"]}'");
}
else{
 DBHelper::set("INSERT INTO `saller_account`(`amount`, `sall_ID`) VALUES ('{$prdPrice}','{$row["suppID"]}')");
}

DBHelper::set("INSERT INTO `saller_account_transaction`(
    `amount`,
    `prdID`, 
    `order_qty`, 
    `orderlist_ID`,
    sall_ID)
    VALUES (
    '{$prdPrice}',
        '{$row["prdID"]}',
        '{$row["qty"]}',
        '{$row["id"]}',
        '{$row["suppID"]}'
    )");

     DBHelper::set("UPDATE orderlist set paid_status = 1,status = 5 where id  = '{$row["id"]}'");
    
    } 
    
    }

    $orderData = DBHelper::get("SELECT * FROM `orders` WHERE id = '{$orderID}'")->fetch_assoc();
    if($i == $orderData["prod_count"]){
        //basit
        DBHelper::set("UPDATE orders set `orderStatus` = '5' WHERE id = '{$orderID}'");
    }
    else{
        DBHelper::set("UPDATE orders set `orderStatus` = '4',payment_Type=1 WHERE id = '{$orderID}'");
    }

    $customerInfo = DBHelper::get("SELECT `referby_ID` FROM `tbl_customer` WHERE id = '{$orderData["cusID"]}' and referby_ID != 0");
    if($customerInfo->num_rows > 0){
      $paymentAMT = ($orderData["total_with_disount"] / 100) * 5;
      $referby_ID = $customerInfo->fetch_assoc()["referby_ID"];
      
      DBHelper::set("INSERT INTO `tbl_customer_credit_trans`
      (`amount`, `cusID`, `tran_type`, `type`) 
      VALUES (
      '{$paymentAMT}',
      '{$referby_ID}',
      6,
      1
      )");

      $ckk = DBHelper::get("SELECT id FROM `tbl_customer_credit_total` WHERE `cusID` = '{$referby_ID}'");
      if($ckk->num_rows > 0){
         DBHelper::set("UPDATE tbl_customer_credit_total set `amount` = amount + $paymentAMT where `cusID` = '{$referby_ID}' and type = 1");
      }
      else{
         DBHelper::set("INSERT INTO `tbl_customer_credit_total`
         (`amount`, `cusID`, `type`)
         VALUES (
         '{$paymentAMT}',
         '{$referby_ID}',
         '1'
         )");
      }
      
    }
}
elseif($type == 'orderReturn'){
    DBHelper::set("UPDATE orders set `orderStatus` = '5' WHERE id = '{$orderID}'");
}

header("Location: ../?p=orderDetails&id=".$orderID."&msg=succ")

?>