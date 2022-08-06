<?php 
 function validateInput($value)
 {
   $data = trim($value);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = $GLOBALS["con"]-> real_escape_string($data);
  return $data;
 }


 function is_english($str)
 {
   if (strlen($str) != strlen(utf8_decode($str))) {
     return false;
   } else {
     return true;
   }
 }

 function print_data($arr){
   echo "<pre>";
   print_r($arr);
   echo "</pre>";
 }
 
function RandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function RandomNum($length = 6) {
  $characters = '0123456789';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

function verifyCustomer(){
  $con=$GLOBALS["con"];
  if(isset($_COOKIE["cusID"])){
    $cusID = Encryption::Decrypt($_COOKIE["cusID"]);
    $email = Encryption::Decrypt($_COOKIE["t1"]);
    $mobile = Encryption::Decrypt($_COOKIE["t2"]);
    $check = DBHelper::get("SELECT id FROM `tbl_customer` WHERE id = '{$cusID}' and email = '{$email}' and mobile = '{$mobile}' limit 1");
    
    if($check->num_rows > 0){
      return true;
    }
    else{
      return false;
    }

  }
  else{
    return false;
  }
}

function msg($content,$st = 1){
  // $st = 1 success and 2 = for error
  if($st == '1'){
    echo '<div id="success" class="alert alert-success"  style="padding:8px 10px; role="alert">'.$content.'</div>';
  }
  else{
    echo '<div  id="error" class="alert alert-danger"  style="padding:8px 10px; role="alert">'.$content.'</div>';
  }

}

function calculateDiscount($row){
  if(trim($row["wallet_amount_status"]) == "1"){  			
    if($row["wallet_amount_type"] == "1"){
      // percentage
      $customer_discount = ($row["allow_wallet_per"] / 100) * 70;									
      $customer_discount =  ($row["price"] / 100) * $customer_discount;
      $customer_discount *= $row["or_qty"];									
     
      $company_discount = ($row["allow_wallet_per"] / 100) * 30;									
      $company_discount =  ($row["price"] / 100) * $company_discount;
      $company_discount *= $row["or_qty"];		
    }
    else{                // valeu
       $customer_discount = (($row["allow_wallet_per"] / 100) * 70) * $row["or_qty"];
       $company_discount = (($row["allow_wallet_per"] / 100) * 30) * $row["or_qty"];
    }
    $tot_disc = $customer_discount + $company_discount;
    return ["customer"=>$customer_discount,"company"=>$company_discount,"discount"=>$tot_disc];
  }
  else{
    return ["customer"=>0,"company"=>0,"discount"=>0];
  }
}

?>