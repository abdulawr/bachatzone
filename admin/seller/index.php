<?php
  session_start();
  if(!isset($_SESSION["supplier_login"]) && !isset($_SESSION["data"])){
   header("Location: ../seller_login?msg=expired");
   exit;
  }
  else{
      ?>
      <script>
          location.replace("sell_dashboard");
      </script>
      <?php
  }
?>