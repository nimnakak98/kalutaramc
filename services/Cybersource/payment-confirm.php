<?php
session_unset();
session_start();
//  require_once('../config/config.php');
//  require_once($_SERVER['DOCUMENT_ROOT'].'/services/peoples/PGMData.php');
// require_once($_SERVER['DOCUMENT_ROOT'].'/services/peoples/pgconnect.php');
include $_SERVER['DOCUMENT_ROOT'].'/services/Cybersource/security.php';
// require_once(DOC_ROOT.'boc_android/api_lib.php');


$orderID = ""; 
$order_amount = "0.00"; 
$paytype="";  
$user="";
$token="";
$email='';
    if(isset($_POST["orderID"]))
    {
        $orderID=$_POST["orderID"];
    }
    if(isset($_POST["amount"]))
    {
        $order_amount=$_POST["amount"];
    }
    if(isset($_POST["type"]))
    {
        $paytype=$_POST["type"];
    }
    if(isset($_POST["userId"]))
    {
        $user=$_POST["userId"];
    }
    if(isset($_POST["mytoken"]))
    {
        $token=$_POST["mytoken"];
    }
    if(isset($_POST["email"]))
    {
        $email=$_POST["email"];
    }
    if($email=='')
    {
        $email='noemail@gmail.com'; 
    }
    $order_id = $orderID;    

 
    $accesskey="b43b5af7cac13ea1b6d87000f5912348";
    $profiekey="0EAE4291-C1FD-44A2-B172-97993BF6C1A6";
    $uuid=uniqid();
    $date=gmdate("Y-m-d\TH:i:s\Z");


  ?>









<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="icon" href="../favicon.ico" type="image/gif" sizes="16x16">
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script defer src="../js/fontawesome-all.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">

    <title>Payment</title>

</head>

<body id="body-wrapper" onload="">

<!-- 2023/Jun/06 - For Testing, uncomment when release project for a customer. -->

<form id="payment_confirmation" action="https://secureacceptance.cybersource.com/pay" method="post"/>
<!--  -->
    <!-- <form id="payment_confirmation" action="https://testsecureacceptance.cybersource.com/pay" method="post"/>  -->
 

    <input type="hidden" name="access_key" value="<?php echo $accesskey; ?>">
    <input type="hidden" name="profile_id" value="<?php echo $profiekey;?>">
	
    <input type="hidden" name="transaction_uuid" id="transaction_uuid" value="<?php echo $uuid; ?>">

    <!--Check these Values-->
    <input type="hidden" name="signed_field_names" value="access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount,currency">	
	<input type="hidden" name="unsigned_field_names" value="auth_trans_ref_no,bill_to_forename,bill_to_surname,bill_to_address_line1,bill_to_address_city,bill_to_address_country,bill_to_email,merchant_defined_data30,merchant_secure_data4">
    
	<input type="hidden" name="signed_date_time" value="<?php echo $date; ?>">
    <input type="hidden" name="locale" value="en">
    <input type="hidden" name="transaction_type" value="sale">
    <input type="hidden" name="reference_number" value="<?php echo $order_id; ?>">
    <input type="hidden" name="auth_trans_ref_no" value="<?php echo $order_id; ?>">
    <input type="hidden" name="amount" value="<?php echo $order_amount; ?>">
    <input type="hidden" name="currency" value="LKR">

     
	<!--Add these billing Parameters-->
	<input type="hidden" name="bill_to_email" value="<?php echo $email; ?>"/>
	<input type="hidden" name="bill_to_forename" value="NOREAL"/>
	<input type="hidden" name="bill_to_surname" value='NOREAL'/>
	<input type="hidden" name="bill_to_address_line1" value="Address "/>
	<input type="hidden" name="bill_to_address_city" value="<?php echo $paytype; ?>"/>
	<input type="hidden" name="bill_to_address_country" value="LK"/>

    <input type="hidden" name="merchant_defined_data30" value="<?php echo $user; ?>"/>
    <input type="hidden" name="merchant_secure_data4" value="<?php echo $token; ?>"/>





    <?php  



        $params['access_key'] = $accesskey;
        $params['profile_id'] = $profiekey;
        $params['transaction_uuid'] = $uuid;
        $params['signed_field_names'] =  "access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount,currency";
        $params['unsigned_field_names'] = "auth_trans_ref_no,bill_to_forename,bill_to_surname,bill_to_address_line1,bill_to_address_city,bill_to_address_country,bill_to_email,merchant_defined_data30,merchant_secure_data4";
        $params['signed_date_time'] =$date;
        $params['locale'] ="en";
        $params['transaction_type'] ='sale';
        $params['reference_number'] =$order_id;
        $params['auth_trans_ref_no'] =$order_id;
        $params['amount'] =$order_amount;
        $params['currency'] ="LKR";
        $params['bill_to_email'] =$email;
        $params['bill_to_forename'] ="NOREAL";
        $params['bill_to_surname'] ="NAME";
        $params['currbill_to_address_line1ency'] ="Address";
        $params['bill_to_address_city'] =$paytype;
        $params['bill_to_address_country'] ="LK";


        echo "<input type=\"hidden\" id=\"signature\" name=\"signature\" value=\"" . sign($params) . "\"/>\n";


    ?>



 
</form>

<div style="color:blue;text-align:center;">Welcome<br/>loading people's bank payment gateway.</div>

<script>
    $(function() {
       $('#payment_confirmation').submit();
    });

</script>
</body>
</html>