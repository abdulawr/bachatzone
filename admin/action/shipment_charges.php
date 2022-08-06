<?php
include("include.php");

if(isset($_GET["type"]) && $_GET["type"] == "deleted"){

    DBHelper::set("delete from shipment_charges where id = '{$_GET["ID"]}'");
    header("Location: ../?p=shipment_charges&msg=success");
    exit;
}

$name = DBHelper::escape(strtolower($_POST["name"]));
$charges = DBHelper::escape(strtolower($_POST["charges"]));

if(DBHelper::escape($_POST["ID"])){
$ID = DBHelper::escape($_POST["ID"]);

  if(DBHelper::set("UPDATE `shipment_charges` SET `city_name`='{$name}',`charges`='{$charges}' WHERE id = '{$ID}'")){
    header("Location: ../?p=shipment_charges&msg=update&ID=".$ID);
   }
   else{
    header("Location: ../?p=shipment_charges&msg=fail&ID=".$ID);
   }

}
else{
$check = DBHelper::get("SELECT * FROM `shipment_charges` WHERE city_name = '{$name}'");
if($check->num_rows > 0){
    header("Location: ../?p=shipment_charges&msg=exist");
}
else{

    if(DBHelper::set("INSERT INTO `shipment_charges`(`city_name`,charges) VALUES ('$name','{$charges}')")){
        header("Location: ../?p=shipment_charges&msg=success");
    }
    else{
        header("Location: ../?p=shipment_charges&msg=fail");
    }
}
}

?>