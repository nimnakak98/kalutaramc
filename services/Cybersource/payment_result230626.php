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
        else if(t=='Boutique')
        {
            url="https://boutique-api.nekfa.com/api/UpdateBankInfo?userId="+user;
        }
        else if(t=='BUSINESSTAX')
        {
            url="https://regular-tax-api.nekfa.com//api/updatepayment";
        }
        else if (t == 'NewPropertyNo') {
            url="https://rate-new-propertyno.nekfa.com/api/updatepayment";
        }
        else if(t=='WaterBill')
        {
            url="http://localhost:39094/api/UpdateBankInfo?userId="+user;
        }
        else if(t=='Library')
        {
            url="https://library-api.nekfa.com/api/updatepayment"
        }
        else if(t=='Ground')
        {
            url="https://ground-api.nekfa.com/api/updatepayment"
        }
        else if(t=='Boutique')
        {
            url="https://boutique-api.nekfa.com/api/UpdateBankInfo?userId="+user;
        }
        else if(t=='PNM')
        {
            url="https://pnm-program-api.nekfa.com/api/updatepayment";
        }
        else if(t=='INVOICE')
        {
            url="https://other-income-api.nekfa.com/api/updatepayment";
        }
        else if(t=='GARBAGEFEE')
        {
            url="https://regular-tax-api.nekfa.com//api/updatepayment";
        }
        else if(t=='Preschool')
        {
            url="https://preschool-api.nekfa.com/api/updatepayment";
        }
        else if(t=='Cemetery')
        {
            url="https://cemeteries-api.nekfa.com/api/updatepayment";
        }
        else if(t=='TownHall')
        {
            url="https://town-hall-api.nekfa.com/api/updatepayment";
        }
        else if(t=='NONAQUI' || t=='STREETLINE')
        {
            url="https://street-line-api.nekfa.com//api/updatepayment";
        }
        else if(t=='Gully')
        {
            url="https://gully-service-api.nekfa.com/api/updatepayment";
        }
        else if (t == 'SalesItem') {
            url="https://sales-api.nekfa.com/api/updatepayment";
        }
        else if (t == 'TRADELICENSE') {
            url="https://regular-tax-api.nekfa.com//api/updatepayment";
        }
        else if (t == 'Crematoriums') {
            url="https://crematoriums-api.nekfa.com/api/updatepayment";
        }
        else if (t == 'Photoshoot') {
            url="https://photoshoot-api.nekfa.com/api/AppBankPayResult?userId="+user;
        }
        //walking lane
        else if (t == 'WalkingLane') {
            url="https://walkinglane-api.nekfa.com/api/SaveBankMsg?userId="+user;
        }
        //RateCertificate
        else if (t == 'RateCertificate') {
            url="https://ratecertificate-api.nekfa.com/api/SaveBankMsg?userId="+user;
        }
        else if (t == 'Procument') {
            url="https://tender-api.nekfa.com/api/AppBankPayResult?userId="+user;
        }
        //Fire Certificate
        else if (t == 'FireCertificate') {
            url="https://firecertificate-api.nekfa.com/api/SaveBankMsg?userId="+user;
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
                            else if(t=='Boutique'){
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
        
        else if(t=='NewPropertyNo')
            {
            $.ajax({
			url: url,
			type: 'post',
			dataType: 'json',
            headers: {
                "Authorization": 'Bearer '+token
            },            
			data: {"LocationID":ClientID,"ReturnBankInfo":{"OrderID": "<?php echo $ordID ?>","ResponseCode": "<?php echo $responcecode1?>","ReasonCode":"<?php echo $reasoncode?>","ReasonCodeDesc": "<?php echo $ResponseCode;?>", "ReferenceNo":"<?php echo $ReferenceNo ?>", "PaddedCardNo": "<?php  echo $CardNo ?>","AuthCode":"<?php echo $authCode?>","BillToToFirstName": "<?php echo $firstName.' '.$middlename ?>","BillToMiddleName":"<?php echo $lastname; ?>", "BillToLastName": "","Signature":"<?php echo $signature?>","SignatureMethod": "<?php echo $signatureMethod?>" }}

		    }).done(function (data){
             
               // console.log(data);
                var returnMsg=data["returnMsgInfo"];
                if(data["returnMsgInfo"]["ReturnValue"]=="OK"){
                    if(data["updateResponseInfo"]["ReasonCode"]=='1')

                    {
                    
                       
                        $("#divWait").css("display", "none");
                        $("#NPorderId").html(data["updateResponseInfo"]["OrderID"]);
                        $("#NPcard").html(data ["updateResponseInfo"]["BillToMiddleName"]+' / '+data ["updateResponseInfo"]["PaddedCardNo"]);
                        $("#NPref").html(data ["updateResponseInfo"]["formID"]);
                        $("#NPcardname").html(data ["updateResponseInfo"]["BillToToFirstName"]);
                        // $("#YUamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#NPamountttttt").html(data["updateResponseInfo"]["PayAmount"]);
                        $("#NPconv").html(data["updateResponseInfo"]["ConvenienceFee"]);
                        $("#NPtotttttt").html(data["updateResponseInfo"]["TotalAmount"]);
                        $("#NPowner").html(data["updateResponseInfo"]["NameOfApplicant"]);
                        $("#NPdate").html(data["updateResponseInfo"]["ResultTime"]);
                        $("#NPref").html(data["updateResponseInfo"]["ReferenceNo"]);
                        $("#divNewpropertyNo").css("display", "block");
                        $("#divPrint").css("display", "block");
                        $("#divhome").css("display", "none");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                    else{
                        $("#divError").css("display", "block");
                        $("#divWait").css("display", "none");
                        $("#divPrint").css("display", "none");
                        $("#divhome").css("display", "block");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                }
                else{
                    //alert(data["ReturnMsgInfo"]["ReturnMessage"]);
                    $("#divError").css("display", "block");
                     $("#divWait").css("display", "none");
                     $("#divPrint").css("display", "none");
                     $("#divhome").css("display", "block");
                     $("#modelDiv").css("display", "none");
                     $(".loader").hide();
                }
            
            })
        }
        else if(t=='WaterBill')
            {
            $.ajax({
			url: url,
			type: 'post',
			dataType: 'json',
            headers: {
                "Authorization": 'Bearer '+token
            },            
			data: {"LocationID":ClientID,"ReturnBankInfo":{"OrderID": "<?php echo $ordID ?>","ResponseCode": "<?php echo $responcecode1?>","ReasonCode":"<?php echo $reasoncode?>","ReasonCodeDesc": "<?php echo $ResponseCode;?>", "ReferenceNo":"<?php echo $ReferenceNo ?>", "PaddedCardNo": "<?php  echo $CardNo ?>","AuthCode":"<?php echo $authCode?>","BillToToFirstName": "<?php echo $firstName.' '.$middlename ?>","BillToMiddleName":"<?php echo $lastname; ?>", "BillToLastName": "","Signature":"<?php echo $signature?>","SignatureMethod": "<?php echo $signatureMethod?>" }}

		    }).done(function (data){
             
               // console.log(data);
                var returnMsg=data["returnMsgInfo"];
                if(data["ReturnMsgInfo"]["ReturnValue"]=="OK"){
                    if(data["UpdateResponseInfo"]["ReasonCode"]=='1')

                    {
                      
                       
                        $("#divWait").css("display", "none");
                        $("#WBorderId").html(data["UpdateResponseInfo"]["OrderID"]);
                        $("#WBcard").html(data ["UpdateResponseInfo"]["BillToMiddleName"]+' / '+data ["UpdateResponseInfo"]["PaddedCardNo"]);
                        $("#WBref").html(data ["UpdateResponseInfo"]["formID"]);
                        $("#WBcardname").html(data ["UpdateResponseInfo"]["BillToToFirstName"]);
                        // $("#YUamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#WBamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#WBconv").html(data["UpdateResponseInfo"]["ConvenienceFee"]);
                        $("#WBtotttttt").html(data["UpdateResponseInfo"]["TotalAmount"]);
                        $("#WBowner").html(data["UpdateResponseInfo"]["OwnerName"]);
                        $("#WBdate").html(data["UpdateResponseInfo"]["ResultTime"]);
                        $("#WBref").html(data["UpdateResponseInfo"]["ReferenceNo"]);
                        $("#divWaterBill").css("display", "block");
                        $("#divPrint").css("display", "block");
                        $("#divhome").css("display", "none");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                    else{
                        $("#divError").css("display", "block");
                        $("#divWait").css("display", "none");
                        $("#divPrint").css("display", "none");
                        $("#divhome").css("display", "block");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                }
                else{
                    //alert(data["ReturnMsgInfo"]["ReturnMessage"]);
                    $("#divError").css("display", "block");
                     $("#divWait").css("display", "none");
                     $("#divPrint").css("display", "none");
                     $("#divhome").css("display", "block");
                     $("#modelDiv").css("display", "none");
                     $(".loader").hide();
                }
            
            })
        }
        else if(t=='Library')
            {
            $.ajax({
			url: url,
			type: 'post',
			dataType: 'json',
            headers: {
                "Authorization": 'Bearer '+token
            },            
			data: {"LocationID":ClientID,"ReturnBankInfo":{"OrderID": "<?php echo $ordID ?>","ResponseCode": "<?php echo $responcecode1?>","ReasonCode":"<?php echo $reasoncode?>","ReasonCodeDesc": "<?php echo $ResponseCode;?>", "ReferenceNo":"<?php echo $ReferenceNo ?>", "PaddedCardNo": "<?php  echo $CardNo ?>","AuthCode":"<?php echo $authCode?>","BillToToFirstName": "<?php echo $firstName.' '.$middlename ?>","BillToMiddleName":"<?php echo $lastname; ?>", "BillToLastName": "","Signature":"<?php echo $signature?>","SignatureMethod": "<?php echo $signatureMethod?>" }}

		    }).done(function (data){
             
               // console.log(data);
                var returnMsg=data["returnMsgInfo"];
                if(data["returnMsgInfo"]["ReturnValue"]=="OK"){
                    if(data["UpdateResponseInfo"]["ReasonCode"]=='1')

                    {
                      
                       
                        $("#divWait").css("display", "none");
                        $("#LIorderId").html(data["UpdateResponseInfo"]["OrderID"]);
                        $("#LIcard").html(data ["UpdateResponseInfo"]["BillToMiddleName"]+' / '+data ["UpdateResponseInfo"]["PaddedCardNo"]);
                        $("#LIref").html(data ["UpdateResponseInfo"]["formID"]);
                        $("#LIcardname").html(data ["UpdateResponseInfo"]["BillToToFirstName"]);
                        // $("#YUamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#LIamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#LIconv").html(data["UpdateResponseInfo"]["ConvenienceFee"]);
                        $("#LItotttttt").html(data["UpdateResponseInfo"]["TotalAmount"]);
                        $("#LIowner").html(data["UpdateResponseInfo"]["NameOfApplicant"]);
                        $("#LIdate").html(data["UpdateResponseInfo"]["ResultTime"]);
                        $("#LIref").html(data["UpdateResponseInfo"]["ReferenceNo"]);
                        $("#divLibrary").css("display", "block");
                        $("#divPrint").css("display", "block");
                        $("#divhome").css("display", "none");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                    else{
                        $("#divError").css("display", "block");
                        $("#divWait").css("display", "none");
                        $("#divPrint").css("display", "none");
                        $("#divhome").css("display", "block");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                }
                else{
                    //alert(data["ReturnMsgInfo"]["ReturnMessage"]);
                    $("#divError").css("display", "block");
                     $("#divWait").css("display", "none");
                     $("#divPrint").css("display", "none");
                     $("#divhome").css("display", "block");
                     $("#modelDiv").css("display", "none");
                     $(".loader").hide();
                }
            
            })
        }
        else if(t=='Ground')
            {
            $.ajax({
			url: url,
			type: 'post',
			dataType: 'json',
            headers: {
                "Authorization": 'Bearer '+token
            },            
			data: {"LocationID":ClientID,"ReturnBankInfo":{"OrderID": "<?php echo $ordID ?>","ResponseCode": "<?php echo $responcecode1?>","ReasonCode":"<?php echo $reasoncode?>","ReasonCodeDesc": "<?php echo $ResponseCode;?>", "ReferenceNo":"<?php echo $ReferenceNo ?>", "PaddedCardNo": "<?php  echo $CardNo ?>","AuthCode":"<?php echo $authCode?>","BillToToFirstName": "<?php echo $firstName.' '.$middlename ?>","BillToMiddleName":"<?php echo $lastname; ?>", "BillToLastName": "","Signature":"<?php echo $signature?>","SignatureMethod": "<?php echo $signatureMethod?>" }}

		    }).done(function (data){
             
               // console.log(data);
                var returnMsg=data["returnMsgInfo"];
                if(data["returnMsgInfo"]["ReturnValue"]=="OK"){
                    if(data["UpdateResponseInfo"]["ReasonCode"]=='1')

                    {
                      
                       
                        $("#divWait").css("display", "none");
                        $("#GRorderId").html(data["UpdateResponseInfo"]["OrderID"]);
                        $("#GRcard").html(data ["UpdateResponseInfo"]["BillToMiddleName"]+' / '+data ["UpdateResponseInfo"]["PaddedCardNo"]);
                        $("#GRref").html(data ["UpdateResponseInfo"]["formID"]);
                        $("#GRcardname").html(data ["UpdateResponseInfo"]["BillToToFirstName"]);
                        // $("#YUamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#GRamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#GRconv").html(data["UpdateResponseInfo"]["ConvenienceFee"]);
                        $("#GRtotttttt").html(data["UpdateResponseInfo"]["TotalAmount"]);
                        $("#GRowner").html(data["UpdateResponseInfo"]["NameOfApplicant"]);
                        $("#GRdate").html(data["UpdateResponseInfo"]["ResultTime"]);
                        $("#GRref").html(data["UpdateResponseInfo"]["ReferenceNo"]);
                        $("#divGround").css("display", "block");
                        $("#divPrint").css("display", "block");
                        $("#divhome").css("display", "none");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                    else{
                        $("#divError").css("display", "block");
                        $("#divWait").css("display", "none");
                        $("#divPrint").css("display", "none");
                        $("#divhome").css("display", "block");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                }
                else{
                    //alert(data["ReturnMsgInfo"]["ReturnMessage"]);
                    $("#divError").css("display", "block");
                     $("#divWait").css("display", "none");
                     $("#divPrint").css("display", "none");
                     $("#divhome").css("display", "block");
                     $("#modelDiv").css("display", "none");
                     $(".loader").hide();
                }
            
            })
        }
        else if(t=='PNM')
            {
            $.ajax({
			url: url,
			type: 'post',
			dataType: 'json',
            headers: {
                "Authorization": 'Bearer '+token
            },            
			data: {"LocationID":ClientID,"ReturnBankInfo":{"OrderID": "<?php echo $ordID ?>","ResponseCode": "<?php echo $responcecode1?>","ReasonCode":"<?php echo $reasoncode?>","ReasonCodeDesc": "<?php echo $ResponseCode;?>", "ReferenceNo":"<?php echo $ReferenceNo ?>", "PaddedCardNo": "<?php  echo $CardNo ?>","AuthCode":"<?php echo $authCode?>","BillToToFirstName": "<?php echo $firstName.' '.$middlename ?>","BillToMiddleName":"<?php echo $lastname; ?>", "BillToLastName": "","Signature":"<?php echo $signature?>","SignatureMethod": "<?php echo $signatureMethod?>" }}

		    }).done(function (data){
             
               // console.log(data);
                var returnMsg=data["returnMsgInfo"];
                if(data["returnMsgInfo"]["ReturnValue"]=="OK"){
                    if(data["UpdateResponseInfo"]["ReasonCode"]=='1')

                    {
                      
                       
                        $("#divWait").css("display", "none");
                        $("#PNorderId").html(data["UpdateResponseInfo"]["OrderID"]);
                        $("#PNcard").html(data ["UpdateResponseInfo"]["BillToMiddleName"]+' / '+data ["UpdateResponseInfo"]["PaddedCardNo"]);
                        $("#PNref").html(data ["UpdateResponseInfo"]["formID"]);
                        $("#PNcardname").html(data ["UpdateResponseInfo"]["BillToToFirstName"]);
                        // $("#YUamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#PNamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#PNconv").html(data["UpdateResponseInfo"]["ConvenienceFee"]);
                        $("#PNtotttttt").html(data["UpdateResponseInfo"]["TotalAmount"]);
                        $("#PNowner").html(data["UpdateResponseInfo"]["NameOfApplicant"]);
                        $("#PNdate").html(data["UpdateResponseInfo"]["ResultTime"]);
                        $("#PNref").html(data["UpdateResponseInfo"]["ReferenceNo"]);
                        $("#divPNM").css("display", "block");
                        $("#divPrint").css("display", "block");
                        $("#divhome").css("display", "none");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                    else{
                        $("#divError").css("display", "block");
                        $("#divWait").css("display", "none");
                        $("#divPrint").css("display", "none");
                        $("#divhome").css("display", "block");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                }
                else{
                    //alert(data["ReturnMsgInfo"]["ReturnMessage"]);
                    $("#divError").css("display", "block");
                     $("#divWait").css("display", "none");
                     $("#divPrint").css("display", "none");
                     $("#divhome").css("display", "block");
                     $("#modelDiv").css("display", "none");
                     $(".loader").hide();
                }
            
            })
        }
        else if(t=='INVOICE')
            {
            $.ajax({
			url: url,
			type: 'post',
			dataType: 'json',
            headers: {
                "Authorization": 'Bearer '+token
            },            
			data: {"LocationID":ClientID,"ReturnBankInfo":{"OrderID": "<?php echo $ordID ?>","ResponseCode": "<?php echo $responcecode1?>","ReasonCode":"<?php echo $reasoncode?>","ReasonCodeDesc": "<?php echo $ResponseCode;?>", "ReferenceNo":"<?php echo $ReferenceNo ?>", "PaddedCardNo": "<?php  echo $CardNo ?>","AuthCode":"<?php echo $authCode?>","BillToToFirstName": "<?php echo $firstName.' '.$middlename ?>","BillToMiddleName":"<?php echo $lastname; ?>", "BillToLastName": "","Signature":"<?php echo $signature?>","SignatureMethod": "<?php echo $signatureMethod?>" }}

		    }).done(function (data){
             
               // console.log(data);
                var returnMsg=data["returnMsgInfo"];
                if(data["returnMsgInfo"]["ReturnValue"]=="OK"){
                    if(data["UpdateResponseInfo"]["ReasonCode"]=='1')

                    {
                      
                       
                        $("#divWait").css("display", "none");
                        $("#INorderId").html(data["UpdateResponseInfo"]["OrderID"]);
                        $("#INcard").html(data ["UpdateResponseInfo"]["BillToMiddleName"]+' / '+data ["UpdateResponseInfo"]["PaddedCardNo"]);
                        $("#INref").html(data ["UpdateResponseInfo"]["formID"]);
                        $("#INcardname").html(data ["UpdateResponseInfo"]["BillToToFirstName"]);
                        // $("#YUamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#INamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#INconv").html(data["UpdateResponseInfo"]["ConvenienceFee"]);
                        $("#INtotttttt").html(data["UpdateResponseInfo"]["TotalAmount"]);
                        $("#INowner").html(data["UpdateResponseInfo"]["NameOfApplicant"]);
                        $("#INdate").html(data["UpdateResponseInfo"]["ResultTime"]);
                        $("#INref").html(data["UpdateResponseInfo"]["ReferenceNo"]);
                        $("#divINVOICE").css("display", "block");
                        $("#divPrint").css("display", "block");
                        $("#divhome").css("display", "none");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                    else{
                        $("#divError").css("display", "block");
                        $("#divWait").css("display", "none");
                        $("#divPrint").css("display", "none");
                        $("#divhome").css("display", "block");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                }
                else{
                    //alert(data["ReturnMsgInfo"]["ReturnMessage"]);
                    $("#divError").css("display", "block");
                     $("#divWait").css("display", "none");
                     $("#divPrint").css("display", "none");
                     $("#divhome").css("display", "block");
                     $("#modelDiv").css("display", "none");
                     $(".loader").hide();
                }
            
            })
        }
        else if(t=='GARBAGEFEE')
            {
            $.ajax({
			url: url,
			type: 'post',
			dataType: 'json',
            headers: {
                "Authorization": 'Bearer '+token
            },            
			data: {"LocationID":ClientID,"ReturnBankInfo":{"OrderID": "<?php echo $ordID ?>","ResponseCode": "<?php echo $responcecode1?>","ReasonCode":"<?php echo $reasoncode?>","ReasonCodeDesc": "<?php echo $ResponseCode;?>", "ReferenceNo":"<?php echo $ReferenceNo ?>", "PaddedCardNo": "<?php  echo $CardNo ?>","AuthCode":"<?php echo $authCode?>","BillToToFirstName": "<?php echo $firstName.' '.$middlename ?>","BillToMiddleName":"<?php echo $lastname; ?>", "BillToLastName": "","Signature":"<?php echo $signature?>","SignatureMethod": "<?php echo $signatureMethod?>" }}

		    }).done(function (data){
             
               // console.log(data);
                var returnMsg=data["ReturnMsgInfo"];
                if(data["ReturnMsgInfo"]["ReturnValue"]=="OK"){
                    if(data["UpdateResponseInfo"]["ReasonCode"]=='1')

                    {
                      
                       
                        $("#divWait").css("display", "none");
                        $("#GAorderId").html(data["UpdateResponseInfo"]["OrderID"]);
                        $("#GAcard").html(data ["UpdateResponseInfo"]["BillToMiddleName"]+' / '+data ["UpdateResponseInfo"]["PaddedCardNo"]);
                        $("#GAref").html(data ["UpdateResponseInfo"]["formID"]);
                        $("#GAcardname").html(data ["UpdateResponseInfo"]["BillToToFirstName"]);
                        // $("#YUamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#GAamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#GAconv").html(data["UpdateResponseInfo"]["ConvenienceFee"]);
                        $("#GAtotttttt").html(data["UpdateResponseInfo"]["TotalAmount"]);
                        $("#GAowner").html(data["UpdateResponseInfo"]["NameOfApplicant"]);
                        $("#GAdate").html(data["UpdateResponseInfo"]["ResultTime"]);
                        $("#GAref").html(data["UpdateResponseInfo"]["ReferenceNo"]);
                        $("#divGARBAGEFEE").css("display", "block");
                        $("#divPrint").css("display", "block");
                        $("#divhome").css("display", "none");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                    else{
                        $("#divError").css("display", "block");
                        $("#divWait").css("display", "none");
                        $("#divPrint").css("display", "none");
                        $("#divhome").css("display", "block");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                }
                else{
                    //alert(data["ReturnMsgInfo"]["ReturnMessage"]);
                    $("#divError").css("display", "block");
                     $("#divWait").css("display", "none");
                     $("#divPrint").css("display", "none");
                     $("#divhome").css("display", "block");
                     $("#modelDiv").css("display", "none");
                     $(".loader").hide();
                }
            
            })
        }
        else if(t=='Preschool')
            {
            $.ajax({
			url: url,
			type: 'post',
			dataType: 'json',
            headers: {
                "Authorization": 'Bearer '+token
            },            
			data: {"LocationID":ClientID,"ReturnBankInfo":{"OrderID": "<?php echo $ordID ?>","ResponseCode": "<?php echo $responcecode1?>","ReasonCode":"<?php echo $reasoncode?>","ReasonCodeDesc": "<?php echo $ResponseCode;?>", "ReferenceNo":"<?php echo $ReferenceNo ?>", "PaddedCardNo": "<?php  echo $CardNo ?>","AuthCode":"<?php echo $authCode?>","BillToToFirstName": "<?php echo $firstName.' '.$middlename ?>","BillToMiddleName":"<?php echo $lastname; ?>", "BillToLastName": "","Signature":"<?php echo $signature?>","SignatureMethod": "<?php echo $signatureMethod?>" }}

		    }).done(function (data){
             
               // console.log(data);
                var returnMsg=data["returnMsgInfo"];
                if(data["returnMsgInfo"]["ReturnValue"]=="OK"){
                    if(data["UpdateResponseInfo"]["ReasonCode"]=='1')

                    {
                      
                       
                        $("#divWait").css("display", "none");
                        $("#PRorderId").html(data["UpdateResponseInfo"]["OrderID"]);
                        $("#PRcard").html(data ["UpdateResponseInfo"]["BillToMiddleName"]+' / '+data ["UpdateResponseInfo"]["PaddedCardNo"]);
                        $("#PRref").html(data ["UpdateResponseInfo"]["formID"]);
                        $("#PRcardname").html(data ["UpdateResponseInfo"]["BillToToFirstName"]);
                        // $("#YUamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#PRamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#PRconv").html(data["UpdateResponseInfo"]["ConvenienceFee"]);
                        $("#PRtotttttt").html(data["UpdateResponseInfo"]["TotalAmount"]);
                        $("#PRowner").html(data["UpdateResponseInfo"]["NameOfApplicant"]);
                        $("#PRdate").html(data["UpdateResponseInfo"]["ResultTime"]);
                        $("#PRref").html(data["UpdateResponseInfo"]["ReferenceNo"]);
                        $("#divPreschool").css("display", "block");
                        $("#divPrint").css("display", "block");
                        $("#divhome").css("display", "none");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                    else{
                        $("#divError").css("display", "block");
                        $("#divWait").css("display", "none");
                        $("#divPrint").css("display", "none");
                        $("#divhome").css("display", "block");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                }
                else{
                    //alert(data["ReturnMsgInfo"]["ReturnMessage"]);
                    $("#divError").css("display", "block");
                     $("#divWait").css("display", "none");
                     $("#divPrint").css("display", "none");
                     $("#divhome").css("display", "block");
                     $("#modelDiv").css("display", "none");
                     $(".loader").hide();
                }
            
            })
        }
        else if(t=='Cemetery')
            {
            $.ajax({
			url: url,
			type: 'post',
			dataType: 'json',
            headers: {
                "Authorization": 'Bearer '+token
            },            
			data: {"LocationID":ClientID,"ReturnBankInfo":{"OrderID": "<?php echo $ordID ?>","ResponseCode": "<?php echo $responcecode1?>","ReasonCode":"<?php echo $reasoncode?>","ReasonCodeDesc": "<?php echo $ResponseCode;?>", "ReferenceNo":"<?php echo $ReferenceNo ?>", "PaddedCardNo": "<?php  echo $CardNo ?>","AuthCode":"<?php echo $authCode?>","BillToToFirstName": "<?php echo $firstName.' '.$middlename ?>","BillToMiddleName":"<?php echo $lastname; ?>", "BillToLastName": "","Signature":"<?php echo $signature?>","SignatureMethod": "<?php echo $signatureMethod?>" }}

		    }).done(function (data){
             
               // console.log(data);
                var returnMsg=data["returnMsgInfo"];
                if(data["returnMsgInfo"]["ReturnValue"]=="OK"){
                    if(data["UpdateResponseInfo"]["ReasonCode"]=='1')

                    {
                      
                       
                        $("#divWait").css("display", "none");
                        $("#CEorderId").html(data["UpdateResponseInfo"]["OrderID"]);
                        $("#CEcard").html(data ["UpdateResponseInfo"]["BillToMiddleName"]+' / '+data ["UpdateResponseInfo"]["PaddedCardNo"]);
                        $("#CEref").html(data ["UpdateResponseInfo"]["formID"]);
                        $("#CEcardname").html(data ["UpdateResponseInfo"]["BillToToFirstName"]);
                        // $("#YUamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#CEamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#CEconv").html(data["UpdateResponseInfo"]["ConvenienceFee"]);
                        $("#CEtotttttt").html(data["UpdateResponseInfo"]["TotalAmount"]);
                        $("#CEowner").html(data["UpdateResponseInfo"]["NameOfApplicant"]);
                        $("#CEdate").html(data["UpdateResponseInfo"]["ResultTime"]);
                        $("#CEref").html(data["UpdateResponseInfo"]["ReferenceNo"]);
                        $("#divCemetery").css("display", "block");
                        $("#divPrint").css("display", "block");
                        $("#divhome").css("display", "none");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                    else{
                        $("#divError").css("display", "block");
                        $("#divWait").css("display", "none");
                        $("#divPrint").css("display", "none");
                        $("#divhome").css("display", "block");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                }
                else{
                    //alert(data["ReturnMsgInfo"]["ReturnMessage"]);
                    $("#divError").css("display", "block");
                     $("#divWait").css("display", "none");
                     $("#divPrint").css("display", "none");
                     $("#divhome").css("display", "block");
                     $("#modelDiv").css("display", "none");
                     $(".loader").hide();
                }
            
            })
        }
        else if(t=='TownHall')
            {
            $.ajax({
			url: url,
			type: 'post',
			dataType: 'json',
            headers: {
                "Authorization": 'Bearer '+token
            },            
			data: {"LocationID":ClientID,"ReturnBankInfo":{"OrderID": "<?php echo $ordID ?>","ResponseCode": "<?php echo $responcecode1?>","ReasonCode":"<?php echo $reasoncode?>","ReasonCodeDesc": "<?php echo $ResponseCode;?>", "ReferenceNo":"<?php echo $ReferenceNo ?>", "PaddedCardNo": "<?php  echo $CardNo ?>","AuthCode":"<?php echo $authCode?>","BillToToFirstName": "<?php echo $firstName.' '.$middlename ?>","BillToMiddleName":"<?php echo $lastname; ?>", "BillToLastName": "","Signature":"<?php echo $signature?>","SignatureMethod": "<?php echo $signatureMethod?>" }}

		    }).done(function (data){
             
               // console.log(data);
                var returnMsg=data["returnMsgInfo"];
                if(data["returnMsgInfo"]["ReturnValue"]=="OK"){
                    if(data["UpdateResponseInfo"]["ReasonCode"]=='1')

                    {
                      
                       
                        $("#divWait").css("display", "none");
                        $("#TOorderId").html(data["UpdateResponseInfo"]["OrderID"]);
                        $("#TOcard").html(data ["UpdateResponseInfo"]["BillToMiddleName"]+' / '+data ["UpdateResponseInfo"]["PaddedCardNo"]);
                        $("#TOref").html(data ["UpdateResponseInfo"]["formID"]);
                        $("#TOcardname").html(data ["UpdateResponseInfo"]["BillToToFirstName"]);
                        // $("#YUamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#TOamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#TOconv").html(data["UpdateResponseInfo"]["ConvenienceFee"]);
                        $("#TOtotttttt").html(data["UpdateResponseInfo"]["TotalAmount"]);
                        $("#TOowner").html(data["UpdateResponseInfo"]["NameOfApplicant"]);
                        $("#TOdate").html(data["UpdateResponseInfo"]["ResultTime"]);
                        $("#TOref").html(data["UpdateResponseInfo"]["ReferenceNo"]);
                        $("#divTownHall").css("display", "block");
                        $("#divPrint").css("display", "block");
                        $("#divhome").css("display", "none");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                    else{
                        $("#divError").css("display", "block");
                        $("#divWait").css("display", "none");
                        $("#divPrint").css("display", "none");
                        $("#divhome").css("display", "block");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                }
                else{
                    //alert(data["ReturnMsgInfo"]["ReturnMessage"]);
                    $("#divError").css("display", "block");
                     $("#divWait").css("display", "none");
                     $("#divPrint").css("display", "none");
                     $("#divhome").css("display", "block");
                     $("#modelDiv").css("display", "none");
                     $(".loader").hide();
                }
            
            })
        }
        else if(t=='STREETLINE' || t=='NONAQUI')
            {
            $.ajax({
			url: url,
			type: 'post',
			dataType: 'json',
            headers: {
                "Authorization": 'Bearer '+token
            },            
			data: {"LocationID":ClientID,"ReturnBankInfo":{"OrderID": "<?php echo $ordID ?>","ResponseCode": "<?php echo $responcecode1?>","ReasonCode":"<?php echo $reasoncode?>","ReasonCodeDesc": "<?php echo $ResponseCode;?>", "ReferenceNo":"<?php echo $ReferenceNo ?>", "PaddedCardNo": "<?php  echo $CardNo ?>","AuthCode":"<?php echo $authCode?>","BillToToFirstName": "<?php echo $firstName.' '.$middlename ?>","BillToMiddleName":"<?php echo $lastname; ?>", "BillToLastName": "","Signature":"<?php echo $signature?>","SignatureMethod": "<?php echo $signatureMethod?>" }}

		    }).done(function (data){
             
               // console.log(data);
                var returnMsg=data["returnMsgInfo"];
                if(data["returnMsgInfo"]["ReturnValue"]=="OK"){
                    if(data["updateResponseInfo"]["ReasonCode"]=='1')

                    {
                    
                       
                        $("#divWait").css("display", "none");
                        $("#STorderId").html(data["updateResponseInfo"]["OrderID"]);
                        $("#STcard").html(data ["updateResponseInfo"]["BillToMiddleName"]+' / '+data ["updateResponseInfo"]["PaddedCardNo"]);
                        $("#STref").html(data ["updateResponseInfo"]["formID"]);
                        $("#STcardname").html(data ["updateResponseInfo"]["BillToToFirstName"]);
                        // $("#YUamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#STamountttttt").html(data["updateResponseInfo"]["PayAmount"]);
                        $("#STconv").html(data["updateResponseInfo"]["ConvenienceFee"]);
                        $("#STtotttttt").html(data["updateResponseInfo"]["TotalAmount"]);
                        $("#STowner").html(data["updateResponseInfo"]["NameOfApplicant"]);
                        $("#STdate").html(data["updateResponseInfo"]["ResultTime"]);
                        $("#STref").html(data["updateResponseInfo"]["ReferenceNo"]);
                        $("#divSTREETLINE").css("display", "block");
                        $("#divPrint").css("display", "block");
                        $("#divhome").css("display", "none");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                    else{
                        $("#divError").css("display", "block");
                        $("#divWait").css("display", "none");
                        $("#divPrint").css("display", "none");
                        $("#divhome").css("display", "block");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                }
                else{
                    //alert(data["ReturnMsgInfo"]["ReturnMessage"]);
                    $("#divError").css("display", "block");
                     $("#divWait").css("display", "none");
                     $("#divPrint").css("display", "none");
                     $("#divhome").css("display", "block");
                     $("#modelDiv").css("display", "none");
                     $(".loader").hide();
                }
            
            })
        }
        else if(t=='Gully')
            {
            $.ajax({
			url: url,
			type: 'post',
			dataType: 'json',
            headers: {
                "Authorization": 'Bearer '+token
            },            
			data: {"LocationID":ClientID,"ReturnBankInfo":{"OrderID": "<?php echo $ordID ?>","ResponseCode": "<?php echo $responcecode1?>","ReasonCode":"<?php echo $reasoncode?>","ReasonCodeDesc": "<?php echo $ResponseCode;?>", "ReferenceNo":"<?php echo $ReferenceNo ?>", "PaddedCardNo": "<?php  echo $CardNo ?>","AuthCode":"<?php echo $authCode?>","BillToToFirstName": "<?php echo $firstName.' '.$middlename ?>","BillToMiddleName":"<?php echo $lastname; ?>", "BillToLastName": "","Signature":"<?php echo $signature?>","SignatureMethod": "<?php echo $signatureMethod?>" }}

		    }).done(function (data){
             
               // console.log(data);
                var returnMsg=data["returnMsgInfo"];
                if(data["returnMsgInfo"]["ReturnValue"]=="OK"){
                    if(data["UpdateResponseInfo"]["ReasonCode"]=='1')

                    {
                      
                       
                        $("#divWait").css("display", "none");
                        $("#GUorderId").html(data["UpdateResponseInfo"]["OrderID"]);
                        $("#GUcard").html(data ["UpdateResponseInfo"]["BillToMiddleName"]+' / '+data ["UpdateResponseInfo"]["PaddedCardNo"]);
                        $("#GUref").html(data ["UpdateResponseInfo"]["formID"]);
                        $("#GUcardname").html(data ["UpdateResponseInfo"]["BillToToFirstName"]);
                        // $("#YUamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#GUamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#GUconv").html(data["UpdateResponseInfo"]["ConvenienceFee"]);
                        $("#GUtotttttt").html(data["UpdateResponseInfo"]["TotalAmount"]);
                        $("#GUowner").html(data["UpdateResponseInfo"]["NameOfApplicant"]);
                        $("#GUdate").html(data["UpdateResponseInfo"]["ResultTime"]);
                        $("#GUref").html(data["UpdateResponseInfo"]["ReferenceNo"]);
                        $("#divGully").css("display", "block");
                        $("#divPrint").css("display", "block");
                        $("#divhome").css("display", "none");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                    else{
                        $("#divError").css("display", "block");
                        $("#divWait").css("display", "none");
                        $("#divPrint").css("display", "none");
                        $("#divhome").css("display", "block");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                }
                else{
                    //alert(data["ReturnMsgInfo"]["ReturnMessage"]);
                    $("#divError").css("display", "block");
                     $("#divWait").css("display", "none");
                     $("#divPrint").css("display", "none");
                     $("#divhome").css("display", "block");
                     $("#modelDiv").css("display", "none");
                     $(".loader").hide();
                }
            
            })
        }
        else if(t=='SalesItem')
            {
            $.ajax({
			url: url,
			type: 'post',
			dataType: 'json',
            headers: {
                "Authorization": 'Bearer '+token
            },            
			data: {"LocationID":ClientID,"ReturnBankInfo":{"OrderID": "<?php echo $ordID ?>","ResponseCode": "<?php echo $responcecode1?>","ReasonCode":"<?php echo $reasoncode?>","ReasonCodeDesc": "<?php echo $ResponseCode;?>", "ReferenceNo":"<?php echo $ReferenceNo ?>", "PaddedCardNo": "<?php  echo $CardNo ?>","AuthCode":"<?php echo $authCode?>","BillToToFirstName": "<?php echo $firstName.' '.$middlename ?>","BillToMiddleName":"<?php echo $lastname; ?>", "BillToLastName": "","Signature":"<?php echo $signature?>","SignatureMethod": "<?php echo $signatureMethod?>" }}

		    }).done(function (data){
             
               // console.log(data);
                var returnMsg=data["returnMsgInfo"];
                if(data["returnMsgInfo"]["ReturnValue"]=="OK"){
                    if(data["UpdateResponseInfo"]["ReasonCode"]=='1')

                    {
                      
                       
                        $("#divWait").css("display", "none");
                        $("#SAorderId").html(data["UpdateResponseInfo"]["OrderID"]);
                        $("#SAcard").html(data ["UpdateResponseInfo"]["BillToMiddleName"]+' / '+data ["UpdateResponseInfo"]["PaddedCardNo"]);
                        $("#SAref").html(data ["UpdateResponseInfo"]["formID"]);
                        $("#SAcardname").html(data ["UpdateResponseInfo"]["BillToToFirstName"]);
                        // $("#YUamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#SAamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#SAconv").html(data["UpdateResponseInfo"]["ConvenienceFee"]);
                        $("#SAtotttttt").html(data["UpdateResponseInfo"]["TotalAmount"]);
                        $("#SAowner").html(data["UpdateResponseInfo"]["NameOfApplicant"]);
                        $("#SAdate").html(data["UpdateResponseInfo"]["ResultTime"]);
                        $("#SAref").html(data["UpdateResponseInfo"]["ReferenceNo"]);
                        $("#divSalesItem").css("display", "block");
                        $("#divPrint").css("display", "block");
                        $("#divhome").css("display", "none");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                    else{
                        $("#divError").css("display", "block");
                        $("#divWait").css("display", "none");
                        $("#divPrint").css("display", "none");
                        $("#divhome").css("display", "block");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                }
                else{
                    //alert(data["ReturnMsgInfo"]["ReturnMessage"]);
                    $("#divError").css("display", "block");
                     $("#divWait").css("display", "none");
                     $("#divPrint").css("display", "none");
                     $("#divhome").css("display", "block");
                     $("#modelDiv").css("display", "none");
                     $(".loader").hide();
                }
            
            })
        }
        else if(t=='TRADELICENSE')
            {
            $.ajax({
			url: url,
			type: 'post',
			dataType: 'json',
            headers: {
                "Authorization": 'Bearer '+token
            },            
			data: {"LocationID":ClientID,"ReturnBankInfo":{"OrderID": "<?php echo $ordID ?>","ResponseCode": "<?php echo $responcecode1?>","ReasonCode":"<?php echo $reasoncode?>","ReasonCodeDesc": "<?php echo $ResponseCode;?>", "ReferenceNo":"<?php echo $ReferenceNo ?>", "PaddedCardNo": "<?php  echo $CardNo ?>","AuthCode":"<?php echo $authCode?>","BillToToFirstName": "<?php echo $firstName.' '.$middlename ?>","BillToMiddleName":"<?php echo $lastname; ?>", "BillToLastName": "","Signature":"<?php echo $signature?>","SignatureMethod": "<?php echo $signatureMethod?>" }}

		    }).done(function (data){
             
               // console.log(data);
                var returnMsg=data["returnMsgInfo"];
                if(data["returnMsgInfo"]["ReturnValue"]=="OK"){
                    if(data["UpdateResponseInfo"]["ReasonCode"]=='1')

                    {
                      
                       
                        $("#divWait").css("display", "none");
                        $("#TRorderId").html(data["UpdateResponseInfo"]["OrderID"]);
                        $("#TRcard").html(data ["UpdateResponseInfo"]["BillToMiddleName"]+' / '+data ["UpdateResponseInfo"]["PaddedCardNo"]);
                        $("#TRref").html(data ["UpdateResponseInfo"]["formID"]);
                        $("#TRcardname").html(data ["UpdateResponseInfo"]["BillToToFirstName"]);
                        // $("#YUamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#TRamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#TRconv").html(data["UpdateResponseInfo"]["ConvenienceFee"]);
                        $("#TRtotttttt").html(data["UpdateResponseInfo"]["TotalAmount"]);
                        $("#TRowner").html(data["UpdateResponseInfo"]["NameOfApplicant"]);
                        $("#TRdate").html(data["UpdateResponseInfo"]["ResultTime"]);
                        $("#TRref").html(data["UpdateResponseInfo"]["ReferenceNo"]);
                        $("#divTRADELICENSE").css("display", "block");
                        $("#divPrint").css("display", "block");
                        $("#divhome").css("display", "none");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                    else{
                        $("#divError").css("display", "block");
                        $("#divWait").css("display", "none");
                        $("#divPrint").css("display", "none");
                        $("#divhome").css("display", "block");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                }
                else{
                    //alert(data["ReturnMsgInfo"]["ReturnMessage"]);
                    $("#divError").css("display", "block");
                     $("#divWait").css("display", "none");
                     $("#divPrint").css("display", "none");
                     $("#divhome").css("display", "block");
                     $("#modelDiv").css("display", "none");
                     $(".loader").hide();
                }
            
            })
        }
        else if(t=='Crematoriums')
            {
            $.ajax({
			url: url,
			type: 'post',
			dataType: 'json',
            headers: {
                "Authorization": 'Bearer '+token
            },            
			data: {"LocationID":ClientID,"ReturnBankInfo":{"OrderID": "<?php echo $ordID ?>","ResponseCode": "<?php echo $responcecode1?>","ReasonCode":"<?php echo $reasoncode?>","ReasonCodeDesc": "<?php echo $ResponseCode;?>", "ReferenceNo":"<?php echo $ReferenceNo ?>", "PaddedCardNo": "<?php  echo $CardNo ?>","AuthCode":"<?php echo $authCode?>","BillToToFirstName": "<?php echo $firstName.' '.$middlename ?>","BillToMiddleName":"<?php echo $lastname; ?>", "BillToLastName": "","Signature":"<?php echo $signature?>","SignatureMethod": "<?php echo $signatureMethod?>" }}

		    }).done(function (data){
             
               // console.log(data);
                var returnMsg=data["returnMsgInfo"];
                if(data["returnMsgInfo"]["ReturnValue"]=="OK"){
                    if(data["UpdateResponseInfo"]["ReasonCode"]=='1')

                    {
                      
                       
                        $("#divWait").css("display", "none");
                        $("#CRorderId").html(data["UpdateResponseInfo"]["OrderID"]);
                        $("#CRcard").html(data ["UpdateResponseInfo"]["BillToMiddleName"]+' / '+data ["UpdateResponseInfo"]["PaddedCardNo"]);
                        $("#CRref").html(data ["UpdateResponseInfo"]["formID"]);
                        $("#CRcardname").html(data ["UpdateResponseInfo"]["BillToToFirstName"]);
                        // $("#YUamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#CRamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#CRconv").html(data["UpdateResponseInfo"]["ConvenienceFee"]);
                        $("#CRtotttttt").html(data["UpdateResponseInfo"]["TotalAmount"]);
                        $("#CRowner").html(data["UpdateResponseInfo"]["NameOfApplicant"]);
                        $("#CRdate").html(data["UpdateResponseInfo"]["ResultTime"]);
                        $("#CRref").html(data["UpdateResponseInfo"]["ReferenceNo"]);
                        $("#divCrematoriums").css("display", "block");
                        $("#divPrint").css("display", "block");
                        $("#divhome").css("display", "none");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                    else{
                        $("#divError").css("display", "block");
                        $("#divWait").css("display", "none");
                        $("#divPrint").css("display", "none");
                        $("#divhome").css("display", "block");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                }
                else{
                    //alert(data["ReturnMsgInfo"]["ReturnMessage"]);
                    $("#divError").css("display", "block");
                     $("#divWait").css("display", "none");
                     $("#divPrint").css("display", "none");
                     $("#divhome").css("display", "block");
                     $("#modelDiv").css("display", "none");
                     $(".loader").hide();
                }
            
            })
        }
        else if(t=='BUSINESSTAX')
            {
            $.ajax({
			url: url,
			type: 'post',
			dataType: 'json',
            headers: {
                "Authorization": 'Bearer '+token
            },            
			data: {"LocationID":ClientID,"ReturnBankInfo":{"OrderID": "<?php echo $ordID ?>","ResponseCode": "<?php echo $responcecode1?>","ReasonCode":"<?php echo $reasoncode?>","ReasonCodeDesc": "<?php echo $ResponseCode;?>", "ReferenceNo":"<?php echo $ReferenceNo ?>", "PaddedCardNo": "<?php  echo $CardNo ?>","AuthCode":"<?php echo $authCode?>","BillToToFirstName": "<?php echo $firstName.' '.$middlename ?>","BillToMiddleName":"<?php echo $lastname; ?>", "BillToLastName": "","Signature":"<?php echo $signature?>","SignatureMethod": "<?php echo $signatureMethod?>" }}

		    }).done(function (data){
             
               // console.log(data);
                var returnMsg=data["ReturnMsgInfo"];
                if(data["ReturnMsgInfo"]["ReturnValue"]=="OK"){
                    if(data["UpdateResponseInfo"]["ReasonCode"]=='1')

                    {
                      
                       
                        $("#divWait").css("display", "none");
                        $("#BUorderId").html(data["UpdateResponseInfo"]["OrderID"]);
                        $("#BUcard").html(data ["UpdateResponseInfo"]["BillToMiddleName"]+' / '+data ["UpdateResponseInfo"]["PaddedCardNo"]);
                        $("#BUref").html(data ["UpdateResponseInfo"]["formID"]);
                        $("#BUcardname").html(data ["UpdateResponseInfo"]["BillToToFirstName"]);
                        // $("#YUamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#BUamountttttt").html(data["UpdateResponseInfo"]["PayAmount"]);
                        $("#BUconv").html(data["UpdateResponseInfo"]["ConvenienceFee"]);
                        $("#BUtotttttt").html(data["UpdateResponseInfo"]["TotalAmount"]);
                        $("#BUowner").html(data["UpdateResponseInfo"]["NameOfApplicant"]);
                        $("#BUdate").html(data["UpdateResponseInfo"]["ResultTime"]);
                        $("#BUref").html(data["UpdateResponseInfo"]["ReferenceNo"]);
                        $("#divBUSINESSTAX").css("display", "block");
                        $("#divPrint").css("display", "block");
                        $("#divhome").css("display", "none");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                    else{
                        $("#divError").css("display", "block");
                        $("#divWait").css("display", "none");
                        $("#divPrint").css("display", "none");
                        $("#divhome").css("display", "block");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                }
                else{
                    //alert(data["ReturnMsgInfo"]["ReturnMessage"]);
                    $("#divError").css("display", "block");
                     $("#divWait").css("display", "none");
                     $("#divPrint").css("display", "none");
                     $("#divhome").css("display", "block");
                     $("#modelDiv").css("display", "none");
                     $(".loader").hide();
                }
            
            })
        }
        else if(t=='Photoshoot')
            {

            var reasonCode = "<?php echo $reasoncode?>";
            var responseCode = "<?php echo $responcecode1?>";

            $.ajax({
			url: url,
			type: 'post',
			dataType: 'json',
            headers: {
                "Authorization": 'Bearer '+token
            },            
			data: {         
                    "OrderID": "<?php echo $ordID ?>",
                    "ResponseCode":responseCode,
                    "ReasonCode":reasonCode,
                    "ReasonCodeDesc": "<?php echo $ResponseCode;?>", 
                    "ReferenceNo":"<?php echo $ReferenceNo ?>", 
                    "PaddedCardNo": "<?php  echo $CardNo ?>",
                    "AuthCode":"<?php echo $authCode?>",
                    "BillToToFirstName": "<?php echo $firstName.' '.$middlename ?>",
                    "BillToMiddleName":"<?php echo $lastname; ?>", 
                    "BillToLastName": "",
                    "Signature":"<?php echo $signature?>",
                    "SignatureMethod": "<?php echo $signatureMethod?>",
                    "ResultTime":"<?php echo date("Y/m/d h:i")?>",
                    "User":user,
                    "ClientID":ClientID
                }
                
		    }).done(function (data)
            {     
                
                 var returnValue = data.ReturnMessageInfo.ReturnValue;
                 var paymentRslt =  data.PaymentResult;

                if(returnValue == "OK")
                {
                    if(reasonCode == '1' && responseCode == '1')
                    {                                             
                        $("#divWait").css("display", "none");
                        $("#PHorderId").html(paymentRslt["OrderID"]);
                        $("#PHcard").html(paymentRslt["PayByMiddleName"]);
                        $("#PHcardn").html(paymentRslt["CardNo"]);
                        $("#PHref").html(paymentRslt["ApplicationId"]);
                        $("#PHphotorefno").html(paymentRslt["BookingId"]);
                        $("#PHcardname").html(paymentRslt["PayByFirstName"]);
                        $("#PHnic").html(paymentRslt["NIC"]);
                        $("#PHamountttttt").html(paymentRslt["PayAmount"]);
                        $("#PHconv").html(paymentRslt["ConvenienceFee"]);
                        $("#PHtotttttt").html(paymentRslt["TotalAmount"]);
                        $("#PHowner").html(paymentRslt["Name"]);
                        $("#PHdate").html(paymentRslt["PaidDate"]);
                        $("#PHref").html(paymentRslt["ReferenceNo"]);
                        $("#divPhotoshoot").css("display", "block");
                        $("#divPrint").css("display", "block");
                        $("#divhome").css("display", "none");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                    else{
                        $("#divError").css("display", "block");
                        $("#divWait").css("display", "none");
                        $("#divPrint").css("display", "none");
                        $("#divhome").css("display", "block");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                }
                else{
                    //alert(data["ReturnMsgInfo"]["ReturnMessage"]);
                    $("#divError").css("display", "block");
                     $("#divWait").css("display", "none");
                     $("#divPrint").css("display", "none");
                     $("#divhome").css("display", "block");
                     $("#modelDiv").css("display", "none");
                     $(".loader").hide();
                }
            
            })
        }
        else if(t=='WalkingLane') //Walking Lane 
        {
            $.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
            headers: {
                "Authorization": 'Bearer '+ token
            },
			data: {
        "ClientID":ClientID, "OrderID": "<?php echo $ordID ?>","ResponseCode": "<?php echo $responcecode1?>","ReasonCode":"<?php echo $reasoncode?>","ReasonCodeDesc": "<?php echo $ResponseCode;?>", "ReferenceNo":"<?php echo $ReferenceNo ?>",
        "PaddedCardNo": "<?php  echo $CardNo ?>","AuthCode":"<?php echo $authCode?>","BillToToFirstName": "<?php echo $firstName.' '.$middlename ?>","BillToMiddleName":"<?php echo $lastname; ?>", "BillToLastName": "","Signature":"<?php echo $signature?>",
        "SignatureMethod": "<?php echo $signatureMethod?>"}

		    }).done(function (data){

               // console.log(data);
                var returnMsg=data["ReturnMessageInfo"];
                if(data["ReturnMessageInfo"]["ReturnValue"]=="OK"){
                    if(data["ReturnPaidDetails"]["ReasonCode"]=='1')

                    {

                        //Applicant Details
                        $("#divWait").css("display", "none");
                        $("#wlOrderId").html(data["ReturnPaidDetails"]["OrderID"]);
                        $("#wlServiceName").html(data["ReturnPaidDetails"]["ServiceName"]);
                        $("#wlOwner").html(data["ReturnPaidDetails"]["ApplicantName"]);
                        $("#wlApplicantAddress").html(data["ReturnPaidDetails"]["ApplicantAddress"]);
                        $("#wlApplicantMobileNo").html(data["ReturnPaidDetails"]["ApplicantMobile"]);
                        $("#wlApplicantNIC").html(data["ReturnPaidDetails"]["ApplicantNIC"]);
                        //Payment Details
                        $("#wlAmount").html(data["ReturnPaidDetails"]["Amount"]);
                        $("#wlConv").html(data["ReturnPaidDetails"]["BankCharges"]);
                        $("#wlAppCharges").html(data["ReturnPaidDetails"]["ApplicationFee"]);
                        $("#wlTotal").html(data["ReturnPaidDetails"]["TotalAmount"]);
                        //Bank Details
                        $("#wlCard").html(data ["ReturnPaidDetails"]["BillToMiddleName"]+' / '+ data ["ReturnPaidDetails"]["PaddedCardNo"]);
                        $("#wlCardName").html(data ["ReturnPaidDetails"]["BillToFirstName"]);
                        $("#wlRef").html(data["ReturnPaidDetails"]["ReferenceNo"]);
                        $("#wlDate").html(data["ReturnPaidDetails"]["ResultTime"]);
                        
                        $("#divWalkingLane").css("display", "block");
                        $("#divPrint").css("display", "block");
                        $("#divhome").css("display", "none");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                    else{
                        $("#divError").css("display", "block");
                        $("#divWait").css("display", "none");
                        $("#divPrint").css("display", "none");
                        $("#divhome").css("display", "block");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                }
                else{
                    //alert(data["ReturnMsgInfo"]["ReturnMessage"]);
                    $("#divError").css("display", "block");
                     $("#divWait").css("display", "none");
                     $("#divPrint").css("display", "none");
                     $("#divhome").css("display", "block");
                     $("#modelDiv").css("display", "none");
                     $(".loader").hide();
                }

            })
        }
        else if(t=='RateCertificate') //RateCertificate
        {
            $.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
            headers: {
                "Authorization": 'Bearer '+ token
            },
			data: {
        "ClientID":ClientID, "OrderID": "<?php echo $ordID ?>","ResponseCode": "<?php echo $responcecode1?>","ReasonCode":"<?php echo $reasoncode?>","ReasonCodeDesc": "<?php echo $ResponseCode;?>", "ReferenceNo":"<?php echo $ReferenceNo ?>",
        "PaddedCardNo": "<?php  echo $CardNo ?>","AuthCode":"<?php echo $authCode?>","BillToToFirstName": "<?php echo $firstName.' '.$middlename ?>","BillToMiddleName":"<?php echo $lastname; ?>", "BillToLastName": "","Signature":"<?php echo $signature?>",
        "SignatureMethod": "<?php echo $signatureMethod?>"}

		    }).done(function (data){

               // console.log(data);
                var returnMsg=data["ReturnMessageInfo"];
                if(data["ReturnMessageInfo"]["ReturnValue"]=="OK"){
                    if(data["ReturnPaidDetails"]["ReasonCode"]=='1')

                    {

                        //Applicant Details
                        $("#divWait").css("display", "none");
                        $("#rcOrderId").html(data["ReturnPaidDetails"]["OrderID"]); 
                        $("#rcApplicationIndexNo").html(data["ReturnPaidDetails"]["ApplicantIndexNo"]);
                        $("#rcServiceName").html(data["ReturnPaidDetails"]["ServiceName"]);
                        $("#rcOwner").html(data["ReturnPaidDetails"]["ApplicantName"]);
                        $("#rcApplicantAddress").html(data["ReturnPaidDetails"]["ApplicantAddress"]);
                        $("#rcApplicantMobileNo").html(data["ReturnPaidDetails"]["ApplicantMobile"]);
                        $("#rcApplicantNIC").html(data["ReturnPaidDetails"]["ApplicantNIC"]);
                        //Payment Details
                        $("#rcAmount").html(data["ReturnPaidDetails"]["Amount"]);
                        $("#rcConv").html(data["ReturnPaidDetails"]["BankCharges"]);
                        $("#rcPostalFee").html(data["ReturnPaidDetails"]["PostalFee"]);
                        
                        $("#rcTotal").html(data["ReturnPaidDetails"]["TotalAmount"]);
                        //Bank Details
                        $("#rcCard").html(data ["ReturnPaidDetails"]["PaddedCardNo"]);
                        // $("#rcCardName").html(data ["ReturnPaidDetails"]["BillToFirstName"]);
                        $("#rcRef").html(data["ReturnPaidDetails"]["ReferenceNo"]);
                        $("#rcDate").html(data["ReturnPaidDetails"]["ResultTime"]);
                        
                        $("#divRateCertificate").css("display", "block");
                        $("#divPrint").css("display", "block");
                        $("#divhome").css("display", "none");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                    else{
                        $("#divError").css("display", "block");
                        $("#divWait").css("display", "none");
                        $("#divPrint").css("display", "none");
                        $("#divhome").css("display", "block");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                }
                else{
                    //alert(data["ReturnMsgInfo"]["ReturnMessage"]);
                    $("#divError").css("display", "block");
                     $("#divWait").css("display", "none");
                     $("#divPrint").css("display", "none");
                     $("#divhome").css("display", "block");
                     $("#modelDiv").css("display", "none");
                     $(".loader").hide();
                }

            })
        }

        else if(t=='Procument')
            {

            var reasonCode = "<?php echo $reasoncode?>";
            var responseCode = "<?php echo $responcecode1?>";

            $.ajax({
			url: url,
			type: 'post',
			dataType: 'json',
            headers: {
                "Authorization": 'Bearer '+token
            },            
			data: {         
                    "OrderID": "<?php echo $ordID ?>",
                    "ResponseCode":responseCode,
                    "ReasonCode":reasonCode,
                    "ReasonCodeDesc": "<?php echo $ResponseCode;?>", 
                    "ReferenceNo":"<?php echo $ReferenceNo ?>", 
                    "PaddedCardNo": "<?php  echo $CardNo ?>",
                    "AuthCode":"<?php echo $authCode?>",
                    "BillToToFirstName": "<?php echo $firstName.' '.$middlename ?>",
                    "BillToMiddleName":"<?php echo $lastname; ?>", 
                    "BillToLastName": "",
                    "Signature":"<?php echo $signature?>",
                    "SignatureMethod": "<?php echo $signatureMethod?>",
                    "ResultTime":"<?php echo date("Y/m/d h:i")?>",
                    "User":user,
                    "ClientID":ClientID
                }
                
		    }).done(function (data)
            {     
                
                 var returnValue = data.ReturnMessageInfo.ReturnValue;
                 var paymentRslt =  data.PaymentResult;

                if(returnValue == "OK")
                {
                    if(reasonCode == '1' && responseCode == '1')
                    {                                             
                        $("#divWait").css("display", "none");
                        $("#PCorderId").html(paymentRslt["OrderID"]);
                        $("#PCcard").html(paymentRslt["PayByMiddleName"]);
                        $("#PCcardn").html(paymentRslt["CardNo"]);
                        $("#PCaddress").html(paymentRslt["Address"]);
                        $("#PCmobilenumber").html(paymentRslt["Mobile"]);
                        $("#PCappid").html(paymentRslt["AppCode"]);
                        $("#PCprocumentefno").html(paymentRslt["ServiceName"]);
                        $("#PCcardname").html(paymentRslt["PayByFirstName"]);
                        $("#PCnic").html(paymentRslt["NIC"]);
                        $("#PCamountttttt").html(paymentRslt["PayAmount"]);
                        $("#PCconv").html(paymentRslt["ConvenienceFee"]);
                        $("#PCtotttttt").html(paymentRslt["TotalAmount"]);
                        $("#PCowner").html(paymentRslt["Name"]);
                        $("#PCdate").html(paymentRslt["PaidDate"].replace('00:00',' '));
                        $("#PCref").html(paymentRslt["ReferenceNo"]);
                        $("#divProcument").css("display", "block");
                        $("#divPrint").css("display", "block");
                        $("#divhome").css("display", "none");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                    else{
                        $("#divError").css("display", "block");
                        $("#divWait").css("display", "none");
                        $("#divPrint").css("display", "none");
                        $("#divhome").css("display", "block");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                }
                else{
                    //alert(data["ReturnMsgInfo"]["ReturnMessage"]);
                    $("#divError").css("display", "block");
                     $("#divWait").css("display", "none");
                     $("#divPrint").css("display", "none");
                     $("#divhome").css("display", "block");
                     $("#modelDiv").css("display", "none");
                     $(".loader").hide();
                }
            
            })
        }
        //Fire Certificate
        else if(t=='FireCertificate') 
        {
            $.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
            headers: {
                "Authorization": 'Bearer '+ token
            },
			data: {
            "ClientID":ClientID, "OrderID": "<?php echo $ordID ?>","ResponseCode": "<?php echo $responcecode1?>","ReasonCode":"<?php echo $reasoncode?>","ReasonCodeDesc": "<?php echo $ResponseCode;?>", "ReferenceNo":"<?php echo $ReferenceNo ?>",
            "PaddedCardNo": "<?php  echo $CardNo ?>","AuthCode":"<?php echo $authCode?>","BillToToFirstName": "<?php echo $firstName.' '.$middlename ?>","BillToMiddleName":"<?php echo $lastname; ?>", "BillToLastName": "","Signature":"<?php echo $signature?>",
            "SignatureMethod": "<?php echo $signatureMethod?>"}

		    }).done(function (data)
            {

           // var bCharge  = data.PaidDetails.BankCharges.toFixed(2);

                        //var bankCharges = bCharge["BankCharges"];
                        //var edit1 = parseFloat(bankCharges);
                       // var edit2 = bankCharges.toFixed(2); 

                        //alert(number_format((float)$foo, 2, '.', '');); 
                    



           
            
               // console.log(data);
                var returnMsg=data["ReturnMsg"];
                if(data["ReturnMsg"]["ReturnValue"]=="OK"){
                    if(data["PaidDetails"]["ReasonCode"]=='1')

                    {
                        //Applicant Details
                        $("#divWait").css("display", "none");
                        $("#FIOrderId").html(data["PaidDetails"]["OrderID"]);
                        $("#FICertId").html(data["PaidDetails"]["CertificateId"]);
                        $("#FIServiceName").html(data["PaidDetails"]["ServiceName"]);
                        $("#FIOwner").html(data["PaidDetails"]["ApplicantName"]);
                        $("#FIApplicantAddress").html(data["PaidDetails"]["ApplicantAddress"]);
                        $("#FIApplicantMobileNo").html(data["PaidDetails"]["ApplicantMobile"]);
                        //$("#FIApplicantNIC").html(data["PaidDetails"]["ApplicantNIC"]);
                        //Payment Details
                        $("#FIAmount").html(data["PaidDetails"]["Amount"]);
                        //$("#FIConv").html(bankcharges.tofixed(2));
                        //$("#FIConv").html(bCharge);
                        $("#FIConv").html(data["PaidDetails"]["BankCharges"]);
                        $("#FIAppCharges").html(data["PaidDetails"]["ConsultantFee"]);
                        $("#FIInspecCharges").html(data["PaidDetails"]["InspectionFees"]);
                        $("#FICertificateCharges").html(data["PaidDetails"]["AnnualCertificate"]);
                        $("#FITotal").html(data["PaidDetails"]["TotalPayment"]);
                        //Bank Details
                        $("#FICard").html(data ["PaidDetails"]["BillToMiddleName"]+' / '+ data ["PaidDetails"]["PaddedCardNo"]);
                        $("#FICardName").html(data ["PaidDetails"]["BillToFirstName"]);
                        $("#FIRef").html(data["PaidDetails"]["ReferenceNo"]);
                        $("#FIDate").html(data["PaidDetails"]["ResultTime"]);
                        
                        $("#divFireCertificate").css("display", "block");
                        $("#divPrint").css("display", "block");
                        $("#divhome").css("display", "none");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                    else{
                        $("#divError").css("display", "block");
                        $("#divWait").css("display", "none");
                        $("#divPrint").css("display", "none");
                        $("#divhome").css("display", "block");
                        $("#modelDiv").css("display", "none");
                        $(".loader").hide();
                    }
                }
                else{
                    //alert(data["ReturnMsgInfo"]["ReturnMessage"]);
                    $("#divError").css("display", "block");
                     $("#divWait").css("display", "none");
                     $("#divPrint").css("display", "none");
                     $("#divhome").css("display", "block");
                     $("#modelDiv").css("display", "none");
                     $(".loader").hide();
                }

            })
        }


                
    }
                
    
    </script>
      <script>
        function printDiv() {
            var t='<?php echo $type ?>';

            var divContents = document.getElementById("divMain").innerHTML;
            if(t == 'NewPropertyNo'){                
				divContents = document.getElementById("divNewpropertyNo").innerHTML;
            }
            if(t == 'WaterBill'){                
				divContents = document.getElementById("divWaterBill").innerHTML;
            }
            if(t == 'Library'){                
				divContents = document.getElementById("divLibrary").innerHTML;
            }
            if(t == 'Ground'){                
				divContents = document.getElementById("divGround").innerHTML;
            }
            if(t == 'PNM'){                
				divContents = document.getElementById("divPNM").innerHTML;
            }
            if(t == 'INVOICE'){                
				divContents = document.getElementById("divINVOICE").innerHTML;
            }
            if(t == 'GARBAGEFEE'){                
				divContents = document.getElementById("divGARBAGEFEE").innerHTML;
            }
            if(t == 'Preschool'){                
				divContents = document.getElementById("divPreschool").innerHTML;
            }
            if(t == 'Cemetery'){                
				divContents = document.getElementById("divCemetery").innerHTML;
            }
            if(t == 'TownHall'){                
				divContents = document.getElementById("divTownHall").innerHTML;
            }
            
            if(t == 'STREETLINE'|| t == 'NONAQUI'){    
				divContents = document.getElementById("divSTREETLINE").innerHTML;
            }
            if(t == 'Gully'){                
				divContents = document.getElementById("divGully").innerHTML;
            }
            if(t == 'SalesItem'){                
				divContents = document.getElementById("divSalesItem").innerHTML;
            }
            if(t == 'TRADELICENSE'){                
				divContents = document.getElementById("divTRADELICENSE").innerHTML;
            }
            if(t == 'Crematoriums'){                
				divContents = document.getElementById("divCrematoriums").innerHTML;
            }
            if(t == 'BUSINESSTAX'){                
				divContents = document.getElementById("divBUSINESSTAX").innerHTML;
            }
            if(t == 'Photoshoot'){                
				divContents = document.getElementById("divPhotoshoot").innerHTML;
            }
            if(t == 'WalkingLane'){
				divContents = document.getElementById("divWalkingLane").innerHTML;
            }
            if(t == 'RateCertificate')
            {
                divContents = document.getElementById("divRateCertificate").innerHTML;
            }
            if(t == 'Procument')
            {
                divContents = document.getElementById("divProcument").innerHTML;
            }
            
            if(t == 'FireCertificate'){
				divContents = document.getElementById("divFireCertificate").innerHTML;
            }
            
            
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
            <!-- <b>Custom NO :  </b><span id="premisesId"></span><br/> -->
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
    <div id="divNewpropertyNo" style="display:none;padding:10px;">
    <div>
        
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6"  style="border:solid 1px black;padding:15px;">
            <div class="text-center" ><h4><b><span id="councilName"></span></b></h4></div>
            <div class="text-center" ><h5>Online <?php echo $type ?> Payment Invoice</h4></div><hr/>
            <b>Order ID : </b><span id="NPorderId"></span><br/>
            <b>Applicant Name :  </b><span id="NPowner"></span><br/>
            <!-- <b>Property Details :  </b><span id="STproperty"></span><br/> -->
            <b>Pay Date :  </b><span id="NPdate"></span><br/><br/>

            <table style=" width: 100%;">
            <tr style="border-bottom: solid 1px gray;"><th>Description</th><th class="text-right">Fee</th></tr>
            <tr><td>Total  <span id="SkType"></span> fee</td><td class="text-right"><span id="NPamountttttt"></span></td></tr>
            <tr><td>Bank Fee</td><td class="text-right"><span id="NPconv"></span></td></tr>
            <tr style="border-top: solid 1px gray;border-bottom: double 1px gray;"><td><b>Total Paid Amount</b></td><td class="text-right"><b><span id="NPtotttttt"></span></b></td></tr>
            </table>
            <br/>
            <b>Pay By  : </b><span id="NPcard"></span><br/>
            <b>Reference No  : </b><span id="NPref"></span><br/><br/>
            <span style="color:gray;font-size:12px;">You can get the screen capture of this window for future reference.Any clarification contact <span id="lblContactNo_NewpropertyNo"></span>.</span>
            <br/>
            <span style="color:gray;font-size:10px;">Please press BACK/Close button to close this screen.</span>
        </div>
        <div class="col-md-3"></div>
        </div>       
    </div>
    </div>
    <div id="divWaterBill" style="display:none;padding:10px;">
    <div>
        
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6"  style="border:solid 1px black;padding:15px;">
            <div class="text-center" ><h4><b><span id="councilName"></span></b></h4></div>
            <div class="text-center" ><h5>Online <?php echo $type ?> Payment Invoice</h4></div><hr/>
            <b>Order ID : </b><span id="WBorderId"></span><br/>
            <b>Applicant Name :  </b><span id="WBowner"></span><br/>
            <!-- <b>Property Details :  </b><span id="STproperty"></span><br/> -->
            <b>Pay Date :  </b><span id="WBdate"></span><br/><br/>

            <table style=" width: 100%;">
            <tr style="border-bottom: solid 1px gray;"><th>Description</th><th class="text-right">Fee</th></tr>
            <tr><td>Water Bill  <span id="SkType"></span> fee</td><td class="text-right"><span id="WBamountttttt"></span></td></tr>
            <tr><td>Bank Fee</td><td class="text-right"><span id="WBconv"></span></td></tr>
            <tr style="border-top: solid 1px gray;border-bottom: double 1px gray;"><td><b>Total Paid Amount</b></td><td class="text-right"><b><span id="WBtotttttt"></span></b></td></tr>
            </table>
            <br/>
            <b>Pay By  : </b><span id="WBcard"></span><br/>
            <b>Reference No  : </b><span id="WBref"></span><br/><br/>
            <span style="color:gray;font-size:12px;">You can get the screen capture of this window for future reference.Any clarification contact <span id="lblContactNo_WaterBill"></span>.</span>
            <br/>
            <span style="color:gray;font-size:10px;">Please press BACK/Close button to close this screen.</span>
        </div>
        <div class="col-md-3"></div>
        </div>       
    </div>
    </div>
    <div id="divLibrary" style="display:none;padding:10px;">
    <div>
        
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6"  style="border:solid 1px black;padding:15px;">
            <div class="text-center" ><h4><b><span id="councilName"></span></b></h4></div>
            <div class="text-center" ><h5>Online <?php echo $type ?> Payment Invoice</h4></div><hr/>
            <b>Order ID : </b><span id="LIorderId"></span><br/>
            <b>Applicant Name :  </b><span id="LIowner"></span><br/>
            <!-- <b>Property Details :  </b><span id="STproperty"></span><br/> -->
            <b>Pay Date :  </b><span id="LIdate"></span><br/><br/>

            <table style=" width: 100%;">
            <tr style="border-bottom: solid 1px gray;"><th>Description</th><th class="text-right">Fee</th></tr>
            <tr><td>Total  <span id="SkType"></span> fee</td><td class="text-right"><span id="LIamountttttt"></span></td></tr>
            <tr><td>Bank Fee</td><td class="text-right"><span id="LIconv"></span></td></tr>
            <tr style="border-top: solid 1px gray;border-bottom: double 1px gray;"><td><b>Total Paid Amount</b></td><td class="text-right"><b><span id="LItotttttt"></span></b></td></tr>
            </table>
            <br/>
            <b>Pay By  : </b><span id="LIcard"></span><br/>
            <b>Reference No  : </b><span id="LIref"></span><br/><br/>
            <span style="color:gray;font-size:12px;">You can get the screen capture of this window for future reference.Any clarification contact <span id="lblContactNo_Library"></span>.</span>
            <br/>
            <span style="color:gray;font-size:10px;">Please press BACK/Close button to close this screen.</span>
        </div>
        <div class="col-md-3"></div>
        </div>       
    </div>
    </div>
    <div id="divGround" style="display:none;padding:10px;">
    <div>
        
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6"  style="border:solid 1px black;padding:15px;">
            <div class="text-center" ><h4><b><span id="councilName"></span></b></h4></div>
            <div class="text-center" ><h5>Online <?php echo $type ?> Payment Invoice</h4></div><hr/>
            <b>Order ID : </b><span id="GRorderId"></span><br/>
            <b>Applicant Name :  </b><span id="GRowner"></span><br/>
            <!-- <b>Property Details :  </b><span id="STproperty"></span><br/> -->
            <b>Pay Date :  </b><span id="GRdate"></span><br/><br/>

            <table style=" width: 100%;">
            <tr style="border-bottom: solid 1px gray;"><th>Description</th><th class="text-right">Fee</th></tr>
            <tr><td>Total  <span id="SkType"></span> fee</td><td class="text-right"><span id="GRamountttttt"></span></td></tr>
            <tr><td>Bank Fee</td><td class="text-right"><span id="GRconv"></span></td></tr>
            <tr style="border-top: solid 1px gray;border-bottom: double 1px gray;"><td><b>Total Paid Amount</b></td><td class="text-right"><b><span id="GRtotttttt"></span></b></td></tr>
            </table>
            <br/>
            <b>Pay By  : </b><span id="GRcard"></span><br/>
            <b>Reference No  : </b><span id="GRref"></span><br/><br/>
            <span style="color:gray;font-size:12px;">You can get the screen capture of this window for future reference.Any clarification contact <span id="lblContactNo_Ground"></span>.</span>
            <br/>
            <span style="color:gray;font-size:10px;">Please press BACK/Close button to close this screen.</span>
        </div>
        <div class="col-md-3"></div>
        </div>       
    </div>
    </div>
    <div id="divPNM" style="display:none;padding:10px;">
    <div>
        
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6"  style="border:solid 1px black;padding:15px;">
            <div class="text-center" ><h4><b><span id="councilName"></span></b></h4></div>
            <div class="text-center" ><h5>Online <?php echo $type ?> Payment Invoice</h4></div><hr/>
            <b>Order ID : </b><span id="PNorderId"></span><br/>
            <b>Applicant Name :  </b><span id="PNowner"></span><br/>
            <!-- <b>Property Details :  </b><span id="STproperty"></span><br/> -->
            <b>Pay Date :  </b><span id="PNdate"></span><br/><br/>

            <table style=" width: 100%;">
            <tr style="border-bottom: solid 1px gray;"><th>Description</th><th class="text-right">Fee</th></tr>
            <tr><td>Total  <span id="SkType"></span> fee</td><td class="text-right"><span id="PNamountttttt"></span></td></tr>
            <tr><td>Bank Fee</td><td class="text-right"><span id="PNconv"></span></td></tr>
            <tr style="border-top: solid 1px gray;border-bottom: double 1px gray;"><td><b>Total Paid Amount</b></td><td class="text-right"><b><span id="PNtotttttt"></span></b></td></tr>
            </table>
            <br/>
            <b>Pay By  : </b><span id="PNcard"></span><br/>
            <b>Reference No  : </b><span id="PNref"></span><br/><br/>
            <span style="color:gray;font-size:12px;">You can get the screen capture of this window for future reference.Any clarification contact <span id="lblContactNo_PNM"></span>.</span>
            <br/>
            <span style="color:gray;font-size:10px;">Please press BACK/Close button to close this screen.</span>
        </div>
        <div class="col-md-3"></div>
        </div>       
    </div>
    </div>
    <div id="divINVOICE" style="display:none;padding:10px;">
    <div>
        
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6"  style="border:solid 1px black;padding:15px;">
            <div class="text-center" ><h4><b><span id="councilName"></span></b></h4></div>
            <div class="text-center" ><h5>Online <?php echo $type ?> Payment Invoice</h4></div><hr/>
            <b>Order ID : </b><span id="INorderId"></span><br/>
            <b>Applicant Name :  </b><span id="INowner"></span><br/>
            <!-- <b>Property Details :  </b><span id="STproperty"></span><br/> -->
            <b>Pay Date :  </b><span id="INdate"></span><br/><br/>

            <table style=" width: 100%;">
            <tr style="border-bottom: solid 1px gray;"><th>Description</th><th class="text-right">Fee</th></tr>
            <tr><td>Total  <span id="SkType"></span> fee</td><td class="text-right"><span id="INamountttttt"></span></td></tr>
            <tr><td>Bank Fee</td><td class="text-right"><span id="INconv"></span></td></tr>
            <tr style="border-top: solid 1px gray;border-bottom: double 1px gray;"><td><b>Total Paid Amount</b></td><td class="text-right"><b><span id="INtotttttt"></span></b></td></tr>
            </table>
            <br/>
            <b>Pay By  : </b><span id="INcard"></span><br/>
            <b>Reference No  : </b><span id="INref"></span><br/><br/>
            <span style="color:gray;font-size:12px;">You can get the screen capture of this window for future reference.Any clarification contact <span id="lblContactNo_INVOICE"></span>.</span>
            <br/>
            <span style="color:gray;font-size:10px;">Please press BACK/Close button to close this screen.</span>
        </div>
        <div class="col-md-3"></div>
        </div>       
    </div>
    </div>
    <div id="divGARBAGEFEE" style="display:none;padding:10px;">
    <div>
        
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6"  style="border:solid 1px black;padding:15px;">
            <div class="text-center" ><h4><b><span id="councilName"></span></b></h4></div>
            <div class="text-center" ><h5>Online <?php echo $type ?> Payment Invoice</h4></div><hr/>
            <b>Order ID : </b><span id="GAorderId"></span><br/>
            <b>Applicant Name :  </b><span id="GAowner"></span><br/>
            <!-- <b>Property Details :  </b><span id="STproperty"></span><br/> -->
            <b>Pay Date :  </b><span id="GAdate"></span><br/><br/>

            <table style=" width: 100%;">
            <tr style="border-bottom: solid 1px gray;"><th>Description</th><th class="text-right">Fee</th></tr>
            <tr><td>Total  <span id="SkType"></span> fee</td><td class="text-right"><span id="GAamountttttt"></span></td></tr>
            <tr><td>Bank Fee</td><td class="text-right"><span id="GAconv"></span></td></tr>
            <tr style="border-top: solid 1px gray;border-bottom: double 1px gray;"><td><b>Total Paid Amount</b></td><td class="text-right"><b><span id="GAtotttttt"></span></b></td></tr>
            </table>
            <br/>
            <b>Pay By  : </b><span id="GAcard"></span><br/>
            <b>Reference No  : </b><span id="GAref"></span><br/><br/>
            <span style="color:gray;font-size:12px;">You can get the screen capture of this window for future reference.Any clarification contact <span id="lblContactNo_GARBAGEFEE"></span>.</span>
            <br/>
            <span style="color:gray;font-size:10px;">Please press BACK/Close button to close this screen.</span>
        </div>
        <div class="col-md-3"></div>
        </div>       
    </div>
    </div>
    <div id="divPreschool" style="display:none;padding:10px;">
    <div>
        
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6"  style="border:solid 1px black;padding:15px;">
            <div class="text-center" ><h4><b><span id="councilName"></span></b></h4></div>
            <div class="text-center" ><h5>Online <?php echo $type ?> Payment Invoice</h4></div><hr/>
            <b>Order ID : </b><span id="PRorderId"></span><br/>
            <b>Applicant Name :  </b><span id="PRowner"></span><br/>
            <!-- <b>Property Details :  </b><span id="STproperty"></span><br/> -->
            <b>Pay Date :  </b><span id="PRdate"></span><br/><br/>

            <table style=" width: 100%;">
            <tr style="border-bottom: solid 1px gray;"><th>Description</th><th class="text-right">Fee</th></tr>
            <tr><td>Total  <span id="SkType"></span> fee</td><td class="text-right"><span id="PRamountttttt"></span></td></tr>
            <tr><td>Bank Fee</td><td class="text-right"><span id="PRconv"></span></td></tr>
            <tr style="border-top: solid 1px gray;border-bottom: double 1px gray;"><td><b>Total Paid Amount</b></td><td class="text-right"><b><span id="PRtotttttt"></span></b></td></tr>
            </table>
            <br/>
            <b>Pay By  : </b><span id="PRcard"></span><br/>
            <b>Reference No  : </b><span id="PRref"></span><br/><br/>
            <span style="color:gray;font-size:12px;">You can get the screen capture of this window for future reference.Any clarification contact <span id="lblContactNo_Preschool"></span>.</span>
            <br/>
            <span style="color:gray;font-size:10px;">Please press BACK/Close button to close this screen.</span>
        </div>
        <div class="col-md-3"></div>
        </div>       
    </div>
    </div>
    <div id="divCemetery" style="display:none;padding:10px;">
    <div>
        
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6"  style="border:solid 1px black;padding:15px;">
            <div class="text-center" ><h4><b><span id="councilName"></span></b></h4></div>
            <div class="text-center" ><h5>Online <?php echo $type ?> Payment Invoice</h4></div><hr/>
            <b>Order ID : </b><span id="CEorderId"></span><br/>
            <b>Applicant Name :  </b><span id="CEowner"></span><br/>
            <!-- <b>Property Details :  </b><span id="STproperty"></span><br/> -->
            <b>Pay Date :  </b><span id="CEdate"></span><br/><br/>

            <table style=" width: 100%;">
            <tr style="border-bottom: solid 1px gray;"><th>Description</th><th class="text-right">Fee</th></tr>
            <tr><td>Total  <span id="SkType"></span> fee</td><td class="text-right"><span id="CEamountttttt"></span></td></tr>
            <tr><td>Bank Fee</td><td class="text-right"><span id="CEconv"></span></td></tr>
            <tr style="border-top: solid 1px gray;border-bottom: double 1px gray;"><td><b>Total Paid Amount</b></td><td class="text-right"><b><span id="CEtotttttt"></span></b></td></tr>
            </table>
            <br/>
            <b>Pay By  : </b><span id="CEcard"></span><br/>
            <b>Reference No  : </b><span id="CEref"></span><br/><br/>
            <span style="color:gray;font-size:12px;">You can get the screen capture of this window for future reference.Any clarification contact <span id="lblContactNo_Cemetery"></span>.</span>
            <br/>
            <span style="color:gray;font-size:10px;">Please press BACK/Close button to close this screen.</span>
        </div>
        <div class="col-md-3"></div>
        </div>       
    </div>
    </div>
    <div id="divTownHall" style="display:none;padding:10px;">
    <div>
        
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6"  style="border:solid 1px black;padding:15px;">
            <div class="text-center" ><h4><b><span id="councilName"></span></b></h4></div>
            <div class="text-center" ><h5>Online <?php echo $type ?> Payment Invoice</h4></div><hr/>
            <b>Order ID : </b><span id="TOorderId"></span><br/>
            <b>Applicant Name :  </b><span id="TOowner"></span><br/>
            <!-- <b>Property Details :  </b><span id="STproperty"></span><br/> -->
            <b>Pay Date :  </b><span id="TOdate"></span><br/><br/>

            <table style=" width: 100%;">
            <tr style="border-bottom: solid 1px gray;"><th>Description</th><th class="text-right">Fee</th></tr>
            <tr><td>Total  <span id="SkType"></span> fee</td><td class="text-right"><span id="TOamountttttt"></span></td></tr>
            <tr><td>Bank Fee</td><td class="text-right"><span id="TOconv"></span></td></tr>
            <tr style="border-top: solid 1px gray;border-bottom: double 1px gray;"><td><b>Total Paid Amount</b></td><td class="text-right"><b><span id="TOtotttttt"></span></b></td></tr>
            </table>
            <br/>
            <b>Pay By  : </b><span id="TOcard"></span><br/>
            <b>Reference No  : </b><span id="TOref"></span><br/><br/>
            <span style="color:gray;font-size:12px;">You can get the screen capture of this window for future reference.Any clarification contact <span id="lblContactNo_TownHall"></span>.</span>
            <br/>
            <span style="color:gray;font-size:10px;">Please press BACK/Close button to close this screen.</span>
        </div>
        <div class="col-md-3"></div>
        </div>       
    </div>
    </div>
    <div id="divGully" style="display:none;padding:10px;">
    <div>
        
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6"  style="border:solid 1px black;padding:15px;">
            <div class="text-center" ><h4><b><span id="councilName"></span></b></h4></div>
            <div class="text-center" ><h5>Online <?php echo $type ?> Payment Invoice</h4></div><hr/>
            <b>Order ID : </b><span id="GUorderId"></span><br/>
            <b>Applicant Name :  </b><span id="GUowner"></span><br/>
            <!-- <b>Property Details :  </b><span id="STproperty"></span><br/> -->
            <b>Pay Date :  </b><span id="GUdate"></span><br/><br/>

            <table style=" width: 100%;">
            <tr style="border-bottom: solid 1px gray;"><th>Description</th><th class="text-right">Fee</th></tr>
            <tr><td>Total  <span id="SkType"></span> fee</td><td class="text-right"><span id="GUamountttttt"></span></td></tr>
            <tr><td>Bank Fee</td><td class="text-right"><span id="GUconv"></span></td></tr>
            <tr style="border-top: solid 1px gray;border-bottom: double 1px gray;"><td><b>Total Paid Amount</b></td><td class="text-right"><b><span id="GUtotttttt"></span></b></td></tr>
            </table>
            <br/>
            <b>Pay By  : </b><span id="GUcard"></span><br/>
            <b>Reference No  : </b><span id="GUref"></span><br/><br/>
            <span style="color:gray;font-size:12px;">You can get the screen capture of this window for future reference.Any clarification contact <span id="lblContactNo_Gully"></span>.</span>
            <br/>
            <span style="color:gray;font-size:10px;">Please press BACK/Close button to close this screen.</span>
        </div>
        <div class="col-md-3"></div>
        </div>       
    </div>
    </div>
    <div id="divSTREETLINE" style="display:none;padding:10px;">
    <div>
        
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6"  style="border:solid 1px black;padding:15px;">
            <div class="text-center" ><h4><b><span id="councilName"></span></b></h4></div>
            <div class="text-center" ><h5>Online <?php echo $type ?> Payment Invoice</h4></div><hr/>
            <b>Order ID : </b><span id="STorderId"></span><br/>
            <b>Applicant Name :  </b><span id="STowner"></span><br/>
            <!-- <b>Property Details :  </b><span id="STproperty"></span><br/> -->
            <b>Pay Date :  </b><span id="STdate"></span><br/><br/>

            <table style=" width: 100%;">
            <tr style="border-bottom: solid 1px gray;"><th>Description</th><th class="text-right">Fee</th></tr>
            <tr><td>Total  <span id="SkType"></span> fee</td><td class="text-right"><span id="STamountttttt"></span></td></tr>
            <tr><td>Bank Fee</td><td class="text-right"><span id="STconv"></span></td></tr>
            <tr style="border-top: solid 1px gray;border-bottom: double 1px gray;"><td><b>Total Paid Amount</b></td><td class="text-right"><b><span id="STtotttttt"></span></b></td></tr>
            </table>
            <br/>
            <b>Pay By  : </b><span id="STcard"></span><br/>
            <b>Reference No  : </b><span id="STref"></span><br/><br/>
            <span style="color:gray;font-size:12px;">You can get the screen capture of this window for future reference.Any clarification contact <span id="lblContactNo_STREETLINE"></span>.</span>
            <br/>
            <span style="color:gray;font-size:10px;">Please press BACK/Close button to close this screen.</span>
        </div>
        <div class="col-md-3"></div>
        </div>       
    </div>
    </div>
    <div id="divSalesItem" style="display:none;padding:10px;">
    <div>
        
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6"  style="border:solid 1px black;padding:15px;">
            <div class="text-center" ><h4><b><span id="councilName"></span></b></h4></div>
            <div class="text-center" ><h5>Online <?php echo $type ?> Payment Invoice</h4></div><hr/>
            <b>Order ID : </b><span id="SAorderId"></span><br/>
            <b>Applicant Name :  </b><span id="SAowner"></span><br/>
            <!-- <b>Property Details :  </b><span id="STproperty"></span><br/> -->
            <b>Pay Date :  </b><span id="SAdate"></span><br/><br/>

            <table style=" width: 100%;">
            <tr style="border-bottom: solid 1px gray;"><th>Description</th><th class="text-right">Fee</th></tr>
            <tr><td>Total  <span id="SkType"></span> fee</td><td class="text-right"><span id="SAamountttttt"></span></td></tr>
            <tr><td>Bank Fee</td><td class="text-right"><span id="SAconv"></span></td></tr>
            <tr style="border-top: solid 1px gray;border-bottom: double 1px gray;"><td><b>Total Paid Amount</b></td><td class="text-right"><b><span id="SAtotttttt"></span></b></td></tr>
            </table>
            <br/>
            <b>Pay By  : </b><span id="SAcard"></span><br/>
            <b>Reference No  : </b><span id="SAref"></span><br/><br/>
            <span style="color:gray;font-size:12px;">You can get the screen capture of this window for future reference.Any clarification contact <span id="lblContactNo_SalesItem"></span>.</span>
            <br/>
            <span style="color:gray;font-size:10px;">Please press BACK/Close button to close this screen.</span>
        </div>
        <div class="col-md-3"></div>
        </div>       
    </div>
    </div>
    <div id="divTRADELICENSE" style="display:none;padding:10px;">
    <div>
        
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6"  style="border:solid 1px black;padding:15px;">
            <div class="text-center" ><h4><b><span id="councilName"></span></b></h4></div>
            <div class="text-center" ><h5>Online <?php echo $type ?> Payment Invoice</h4></div><hr/>
            <b>Order ID : </b><span id="TRorderId"></span><br/>
            <b>Applicant Name :  </b><span id="TRowner"></span><br/>
            <!-- <b>Property Details :  </b><span id="STproperty"></span><br/> -->
            <b>Pay Date :  </b><span id="TRdate"></span><br/><br/>

            <table style=" width: 100%;">
            <tr style="border-bottom: solid 1px gray;"><th>Description</th><th class="text-right">Fee</th></tr>
            <tr><td>Total  <span id="SkType"></span> fee</td><td class="text-right"><span id="TRamountttttt"></span></td></tr>
            <tr><td>Bank Fee</td><td class="text-right"><span id="TRconv"></span></td></tr>
            <tr style="border-top: solid 1px gray;border-bottom: double 1px gray;"><td><b>Total Paid Amount</b></td><td class="text-right"><b><span id="TRtotttttt"></span></b></td></tr>
            </table>
            <br/>
            <b>Pay By  : </b><span id="TRcard"></span><br/>
            <b>Reference No  : </b><span id="TRref"></span><br/><br/>
            <span style="color:gray;font-size:12px;">You can get the screen capture of this window for future reference.Any clarification contact <span id="lblContactNo_TRADELICENSE"></span>.</span>
            <br/>
            <span style="color:gray;font-size:10px;">Please press BACK/Close button to close this screen.</span>
        </div>
        <div class="col-md-3"></div>
        </div>       
    </div>
    </div>
    <div id="divCrematoriums" style="display:none;padding:10px;">
    <div>
        
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6"  style="border:solid 1px black;padding:15px;">
            <div class="text-center" ><h4><b><span id="councilName"></span></b></h4></div>
            <div class="text-center" ><h5>Online <?php echo $type ?> Payment Invoice</h4></div><hr/>
            <b>Order ID : </b><span id="CRorderId"></span><br/>
            <b>Applicant Name :  </b><span id="CRowner"></span><br/>
            <!-- <b>Property Details :  </b><span id="STproperty"></span><br/> -->
            <b>Pay Date :  </b><span id="CRdate"></span><br/><br/>

            <table style=" width: 100%;">
            <tr style="border-bottom: solid 1px gray;"><th>Description</th><th class="text-right">Fee</th></tr>
            <tr><td>Total  <span id="SkType"></span> fee</td><td class="text-right"><span id="CRamountttttt"></span></td></tr>
            <tr><td>Bank Fee</td><td class="text-right"><span id="CRconv"></span></td></tr>
            <tr style="border-top: solid 1px gray;border-bottom: double 1px gray;"><td><b>Total Paid Amount</b></td><td class="text-right"><b><span id="CRtotttttt"></span></b></td></tr>
            </table>
            <br/>
            <b>Pay By  : </b><span id="CRcard"></span><br/>
            <b>Reference No  : </b><span id="CRref"></span><br/><br/>
            <span style="color:gray;font-size:12px;">You can get the screen capture of this window for future reference.Any clarification contact <span id="lblContactNo_Crematorium"></span>.</span>
            <br/>
            <span style="color:gray;font-size:10px;">Please press BACK/Close button to close this screen.</span>
        </div>
        <div class="col-md-3"></div>
        </div>       
    </div>
    </div>
    <div id="divBUSINESSTAX" style="display:none;padding:10px;">
    <div>
        
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6"  style="border:solid 1px black;padding:15px;">
            <div class="text-center" ><h4><b><span id="councilName"></span></b></h4></div>
            <div class="text-center" ><h5>Online <?php echo $type ?> Payment Invoice</h4></div><hr/>
            <b>Order ID : </b><span id="BUorderId"></span><br/>
            <b>Applicant Name :  </b><span id="BUowner"></span><br/>
            <!-- <b>Property Details :  </b><span id="STproperty"></span><br/> -->
            <b>Pay Date :  </b><span id="BUdate"></span><br/><br/>

            <table style=" width: 100%;">
            <tr style="border-bottom: solid 1px gray;"><th>Description</th><th class="text-right">Fee</th></tr>
            <tr><td>Total  <span id="SkType"></span> fee</td><td class="text-right"><span id="BUamountttttt"></span></td></tr>
            <tr><td>Bank Fee</td><td class="text-right"><span id="BUconv"></span></td></tr>
            <tr style="border-top: solid 1px gray;border-bottom: double 1px gray;"><td><b>Total Paid Amount</b></td><td class="text-right"><b><span id="BUtotttttt"></span></b></td></tr>
            </table>
            <br/>
            <b>Pay By  : </b><span id="CRcard"></span><br/>
            <b>Reference No  : </b><span id="CRref"></span><br/><br/>
            <span style="color:gray;font-size:12px;">You can get the screen capture of this window for future reference.Any clarification contact <span id="lblContactNo_BUSINESSTAX"></span>.</span>
            <br/>
            <span style="color:gray;font-size:10px;">Please press BACK/Close button to close this screen.</span>
        </div>
        <div class="col-md-3"></div>
        </div>       
    </div>
    </div>
    <div id="divPhotoshoot" style="display:none;padding:10px;">
    <div>
        
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6"  style="border:solid 1px black;padding:15px;">
            <div class="text-center" ><h4><b><span id="lblCouncilName_Photoshoot"></span></b></h4></div>
            <div class="text-center" ><h5>Online <?php echo $type ?> Payment Receipt</h4></div><hr/>
            <b>Order ID : </b><span id="PHorderId"></span><br/>
            <b>Photoshoot Ref No : </b><span id="PHphotorefno"></span><br/>
            <b>Applicant Name :  </b><span id="PHowner"></span><br/>
            <b>Applicant NIC :  </b><span id="PHnic"></span><br/> 
            <b>Pay Date :  </b><span id="PHdate"></span><br/><br/>

            <table style=" width: 100%;">
            <tr style="border-bottom: solid 1px gray;"><th>Description</th><th class="text-right">Fee</th></tr>
            <tr><td>Total  <span id="SkType"></span> fee</td><td class="text-right"><span id="PHamountttttt"></span></td></tr>
            <tr><td>Bank Fee</td><td class="text-right"><span id="PHconv"></span></td></tr>
            <tr style="border-top: solid 1px gray;border-bottom: double 1px gray;"><td><b>Total Paid Amount</b></td><td class="text-right"><b><span id="PHtotttttt"></span></b></td></tr>
            </table>
            <br/>
            <b>Pay By  : </b><span id="PHcard"></span><br/>
            <b>Card No  : </b><span id="PHcardn"></span><br/>
            <b>Bank Ref No  : </b><span id="PHref"></span><br/><br/>
            <span style="color:gray;font-size:12px;">You can get the screen capture of this window for future reference.Any clarification contact <span id="lblContactNo_Photoshoot"></span>.</span>
            <br/>
            <span style="color:gray;font-size:10px;">Please press BACK/Close button to close this screen.</span>
        </div>
        <div class="col-md-3"></div>
        </div>       
    </div>
    </div>

    <!--walking lane-->

    <div id="divWalkingLane" style="display:none;padding:10px;">
    <div>

        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6"  style="border:solid 1px black;padding:15px;">
            <div class="text-center" ><h4><b><span id="councilName_walkinglane"></span></b></h4></div>
            <div class="text-center" ><h5>Online <?php echo $type ?> Customer Payment Reciept </h4></div><hr/>
            <b>Order ID : </b><span id="wlOrderId"></span><br/>
            <b>Service Name : </b><span id="wlServiceName"></span><br/>
            <b>Applicant Name : </b><span id="wlOwner"></span><br/>
            <b>Applicant Address : </b><span id="wlApplicantAddress"></span><br/>
            <b>Applicant Mobile No : </b><span id="wlApplicantMobileNo"></span><br/>
            <b>Applicant NIC : </b><span id="wlApplicantNIC"></span><br/>
            
            <table style=" width: 100%;">
            <tr style="border-bottom: solid 1px gray;"><th>Description</th><th class="text-right">Fee</th></tr>
            <tr><td>Payment Amount <span id="SkType"></span> fee</td><td class="text-right"><span id="wlAmount"></span></td></tr>
            <tr><td>Bank Fee</td><td class="text-right"><span id="wlConv"></span></td></tr>
            <tr><td>Application Fee</td><td class="text-right"><span id="wlAppCharges"></span></td></tr>
            <tr style="border-top: solid 1px gray;border-bottom: double 1px gray;"><td><b>Total Paid Amount</b></td><td class="text-right"><b><span id="wlTotal"></span></b></td></tr>
            </table>
            <br/>
            <b>Pay By  : </b><span id="wlCard"></span><br/>
            <b>Name on Card  : </b><span id="wlCardName"></span><br/><br/>
            <b>Reference No  : </b><span id="wlRef"></span><br/><br/>
            <b>Pay Date :  </b><span id="wlDate"></span><br/><br/>

            <span style="color:gray;font-size:12px;">You can get the screen capture of this window for future reference.Any clarification contact <span id="lblContactNo_WalkingLane"></span>.</span>
            <br/>
            <span style="color:gray;font-size:10px;">Please press BACK/Close button to close this screen.</span>
        </div>
        <div class="col-md-3"></div>
        </div>
    </div>
    </div>

    <!--Rate Certificate-->

    <div id="divRateCertificate" style="display:none;padding:10px;">
    <div>

        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6"  style="border:solid 1px black;padding:15px;">
            <div class="text-center" ><h4><b><span id="councilName_RateCertificate"></span></b></h4></div>
            <div class="text-center" ><h5>Online Rate Certificate - Customer Payment Reciept </h4></div><hr/>
            <b>Order ID : </b><span id="rcOrderId"></span><br/>
            <b>Application No : </b><span id="rcApplicationIndexNo"></span><br/>
            <b>Service Name : </b><span id="rcServiceName"></span><br/>
            <b>Applicant Name : </b><span id="rcOwner"></span><br/>
            <b>Applicant Address : </b><span id="rcApplicantAddress"></span><br/>
            <b>Applicant Mobile No : </b><span id="rcApplicantMobileNo"></span><br/>
            <b>Applicant NIC : </b><span id="rcApplicantNIC"></span><br/>
            
            <table style=" width: 100%;">
            <tr style="border-bottom: solid 1px gray;"><th>Description</th><th class="text-right">Fee</th></tr>
            <tr><td>Payment Amount <span id="SkType"></span> fee</td><td class="text-right"><span id="rcAmount"></span></td></tr>
            <tr><td>Postal Fee</td><td class="text-right"><span id="rcPostalFee"></span></td></tr>
            <tr><td>Bank Fee</td><td class="text-right"><span id="rcConv"></span></td></tr>
            
            <tr style="border-top: solid 1px gray;border-bottom: double 1px gray;"><td><b>Total Paid Amount</b></td><td class="text-right"><b><span id="rcTotal"></span></b></td></tr>
            </table>
            <br/>
            <b>Pay By  : </b><span id="rcCard"></span><br/>
            <!-- <b>Name on Card  : </b><span id="rcCardName"></span><br/><br/> -->
            <b>Bank Reference No  : </b><span id="rcRef"></span><br/><br/>
            <b>Pay Date :  </b><span id="rcDate"></span><br/><br/>

            <span style="color:gray;font-size:12px;">You can get the screen capture of this window for future reference.Any clarification contact <span id="lblContactNo_WalkingLane"></span>.</span>
            <br/>
            <span style="color:gray;font-size:10px;">Please press BACK/Close button to close this screen.</span>
        </div>
        <div class="col-md-3"></div>
        </div>
    </div>
    </div>

    <div id="divProcument" style="display:none;padding:10px;">
    <div>
        
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6"  style="border:solid 1px black;padding:15px;">
            <div class="text-center" ><h4><b><span id="lblCouncilName_Procument"></span></b></h4></div>
            <div class="text-center" ><h5>Online <?php echo $type ?> Payment Receipt</h4></div><hr/>
            <b>Order ID : </b><span id="PCorderId"></span><br/>
            <b>Service Name : </b><span id="PCprocumentefno"></span><br/>
            <b>Applicant Name :  </b><span id="PCowner"></span><br/>
            <b>Applicant Address :  </b><span id="PCaddress"></span><br/>
            <b>Applicant Mobile Number :  </b><span id="PCmobilenumber"></span><br/>
            <b>Applicant NIC :  </b><span id="PCnic"></span><br/> 
            <b>Application Ref. No :  </b><span id="PCappid"></span><br/> 
            <b>Pay Date :  </b><span id="PCdate"></span><br/><br/>

            <table style=" width: 100%;">
            <tr style="border-bottom: solid 1px gray;"><th>Description</th><th class="text-right">Fee</th></tr>
            <tr><td>Total  <span id="SkType"></span> fee</td><td class="text-right"><span id="PCamountttttt"></span></td></tr>
            <tr><td>Bank Fee</td><td class="text-right"><span id="PCconv"></span></td></tr>
            <tr style="border-top: solid 1px gray;border-bottom: double 1px gray;"><td><b>Total Paid Amount</b></td><td class="text-right"><b><span id="PCtotttttt"></span></b></td></tr>
            </table>
            <br/>
            <b>Pay By  : </b><span id="PCcard"></span><br/>
            <b>Card No  : </b><span id="PCcardn"></span><br/>
            <b>Bank Ref No  : </b><span id="PCref"></span><br/><br/>
            <span style="color:gray;font-size:12px;">You can get the screen capture of this window for future reference.Any clarification contact <span id="lblContactNo_procument"></span>.</span>
            <br/>
            <span style="color:gray;font-size:10px;">Please press BACK/Close button to close this screen.</span>
        </div>
        <div class="col-md-3"></div>
        </div>       
    </div>
    </div>
    <!--Fire Certificate-->
    <div id="divFireCertificate" style="display:none;padding:10px;">
    <div>

        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6"  style="border:solid 1px black;padding:15px;">
            <div class="text-center" ><h4><b><span id="lblcouncilName_FireCertificate"></span></b></h4></div>
            <div class="text-center" ><h5>Online Fire Certificate - Customer Payment Reciept </h4></div><hr/>
            <b>Order ID : </b><span id="FIOrderId"></span><br/>
            <b>Certificate ID : </b><span id="FICertId"></span><br/> 
            <b>Service Name : </b><span id="FIServiceName"></span><br/>
            <b>Applicant Name : </b><span id="FIOwner"></span><br/>
            <b>Applicant Address : </b><span id="FIApplicantAddress"></span><br/>
            <b>Applicant Mobile No : </b><span id="FIApplicantMobileNo"></span><br/>
            <!-- <b>Applicant NIC : </b><span id="FIApplicantNIC"></span><br/> -->
            
            <table style=" width: 100%;">
            <tr style="border-bottom: solid 1px gray;"><th>Description</th><th class="text-right">Fee</th></tr>
            
            <tr><td>Bank Fee</td><td class="text-right"><span id="FIConv"></span></td></tr>
            <tr><td>Application Fee</td><td class="text-right"><span id="FIAppCharges"></span></td></tr>
            <tr><td>Inspection Fee</td><td class="text-right"><span id="FIInspecCharges"></span></td></tr>
            <tr><td>Annual Certificate Fee</td><td class="text-right"><span id="FICertificateCharges"></span></td></tr>
            <tr style="border-top: solid 1px gray;border-bottom: double 1px gray;"><td><b>Total Paid Amount</b></td><td class="text-right"><b><span id="FITotal"></span></b></td></tr>
            </table>
            <br/>
            <b>Pay By  : </b><span id="FICard"></span><br/>
            <b>Bank Reference No  : </b><span id="FIRef"></span><br/><br/><br/>
            <b>Pay Date :  </b><span id="FIDate"></span><br/><br/>

            <span style="color:gray;font-size:12px;">You can get the screen capture of this window for future reference.Any clarification contact <span id="lblContactNo_FireCertificate"></span>.</span>
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