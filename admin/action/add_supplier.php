<?php
include("include.php");
include("../../mail/sendMail.php");

$name = DBHelper::escape($_POST["name"]);
$mobile = DBHelper::escape($_POST["mobile"]);
$cnic = DBHelper::escape($_POST["cnic"]);
$email = DBHelper::escape($_POST["email"]);
$username = DBHelper::escape($_POST["username"]);
$shop_name = DBHelper::escape($_POST["shop_name"]);
$shop_add = DBHelper::escape($_POST["shop_add"]);

$sallerType = DBHelper::escape($_POST["sallerType"]);

$password = $_POST["password"];
$eng_pass = Encryption::Encrypt($password);

$mobile_account = DBHelper::escape($_POST["mobile_account"]);
$mobile_account_type = DBHelper::escape($_POST["mobile_account_type"]);
$account_no = DBHelper::escape($_POST["account_no"]);
$account_title = DBHelper::escape($_POST["account_title"]);
$bank_name = DBHelper::escape($_POST["bank_name"]);

if(isset($_POST["ID"])){
  $ID = $_POST["ID"];
  $img = $_POST["update_link"];
  $file = $_FILES["file"];

  if (!empty($file['name']) && !empty($file['type'])) {

    if(!empty($img)){
      $org_type = explode(".",$img)[1];
      $type = strtolower(explode("/", $file["type"])[1]);
      if($org_type != $type){
        unlink("../../images/admin/".$img);
        $img = explode(".",$img)[0].".".$type;
    }

    }
    else{
      $type = strtolower(explode("/", $file["type"])[1]);
      $img = "seller_".$mobile."_".RandomString(20).".".$type;
    }

    move_uploaded_file($file["tmp_name"], "../../images/seller/".$img);

  }

  $qqr = "UPDATE `supplier` SET 
  `name`='{$name}',
  `email`='{$email}',
  `mobile`='{$mobile}',
  `shop_name`='{$shop_name}',
  `shop_add`='{$shop_add}',
  `cnic`='{$cnic}',
  `image`='{$img}',
  `password`='{$eng_pass}',
  `username`='{$username}',
  `sallerType`='{$sallerType}',
  `mobile_account`='{$mobile_account}',
  `mobile_account_type`='{$mobile_account_type}'
  WHERE id = '{$ID}'";

   if(DBHelper::set($qqr)){

    DBHelper::set("UPDATE `bank_account` SET 
    `ac_no`='{$account_no}',
    `ac_title`='{$account_title}',
    `bank_name`='{$bank_name}'
    WHERE `holder_id` = '{$ID}' and `type` = 2");

    header("Location: ../?p=add_supplier&msg=update&ID=".$ID);
   }
   else{
    header("Location: ../?p=add_supplier&msg=fail");
   }
}
else{

  $check = DBHelper::get("SELECT id FROM supplier WHERE mobile = '{$mobile}' or email = '{$email}' or cnic = '{$cnic}'");
  if($check->num_rows > 0){
      header("Location: ../?p=add_supplier&msg=exist");
  }
  else{

    $file = $_FILES["file"];
    $type = strtolower(explode("/", $file["type"])[1]);
    $img_name = "seller_".$mobile."_".RandomString(20).".".$type;
    move_uploaded_file($file["tmp_name"], "../../images/seller/".$img_name);

      if(DBHelper::set("INSERT INTO `supplier`(sallerType,`name`, `email`, `mobile`, `cnic`,password,username,image,shop_name,shop_add,mobile_account,mobile_account_type)
      VALUES ('{$sallerType}','{$name}','{$email}','{$mobile}','{$cnic}','{$eng_pass}','{$username}','{$img_name}','{$shop_name}','{$shop_add}','{$mobile_account}','{$mobile_account_type}')")){
       
       DBHelper::set("INSERT INTO `bank_account`(`ac_no`, `ac_title`, `bank_name`, `holder_id`, `type`) 
VALUES ('{$account_no}','{$account_title}','{$bank_name}','{$con->insert_id}',2)");

       sendMail($email,"Account credentials ","Your account has been created successfull.<br><b>Username: </b><span style='margin-left:10'>".$email."</span><br><b>Password: </b><span style='margin-left:10'>".$password."</span>");
      header("Location: ../?p=add_supplier&msg=success");
      }
      else{
        header("Location: ../?p=add_supplier&msg=fail");
      }
  }
}


?>