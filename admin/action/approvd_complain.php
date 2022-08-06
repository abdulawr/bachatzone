<?php
include("include.php");

$desc  = DBHelper::escape($_POST["desc"]);
$compID  = DBHelper::escape($_POST["compID"]);

$qr = "UPDATE order_return SET `company_response` = '{$desc}', status = '2' WHERE id = '{$compID}'";

if(DBHelper::set($qr)){
header("Location: ../?p=view_return_det&msg=success&cmpID=".$compID);
}
else{
    header("Location: ../?p=view_return_det&msg=fail&cmpID=".$compID);
}

?>