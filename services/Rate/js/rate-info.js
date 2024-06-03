$(document).ready(function(){

    var ClientID = getConfigData.getlocation();   
    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("id");
    var loc = url.searchParams.get("loc");
    var id =c.toString();
    if(id!=''){
        if(loc!=''){
            $("#userName").val(sessionStorage.getItem('UserName')); 
            var sendUrl = getRateTaxAPIURL()+'propertyinfo?userId='+$("#userName").val();
            var apiKey =  getapiKey();
            $("#ID").val(c);
           
            var customerId = sessionStorage.getItem('CustomerID');  
            $("#loginType").val(sessionStorage.getItem('DataType'));
            $("#customerID").val(customerId); 
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
        
                if(val=="OK"){           
                    
                    $('#lblOffice').html(info['BranchName']);
                    $('#lblDiv').html(info['Division']);
                    $('#lblStreet').html(info['StreerName']);
                    $('#lblPropertyNo').html(info['PropertyNO']);
                    $('#lblCustomNo').html(info['CustomNO']);
                    $('#lblDesc').html(info['PropertyDescription']);
                    $('#lblAV').html(info['AnualValue']+" / "+info['QuarterRate']);
                    $('#lblArrears').html(info['Arrears']);
                    $('#lblWarrent').html(info['Warrant']);
                    $('#lblRate').html(info['Rate']);
                    $('#lblFuture').html(info['Future']);
                    $('#lblDiscount').html(info['Discount']);
                    $('#lblOwner').html(info['FullName']);
                    $('#infoLoc').val(info['BranchID']);
                    $(".loader").hide();
                }else{

                }
            
            },
            error: function (ex) {
                alert("Error : " + ex.status + ' : ' + ex.statusText);
            }
            }); 
        }
        else{
            $("#msgErr").html('Parameter(loc) not received.');
        }
    }
    else{
        $("#msgErr").html('Parameter(id) not received.');
    }          
 });

 
 $('#btPayment').click(function(){

    sessionStorage.setItem("userName",$("#userName").val()); 
    sessionStorage.setItem("loginType",$("#loginType").val()); 
    sessionStorage.setItem("customerID",$("#customerID").val()); 
    window.location ="rate-tax-payment.html?id="+ $("#ID").val()+"&loc="+$('#infoLoc').val();

 });

 function Reset()
 {
    window.location="mylist.html";
 }
 
 