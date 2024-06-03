<?php
 
// foreach($_REQUEST as $name => $value) {
//                      $params[$name] = $value;
//                      echo "<span>" . $name . "</span><input type=\"text\" name=\"" . $name . "\" size=\"50\" value=\"" . $value . "\" readonly=\"true\"/><br/>";
//                  }


    $parsed_array = $_REQUEST;

    $ordID = $_REQUEST["auth_trans_ref_no"];  
    
    $type = $_REQUEST["req_bill_to_address_city"]; 
    
    $requser=$_REQUEST["req_merchant_defined_data30"]; 
    $reqtoken=$_REQUEST["req_merchant_secure_data4"]; 


    $ResponseCode = $parsed_array['reason_code'];
    $CardNo =$parsed_array['req_card_number'];

    $ReferenceNo = $parsed_array['transaction_id'];
    $authCode=$parsed_array['auth_code'];
    $firstName=$parsed_array['req_bill_to_forename'];
    $firstName='';

    $middlename=$parsed_array['req_bill_to_surname'];
    $middlename='';
    $lastname=$parsed_array['card_type_name'];
    $signature=$parsed_array['signature'];
    $signatureMethod=$parsed_array['payer_authentication_transaction_id'];

    $responcecode1=$parsed_array['reason_code'];// 1 for mail
    $reasoncode=$parsed_array['reason_code'];// 1 for mail
    $ResponseCode=$parsed_array['decision'];
    
    if($responcecode1=='100' && $reasoncode=='100' )
    {
        $responcecode1="1";
        $reasoncode="1";
    }
    else{
        $responcecode1="0";
        $reasoncode="0";
    }

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
    <link rel="stylesheet" href="../css/home.css" type="text/css">
    <style>
            .mobile_height {
              height: 50px;
            }
        
            #label {
              width: 100%;
            }
        
        
            * {
              margin: 0;
              padding: 0;
              box-sizing: border-box;
            }
        
            body {
              font-family: Arial, Helvetica, sans-serif;
              background-color: #f1f1f1;
              position: relative;
              padding-bottom: 58px;
              min-height: 100vh;
            }
        
            @media(min-width:768px) {
              .table1 {
                table-layout: fixed;
              }
            }
        </style>
    <script defer src="../js/config.js"></script>

    <title>Payment Invoice</title>

    <script>
       $("#modelDiv").show();
    function update()
    {

      
       // alert('<?php echo $token ?>');
       var token=sessionStorage.getItem('mytoken');
       var user=sessionStorage.getItem('UserName');
        var t='<?php echo $type ?>';
        var requesttoken='<?php echo $reqtoken ?>';
        var requestuser='<?php echo $requser ?>';

        var url="";
       // alert(t+''+ user+' '+token);
        if(t=='Rate')
        {      
            //url="https://rate-tax-api2.nekfa.com/api/updateratebankinfo?userId="+user;
            url="https://rate-tax-api2.nekfa.com/api/updateratebankinfo?userId="+requestuser;

        }
        
        
    
       
        var ClientID = getConfigData.getlocation();  
        var contactNo = getContactNumber();
        var CouncilName = getCouncilName();
        $Council=CouncilName;
        $contact=contactNo;
        // $("#councilName").html(getCouncilName()); 
        $("#lblCouncilName_Procument").html(CouncilName);
        $("#lblCouncilName_Photoshoot").html(CouncilName);
        $("#councilName_RateCertificate").html(CouncilName); 
        $("#lblcouncilName_FireCertificate").html(CouncilName); 
        $("#councilName_walkinglane").html(CouncilName);
        $("#lblContactNo10").html(contactNo);
        $("#lblContactNo_NewpropertyNo").html(contactNo);
        $("#lblContactNo_WaterBill").html(contactNo);
        $("#lblContactNo_Library").html(contactNo);
        $("#lblContactNo_Ground").html(contactNo);
        $("#lblContactNo_PNM").html(contactNo);
        $("#lblContactNo_INVOICE").html(contactNo);
        $("#lblContactNo_GARBAGEFEE").html(contactNo);
        $("#lblContactNo_Preschool").html(contactNo);
        $("#lblContactNo_Cemetery").html(contactNo);
        $("#lblContactNo_TownHall").html(contactNo);
        $("#lblContactNo_STREETLINE").html(contactNo);
        $("#lblContactNo_Gully").html(contactNo);
        $("#lblContactNo_SalesItem").html(contactNo);
        $("#lblContactNo_TRADELICENSE").html(contactNo);
        $("#lblContactNo_Crematoriums").html(contactNo);
        $("#lblContactNo_BUSINESSTAX").html(contactNo);
        $("#lblContactNo_Photoshoot").html(contactNo);
         //walking lane
         $("#lblContactNo_WalkingLane").html(contactNo);
         $("#lblContactNo_RateCertificate").html(contactNo);
         $("#lblContactNo_procument").html(contactNo);
         $("#lblContactNo_FireCertificate").html(contactNo);
        
       
        //This if else will remove after apply token for the all API's
        if(t=='Rate'|| t=='Boutique')
        {
            $.ajax({
			url: url,
			type: 'post',
			dataType: 'json',
            headers: {
                "Authorization": "Bearer "+requesttoken
            },            
			data: {"LocationID":ClientID,"ReturnBankInfo":{"OrderID": "<?php echo $ordID ?>","ResponseCode": "<?php echo $responcecode1?>","ReasonCode":"<?php echo $reasoncode?>","ReasonCodeDesc": "<?php echo $ResponseCode;?>", "ReferenceNo":"<?php echo $ReferenceNo ?>", "PaddedCardNo": "<?php  echo $CardNo ?>","AuthCode":"<?php echo $authCode?>","BillToToFirstName": "<?php echo $firstName.' '.$middlename ?>","BillToMiddleName":"<?php echo $lastname; ?>", "BillToLastName": "","Signature":"<?php echo $signature?>","SignatureMethod": "<?php echo $signatureMethod?>" }}

		    }).done(function (data) {
                if(t=='Rate' || t=='Boutique'){
                    if(data["ReturnMsgInfo"]["ReturnValue"]=="OK")
                    {
                        if(data["UpdateResponseInfo"]["ReasonCode"]=='1')
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
                                $("#divPrint").css("display", "block");
                                $("#divhome").css("display", "none");


                            }                      
                            
                            else{
                                $("#divError").css("display", "block");
                            }                
                        }
                        else{                          
                            
                            $("#divError").css("display", "block");
                        }
                    }
                    else{                          
                            
                            $("#divError").css("display", "block");
                        }
                }
                
                
                $("#divWait").css("display", "none");
                $("#modelDiv").css("display", "none");
                $(".loader").hide();

            })
            .fail(function () {
                $("#divWait").css("display", "none");
                $("#modelDiv").css("display", "none");
                $("#divError").css("display", "block");
                $(".loader").hide();
          
            });
        }
        
        
        


                
    }
                
    
    </script>
      <script>
        function printDiv() {
            var t='<?php echo $type ?>';

            var divContents = document.getElementById("divMain").innerHTML;
           
            
            
            //new
            var a = window.open('', '', 'height=500, width=500');
            a.document.write('<html><head>');
            a.document.write('<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />');
            a.document.write('</head><body >');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.onunload = function(){
                console.log('closed!');
            }
            a.focus();
            a.print();
            a.close();
            //end

            //before
            // var a = window.open('', '', 'height=500, width=500');
            // a.document.write('<html><head>');
            // a.document.write('<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />');
            // a.document.write('</head><body >');
            // a.document.write(divContents);
            // a.document.write('</body></html>');
            // a.document.close();
            // a.print();
            //end
        }

        function home()
        {
            window.location.replace(getDomain()+"/services");
           // window.location=getDomain()+"/services";
            return false;
        }
   

        </script>



