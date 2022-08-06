<?php
include("include.php");

$rating = validateInput($_POST["rating"]);
$prdID = validateInput($_POST["prdID"]);
$review = validateInput($_POST["review"]);
$ID = Encryption::Decrypt($_COOKIE["cusID"]);

$ratings = DBHelper::get("SELECT sum(rating) as total FROM `product_review` WHERE prdID = {$prdID}")->fetch_assoc();

if($rating <= 0){
    $rating = 1;
}

if(DBHelper::set("INSERT INTO `product_review`(`rating`, `review`, `cusID`, `prdID`) 
VALUES ('{$rating}','{$review}','{$ID}','{$prdID}')")){

 $total = $ratings["total"] + $rating;
 DBHelper::set("UPDATE product set rating = '{$total}' WHERE id = '{$prdID}'");
 header("Location: ../product-detail?ID=".$prdID."&msg=success");
}
else{
   header("Location: ../product-detail?ID=".$prdID."&msg=error");
}

?>