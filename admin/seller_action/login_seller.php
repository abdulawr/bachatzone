<?php
include("include.php");

if(isset($_GET["logout"]))
{
    session_unset(); 
    session_destroy(); 
     ?>
    <script>location.replace("../seller_login?msg=signout");</script>
    <?php
    exit;
}
else{
    $username = validateInput($_POST["username"]);
    $password = Encryption::Encrypt(validateInput($_POST["password"]));
    $chk = DBHelper::get("SELECT * FROM `supplier` WHERE (email = '{$username}' or mobile = '{$username}') and password = '{$password}'");

    if ($chk->num_rows > 0) {
        $chk = $chk->fetch_assoc();
        $_SESSION["supplier_login"] = true;
        $_SESSION['data'] = $chk; 
        ?>
   <script>location.replace("../seller/sell_dashboard");</script>
   <?php
    } else {
        header("Location: ../seller_login?msg=invalid_record");
    }
}

?>