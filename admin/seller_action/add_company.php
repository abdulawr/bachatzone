<?php
include("include.php");
$name = DBHelper::escape(strtolower($_POST["name"]));
$ID = $_SESSION["data"]["id"];

if(DBHelper::escape($_POST["ID"])){
$ID = DBHelper::escape($_POST["ID"]);

  if(DBHelper::set("UPDATE `company` SET `name`='{$name}' WHERE id = '{$ID}'")){
    header("Location: ../seller/product_company?msg=update&ID=".$ID);
   }
   else{
    header("Location: ../seller/product_company?msg=fail&ID=".$ID);
   }

}
else{
$check = DBHelper::get("SELECT * FROM `company` WHERE name = '{$name}'");
if($check->num_rows > 0){
    header("Location: ../seller/product_company?msg=exist");
}
else{

    if(DBHelper::set("INSERT INTO `company`(`name`,addedBy) VALUES ('$name','{$ID}')")){
        header("Location: ../seller/product_company?msg=success");
    }
    else{
        header("Location: ../seller/product_company?msg=fail");
    }

}
}

?>