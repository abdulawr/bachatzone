<?php
include("include.php");

$data = json_encode($_POST);
if(DBHelper::set("UPDATE `json_data` SET `content`='{$data}' WHERE `status` = 'cmp_info'")){
    header("Location: ../?p=companyInfo&msg=1");
}
else{
    header("Location: ../?p=companyInfo&msg=0");
}

?>