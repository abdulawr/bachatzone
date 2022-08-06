<?php
include("include.php");

if(isset($_GET["type"]) && $_GET["type"] == "delet_prd"){
    $ID = DBHelper::escape($_GET["ID"]);
    $status = DBHelper::escape($_GET["status"]);

    if($status == '99'){
        DBHelper::set("delete from product where id = '{$ID}'");
    }
    else{
        DBHelper::set("update product set isdelete = '1' where id = '{$ID}'");
    }

    header("Location: ../?p=product_list&msg=deleted");
    exit;
}
elseif(isset($_GET["type"]) && $_GET["type"] == "approved_prod"){
    $ID = DBHelper::escape($_GET["ID"]);
    DBHelper::set("UPDATE product SET status = 1 WHERE id = '{$ID}'");
    header("Location: ../?p=product_list&msg=approved");
    exit;
}

$title = DBHelper::escape($_POST["title"]);
$color = DBHelper::escape($_POST["color"]);
$size = DBHelper::escape($_POST["size"]);
$supplierID = DBHelper::escape($_POST["supplierID"]);
$prdCategory = DBHelper::escape($_POST["prdCategory"]);
$price = DBHelper::escape($_POST["price"]);
$quantity = DBHelper::escape($_POST["quantity"]);
$allow_wallet_percent = DBHelper::escape($_POST["allow_wallet_percent"]);
$content = DBHelper::escape($_POST["content"]);
$wallet_amt_type = isset($_POST["wallet_amt_type"]) ? DBHelper::escape($_POST["wallet_amt_type"]) : 0;
$cmpID = DBHelper::escape($_POST["cmpID"]);
$wallet_amount_used = (isset($_POST["wallet_amount_used"])) ? DBHelper::escape($_POST["wallet_amount_used"]) : 0;

$main_img = $_FILES["main_img"];
$file = $_FILES["main_img"];

if(isset($_POST["update_row"]) && isset($_POST["ID"])){

    $ID = $_POST["ID"];
    $imag_link = $_POST["imag_link"];

    if (!empty($file['name']) && !empty($file['type'])) {
        $org_type = explode(".", $imag_link)[1];
        $type = strtolower(explode("/", $file["type"])[1]);

        if ($org_type != $type) {
            unlink("../../images/product/".$imag_link);
            $imag_link = explode(".", $imag_link)[0].".".$type;
        }
        move_uploaded_file($file["tmp_name"], "../../images/product/".$imag_link);
    }

    $qry = "UPDATE `product` SET
    `title`='{$title}',
    `cmpID`='{$cmpID}',
    `color`='{$color}',
    `size`='{$size}',
    `supplierID`='{$supplierID}',
    `categoryID`='{$prdCategory}',
    `price`='{$price}',
    `wallet_amount_type`='{$wallet_amt_type}',
    `quantity`='{$quantity}',
    `allow_wallet_per`='{$allow_wallet_percent}',
    `wallet_amount_status`='{$wallet_amount_used}',
    `content`='{$content}',
    `main_img`='{$imag_link}'
     WHERE id = '{$ID}'";
    DBHelper::set($qry);

    header("Location: ../?p=add_product&msg=updated&ID=".$ID);

}
else{
    $folder = RandomString(15)."_".$supplierID."_".$prdCategory."_".time();
    if (!file_exists("../../images/product/".$folder)) {
        mkdir("../../images/product/".$folder);
    }

    $type = strtolower(explode("/", $main_img["type"])[1]);
    $main_path = "main_".RandomString(20)."_".time().".".$type;
    $other_image_json = [];
    if (move_uploaded_file($main_img["tmp_name"], "../../images/product/".$folder."/".$main_path)) {
        $total = count($_FILES['other_img']['name']);
        for ($i=0 ; $i < $total ; $i++) {
            $tmpFilePath = $_FILES['other_img']['tmp_name'][$i];
            $tt = strtolower(explode("/", $_FILES['other_img']['type'][$i])[1]);
            $file_names = "other_img_".RandomString(25)."_.".$tt;
            if (move_uploaded_file($tmpFilePath, "../../images/product/".$folder."/".$file_names)) {
                array_push($other_image_json, $folder."/".$file_names);
            }
        }

        $main_path = $folder."/".$main_path;

        $other_image_json = DBHelper::escape(json_encode($other_image_json));
  
        $qry = "INSERT INTO `product`(
        `title`, 
        `cmpID`, 
        `supplierID`, 
        `categoryID`,
        `price`, 
        `quantity`, 
        `allow_wallet_per`, 
        `wallet_amount_status`, 
        `content`,
         `main_img`, 
        `other_images`,
        `wallet_amount_type`,
        `color`,
        `size`
        )
        VALUES (
            '{$title}',
            '{$cmpID}',
            '{$supplierID}',
            '{$prdCategory}',
            '{$price}',
            '{$quantity}',
            '{$allow_wallet_percent}',
            '{$wallet_amount_used}',
            '{$content}',
            '{$main_path}',
            '{$other_image_json}',
            '{$wallet_amt_type}',
            '{$color}',
            '{$size}'
        )";
    
        DBHelper::set($qry);

        header("Location: ../?p=add_product&msg=success");
    } else {
        header("Location: ../?p=add_product&msg=fail");
    }
}

?>