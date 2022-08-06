<?php
include("include.php");

if(isset($_POST["sendVerificationCode"])){
    $email = validateInput($_POST["email"]);
    $check = DBHelper::get("SELECT email,id from tbl_customer WHERE email = '{$email}' LIMIT 1");
    if($check->num_rows > 0){
        $code = DBHelper::intCodeRandom(6);
       if(sendMail($email,"Forgot password verification code","Your verification code is: <b>".$code."</b>")){
       $c_ID = $check->fetch_assoc()["id"];
       DBHelper::set("delete from tbl_cus_verification_code where cusID = {$c_ID}");
       DBHelper::set("INSERT INTO `tbl_cus_verification_code`(`code`, `cusID`)
        VALUES ('{$code}',{$c_ID})");
      
        header("Location: ../../forgotPass?msg=success&type=ver_code&s_ID=".$c_ID);
       }
       else{
        header("Location: ../../forgotPass?msg=send_code_error");
       }
    }
    else{
        header("Location: ../../forgotPass?msg=invalidEmail");
    }
}

elseif(isset($_POST["verify_email_code"])){
   $ID = DBHelper::escape($_POST["c_ID"]);
   $OTP = DBHelper::escape($_POST["OTP"]);
   $check = DBHelper::get("select * from tbl_cus_verification_code where code = '{$OTP}' and cusID = {$ID}");
    
   if($check->num_rows > 0){
      DBHelper::set("delete from tbl_cus_verification_code where cusID = {$ID}");
      header("Location: ../../forgotPass?msg=success_otp&type=new_password&sd1=".Encryption::Encrypt($ID)); 
   }
   else{
    header("Location: ../../forgotPass?msg=wrgCode");
   }
   exit;

}

elseif(isset($_POST["new_password"])){
   $ID = Encryption::Decrypt($_POST["c_ID"]);
   $password = Encryption::Encrypt($_POST["password"]);
   $check = DBHelper::get("SELECT * from tbl_customer WHERE id = '{$ID}' LIMIT 1")->fetch_assoc();

   if(DBHelper::set("UPDATE tbl_customer SET password = '{$password}' WHERE id = {$ID}")){
    $message = "Dear <b>".$check["name"]."</b><br>
    Your account password is changed on: ".date("d-m-Y");
    sendMail($check["email"],"Alert, Account password changed",$message);
    header("Location: ../../index?msg=pasChanged");
   }
   else{
    header("Location: ../../index?msg=failNPass");
   }
}


?>