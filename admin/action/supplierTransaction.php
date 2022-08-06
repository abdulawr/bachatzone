<?php
include("include.php");

$amount = validateInput($_POST["amount"]);
$supID = validateInput($_POST["supID"]);
$tranType = validateInput($_POST["tranType"]);
$balance = validateInput($_POST["balance"]);
$des = validateInput($_POST["description"]);

if($tranType == 3){
    if ($amount <= $balance && $amount > 0) {
        DBHelper::set("UPDATE buy_now_saller_account SET amount = amount - $amount WHERE sallID = '{$supID}'");
        $qry = "INSERT INTO `saller_account_transaction`(`amount`, `prdID`, `order_qty`, `orderlist_ID`, `sall_ID`, `pay_type`,des) 
        VALUES (
        '{$amount}',
            '0',
            '0',
            '0',
            '{$supID}',
            '{$tranType}',
            '{$des}'
        )";
        DBHelper::set($qry);
        header("Location: ../?p=supplier_profile&msg=success&id=".$supID);
        exit;
    }
    else{
        header("Location: ../?p=supplier_profile&msg=inval_ablss&id=".$supID);
        exit;
    }
}
else{
    if ($amount <= $balance && $amount > 0) {
        $qry = "INSERT INTO `saller_account_transaction`(`amount`, `prdID`, `order_qty`, `orderlist_ID`, `sall_ID`, `pay_type`,des) 
VALUES (
'{$amount}',
    '0',
    '0',
    '0',
    '{$supID}',
    '{$tranType}',
    '{$des}'
)";

        $check = DBHelper::get("SELECT * FROM `saller_account` WHERE `sall_ID` = '{$supID}'");
        if ($check->num_rows > 0) {
            if ($tranType == '1') {
                // add
                $supp_ac_qr = "UPDATE saller_account SET amount = amount + $amount WHERE sall_ID = '{$supID}'";
            } else {
                if ($check->fetch_assoc()["amount"] < $amount) {
                    header("Location: ../?p=supplier_profile&msg=invalid_amount&id=".$supID);
                    exit;
                }
                // sub
                $supp_ac_qr = "UPDATE saller_account SET amount = amount - $amount WHERE sall_ID = '{$supID}'";
            }
        } else {
            if ($tranType == '1') {
                $supp_ac_qr = "INSERT INTO `saller_account`(`amount`, `sall_ID`) VALUES ('{$amount}','{$supID}')";
            } else {
                header("Location: ../?p=supplier_profile&msg=bal_zero&id=".$supID);
                exit;
            }
        }

        if (DBHelper::set($supp_ac_qr)) {
            DBHelper::set($qry);
            header("Location: ../?p=supplier_profile&msg=success&id=".$supID);
            exit;
        } else {
            header("Location: ../?p=supplier_profile&msg=error&id=".$supID);
            exit;
        }
    } else {
        header("Location: ../?p=supplier_profile&msg=inval_ablss&id=".$supID);
        exit;
    }
}

?>