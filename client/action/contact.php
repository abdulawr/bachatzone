<?php
include("include.php");
$subject = DBHelper::escape($_POST["subject"]);
$message = DBHelper::escape($_POST["msg"]);
$ID = DBHelper::escape($_POST["ID"]);

if(DBHelper::set("INSERT INTO `message`(`subject`, `message`, `type`, `senderID`) 
VALUES ('{$subject}','{$message}',1,'{$ID}')")){
  header("Location: ../contact?msg=success");
}
else{
    header("Location: ../contact?msg=fail");
}
?>