<?php 
if (!empty($page)) {
    include("../include/conn.php");
    include("../include/DBHelper.php");
    include("../include/Encryption.php");
    include("../include/HelperFunction.php");
    include("../mail/sendMail.php");

    include_once("include/header.php");
    include_once("include/nav.php");
    include_once("include/slider.php");
    echo '<div class="content-wrapper">';
    require_once("view/".$page.'.php');
    include_once("include/footer.php");
    echo '</div></body></html>';
}
else{
    exit("Direct access is not allowed");
}
?>