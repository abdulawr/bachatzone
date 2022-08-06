<?php
include("include.php");

if(isset($_GET["type"]) && $_GET["type"] == 'delete_file'){
    $ID = DBHelper::escape($_GET["ID"]);
    DBHelper::set("DELETE FROM `advertisement` WHERE id = '$ID'");
    header("Location: ../?p=advertisement&msg=del_succes");
    exit;
}

$sub_title = DBHelper::escape($_POST["sub_title"]); 
$title = DBHelper::escape($_POST["title"]);

if(!file_exists("../../images/advertisement")){mkdir("../../images/advertisement");}

if(isset($_POST["ID"])){
    // update
    $file = $_FILES["file"];
    $id = $_POST["ID"];
    $img = $_POST["imageUrl"];

    if (!empty($file['name']) && !empty($file['type'])) {
        $org_type = explode(".",$img)[1];
        $type = strtolower(explode("/", $file["type"])[1]);
        
        if($org_type != $type){
            unlink("../../images/advertisement/".$img);
            $img = explode(".",$img)[0].".".$type;
        }

        move_uploaded_file($file["tmp_name"], "../../images/advertisement/".$img);
    }

    if(DBHelper::set("UPDATE `advertisement` SET 
    `title`='{$title}',
    `sub_title`='{$sub_title}',
    `image`='{$img}' WHERE id = '{$id}'")){
      header("Location: ../?p=advertisement&msg=sus_up");
    }
    else{
     header("Location: ../?p=advertisement&msg=uplo_error");
    }

}
else{
   $file = $_FILES["file"];
   $type = strtolower(explode("/", $file["type"])[1]);

   list($width, $height) = getimagesize($file["tmp_name"]);

   if($width == '1920' && $height == '930'){
        $image_name = "ad_".RandomString(30)."_".time().".".$type;
        if(move_uploaded_file($file["tmp_name"],"../../images/advertisement/".$image_name)){
    
            DBHelper::set("INSERT INTO `advertisement`(`title`, `sub_title`, `image`)
            VALUES ('{$title}','{$sub_title}','{$image_name}')");
            
            header("Location: ../?p=advertisement&msg=success");
        }
        else{
            header("Location: ../?p=advertisement&msg=uplo_error");
        }
   }
   else{
      header("Location: ../?p=advertisement&msg=invalid");
   }

  
}

?>