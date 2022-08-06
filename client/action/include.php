<?php
// if(!isset($_COOKIE["cusID"])){
// 	header("../login?msg=invalid_access");
// }
session_start();
include("../../include/conn.php");
include("../../include/DBHelper.php");
include("../../include/Encryption.php");
include("../../include/HelperFunction.php");
include("../../mail/sendMail.php");
?>