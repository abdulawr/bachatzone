<?php
include("include.php");

$name = DBHelper::escape($_POST["name"]);
$mobile = DBHelper::escape($_POST["mobile"]);
$cnic = DBHelper::escape($_POST["cnic"]);
$email = DBHelper::escape($_POST["email"]);
$username = DBHelper::escape($_POST["username"]);
$address = DBHelper::escape($_POST["address"]);
$password = Encryption::Encrypt(DBHelper::escape($_POST["password"]));
$date = date("Y-m-d");
$file = $_FILES["file"];

if(isset($_POST["update_profile"])){

    $id = $_POST["id"];
    $img = $_POST["img"];

    if(!empty($file['name']) && !empty($file['type'])){
        $org_type = explode(".",$img)[1];
        $type = strtolower(explode("/", $file["type"])[1]);

        if($org_type != $type){
            unlink("../../images/admin/".$img);
            $img = explode(".",$img)[0].".".$type;
        }

        $support_type = ["jpg","png","jpeg","gif"];
        if (in_array($type, $support_type)) {

            if (move_uploaded_file($file["tmp_name"], "../../images/admin/".$img)) {
            }
            else {
                $msg = "img_uploading_error";
            }

        }
        else {
                $msg = "invalid_file";
        }

    }
   
    $qry = "UPDATE admin SET
    name = '{$name}',
    mobile = '{$mobile}',
    cnic  = '{$cnic}',
    address = '{$address}',
    password = '{$password}',
    image = '{$img}',
    email = '{$email}' WHERE id = $id";

    $msg = (DBHelper::set($qry)) ? "success" : "fail";

    header("Location: ../?p=update_profile&msg=".$msg);
   exit;
}
else{
    $admin = DBHelper::get("SELECT id from admin WHERE cnic = '{$cnic}' or username = '{$username}' or mobile = '{$mobile}'");
    if ($admin->num_rows <= 0) {
        $type = strtolower(explode("/", $file["type"])[1]);
        $img_name = "admin_".$mobile."_".RandomString(20).".".$type;
        $support_type = ["jpg","png","jpeg","gif"];

        if (in_array($type, $support_type)) {
            if (move_uploaded_file($file["tmp_name"], "../../images/admin/".$img_name)) {
                $qry = "INSERT INTO
           `admin`(
               `name`, 
               `mobile`, 
               `cnic`,
               `address`, 
               `password`,
               `image`, 
               `email`, 
               `username`,
                date
                ) VALUES (
                    '{$name}',
                    '{$mobile}',
                    '{$cnic}',
                    '{$address}',
                    '{$password}',
                    '{$img_name}',
                    '{$email}',
                    '{$username}',
                    '{$date}'
                )";
                $msg = (DBHelper::set($qry)) ? "success" : "fail";
            } else {
                $msg = "img_uploading_error";
            }
        } else {
            $msg = "invalid_file";
        }
    } else {
        $msg = "already_exist";
    }

    header("Location: ../?p=add_admin&msg=".$msg);
}

?>