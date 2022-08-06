<?php
include("include.php");

if(isset($_GET["logout"]))
{
    session_unset(); 
    session_destroy(); 
     ?>
    <script>location.replace("../login?msg=signout");</script>
    <?php
    exit;
}
else{
    $username = DBHelper::escape(trim($_POST["username"]));
    $password = Encryption::Encrypt($_POST["password"]);
    $chk = DBHelper::get("SELECT * FROM `admin` WHERE username = '{$username}' and password = '{$password}'");

    if ($chk->num_rows > 0) {
        $chk = $chk->fetch_assoc();
        $_SESSION["isLogin"] = true;
        $_SESSION['data'] = $chk; 
        ?>
   <script>location.replace("../?p=dashboard");</script>
   <?php
    } else {
        header("Location: ../login?msg=invalid_record");
    }
}

?>