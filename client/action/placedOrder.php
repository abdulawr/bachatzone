<?php
date_default_timezone_set('Asia/Karachi');
//60 seconds = 1 minutes
ini_set('max_execution_time', 60);
include("include.php");

$ID = Encryption::Decrypt($_COOKIE["cusID"]);
$total_amt_with_discount = validateInput($_POST["tot_after_discount"]);
$total = validateInput($_POST["total"]);
$discount = validateInput($_POST["discount"]);
$paymnet = validateInput($_POST["paymnet"]);
$del_address = validateInput($_POST["del_address"]);
$company_earning = validateInput($_POST["company_earning"]);
$color = $_POST["color"];
$size = $_POST["size"];
$shipment = $_POST["shipment"];
$prdIDs = $_POST["prdID"];

$prds_count = count($prdIDs);
$customerData = DBHelper::get("SELECT * FROM `tbl_customer` WHERE id = '{$ID}'")->fetch_assoc();

$orderQry = "INSERT INTO `orders`(
    `total`, 
    `disount`,
    `total_with_disount`,
    `cusID`, 
    `payment_Type`,
    `paymentStatus`,
    `orderStatus`,
    `shipment_charges`,
    `del_address`,
    `company_earning`,
    prod_count
    )
    VALUES (
    '{$total}',
        '{$discount}',
        '{$total_amt_with_discount}',
        '{$ID}',
        '{$paymnet}',
        '99',
        '99',
        '{$shipment}',     
        '{$del_address}',     
        '{$company_earning}',     
        '{$prds_count}'     
    )";
DBHelper::set($orderQry);
$orderID = $con->insert_id;

$dis_price = $_POST["dis_price"];
$price = $_POST["price"];
$qty = $_POST["qty"];
$titles = $_POST["titles"];
$customemr_discount = $_POST["dis_price"];
$company_discount = $_POST["company_ear"];
$supplier_price = $_POST["supplier_price"];

if($paymnet == '2'){
    $ors = ' <tr>
    <th style="border:none !important; width:120px;">Order Type</th>
    <td style="border:none !important;">Cash on delivery</td>
</tr>';
}
else{
    $ors = '';
}

$message = '
<table style=" padding:0px !important; border:none !important; text-align:left; ">
 <tr>
     <th style="border:none !important; width:120px;">Date</th>
     <td style="border:none !important;">'.date("d-m-Y").'</td>
 </tr>
 <tr>
     <th style="border:none !important; width:120px;">Name</th>
     <td style="border:none !important;">'.$customerData["name"].'</td>
 </tr>
 <tr>
     <th style="border:none !important; width:120px;">Moblie</th>
     <td style="border:none !important;">'.$customerData["mobile"].'</td>
 </tr>
 '.$ors.'
 <tr>
     <th style="border:none !important; width:120px;">Address</th>
     <td style="border:none !important;">'.$del_address.'</td>
 </tr>

 <tr>
 <th style="border:none !important; width:120px;">Order no</th>
 <td style="border:none !important;">'.$orderID.'</td>
</tr>

</table>

<table style="border-collapse: collapse; width: 100%;  margin-top:30px; border: 1px solid; padding: 8px;" >
 <thead>
     <th style="border: 1px solid; padding: 8px;">Product</th>
     <th style="border: 1px solid; padding: 8px;">Price</th>
     <th style="border: 1px solid; padding: 8px;">Quantity</th>
     <th style="border: 1px solid; padding: 8px;">Color</th>
     <th style="border: 1px solid; padding: 8px;">Size</th>
     <th style="border: 1px solid; padding: 8px;">Total</th>
 </thead>
 <tbody>';


for($i = 0; $i<count($prdIDs); $i++){
    $pr_ID = $prdIDs[$i];
    $discount = $dis_price[$i];
    $pr_Price = $price[$i];
    $pr_QTY = $qty[$i];
    $pr_cusDis = $customemr_discount[$i];
    $pr_cmpDis = $company_discount[$i];
    $pr_supAmt = $supplier_price[$i];
    $cc_color = $color[$i];
    $cc_size = $size[$i];

    DBHelper::set("UPDATE product set order_no = order_no+1 where id = '{$pr_ID}'");
    $suppID = DBHelper::get("SELECT `supplierID` FROM `product` WHERE id = '{$pr_ID}'")->fetch_assoc()["supplierID"];

    $message .= '<tr>
            <td style="border: 1px solid; padding: 8px;">'.$titles[$i].'</td>
            <td style="border: 1px solid; padding: 8px;">'.$pr_Price.'</td>
            <td style="border: 1px solid; padding: 8px;">'.$pr_QTY.'</td>
            <td style="border: 1px solid; padding: 8px;">'.$cc_color.'</td>
            <td style="border: 1px solid; padding: 8px;">'.$cc_size.'</td>
            <td style="border: 1px solid; padding: 8px;">'.($pr_QTY * $pr_Price).'</td>
        </tr>';

    DBHelper::set("INSERT INTO `orderlist`(`prdID`, `orderID`, `price`, `qty`,suppID,cusID,customer_discount,company_earning,supplier_amont,color,size) VALUES ('{$pr_ID}','{$orderID}','{$pr_Price}','{$pr_QTY}','{$suppID}','{$ID}','{$pr_cusDis}','{$pr_cmpDis}','{$pr_supAmt}','{$cc_color}','{$cc_size}')");
}

