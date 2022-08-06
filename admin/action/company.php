<?php
include("include.php");
$name = DBHelper::escape(strtolower($_POST["name"]));

if(DBHelper::escape($_POST["ID"])){
$ID = DBHelper::escape($_POST["ID"]);

  if(DBHelper::set("UPDATE `company` SET `name`='{$name}' WHERE id = '{$ID}'")){
    header("Location: ../?p=companies&msg=update&ID=".$ID);
   }
   else{
    header("Location: ../?p=companies&msg=fail&ID=".$ID);
   }

}
else{
$check = DBHelper::get("SELECT * FROM `company` WHERE name = '{$name}'");
if($check->num_rows > 0){
    header("Location: ../?p=companies&msg=exist");
}
else{

    if(DBHelper::set("INSERT INTO `company`(`name`) VALUES ('$name')")){
        header("Location: ../?p=companies&msg=success");
    }
    else{
        header("Location: ../?p=companies&msg=fail");
    }

}
}

?>