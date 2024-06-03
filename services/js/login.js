/**
* @Author : Vindya
* 
*/


function newMail() {             
    // $('#eml').removeClass('div-hide');
    $('#login-type').modal('toggle');
    $('#logn').removeClass('div-hide');
    $('#hdType').val('mail');
    $('#switchLgTyp').removeClass('div-hide');
    $('#tPhone').show();
    $('#eMail').hide();
}
function newPhone() {             
    // $('#mob').removeClass('div-hide');
     $('#login-type').modal('toggle');
     $('#logn').removeClass('div-hide');
     $('#lblUserName').text("Mobile :");
     $("#email").attr("placeholder", "Enter your mobile");
    $('#hdType').val('tel');
    $('#switchLgTyp').removeClass('div-hide');
    $('#tPhone').hide();
    $('#eMail').show();

}

function swchEmail(){
    $('#lblUserName').text("Mobile :");
     $("#email").attr("placeholder", "Enter your mobile");
    $('#hdType').val('tel');
    $('#tPhone').hide();
    $('#eMail').show();
}


function swchMobile(){
    $('#lblUserName').text("Email :");
    $("#email").attr("placeholder", "Enter your email");
    $('#hdType').val('mail');
    $('#tPhone').show();
    $('#eMail').hide();
}



$(document).ready(function(){
    sessionStorage.setItem("UserName", "");
    $('#login-type').modal('show');
    var locationMain =  getConfigData.getlocation();
    var baseUrl = getConfigData.geturl();
    $('#viewlocationMain').html(locationMain);
    $('#viewlocationUrl').html(baseUrl);
    var councilName = getCouncilName();
    $('#changeTopic').html(councilName);
    var serviceType = sessionStorage.getItem('ServiceType');
    $('#serviceTyp').html(serviceType);
});

$("#email").blur(function(){
    var username = $('#email').val();    
    var loc = $('#viewlocationMain').text();
    var datType = $('#hdType').val();
    var baseUrl = $('#viewlocationUrl').text();
    var url = baseUrl+'validateuser';
    var apiKey =  getapiKey();

        if(username !=''){
            $('#email').parent().parent().addClass('has-success');
            $('#email').parent().parent().removeClass('has-error');
            $('#spanEmail').html("");                 
            $('#msgErr').html("");
            $('#msgErr').removeClass("alert alert-danger");
            $('#msgSuccess').removeClass("alert alert-success");
            //alert(datType);
            $.ajax({
                type:'POST',
                dataType:'json',
                url:url,
                data:{userName:username,Type:datType, LocationId:loc},
                // headers: {
                //     "x-api-key": apiKey
                // },
                success: function(data){
                    console.log(data);
                console.log(data.arr.msg);
                 var val = data.arr.msg;
                 var description = data.arr.msgdesc;
                 
                 var result = data.arr.res;
                //  console.log(res);
                //  var i = 1;
                //  $.each(result, function (i) {
                //     var customerId = data.arr.res[i]['id'];
                //     sessionStorage.setItem("CustomerID", customerId);
                //     // $('#usrID').html(customerId);
                //     console.log(customerId);
                //  });

                if(val=="newUser"){
                    $("#logUser").html('Sign Up');
                    $('#msgErr').html(description);
                    $('#msgErr').addClass("alert alert-danger");
                }else if(val=="exitsUser"){                   
                    $('#msgErr').html("");
                    $("#logUser").html('LOGIN');
                }else{
                    $('#msgErr').html(description);
                    $('#msgErr').addClass("alert alert-danger");
                }
                return false;
                },
                error:function(xhr,status,error)
                {
                    alert(error);
                
                }

            });
            
    }else{
        if(datType=='mail')
            $('#spanEmail').html("Please enter email !");
        else
            $('#spanEmail').html("Please enter mobile !");

        $('#email').parent().parent().removeClass('has-success');
        $('#email').parent().parent().addClass('has-error');
        $('#msgErr').html("");
        $('#msgErr').removeClass("alert alert-danger");
    }
       
});

$("#pwd").blur(function(){

    if(pwd=!''){
        
        $('#pwd').parent().parent().addClass('has-success');
        $('#pwd').parent().parent().removeClass('has-error');
        $('#spanPwd').html("");
    }else{
        $('#spanPwd').html("Please enter password !");
        $('#pwd').parent().parent().removeClass('has-success');
        $('#pwd').parent().parent().addClass('has-error');
    }

});

$('#logUser').click(function(){
    var username = $('#email').val();    
    var loc = $('#viewlocationMain').text();
    var datType = $('#hdType').val();
    var pwd= $('#pwd').val();
    var baseUrl = $('#viewlocationUrl').text();
    var serviceTyp = $('#serviceTyp').text();
    sessionStorage.setItem("ServiceType", serviceTyp);
    var apiKey =  getapiKey();
    if(datType=='mail'){
    sessionStorage.setItem("Contact", username);
    }else{
    sessionStorage.setItem("ConMobile", username);  
    }

    var btnType = $('#logUser').html();

    if(btnType=="Sign Up"){
        selectUrl = baseUrl+'signup';
    }else{
        selectUrl = baseUrl+'login';
    }

        if(pwd !=''){ 
            
            $('#pwd').parent().parent().addClass('has-success');
            $('#pwd').parent().parent().removeClass('has-error');
            $('#spanPwd').html("");
            $('#msgErr').html("");

            $('#msgErr').removeClass("alert alert-danger");
            $('#msgSuccess').removeClass("alert alert-success");
                        
            $.ajax({
                type:'POST',
                dataType:'json',
                url:selectUrl,
                data:{userName:username,Type:datType, LocationId:loc,password:pwd},
                // headers: {
                //     "x-api-key": apiKey
                // },
                success: function(data){
                    var val = data.arr.msg;
                    var description = data.arr.msgdesc;
                    var res = data.arr.res;                        
                    
                    if(res==1){
                         
                        var userinfo = data.id;  
                        $('#msgSuccess').html(description+"!");
                        $('#msgSuccess').addClass("alert alert-success");
                        sessionStorage.setItem("CustomerID", userinfo);
                        window.location.href = "property-select.html";
                    }else{
                        
                        $('#msgErr').addClass("alert alert-danger");
                        $('#msgErr').html(description);
                    }

                }
                
            });
    }else{
        $('#spanPwd').html("Please enter password !");
        $('#pwd').parent().parent().removeClass('has-success');
        $('#pwd').parent().parent().addClass('has-error');
        $('#msgErr').html("");
        $('#msgErr').removeClass("alert alert-danger");
    }

    if(username !=''){
        $('#email').parent().parent().addClass('has-success');
        $('#email').parent().parent().removeClass('has-error');
        $('#spanEmail').html("");
        $('#msgErr').removeClass("alert alert-danger");
        $('#msgSuccess').removeClass("alert alert-success");
    }else{
        if(datType=='mail')
            $('#spanEmail').html("Please enter email !");
        else
            $('#spanEmail').html("Please enter mobile !");

        $('#email').parent().parent().removeClass('has-success');
        $('#email').parent().parent().addClass('has-error');
        $('#msgErr').html("");
        $('#msgErr').removeClass("alert alert-danger");
    }

    });

function toHome(){
    window.location.href = "index.html";
}

function street(){
    var serviceType ='Street-Line';
    sessionStorage.setItem("Service", serviceType);
}

function nonAqui(){
    var serviceType ='Non-Acquisition';
    sessionStorage.setItem("Service", serviceType);
}