$message .= ' </tbody>
<tfoot>
    
    <tr style="border: none !important;">
        <th style="border: 1px solid; padding: 8px; text-align:right" colspan="5">Total </th>
        <td style="border: 1px solid; padding: 8px;">'.$total.'</td>
    </tr>

    <tr style="border: none !important;">
        <th style="border: 1px solid; padding: 8px; text-align:right" colspan="5">Discount </th>
        <td style="border: 1px solid; padding: 8px;">'.$discount.'</td>
    </tr>

    <tr style="border: none !important;">
        <th style="border: 1px solid; padding: 8px; text-align:right" colspan="5">Shipment </th>
        <td style="border: 1px solid; padding: 8px;">'.$shipment.'</td>
    </tr>

    <tr style="border: none !important;">
        <th style="border: 1px solid; padding: 8px; text-align:right" colspan="5">Subtotal </th>
        <td style="border: 1px solid; padding: 8px;">'.$total_amt_with_discount.'</td>
    </tr>
</tfoot>
</table>';

$subject = "Order NO: ".$orderID." Order invoice ";

//= payment 2 cash on delivery && 1 - jazzcash
try
{
   sendMail($customerData["email"],$subject,$message);
}
catch(Exception $e){
    echo $e;
    exit;
}

DBHelper::set("DELETE FROM `tbl_customer_cart` WHERE `cusID`= '{$ID}'");

