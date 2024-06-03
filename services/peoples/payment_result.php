<?php
session_start();
error_reporting(E_ALL);

require_once($_SERVER['DOCUMENT_ROOT'].'/peoples/PGMData.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/peoples/pgconnect.php');

$ordID = $_GET["orderId"];   
$type = $_GET["type"]; 
$user=$_GET["userId"];
$parsed_array = $_REQUEST;


$OrderID = $parsed_array['id'];
$ResponseCode = $parsed_array['ResponseCode'];
$CardNo =$parsed_array['PaddedCardNo'];
$ReferenceNo = $parsed_array['ReferenceNo'];
$authCode=$parsed_array['AuthCode'];
$firstName=$parsed_array['BillToToFirstName'];
$middlename=$parsed_array['BillToMiddleName'];
$lastname=$parsed_array['BillToLastName'];
$signature=$parsed_array['Signature'];
$signatureMethod=$parsed_array['SignatureMethod'];
$responcecode1=$parsed_array['ResponseCode'];
$reasoncode=$parsed_array['ReasonCode'];
$ResponseCode=$parsed_array['ReasonCodeDesc'];
   
  
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
<!--    font awesomeome-->
    <script defer src="../js/fontawesome-all.min.js"></script>
    <!--    // bootstrap4.0-->
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <script defer src="../js/config.js"></script>

    <title>Payment Invoice</title>

    <script>
    
    function update()
    {
       // alert('<?php echo $token ?>');
      
       var token=sessionStorage.getItem('mytoken');
       var user=sessionStorage.getItem('UserName');
        var t='<?php echo $type ?>';
        var url="";
        if(t=='Rate')
        {      
            url="https://rate-tax-api.nekfa.com/api/updateratebankinfo?userId="+user;
        }
        else if(t=='Boutique')
        {
            url="https://boutique-api.nekfa.com/api/UpdateBankInfo";
        }
        else if(t=='BUSINESSTAX')
        {
            url="https://regular-tax-api.nekfa.com//api/updatepayment";
        }
        else if(t=='GARBAGEFEE')
        {
            url="https://regular-tax-api.nekfa.com//api/updatepayment";
        }

        var ClientID = getConfigData.getlocation();  
        $("#councilName").html(getCouncilName()); 
        $("#lblContactNo").html(getContactNumber());
        //This if else will remove after apply token for the all API's
        if(t=='Rate')
        {
            $.ajax({
			url: url,
			type: 'post',
			dataType: 'json',
            headers: {
                "Authorization": 'Bearer '+token
            },            
			data: {"LocationID":ClientID,"ReturnBankInfo":{"OrderID": "<?php echo $ordID ?>","ResponseCode": "<?php echo $responcecode1?>","ReasonCode":"<?php echo $reasoncode?>","ReasonCodeDesc": "<?php echo $ResponseCode;?>", "ReferenceNo":"<?php echo $ReferenceNo ?>", "PaddedCardNo": "<?php  echo $CardNo ?>","AuthCode":"<?php echo $authCode?>","BillToToFirstName": "<?php echo $firstName.' '.$middlename.' '.$lastname ?>","BillToMiddleName":"", "BillToLastName": "","Signature":"<?php echo $signature?>","SignatureMethod": "<?php echo $signatureMethod?>" }}

		    }).done(function (data) {
                if(t=='Rate' || t=='Boutique'){
                    if(data["ReturnMsgInfo"]["ReturnValue"]=="OK")
                    {
                        if(data["UpdateResponseInfo"]["ReasonCodeDesc"]=='Transaction is approved.')
                        {
                            if(t=='Rate'){
                                $("#orderId").html(data["UpdateResponseInfo"]["OrderID"]);
                                $("#premisesId").html(data["UpdateResponseInfo"]["PremisesID"]);
                                $("#owner").html(data["UpdateResponseInfo"]["OwnerName"]);
                                $("#amount").html(data["UpdateResponseInfo"]["PayAmount"]);
                                $("#conv").html(data["UpdateResponseInfo"]["ConvenienceFee"]);
                                $("#tot").html(data["UpdateResponseInfo"]["TotalAmount"]);
                                $("#date").html(data["UpdateResponseInfo"]["ResultTime"]);
                                $("#card").html(data["UpdateResponseInfo"]["BillToMiddleName"]+' / '+data["UpdateResponseInfo"]["PaddedCardNo"]);
                                $("#ref").html(data["UpdateResponseInfo"]["ReferenceNo"]);
                                $("#cardname").html(data["UpdateResponseInfo"]["BillToToFirstName"]);
                                $("#divMain").css("display", "block");
                            }
                            else if(t=='Boutique')
                            {
                                    $("#orderId").html(data["UpdateResponseInfo"]["OrderID"]);
                                    $("#premisesId").html(data["UpdateResponseInfo"]["BoutiqueNo"]);
                                    $("#owner").html(data["UpdateResponseInfo"]["OwnerName"]);
                                    $("#amount").html(data["UpdateResponseInfo"]["PayAmount"]);
                                    $("#conv").html(data["UpdateResponseInfo"]["ConvenienceFee"]);
                                    $("#tot").html(data["UpdateResponseInfo"]["TotalAmount"]);
                                    $("#date").html(data["UpdateResponseInfo"]["ResultTime"]);
                                    $("#card").html(data["UpdateResponseInfo"]["BillToMiddleName"]+' / '+data["UpdateResponseInfo"]["PaddedCardNo"]);
                                    $("#ref").html(data["UpdateResponseInfo"]["ReferenceNo"]);
                                    $("#cardname").html(data["UpdateResponseInfo"]["BillToToFirstName"]);
                                    $("#divMain").css("display", "block");
                            }   
                            else{
                                $("#divError").css("display", "block");
                            }                
                        }
                        else{
                            alert(data["msgdesc"]);
                            $("#divError").css("display", "block");
                        }
                    }
                }
                else if(t=='BUSINESSTAX')
                {
                    if(data["ReturnMsgInfo"]["ReturnValue"]=="OK"){
                        if(data["UpdateResponseInfo"]["ReasonCodeDesc"]=='Transaction is approved.')
                        {
                                $("#BTorderId").html(data["UpdateResponseInfo"]["OrderID"]);
                                $("#BTpremisesId").html(data["UpdateResponseInfo"]["RefNo"]);
                                $("#BTowner").html(data["UpdateResponseInfo"]["NameOfBusiness"]);
                                $("#BTdate").html(data ["UpdateResponseInfo"]["payDate"]);
                                $("#BTcard").html(data ["UpdateResponseInfo"]["BillToMiddleName"]+' / '+data ["UpdateResponseInfo"]["PaddedCardNo"]);
                                $("#BTref").html(data ["UpdateResponseInfo"]["ReferenceNo"]);
                                $("#BTcardname").html(data ["UpdateResponseInfo"]["BillToToFirstName"]);
                                $("#BTamount").html(data["UpdateResponseInfo"]["PayAmount"]);
                                $("#BTconv").html(data["UpdateResponseInfo"]["ConvenienceFee"]);
                                $("#BTtot").html(data["UpdateResponseInfo"]["TotalAmount"]);
                                $("#BTpost").html(data["UpdateResponseInfo"]["PostFee"]);
                                $("#BTType").html(data["UpdateResponseInfo"]["IncomeType"]);
                                $("#divBusiness").css("display", "block");
                        }
                        else{
                            $("#divError").css("display", "block");
                        }
                    }
                    else{
                        alert(data["ReturnMsgInfo"]["msgdesc"]);
                        $("#divError").css("display", "block");
                    }
                }
                else if(t=='GARBAGEFEE')
                {
                    if(data["ReturnMsgInfo"]["ReturnValue"]=="OK"){
                        if(data["UpdateResponseInfo"]["ReasonCodeDesc"]=='Transaction is approved.')
                        {
                                $("#BTorderId").html(data["UpdateResponseInfo"]["OrderID"]);
                                $("#BTpremisesId").html(data["UpdateResponseInfo"]["RefNo"]);
                                $("#BTowner").html(data["UpdateResponseInfo"]["NameOfBusiness"]);
                                $("#BTdate").html(data ["UpdateResponseInfo"]["payDate"]);
                                $("#BTcard").html(data ["UpdateResponseInfo"]["BillToMiddleName"]+' / '+data ["UpdateResponseInfo"]["PaddedCardNo"]);
                                $("#BTref").html(data ["UpdateResponseInfo"]["ReferenceNo"]);
                                $("#BTcardname").html(data ["UpdateResponseInfo"]["BillToToFirstName"]);
                                $("#BTamount").html(data["UpdateResponseInfo"]["PayAmount"]);
                                $("#BTconv").html(data["UpdateResponseInfo"]["ConvenienceFee"]);
                                $("#BTtot").html(data["UpdateResponseInfo"]["TotalAmount"]);
                                $("#BTpost").html(data["UpdateResponseInfo"]["PostFee"]);
                                $("#BTType").html(data["UpdateResponseInfo"]["IncomeType"]);
                                $("#divBusiness").css("display", "block");
                        }
                        else{
                            $("#divError").css("display", "block");
                        }
                    }
                    else{
                        alert(data["ReturnMsgInfo"]["msgdesc"]);
                        $("#divError").css("display", "block");
                    }
                }
                $("#divWait").css("display", "none");
            })
            .fail(function () {
                $("#divWait").css("display", "none");
            });
        }
        else
        {
            $.ajax({
			url: "<?php echo $url ?>",
			type: 'post',
			dataType: 'json',           
			data: {"LocationID":ClientID,"ReturnBankInfo":{"OrderID": "<?php echo $ordID ?>","ResponseCode": "<?php echo $responcecode1?>","ReasonCode":"<?php echo $reasoncode?>","ReasonCodeDesc": "<?php echo $ResponseCode;?>", "ReferenceNo":"<?php echo $ReferenceNo ?>", "PaddedCardNo": "<?php  echo $CardNo ?>","AuthCode":"<?php echo $authCode?>","BillToToFirstName": "<?php echo $firstName.' '.$middlename.' '.$lastname ?>","BillToMiddleName":"", "BillToLastName": "","Signature":"<?php echo $signature?>","SignatureMethod": "<?php echo $signatureMethod?>" }}

		    }).done(function (data) {
            if(t=='Rate' || t=='Boutique'){
                if(data["ReturnMsgInfo"]["ReturnValue"]=="OK")
                {
                    if(data["UpdateResponseInfo"]["ReasonCodeDesc"]=='Transaction is approved.')
                    {
                        if(t=='Rate'){
                            $("#orderId").html(data["UpdateResponseInfo"]["OrderID"]);
                            $("#premisesId").html(data["UpdateResponseInfo"]["PremisesID"]);
                            $("#owner").html(data["UpdateResponseInfo"]["OwnerName"]);
                            $("#amount").html(data["UpdateResponseInfo"]["PayAmount"]);
                            $("#conv").html(data["UpdateResponseInfo"]["ConvenienceFee"]);
                            $("#tot").html(data["UpdateResponseInfo"]["TotalAmount"]);
                            $("#date").html(data["UpdateResponseInfo"]["ResultTime"]);
                            $("#card").html(data["UpdateResponseInfo"]["BillToMiddleName"]+' / '+data["UpdateResponseInfo"]["PaddedCardNo"]);
                            $("#ref").html(data["UpdateResponseInfo"]["ReferenceNo"]);
                            $("#cardname").html(data["UpdateResponseInfo"]["BillToToFirstName"]);
                            $("#divMain").css("display", "block");
                        }
                        else if(t=='Boutique')
                        {
                                $("#orderId").html(data["UpdateResponseInfo"]["OrderID"]);
                                $("#premisesId").html(data["UpdateResponseInfo"]["BoutiqueNo"]);
                                $("#owner").html(data["UpdateResponseInfo"]["OwnerName"]);
                                $("#amount").html(data["UpdateResponseInfo"]["PayAmount"]);
                                $("#conv").html(data["UpdateResponseInfo"]["ConvenienceFee"]);
                                $("#tot").html(data["UpdateResponseInfo"]["TotalAmount"]);
                                $("#date").html(data["UpdateResponseInfo"]["ResultTime"]);
                                $("#card").html(data["UpdateResponseInfo"]["BillToMiddleName"]+' / '+data["UpdateResponseInfo"]["PaddedCardNo"]);
                                $("#ref").html(data["UpdateResponseInfo"]["ReferenceNo"]);
                                $("#cardname").html(data["UpdateResponseInfo"]["BillToToFirstName"]);
                                $("#divMain").css("display", "block");
                        }   
                        else{
                            $("#divError").css("display", "block");
                        }                
                    }
                    else{
                        alert(data["msgdesc"]);
                        $("#divError").css("display", "block");
                    }
                }
            }
            else if(t=='BUSINESSTAX')
            {
                if(data["ReturnMsgInfo"]["ReturnValue"]=="OK"){
                    if(data["UpdateResponseInfo"]["ReasonCodeDesc"]=='Transaction is approved.')
                    {
                            $("#BTorderId").html(data["UpdateResponseInfo"]["OrderID"]);
                            $("#BTpremisesId").html(data["UpdateResponseInfo"]["RefNo"]);
                            $("#BTowner").html(data["UpdateResponseInfo"]["NameOfBusiness"]);
                            $("#BTdate").html(data ["UpdateResponseInfo"]["payDate"]);
                            $("#BTcard").html(data ["UpdateResponseInfo"]["BillToMiddleName"]+' / '+data ["UpdateResponseInfo"]["PaddedCardNo"]);
                            $("#BTref").html(data ["UpdateResponseInfo"]["ReferenceNo"]);
                            $("#BTcardname").html(data ["UpdateResponseInfo"]["BillToToFirstName"]);
                            $("#BTamount").html(data["UpdateResponseInfo"]["PayAmount"]);
                            $("#BTconv").html(data["UpdateResponseInfo"]["ConvenienceFee"]);
                            $("#BTtot").html(data["UpdateResponseInfo"]["TotalAmount"]);
                            $("#BTpost").html(data["UpdateResponseInfo"]["PostFee"]);
                            $("#BTType").html(data["UpdateResponseInfo"]["IncomeType"]);
                            $("#divBusiness").css("display", "block");
                    }
                    else{
                        $("#divError").css("display", "block");
                    }
                }
                else{
                    alert(data["ReturnMsgInfo"]["msgdesc"]);
                    $("#divError").css("display", "block");
                }
            }
            else if(t=='GARBAGEFEE')
            {
                if(data["ReturnMsgInfo"]["ReturnValue"]=="OK"){
                    if(data["UpdateResponseInfo"]["ReasonCodeDesc"]=='Transaction is approved.')
                    {
                            $("#BTorderId").html(data["UpdateResponseInfo"]["OrderID"]);
                            $("#BTpremisesId").html(data["UpdateResponseInfo"]["RefNo"]);
                            $("#BTowner").html(data["UpdateResponseInfo"]["NameOfBusiness"]);
                            $("#BTdate").html(data ["UpdateResponseInfo"]["payDate"]);
                            $("#BTcard").html(data ["UpdateResponseInfo"]["BillToMiddleName"]+' / '+data ["UpdateResponseInfo"]["PaddedCardNo"]);
                            $("#BTref").html(data ["UpdateResponseInfo"]["ReferenceNo"]);
                            $("#BTcardname").html(data ["UpdateResponseInfo"]["BillToToFirstName"]);
                            $("#BTamount").html(data["UpdateResponseInfo"]["PayAmount"]);
                            $("#BTconv").html(data["UpdateResponseInfo"]["ConvenienceFee"]);
                            $("#BTtot").html(data["UpdateResponseInfo"]["TotalAmount"]);
                            $("#BTpost").html(data["UpdateResponseInfo"]["PostFee"]);
                            $("#BTType").html(data["UpdateResponseInfo"]["IncomeType"]);
                            $("#divBusiness").css("display", "block");
                    }
                    else{
                        $("#divError").css("display", "block");
                    }
                }
                else{
                    alert(data["ReturnMsgInfo"]["msgdesc"]);
                    $("#divError").css("display", "block");
                }
                $("#divWait").css("display", "none");
            }
		})
		.fail(function () {
            $("#divWait").css("display", "none");
		});
        }
        
		
   
    }
    </script>



    <script>
        function printDiv() {
            var t='<?php echo $type ?>';

            var divContents = document.getElementById("divMain").innerHTML;
            if(t=='BUSINESSTAX'){
                divContents = document.getElementById("divBusiness").innerHTML;
            }
            var a = window.open('', '', 'height=500, width=500');
            a.document.write('<html><head>');
            a.document.write('<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />');
            a.document.write('</head><body >');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }

        function home()
        {
            window.location=getDomain();
            return false;
        }
    </script>

