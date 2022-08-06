<?php
include("include.php");

$f_name = DBHelper::escape(validateInput($_POST["f_name"]));
$l_name = DBHelper::escape(validateInput($_POST["l_name"]));
$email = DBHelper::escape(validateInput($_POST["email"]));
$mobile = DBHelper::escape(validateInput($_POST["mobile"]));
$gender = DBHelper::escape(validateInput($_POST["gender"]));
$age = DBHelper::escape(validateInput($_POST["age"]));
$address = DBHelper::escape(validateInput($_POST["address"]));
$mobile_account = DBHelper::escape(validateInput($_POST["mobile_account"]));
$mobile_account_type = DBHelper::escape(validateInput($_POST["mobile_account_type"]));
$account_no = DBHelper::escape(validateInput($_POST["account_no"]));
$account_title = DBHelper::escape(validateInput($_POST["account_title"]));
$bank_name = DBHelper::escape(validateInput($_POST["bank_name"]));
$cnic = DBHelper::escape(validateInput($_POST["cnic"]));
$file = $_FILES["file"];


if(isset($_POST["update_row"]) && isset($_POST["ID"])){
    $ID = $_POST["ID"];
    $dd = DBHelper::get("SELECT * FROM investor WHERE id = '{$ID}'")->fetch_assoc();
    $img_name = $dd["image"];

    if (!empty($file['name']) && !empty($file['type'])) {
        $org_type = explode(".",$img_name)[1];
        $type = strtolower(explode("/", $file["type"])[1]);

        if($org_type != $type){
            unlink("../../images/master_team/".$img_name);
            $img_name = explode(".",$img_name)[0].".".$type;
        }

        move_uploaded_file($file["tmp_name"], "../../images/master_team/".$img_name);

    }

    $qry = "UPDATE `investor` SET 
    `fname`='{$f_name}',
    `lname`='{$l_name}',
    `email`='{$email}',
    `mobile`='{$mobile}',
    `gender`='{$gender}',
    `age`='{$age}',
    `address`='{$address}',
    `image`='{$img_name}',
    `mobile_account`='{$mobile_account}',
    `cnic`='{$cnic}',
    `mobile_account_type`='{$mobile_account_type}'
    WHERE id = '{$ID}'";
    
    $bank_qry = "UPDATE `bank_account` SET 
    `ac_no`='{$account_no}',
    `ac_title`='{$account_title}',
    `bank_name`='{$bank_name}',
    WHERE `holder_id` = '{$ID}'";

    DBHelper::get($qry);
    DBHelper::get($bank_qry);
    $msg = "succ_updated&ID=".$ID;

}
else{
    $check = DBHelper::get("SELECT id FROM investor WHERE email = '{$email}' or mobile = '{$mobile}' or cnic = '{$cnic}'");
  
        if($check->num_rows <= 0){
          
         if(!empty($file['name']) && !empty($file['type'])){
            $type = strtolower(explode("/", $file["type"])[1]);
            $img_name = "master_team_".$mobile."_".RandomString(20).".".$type;
            $support_type = ["jpg","png","jpeg","gif"];

            if (in_array($type, $support_type)) {

                if (move_uploaded_file($file["tmp_name"], "../../images/master_team/".$img_name)) {
                }
                else{
                    $msg = "img_uploading_error";
                    header("Location: ../?p=add_master_team&msg=".$msg);
                    exit;
                }

            }
            else{
                $msg = "invalid_file";
                header("Location: ../?p=add_master_team&msg=".$msg);
                exit;
            }

         }
         else{
            $img_name = '';
         }
        
         $qry = "INSERT INTO `investor`(
            `fname`, 
            `lname`,
            `email`, 
            `mobile`, 
            `gender`,
            `age`, 
            `address`,
            `mobile_account`,
            `cnic`,
            `type`,
            `image`,
            `mobile_account_type`)
            VALUES (
            '{$f_name}',
                '{$l_name}',
                '{$email}',
                '{$mobile}',
                '{$gender}',
                '{$age}',
                '{$address}',
                '{$mobile_account}',
                '{$cnic}',
                '1',
                '{$img_name}',
                '{$mobile_account_type}'
            )";

          DBHelper::get($qry);
          $ID = $con->insert_id;
          DBHelper::set("INSERT INTO `tbl_customer_credit_total`(`amount`, `cusID`, `type`)
          VALUES (0,'{$ID}',3)");
          $bank_qry = "INSERT INTO `bank_account`(
            `ac_no`,
            `ac_title`,
            `bank_name`, 
            `holder_id`)
            VALUES (
            '{$account_no}',
                '{$account_title}',
                '{$bank_name}',
                '{$ID}'
            )";

          DBHelper::get($bank_qry);
          $msg = "succ_insert";

        }
        else{
          $msg = "already_exist";
        }
}

header("Location: ../?p=add_master_team&msg=".$msg);

?>
