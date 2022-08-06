<?php
include("include.php");

   $account_status = $_POST["account_status"];
   $ID = validateInput($_POST["ID"]);
   $support_type = ["jpg","png","jpeg","gif"];

    $name = validateInput($_POST["name"]);
    $email = validateInput($_POST["email"]);
    $mobile = validateInput($_POST["mobile"]);
    $gender = validateInput($_POST["gender"]);
    $password = Encryption::Encrypt(validateInput($_POST["password"]));
  
  // Permenant Address
    $per_h_number = validateInput($_POST["per_h_number"]);
    $per_street_no = validateInput($_POST["per_street_no"]);
    $per_city = validateInput($_POST["per_city"]);
    $per_tehsil = validateInput($_POST["per_tehsil"]);
    $per_district = validateInput($_POST["per_district"]);
    $per_postal_code = validateInput($_POST["per_postal_code"]);
   
    $jazz_easy_mobi_no = validateInput($_POST["jazz_easy_mobi_no"]);
    $jazz_easy_mobi_type = validateInput($_POST["jazz_easy_mobi_type"]);
    $bank_ac_no = validateInput($_POST["bank_ac_no"]);
    $bank_name = validateInput($_POST["bank_name"]);
    $bank_account_title = validateInput($_POST["bank_account_title"]);

    //Present Address
    $pre_h_no = validateInput($_POST["pre_h_no"]);
    $pre_st_no = validateInput($_POST["pre_st_no"]);
    $pre_city = validateInput($_POST["pre_district"]);
    $pre_tehsil = validateInput($_POST["pre_district"]);
    $pre_district = validateInput($_POST["pre_district"]);
    $prr_postal_code = validateInput($_POST["prr_postal_code"]);

    $file = $_FILES["file"];
    $image_name = '';
    if($account_status == '0'){
        // fresh account
        DBHelper::set("INSERT INTO `bank_account`(ac_no, `ac_title`, `bank_name`, `holder_id`, `type`)
         VALUES ('{$bank_ac_no}','{$bank_account_title}','{$bank_name}','{$ID}',1)");

        DBHelper::set("INSERT INTO `tbl_address`(`house_no`, `street_no`, `city`, `tehsil`, `district`, `postal_code`, `type`, `status`,holderID)
        VALUES ('{$per_h_number}','{$per_street_no}','{$per_city}','{$per_tehsil}','{$per_district}','{$per_postal_code}',1,1,$ID)");

        DBHelper::set("INSERT INTO `tbl_address`(`house_no`, `street_no`, `city`, `tehsil`, `district`, `postal_code`, `type`, `status`,holderID)
        VALUES ('{$pre_h_no}','{$pre_st_no}','{$pre_city}','{$pre_tehsil}','{$pre_district}','{$per_postal_code}',1,2,$ID)");

        if (!empty($file['name']) && !empty($file['type'])) {
            $type = strtolower(explode("/", $file["type"])[1]);
            $image_name = "master_team_".$mobile."_".RandomString(20).".".$type;

            if (in_array($type, $support_type)) {
             move_uploaded_file($file["tmp_name"], "../../images/customer/".$image_name);
            }
            else{
                $image_name = '';
            }
        }

    }
    else{
        // updating old account
        DBHelper::set("UPDATE `bank_account` SET `ac_no`='{$bank_ac_no}',`ac_title`='{$bank_account_title}',
        `bank_name`='{$bank_name}' WHERE holder_id = '{$ID}' and type = 1");

        DBHelper::set("UPDATE `tbl_address` SET
        `house_no`='{$per_h_number}',
        `street_no`='{$per_street_no}',
        `city`='{$per_city}',
        `tehsil`='{$per_tehsil}',
        `district`='{$per_district}',
        `postal_code`='{$per_postal_code}'
        WHERE holderID = '{$ID}' and type = '1' and status = 1");

        DBHelper::set("UPDATE `tbl_address` SET
        `house_no`='{$pre_h_no}',
        `street_no`='{$pre_st_no}',
        `city`='{$pre_city}',
        `tehsil`='{$pre_tehsil}',
        `district`='{$pre_district}',
        `postal_code`='{$per_postal_code}'
        WHERE holderID = '{$ID}' and type = '2' and status = 1");
        $image_name = $_POST["imageLink"];

        if (!empty($file['name']) && !empty($file['type'])) {
            $type = strtolower(explode("/", $file["type"])[1]);

            $org_type = explode(".",$image_name)[1];
            $type = strtolower(explode("/", $file["type"])[1]);

            if (in_array($type, $support_type)) {
                if($org_type != $type){
                    unlink("../../images/customer/".$img_name);
                    $image_name = explode(".",$image_name)[0].".".$type;
                }
            move_uploaded_file($file["tmp_name"], "../../images/customer/".$image_name);
            }
          
        }

    }

    DBHelper::set("UPDATE `tbl_customer` SET 
    `email`='{$email}',
    `password`='{$password}',
    `profile_status`='1',
    `name`='{$name}',
    `mobile`='{$mobile}',
    `gender`='{$gender}',
    `image`='{$image_name}',
    `jazz_easy_mobi_no`='{$jazz_easy_mobi_no}',
    `jazz_easy_mobi_type`='{$jazz_easy_mobi_type}'
    WHERE id = {$ID}");

    
    header("Location: ../profile?msg=success");

?>