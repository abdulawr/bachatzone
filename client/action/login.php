<?php
include("include.php");

if(isset($_POST["submit"])){
	$email = validateInput($_POST["email"]);
	$pass = Encryption::Encrypt($_POST["pass"]);
	
	$search = DBHelper::get("SELECT * from tbl_customer WHERE password = '{$pass}' and (email = '{$email}' or mobile = '{$email}') LIMIT 1;");
	if($search->num_rows > 0){
      $search = $search->fetch_assoc();
	  $cusID = Encryption::Encrypt($search["id"]);
	  $email = Encryption::Encrypt($search["email"]);
	  $mobile = Encryption::Encrypt($search["mobile"]);
	  setcookie('cusID', $cusID, time() + (86400 * 7), "/"); // 86400 = 1 day
	  setcookie('t1', $email, time() + (86400 * 7), "/"); // 86400 = 1 day
	  setcookie('t2', $mobile, time() + (86400 * 7), "/"); // 86400 = 1 day

	  if(isset($_POST["pr"]))
	  {
		?>
		<script>
			location.replace("../product-detail?ID=<?php echo $_POST["pr"]; ?>");
		</script>
		<?php
	  }
	  else {
          ?>
	  <script>
		  location.replace("../../index");
	  </script>
	  <?php
      }
	}
	else{
        ?>
        <script>
            alert("Invalid email or password");
            location.replace("../../login");
        </script>
        <?php
	}
}

?>