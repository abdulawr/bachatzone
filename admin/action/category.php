<?php
include("include.php");
$name = DBHelper::escape(strtolower($_POST["name"]));

if(DBHelper::escape($_POST["ID"])){
$ID = DBHelper::escape($_POST["ID"]);

  if(DBHelper::set("UPDATE `product_category` SET `name`='{$name}' WHERE id = '{$ID}'")){
    header("Location: ../?p=category&msg=update&ID=".$ID);
   }
   else{
    header("Location: ../?p=category&msg=fail&ID=".$ID);
   }

}
else{
$check = DBHelper::get("SELECT * FROM `product_category` WHERE name = '{$name}'");
if($check->num_rows > 0){
    header("Location: ../?p=category&msg=exist");
}
else{

    if(DBHelper::set("INSERT INTO `product_category`(`name`) VALUES ('$name')")){
        header("Location: ../?p=category&msg=success");
    }
    else{
        header("Location: ../?p=category&msg=fail");
    }

}
}

?>