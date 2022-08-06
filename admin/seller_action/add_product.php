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
    header("Location: ../seller/product_list?msg=deleted");
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
$wallet_amt_type = DBHelper::escape($_POST["wallet_amt_type"]);
$cmpID = DBHelper::escape($_POST["cmpID"]);
$wallet_amount_used = (isset($_POST["wallet_amount_used"])) ? DBHelper::escape($_POST["wallet_amount_used"]) : 0;

$main_img = $_FILES["main_img"];
$file = $_FILES["main_img"];

$check = "select id from product 
WHERE title = '{$title}' AND
supplierID = '{$supplierID}' AND
categoryID = '{$prdCategory}' AND
cmpID = '{$cmpID}' AND
price = '{$price}'";

if(DBHelper::get($check)->num_rows > 0){
    header("Location: ../seller/sell_add_product?msg=exist");
}

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
        addedBy,
        status,
        color,
        size
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
            '1',
            '99',
            '{$color}',
            '{$size}'
        )";
        DBHelper::set($qry);

        header("Location: ../seller/sell_add_product?msg=success");
    } else {
        header("Location: ../seller/sell_add_product?msg=fail");
    }

?>