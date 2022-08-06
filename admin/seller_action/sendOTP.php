<?php
include("include.php");
include("../../mail/sendMail.php");

if(isset($_POST["type"]) && $_POST["type"] == "otp_ver"){

    $email = validateInput($_POST["email"]);
    $opt = validateInput($_POST["opt"]);

    $check = DBHelper::get("SELECT * FROM `account_email_otp` WHERE code = '{$opt}' and email = '{$email}' and type = 2 limit 1");
    if($check->num_rows > 0){
        DBHelper::set("DELETE FROM `account_email_otp` WHERE email = '{$email}'");
        echo "success";
    }
    else{
     echo "fail";
    }

}
else{
    $email = validateInput($_POST["email"]);
    $otp = RandomNum();
    sendMail($email, "Email verification OTP", "Your OTP is : <b>".$otp."</b>");
    DBHelper::set("DELETE FROM `account_email_otp` WHERE email = '{$email}'");
    DBHelper::set("INSERT INTO `account_email_otp`(`code`, `type`, `email`) VALUES ('{$otp}',2,'{$email}')");
    echo json_encode(["status"=>1]);
}
?>