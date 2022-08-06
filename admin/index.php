<?php
session_start();
if (isset($_SESSION['start']) && (time() - $_SESSION['start'] > 5400)) {
    session_unset(); 
    session_destroy(); 
    header("Location: login?msg=expired");
    exit;
}
$_SESSION['start'] = time();
?>
<style>
    .error{
      vertical-align: middle;
      text-align: center;
      width: 70%;
      border: 2px solid #7a182b;
      padding: 10px 30px;
    }
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
} 

.container {
    display: flex;
    align-items: center;
    height: 100%;
    justify-content: center;
}



</style>
<?php
if(isset($_GET["p"]) && !empty($_GET["p"]) && file_exists("view/".$_GET["p"].".php")){
   
    if(isset($_SESSION["isLogin"])){
        $page = $_GET['p'];
        include("include/include.php");
     }
     else{
         header("Location: login");
     }

}
else{
    if(!isset($_GET["p"]) && !isset($_SESSION["isLogin"]))
    header("Location: login");
    ?>
    <div class="container">
    <h1 class="error">
          Invalid Url (No such page found)
      </h1>
   </div>
    <?php
}
?>