</head>

<body id="body-wrapper" style="width: 99%;" onload="update();">
<div id="modelDiv" class="modal fade in" style="background-color: black;opacity: 0.5;z-index: 999;display:block;"></div>
<div class="loader preLoad" id="loading-image"></div>
    <div id="divMain" style="display:none;padding:10px;">
    <div>
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6"  style="border:solid 1px black;padding:15px;">
            <!-- <div class="text-center" ><h4><b><span id="councilName"></span></b></h4></div> -->
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
            <span style="color:gray;font-size:12px;">You can get the screen capture of this window for future reference.Any clarification contact <span id="lblContactNo10"></span>.</span>
            <br/>
            <span style="color:gray;font-size:10px;">Please press BACK button to close this screen.</span>
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


    <div class="row" style="margin-left:0px;margin-right:0px;display:none" id="divPrint">
        <div class="col-md-3">
            <input type="button" id="print" value="Print" class="btn btn-info" onclick="return printDiv();"/>
            <input type="button" value="Home" class="btn btn-warning" onclick="return home();"/>
        </div>
    </div>
    <div class="row" style="margin-left:0px;margin-right:0px;" id="divhome">
        <div class="col-md-3">          
            <input type="button" value="Home" class="btn btn-warning" onclick="return home();"/>
        
        </div>
    </div>
    </div>
</body>
</html>