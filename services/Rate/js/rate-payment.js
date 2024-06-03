$(document).ready(function(){

    var ClientID = getConfigData.getlocation();   
    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("id");
    var loc = url.searchParams.get("loc");
    var id =c.toString();
    $("#userName").val(sessionStorage.getItem('UserName')); 
    var sendUrl = getRateTaxAPIURL()+'propertyinfo?userId='+$("#userName").val();

    $("#ID").val(c);    
    var customerId = sessionStorage.getItem('CustomerID');  
    $("#loginType").val(sessionStorage.getItem('DataType'));
    $("#customerID").val(customerId); 
    $("#modelDiv").show();
    $.ajax({
     type:'POST',
     dataType:'json',
     url:sendUrl,
     data:{BranchID:loc,ID:id},
     headers: {
        "Authorization": 'Bearer '+sessionStorage.getItem('mytoken')
      },
     success: function(data){
         
         var val = data.ReturnMsgInfo.ReturnValue;
         var description = data.ReturnMsgInfo.ReturnMessage;
         var info = data.PropertyInfo;                        
         
         var i=0;
 
         if (val == "OK") {

             $('#lblOffice').html(info['BarnchName']);
             $('#lblDiv').html(info['Division']);
             $('#lblStreet').html(info['StreerName']);
             $('#lblPropertyNo').html(info['PropertyNO']);
             $('#lblCustomNo').html(info['CustomNO']);
             $('#lblDesc').html(info['PropertyDescription']);
             $('#lblAV').html(info['AnualValue'] + " / " + info['QuarterRate']);
             $('#lblArrears').html(info['Arrears']);
             $('#lblWarrent').html(info['Warrant']);
             $('#lblRate').html(info['Rate']);
             $('#lblFuture').html(info['Future']);
             $('#lblDiscount').html(info['Discount']);
             $('#lblOwner').html(info['FullName']);
             $('#lblDue').html(info['TotaldueAmount']);
             $('#lblTotDue').html(info['FullYearPayAmount']);
             $('#txtamt').val(info['FullYearPayAmount']);
             $('#lblCurrentYear').html(info['CurrentYear']);
             $('#lblNextYear').html(info['NextYear']);
             $('#lblNextYear1').html(info['NextYear']);

             var needtoshowNextYearValue = info['NeedToShowNextYearValues'];
             if (needtoshowNextYearValue == "True") {
                var div = document.getElementById("nxtyrvalue1");  
                var div1 = document.getElementById("nxtyrvalue2");  
                if (div.style.display !== "block") 
                {  
                    div.style.display = "block";  
                }  
                if (div1.style.display !== "block") 
                {  
                    div1.style.display = "block";  
                } 
                 $('#lblNextYearPayAmount').html(info['NextYearPayAmount']);
                 $('#lblNextYearTotPayAmount').html(info['NextYearTotPayAmount']);
             }
             else {
                var div = document.getElementById("nxtyrvalue1");  
                var div1 = document.getElementById("nxtyrvalue2");  
                if (div.style.display !== "none") 
                {  
                    div.style.display = "none";  
                }  
                if (div1.style.display !== "none") 
                {  
                    div1.style.display = "none";  
                }               
             }
             if ($("#loginType").val() == "mail") {
                 $('#email').val($("#userName").val());
             }
             else {
                 $('#mob').val($("#userName").val());
             }
             $('#infoLoc').val(loc);
             $("#modelDiv").hide();
             $(".loader").hide();
         } else {

         }
       
     },
     error: function (ex) {
        alert("Error : " + ex.status + ' : ' + ex.statusText);
      }
 });   
 
     
        
 });
 function calltoinfopage()
 {
     window.location="rate-tax-info.html?id="+ $("#ID").val()+"&loc="+$("#infoLoc").val();
 }

 $('#btnConfirm').click(function(){
  
    var amt=$("#txtamt").val();
    if(amt>0)
    {
    sessionStorage.setItem("userName",$("#userName").val()); 
    sessionStorage.setItem("loginType",$("#loginType").val()); 
    sessionStorage.setItem("customerID",$("#customerID").val()); 
    sessionStorage.setItem("email",$("#email").val()); 
    sessionStorage.setItem("mobile",$("#mob").val()); 
    sessionStorage.setItem("amount",$("#txtamt").val()); 
    window.location ="rate-tax-confirmation.html?id="+ $("#ID").val()+"&loc="+$("#infoLoc").val();
    }
    else{
        alert("Error : "+'Please enter pay amount');
    }

 });
