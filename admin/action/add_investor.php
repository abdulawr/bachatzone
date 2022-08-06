<?php
include("include.php");

$f_name = DBHelper::escape(validateInput($_POST["f_name"]));
$l_name = DBHelper::escape(validateInput($_POST["l_name"]));
$email = DBHelper::escape(validateInput($_POST["email"]));
$mobile = DBHelper::escape(validateInput($_POST["mobile"]));
$gender = DBHelper::escape(validateInput($_POST["gender"]));
$age = DBHelper::escape(validateInput($_POST["age"]));
$address = DBHelper::escape(validateInput($_POST["address"]));
$mobile_account = DBHelper::escape(validateInput($_POST["mobile_account"]));
$mobile_account_type = DBHelper::escape(validateInput($_POST["mobile_account_type"]));
$account_no = DBHelper::escape(validateInput($_POST["account_no"]));
$account_title = DBHelper::escape(validateInput($_POST["account_title"]));
$bank_name = DBHelper::escape(validateInput($_POST["bank_name"]));
$cnic = DBHelper::escape(validateInput($_POST["cnic"]));

if(isset($_POST["update_row"]) && isset($_POST["ID"])){
    $ID = $_POST["ID"];
    $qry = "UPDATE `investor` SET 
    `fname`='{$f_name}',
    `lname`='{$l_name}',
    `email`='{$email}',
    `mobile`='{$mobile}',
    `gender`='{$gender}',
    `age`='{$age}',
    `address`='{$address}',
    `mobile_account`='{$mobile_account}',
    `cnic`='{$cnic}',
    `mobile_account_type`='{$mobile_account_type}'
    WHERE id = '{$ID}'";
    
    $bank_qry = "UPDATE `bank_account` SET 
    `ac_no`='{$account_no}',
    `ac_title`='{$account_title}',
    `bank_name`='{$bank_name}',
    WHERE `holder_id` = '{$ID}'";

    DBHelper::set($qry);
    DBHelper::set($bank_qry);
    $msg = "succ_updated&ID=".$ID;

}
else{
    $check = DBHelper::get("SELECT id FROM investor WHERE email = '{$email}' or mobile = '{$mobile}' or cnic = '{$cnic}'");
    $qry = "INSERT INTO `investor`(
        `fname`, 
        `lname`,
        `email`, 
        `mobile`, 
        `gender`,
        `age`, 
        `address`,
        `mobile_account`,
        `cnic`,
        `mobile_account_type`)
        VALUES (
        '{$f_name}',
            '{$l_name}',
            '{$email}',
            '{$mobile}',
            '{$gender}',
            '{$age}',
            '{$address}',
            '{$mobile_account}',
            '{$cnic}',
            '{$mobile_account_type}'
        )";

        if($check->num_rows <= 0){
          
          DBHelper::set($qry);
          $ID = $con->insert_id;
          DBHelper::set("INSERT INTO `tbl_customer_credit_total`(`amount`, `cusID`, `type`)
          VALUES (0,'{$ID}',2)");
          $bank_qry = "INSERT INTO `bank_account`(
            `ac_no`,
            `ac_title`,
            `bank_name`, 
            `holder_id`)
            VALUES (
            '{$account_no}',
                '{$account_title}',
                '{$bank_name}',
                '{$ID}'
            )";

          DBHelper::get($bank_qry);
          $msg = "succ_insert";
        }
        else{
          $msg = "already_exist";
        }
}

header("Location: ../?p=add_investor&msg=".$msg);

?>
