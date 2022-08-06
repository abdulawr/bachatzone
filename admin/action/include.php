<?php
session_start();
if (isset($_SESSION['start']) && (time() - $_SESSION['start'] > 5400)) {
    session_unset(); 
    session_destroy(); 
    header("Location: ../login?msg=expired");
    exit;
}
$_SESSION['start'] = time();

if(!isset($_SESSION["isLogin"])){
    header("Location: ../login?msg=expired");
 }


include("../../include/conn.php");
include("../../include/DBHelper.php");
include("../../include/Encryption.php");
include("../../include/HelperFunction.php");
?>