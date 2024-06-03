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
    // if(isset($_POST["orderID"]))
    // {
    //     $orderID=$_POST["orderID"];
    // }
    // if(isset($_POST["amount"]))
    // {
    //     $order_amount=$_POST["amount"];
    // }
    // if(isset($_POST["type"]))
    // {
    //     $paytype=$_POST["type"];
    // }
    // if(isset($_POST["userId"]))
    // {
    //     $user=$_POST["userId"];
    // }
    // if(isset($_POST["mytoken"]))
    // {
    //     $token=$_POST["mytoken"];
    // }
    // if(isset($_POST["email"]))
    // {
    //     $email=$_POST["email"];
    // }
    // if($email=='')
    // {
    //     $email='noemail@gmail.com'; 
    // }
    // $order_id = $orderID;    

 
    // $accesskey="a7148f21d10f3f2f971011dd5b5a6f67";
    // $profiekey="E6719FA3-6E97-41FA-9935-EBFE3DC5B466";
    // $uuid=uniqid();
    // $date=gmdate("Y-m-d\TH:i:s\Z");


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

<body id="body-wrapper" onload="return aa();">

<!-- 2023/Jun/06 - For Testing, uncomment when release project for a customer. -->

<!-- <form id="payment_confirmation" action="https://secureacceptance.cybersource.com/pay" method="post"/> -->

    <input type="button" value="btn" onclick="return aa();">



 
 

<div style="color:blue;text-align:center;">Welcome1<br/>loading people's bank payment gateway.</div>

<script>
   
    $(function() {
       // alert('aaa');
      // $('#payment_confirmation').submit();
    });

    function aa(){
        alert('xxx');
        return false;
    }

</script>
</body>
</html>