if($paymnet == '2'){
    DBHelper::set("UPDATE orders SET orderStatus = '1' WHERE id = '{$orderID}'");

    DBHelper::set("UPDATE tbl_customer_credit_total set amount = amount - {$discount} WHERE cusID = '{$ID}' and type = 1");
    DBHelper::set("INSERT INTO `tbl_customer_credit_trans`(`amount`, `cusID`, `tran_type`, `type`) VALUES ('{$discount}','{$ID}',5,1)");

    header("Location: ../shoping-cart?msg=ss1");
}
else{
    // jazz cash
$dateTime = new DateTime();
$time = $dateTime->format("Ymdhis");
$expiryDate = $dateTime;
$expiryDate = $expiryDate->modify('+' . 1 . 'day');
$exp = $expiryDate->format("Ymdhis");
$pp_TxnRefNo = "T" . $time;

$pp_Amount_Array = $total_amt_with_discount;
$post_data =  array(
    "pp_Version"             => "1.1",
    "pp_Language"             => "EN",
    "pp_TxnType"            => 'MWALLET',
    "pp_MerchantID"         => "MC34194",
    "pp_SubMerchantID"         => "",
    "pp_Password"             => "2y3gy0gs82",
    "pp_BankID"             => "TBANK",
    "pp_ProductID"             => "32",
    "pp_TxnRefNo"             => $pp_TxnRefNo,
    "pp_TxnCurrency"         => "PKR",
    "pp_Amount"             => $pp_Amount_Array * 100,
    "pp_TxnDateTime"         => $time,
    "pp_BillReference"         => "billRef",
    "pp_Description"         => "Order Paymnet",
    "pp_TxnExpiryDateTime"     => $exp,
    "pp_ReturnURL"             => "http://localhost/kashif_project/client/action/orderConfirmination_Jazzcas.php",
    "pp_SecureHash"         => "",
    "ppmpf_1"                 => $orderID,
    "ppmpf_2"                 => $ID,
    "ppmpf_3"                 => $pp_Amount_Array,
    "ppmpf_4"                 => "4",
    "ppmpf_5"                 => "5",
);

// Integrity Salt: valie below first one
$sorted_string  = "41t3z87s55" . '&';
$sorted_string .= $post_data['pp_Amount'] . '&';
$sorted_string .= $post_data['pp_BankID'] . '&';
$sorted_string .= $post_data['pp_BillReference'] . '&';
$sorted_string .= $post_data['pp_Description'] . '&';
$sorted_string .= $post_data['pp_Language'] . '&';
$sorted_string .= $post_data['pp_MerchantID'] . '&';
$sorted_string .= $post_data['pp_Password'] . '&';
$sorted_string .= $post_data['pp_ProductID'] . '&';
$sorted_string .= $post_data['pp_ReturnURL'] . '&';
$sorted_string .= $post_data['pp_TxnCurrency'] . '&';
$sorted_string .= $post_data['pp_TxnDateTime'] . '&';
$sorted_string .= $post_data['pp_TxnExpiryDateTime'] . '&';
$sorted_string .= $post_data['pp_TxnRefNo'] . '&';
$sorted_string .= $post_data['pp_TxnType'] . '&';
$sorted_string .= $post_data['pp_Version'] . '&';
$sorted_string .= $post_data['ppmpf_1'] . '&';
$sorted_string .= $post_data['ppmpf_2'] . '&';
$sorted_string .= $post_data['ppmpf_3'] . '&';
$sorted_string .= $post_data['ppmpf_4'] . '&';
$sorted_string .= $post_data['ppmpf_5'];

//sha256 hash encoding
$pp_SecureHash = hash_hmac('sha256', $sorted_string, "41t3z87s55");
//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
$post_data['pp_SecureHash'] =  $pp_SecureHash;
?>
 <form name="jsform" id="jsform_API"  method="post" action="https://sandbox.jazzcash.com.pk/CustomerPortal/transactionmanagement/merchantform/" style="height:100%; margin:20px 12px; border-radius:10px;" class="z-depth-1 col s12 l12">

            <div class="col m12 s12" style="padding-left: 10px; padding-right:10px; margin-top:40px">
               
                <input type="hidden" name="pp_Version" value="<?php echo $post_data['pp_Version']; ?>">
                <input type="hidden" name="pp_TxnType" value="<?php echo $post_data['pp_TxnType']; ?>">
                <input type="hidden" name="pp_Language" value="<?php echo $post_data['pp_Language']; ?>">
                <input type="hidden" name="pp_MerchantID" value="<?php echo $post_data['pp_MerchantID']; ?>">
                <input type="hidden" name="pp_SubMerchantID" value="<?php echo $post_data['pp_SubMerchantID']; ?>">
                <input type="hidden" name="pp_Password" value="<?php echo $post_data['pp_Password']; ?>">
                <input type="hidden" name="pp_BankID" value="<?php echo $post_data['pp_BankID']; ?>">
                <input type="hidden" name="pp_ProductID" value="<?php echo $post_data['pp_ProductID']; ?>">
                <input type="hidden" name="pp_IsRegisteredCustomer" value="Yes">
                <input type="hidden" name="pp_CustomerID" value="<?php echo $ID; ?>">
                <input type="hidden" name="pp_OrderID" value="<?php echo $orderID; ?>">
                <input type="hidden" name="pp_TxnRefNo" value="<?php echo $post_data['pp_TxnRefNo']; ?>">
                <input hidden class="center"  type="text" name="pp_Amount" value="<?php echo $post_data['pp_Amount']; ?>">
                <input class="center" type="hidden" name="pp_TxnCurrency" value="<?php echo $post_data['pp_TxnCurrency']; ?>">
                <input type="hidden" name="pp_TxnDateTime" value="<?php echo $post_data['pp_TxnDateTime']; ?>">
                <input type="hidden" name="pp_BillReference" value="<?php echo $post_data['pp_BillReference']; ?>">
                <input type="hidden" name="pp_Description" value="<?php echo $post_data['pp_Description']; ?>">
                <input type="hidden" name="pp_TxnExpiryDateTime" value="<?php echo $post_data['pp_TxnExpiryDateTime']; ?>">
                <input type="hidden" name="pp_ReturnURL" value="<?php echo $post_data['pp_ReturnURL']; ?>">
                <input type="hidden" name="pp_SecureHash" value="<?php echo $post_data['pp_SecureHash']; ?>">
                <input type="hidden" name="ppmpf_1" value="<?php echo $orderID; ?>">
                <input type="hidden" name="ppmpf_2" value="<?php echo $ID; ?>">
                <input type="hidden" name="ppmpf_3" value="<?php echo $post_data['ppmpf_3']; ?>">
                <input type="hidden" name="ppmpf_4" value="<?php echo $post_data['ppmpf_4']; ?>">
                <input type="hidden" name="ppmpf_5" value="<?php echo $post_data['ppmpf_5']; ?>">

            </div>
        </form>

        <script>
            document.getElementById("jsform_API").submit();
        </script>
<?php

}

?>