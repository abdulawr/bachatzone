<?php
include("include.php");
include("../../mail/sendMail.php");


if(isset($_POST["type"]) && $_POST["type"] == "create_account"){
 // create account

$name = validateInput($_POST["name"]);
$email = validateInput($_POST["email"]);
$mobile = validateInput($_POST["mobile"]);
$cnic = validateInput($_POST["cnic"]);
$username = '';

$shop_name = validateInput($_POST["shop_name"]);
$shop_add = validateInput($_POST["shop_add"]);

$password = Encryption::Encrypt($_POST["password"]);

$name = ucwords($name);

$file = $_FILES["file"];
 
 $check = DBHelper::get("SELECT id FROM supplier WHERE mobile = '{$mobile}' or email = '{$email}' or cnic = '{$cnic}'");
 if($check->num_rows > 0){
  header("Location: ../seller/seller_registration?msg=already");
 }
 else{
    $type = strtolower(explode("/", $file["type"])[1]);
    $img_name = "seller_".$mobile."_".RandomString(20).".".$type;
    $support_type = ["jpg","png","jpeg","gif"];

    if(in_array($type,$support_type)){
        if (move_uploaded_file($file["tmp_name"], "../../images/seller/".$img_name)) {
            
            $qry = "INSERT INTO `supplier`(`name`, `email`, `mobile`, `cnic`,
            `username`, `password`, `image`, `status`, `active`,shop_name,shop_add)
            VALUES (
                '{$name}',
                '{$email}',
                '{$mobile}',
                '{$cnic}',
                '{$username}',
                '{$password}',
                '{$img_name}',
                1,
                1,
                '{$shop_name}',
                '{$shop_add}'
            )";

            DBHelper::set($qry);

            $msg = "Dear <b>".$name."</b> you account has been created successfully. Login into you account and start using our servies.";
            sendMail($email,"Seller account confirmation",$msg);

            header("Location: ../seller/seller_registration?msg=success");
        }
        else{
            header("Location: ../seller/seller_registration?msg=img_error");  
        }
    }
    else{
        header("Location: ../seller/seller_registration?msg=invalid_img");   
    }
 }

}
elseif(isset($_POST["type"]) && $_POST["type"] == "update_acction" && isset($_POST["ID"])){
 // update account
 $ID = validateInput($_POST["ID"]);
 $name = validateInput($_POST["name"]);
 $email = validateInput($_POST["email"]);
 $mobile = validateInput($_POST["mobile"]);
 $cnic = validateInput($_POST["cnic"]);
 $username = validateInput($_POST["username"]);
 $password = Encryption::Encrypt(validateInput($_POST["password"]));

$shop_name = validateInput($_POST["shop_name"]);

$shop_add = validateInput($_POST["shop_add"]);

$mobile_account = DBHelper::escape($_POST["mobile_account"]);
$mobile_account_type = DBHelper::escape($_POST["mobile_account_type"]);
$account_no = DBHelper::escape($_POST["account_no"]);
$account_title = DBHelper::escape($_POST["account_title"]);
$bank_name = DBHelper::escape($_POST["bank_name"]);

 $file = $_FILES["file"];
 $img = $_POST["imageURL"];

 if (!empty($file['name']) && !empty($file['type'])) {
    $org_type = explode(".",$img)[1];
    $type = strtolower(explode("/", $file["type"])[1]);

    if(!empty($img)){
        if($org_type != $type){
            unlink("../../images/seller/".$img);
            $img = explode(".",$img)[0].".".$type;
        }
    }
    else{
        $img = "seller_".$mobile."_".RandomString(20).".".$type;
    }

    move_uploaded_file($file["tmp_name"], "../../images/seller/".$img);
   
 }

 $check = DBHelper::get("SELECT * FROM `bank_account` WHERE holder_id = '{$ID}' and type = 2 LIMIT 1");
 if($check->num_row > 0){
    DBHelper::set("UPDATE `bank_account` SET 
    `ac_no`='{$account_no}',
    `ac_title`='{$account_title}',
    `bank_name`='{$bank_name}'
    WHERE `holder_id` = '{$ID}' and `type` = 2");
 }
 else{
    DBHelper::set("INSERT INTO `bank_account`(`ac_no`, `ac_title`, `bank_name`, `holder_id`, `type`) 
    VALUES ('{$account_no}','{$account_title}','{$bank_name}','{$ID}',2)");
 }

 $qry = "UPDATE `supplier` SET 
 `name`='{$name}',
 `email`='{$email}',
 `mobile`='{$mobile}',
 `cnic`='{$cnic}',
 `shop_name`='{$shop_name}',
 `mobile_account`='{$mobile_account}',
  `mobile_account_type`='{$mobile_account_type}',
 `shop_add`='{$shop_add}',
 `username`='{$username}',
 `password`='{$password}',
 `image`='{$img}' WHERE id = '{$ID}'";
 DBHelper::set($qry);
 header("Location: ../seller/sell_profile?msg=success");   
 exit;
}

?>