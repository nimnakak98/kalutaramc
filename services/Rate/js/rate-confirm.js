$(document).ready(function(){
    
    var contactEmail=getContactEmail();
    $("#lblcontactEmail").html(contactEmail); 
    var contactNo=getContactNumber();
    $("#lblContactNo").html(contactNo); 
    

    var ClientID = getConfigData.getlocation();   
    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("id");
    var id =c.toString();
    $("#ID").val(c);
    var loc = url.searchParams.get("loc");
    $("#customerID").val(customerId); 
    $("#userName").val(sessionStorage.getItem('UserName')); 
    var customerId = sessionStorage.getItem('CustomerID');  
    $("#loginType").val(sessionStorage.getItem('DataType'));
    $("#infoLoc").val(loc); 
    $("#mobile").val(sessionStorage.getItem('mobile')); 
    $("#email").val(sessionStorage.getItem('email')); 
    var sendUrl = getRateTaxAPIURL()+'ratepayinfo?userId='+$("#userName").val();
    var amt=sessionStorage.getItem('amount');  
    $("#modelDiv").show();

    $.ajax({
        type:'POST',
        dataType:'json',
        url:sendUrl,
        data:{LocationID:ClientID,Amount:amt},
        headers: {
            "Authorization": 'Bearer '+sessionStorage.getItem('mytoken')
          },
        success: function(data){
            
            
            var val = data.ReturnMsgInfo.ReturnValue;
            var description = data.ReturnMsgInfo.ReturnMessage;
            var info = data.PayInfo; 
            if(val=="OK"){ 

                $("#appFee").html(info["Amount"]);
                $("#serviceFee").html(info["BankFee"]);
                $("#totAmt").html(info["TotAmount"]);
                $(".loader").hide();
                $("#modelDiv").hide();
            }
            else{

            }
        },
        error: function (ex) {
            alert("Error : " + ex.status + ' : ' + ex.statusText);
          }
    });

});

function calltoinfopage(){
    window.location="rate-tax-payment.html?id="+ $("#ID").val()+"&loc="+ $("#infoLoc").val();;
}

$('#confirm').click(function(){

    Swal.fire({
        title: 'Are you sure?',
        text: "Continue this process !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5cb85c',
        cancelButtonColor: '#d9534f',
        confirmButtonText: 'Yes, confirm it!'
    }).then(function (result) {
        if (result.value) {

            var ClientID = getConfigData.getlocation();   
            var sendUrl = getRateTaxAPIURL()+'RateBankPayInfo?userId='+$("#userName").val();
            
            var propertyId=$("#ID").val();
            var username=$("#userName").val(); 
            var amt=$("#appFee").html();
            var totamt =$("#totAmt").html();
            var branch=$("#infoLoc").val();
            var mobile=$("#mobile").val();
            var email=$("#email").val();
            $.ajax({
                type: "post",
                url: sendUrl,
                data:{LocationID:ClientID,PropertyID:propertyId,UserName:username, Amount:amt,BranchID:branch,Mobile:mobile,Email:email},
                ajaxasync: true,
                headers: {
                    "Authorization": 'Bearer '+sessionStorage.getItem('mytoken')
                  },
       
                success: function (data) {

                    var val = data.ReturnMsgInfo.ReturnValue;
                    var description = data.ReturnMsgInfo.ReturnMessage;
                    var info = data.ReteurnOderInfo; 
                    var url=getRateTaxBankPortalUrl();    
                    if (val == "OK") {
                        var order_id=info.OrderID;
                        var returntot=info.TotAmount;
                        var $form = $("<form/>").attr("id", "data_form")
                        .attr("action", url)
                        .attr("method", "post");
                        $("body").append($form);
                        AddParameterWithID($form, "orderID", order_id);
                        AddParameterWithID($form, "amount", totamt);
                        AddParameterWithID($form, "type", "Rate");  
                        AddParameterWithID($form, "email", email);  
                        AddParameterWithID($form, "userId", username); 
                        AddParameterWithID($form, "mytoken", sessionStorage.getItem('mytoken'));   

                        //Send the Form.
                        $form[0].submit();      
                    }
                    else {
                        Swal.fire(val, description, 'error');
                    }
                },
                error: function (data) {
                    Swal.fire("Error", data.status+' : '+data.statusText, 'error');
                }
            });
        }
    });


 });

 
function AddParameterWithID(form, name, value) {
    var $input = $("<input />").attr("type", "hidden")
                            .attr("name", name).attr("id", name)
                            .attr("value", value);
    form.append($input);
}