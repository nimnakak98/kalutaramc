<?php
session_unset();
session_start();


 require_once($_SERVER['DOCUMENT_ROOT'].'/peoples/PGMData.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/peoples/pgconnect.php');



$orderID = ""; 
$order_amount = "0.00"; 
$paytype="";  
$user="";
$token="";
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
    $order_id = $orderID; 


    $PGConnect = new PGConnect();
    $data = $PGConnect->getCheckoutFormData($orderID, $order_amount);



    
    $responseUrl1 = 'https://payment.kaduwela.mc.gov.lk/peoples/payment_result.php?orderId='.$order_id.'&type='.$paytype;
    
    
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

<form id='FrmHtmlCheckout' name='FrmHtmlCheckout' class="form-horizontal" action="https://pg.peoplesbank.lk/OrderProcessingEngine/RedirectLink.aspx" method="post">

<input id='Version' type='hidden' name='Version' value= "<?php echo $data['version']?>"> 
<input id='MerID' type='hidden' value= "<?php echo $data['merID'];?>" name='MerID' >
<input id='AcqID' type='hidden' value="<?php echo $data['acqID'];?>" name='AcqID' > 
<input id='MerRespURL' type='hidden' value= "<?php echo $responseUrl1 ;?>" name='MerRespURL'> 
<input id='PurchaseCurrency' type='hidden' value= "<?php echo $data['purchaseCurrency'];?>" name='PurchaseCurrency'>
<input id='PurchaseCurrencyExponent' type='hidden' value='2' name='PurchaseCurrencyExponent'> 
<input id='OrderID' type='hidden' value= "<?php echo $order_id;?>" name='OrderID' >
<input id='SignatureMethod' type='hidden' value= "<?php echo $data['signatureMethod'];?>" name='SignatureMethod'>
<input id='PurchaseAmt' type='hidden' value= "<?php echo $data['purchaseAmt'];?>" name='PurchaseAmt'>
<input id='Signature' type='hidden' value="<?php echo $data['signature'];?>" name='Signature'>
</form>

<div style="color:blue;text-align:center;">Welcome<br/>loading people's bank payment gateway.</div>

<script>
    $(function() {
       $('#FrmHtmlCheckout').submit();
    });

</script>
</body>
</html>