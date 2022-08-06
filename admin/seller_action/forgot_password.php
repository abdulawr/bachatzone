<?php
include("../../include/conn.php");
include("../../include/DBHelper.php");
include("../../include/Encryption.php");
include("../../include/HelperFunction.php");
include("../../mail/sendMail.php");

if(isset($_POST["sendVerificationCode"])){
    $email = validateInput($_POST["email"]);

    $check = DBHelper::get("SELECT email,id from supplier WHERE email = '{$email}' LIMIT 1");
    if($check->num_rows > 0){
        $code = DBHelper::intCodeRandom(6);
       if(sendMail($email,"Forgot password verification code","Your verification code is: <b>".$code."</b>")){
       $c_ID = $check->fetch_assoc()["id"];
       DBHelper::set("delete from seller_opt where sellID = {$c_ID}");
       DBHelper::set("INSERT INTO `seller_opt`(`code`, `sellID`)
        VALUES ('{$code}',{$c_ID})");
      
        header("Location: ../seller/forgot_password?msg=success&type=ver_code&s_ID=".$c_ID);
       }
       else{
        header("Location: ../seller/forgot_password?msg=send_code_error");
       }
    }
    else{
        header("Location: ../seller/forgot_password?msg=invalidEmail");
    }
}

elseif(isset($_POST["verify_email_code"])){
   $ID = DBHelper::escape($_POST["c_ID"]);
   $OTP = DBHelper::escape($_POST["OTP"]);
   $check = DBHelper::get("select * from seller_opt where code = '{$OTP}' and sellID = {$ID}");
    
   if($check->num_rows > 0){
      DBHelper::set("delete from seller_opt where sellID = {$ID}");
      header("Location: ../seller/forgot_password?msg=success_otp&type=new_password&sd1=".Encryption::Encrypt($ID)); 
   }
   else{
    header("Location: ../seller/forgot_password?msg=wrgCode&type=ver_code&s_ID=".$ID);
   }
   exit;

}

elseif(isset($_POST["new_password"])){
   $ID = Encryption::Decrypt($_POST["c_ID"]);
   $password = Encryption::Encrypt($_POST["password"]);
   $check = DBHelper::get("SELECT * from supplier WHERE id = '{$ID}' LIMIT 1")->fetch_assoc();

   if(DBHelper::set("UPDATE supplier SET password = '{$password}' WHERE id = {$ID}")){
    $message = "Dear <b>".$check["name"]."</b><br>
    Your account password is changed on: ".date("d-m-Y");
    sendMail($check["email"],"Alert, Account password changed",$message);
    header("Location: ../seller_login?msg=pasChanged");
   }
   else{
    header("Location: ../seller_login?msg=failNPass");
   }
}


?>