</head>

<body id="body-wrapper" onload="update();">
    <div id="divMain" style="display:none;padding:10px;">
    <div>
        
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6"  style="border:solid 1px black;padding:15px;">
            <div class="text-center" ><h4><b><span id="councilName"></span></b></h4></div>
            <div class="text-center" ><h5>Online <?php echo $type ?> Payment Invoice</h4></div><hr/>
            <b>Order ID : </b><span id="orderId"></span><br/>
            <b>Custom NO :  </b><span id="premisesId"></span><br/>
            <b>Owner Name :  </b><span id="owner"></span><br/>
            <b>Pay Date :  </b><span id="date"></span><br/><br/>

            <table style=" width: 100%;">
            <tr style="border-bottom: solid 1px gray;"><th>Description</th><th class="text-right">Fee</th></tr>
            <tr><td>Payment for <?php echo $type ?> fee</td><td class="text-right"><span id="amount"></span></td></tr>
            <tr><td>Convenience Fee</td><td class="text-right"><span id="conv"></span></td></tr>
            <tr style="border-top: solid 1px gray;border-bottom: double 1px gray;"><td><b>Total Paid Amount</b></td><td class="text-right"><b><span id="tot"></span></b></td></tr>
            </table>
            <br/>
            <b>Pay By  : </b><span id="card"></span><br/>
            <b>Name on Card  : </b><span id="cardname"></span><br/>
            <b>Reference No  : </b><span id="ref"></span><br/><br/>
            <span style="color:gray;font-size:12px;">You can get the screen capture of this window for future reference.Any clarification contact <span id="lblContactNo"></span>.</span>
            <br/>
            <span style="color:gray;font-size:10px;">Please press BACK button to close this screen.</span>
        </div>
        <div class="col-md-3"></div>
        </div>
       
    </div>
    </div>
    <div id="divBusiness" style="display:none;padding:10px;">
    <div>
        
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6"  style="border:solid 1px black;padding:15px;">
            <div class="text-center" ><h4><b><span id="councilName"></span></b></h4></div>
            <div class="text-center" ><h5>Online <?php echo $type ?> Payment Invoice</h4></div><hr/>
            <b>Order ID : </b><span id="BTorderId"></span><br/>
            <b>Reference NO :  </b><span id="BTpremisesId"></span><br/>
            <b>Owner Name :  </b><span id="BTowner"></span><br/>
            <b>Pay Date :  </b><span id="BTdate"></span><br/><br/>

            <table style=" width: 100%;">
            <tr style="border-bottom: solid 1px gray;"><th>Description</th><th class="text-right">Fee</th></tr>
            <tr><td>Payment for <span id="BTType"></span> fee</td><td class="text-right"><span id="BTamount"></span></td></tr>
            <tr><td>Post Fee</td><td class="text-right"><span id="BTpost"></span></td></tr>
            <tr><td>Convenience Fee</td><td class="text-right"><span id="BTconv"></span></td></tr>
            <tr style="border-top: solid 1px gray;border-bottom: double 1px gray;"><td><b>Total Paid Amount</b></td><td class="text-right"><b><span id="BTtot"></span></b></td></tr>
            </table>
            <br/>
            <b>Pay By  : </b><span id="BTcard"></span><br/>
            <b>Name on Card  : </b><span id="BTcardname"></span><br/>
            <b>Reference No  : </b><span id="BTref"></span><br/><br/>
            <span style="color:gray;font-size:12px;">You can get the screen capture of this window for future reference.Any clarification contact <span id="lblContactNo"></span>.</span>
            <br/>
            <span style="color:gray;font-size:10px;">Please press BACK/Close button to close this screen.</span>
        </div>
        <div class="col-md-3"></div>
        </div>
       
    </div>
    </div>
    <div id="divError" style="display:none;padding:10px;">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
        <span style="color:red;">
        YOUR PAYMENT UNSUCCESFULLY..!<br>
        Order ID - <?php echo $ordID ?><br>
        </span>
        <span style="color:gray;font-size:12px;">You can get the screen capture of this window for future reference.Any clarification contact <span id="lblContactNo"></span>.</span>
            <br/>
            <span style="color:gray;font-size:10px;">Please press BACK/Close button to close this screen.</span></div>
        <div class="col-md-3"></div>
        </div>
    </div>
    <div  style="padding:10px;">

    <div class="row" style="margin-left:0px;margin-right:0px;" id="divWait">
        <div class="col-md-12" style="color:blue;text-align:center;">
            Please wait .......<br/>loading your payment details from the bank.
        </div>
    </div>
    <div class="row" style="margin-left:0px;margin-right:0px;">
        <div class="col-md-3">
            <input type="button" value="Print" class="btn btn-info" onclick="return printDiv();"/>
            <input type="button" value="Home" class="btn btn-warning" onclick="return home();"/>
        </div>
    </div>
    </div>
</body>
</html>