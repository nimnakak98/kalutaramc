$(document).ready(function(){

    $("#modelDiv").show();
    $("#divDiv").hide();
    $("#divStreet").hide();
    $("#divProperty").hide();
    $("#divByNo").hide(); 
    $("#divDetails").hide();


    var customerId = sessionStorage.getItem('CustomerID');  
    var username = sessionStorage.getItem('UserName');  
    var loginType = sessionStorage.getItem('loginType');  

    $("#customerID").val(customerId); 
    $("#username").val(username); 
    $("#loginType").val(loginType); 

    var ClientID = getConfigData.getlocation();   
    var sendUrl = getRateTaxAPIURL()+'subbranchlist?userId='+username;

    $.ajax({
        type:'POST',
        dataType:'json',
        url:sendUrl,
        data:{LocationID :ClientID},
        headers: {
            "Authorization": 'Bearer '+sessionStorage.getItem('mytoken')
          },
        success: function(data){
            
            var val = data.ReturnMsgInfo.ReturnValue;
            var description = data.ReturnMsgInfo.ReturnMessage; 
            var listBranch = data.BranchList; 
            if(val=="OK"){  
                if(listBranch.length>0){  
                     for (var i=0; i < listBranch.length; i++) { 
                         $("#listCompany").append($('<option></option>').val(listBranch[i]["BranchKey"]).html(listBranch[i]["BranchName"]));            
                     }
                   
                    $(".loader").hide();
                }
                else{
                    
                }
                $(".loader").hide();
                $("#modelDiv").hide();
            }
            else{
                $("#error").html('<h4>'+description+'</h4>');
            }
            
            
        }
        
    });

});

$("#btnByDiv").on('click',function(){
    $("#divByDiv").show(); 
    $("#divByNo").hide(); 
    $("#divDetails").hide();
    $("#error").html('');
});

$("#btnByNo").on('click',function(){
    $("#divByDiv").hide(); 
    $("#divByNo").show(); 
    $("#divDetails").hide();
    $("#error").html('');
});

$("#listCompany").on('change', function () {
    $(".loader").show();
    $("#modelDiv").show(); 
    $("#divStreet").hide(); 
    $("#divProperty").hide();
    $("#divDetails").hide();
    $('#listDiv').children('option:not(:first)').remove();
    var comID = $(this).val();  
    var sendUrl = getRateTaxAPIURL()+'divisionlist?userId='+$("#username").val() ;

    if(comID!=''){
    $.ajax({
        type:'POST',
        dataType:'json',
        url:sendUrl,
        data:{BranchID :comID},
        headers: {
            "Authorization": 'Bearer '+sessionStorage.getItem('mytoken')
          },
        success: function(data){
            
            var val = data.ReturnMsgInfo.ReturnValue;
            var description = data.ReturnMsgInfo.ReturnMessage; 
            var list = data.DivisionList; 
            if(val=="OK"){  
                if(list.length>0){  
                     for (var i=0; i < list.length; i++) { 
                         $("#listDiv").append($('<option></option>').val(list[i]["div_Id"]).html(list[i]["div_Id"]));            
                     }
                   
                    $(".loader").hide();
                }
                else{
                    
                }
                $(".loader").hide();
                $("#modelDiv").hide();                
                $("#divDiv").show();
            }
            else{
                $("#error").html('<h4>'+description+'</h4>');
            }
            
            
        },
        error: function (data) {
            alert(data.responseText);
        }
        
    });  
}    
else{
    $(".loader").hide();
    $("#modelDiv").hide();                
    $("#divDiv").hide();  
}        
});                                             

$("#listDiv").on('change', function () {
    $(".loader").show();
    $("#modelDiv").show(); 
    $("#divProperty").hide(); 
    $("#divDetails").hide();
    $('#listStreet').children('option:not(:first)').remove();
    var comID = $("#listCompany").val();  
    var divId=$("#listDiv").val();
    var sendUrl = getRateTaxAPIURL()+'streetlist?userId='+$("#username").val();

    if(divId!=''){
    $.ajax({
        type:'POST',
        dataType:'json',
        url:sendUrl,
        data:{BranchID :comID,Division:divId},
        headers: {
            "Authorization": 'Bearer '+sessionStorage.getItem('mytoken')
          },
        success: function(data){
            
            var val = data.ReturnMsgInfo.ReturnValue;
            var description = data.ReturnMsgInfo.ReturnMessage; 
            var list = data.StreetList; 
            if(val=="OK"){  
                if(list.length>0){  
                     for (var i=0; i < list.length; i++) { 
                         $("#listStreet").append($('<option></option>').val(list[i]["street_Id"]).html(list[i]["street_Name"]));            
                     }
                   
                    $(".loader").hide();
                }
                else{
                    
                }
                $(".loader").hide();
                $("#modelDiv").hide();                
                $("#divStreet").show();
            }
            else{
                $("#error").html('<h4>'+description+'</h4>');
            }
            
            
        },
        error: function (data) {
            alert(data.responseText);
        }
        
    });  
}    
else{
    $(".loader").hide();
    $("#modelDiv").hide();  
    $("#divStreet").hide();
    $("#divProperty").hide();
    $("#divDetails").hide();
}        
});    

$("#listStreet").on('change', function () {
    $(".loader").show();
    $("#modelDiv").show();  
    $("#divDetails").hide();
    $('#listProperty').children('option:not(:first)').remove();
    var comID = $("#listCompany").val();  
    var divId=$("#listDiv").val();
    var streetId=$("#listStreet").val();
    var sendUrl = getRateTaxAPIURL()+'propertylist?userId='+$("#username").val();

    if(streetId!=''){
    $.ajax({
        type:'POST',
        dataType:'json',
        url:sendUrl,
        data:{BranchID :comID,DivisionID:divId,StreetID:streetId},
        headers: {
            "Authorization": 'Bearer '+sessionStorage.getItem('mytoken')
          },
        success: function(data){
            
            var val = data.ReturnMsgInfo.ReturnValue;
            var description = data.ReturnMsgInfo.ReturnMessage; 
            var list = data.PropertyList; 
            if(val=="OK"){  
                if(list.length>0){  
                     for (var i=0; i < list.length; i++) { 
                         $("#listProperty").append($('<option></option>').val(list[i]["ID"]).html(list[i]["PropertyNo"]));            
                     }
                   
                    $(".loader").hide();
                }
                else{
                    
                }
                $(".loader").hide();
                $("#modelDiv").hide();                
                $("#divProperty").show();
            }
            else{
                $("#error").html('<h4>'+description+'</h4>');
                $(".loader").hide();
                $("#modelDiv").hide();     
            }
            
            
        },
        error: function (data) {
            alert(data.responseText);
        }
        
    });  
}    
else{
    $(".loader").hide();
    $("#modelDiv").hide();  
    $("#divProperty").hide();
    $("#divDetails").hide();
}        
}); 


$("#listProperty").on('change', function () {
    $(".loader").show();
    $("#modelDiv").show();  
   
    var comID = $("#listCompany").val();  
    var propertyid=$("#listProperty").val();
    var sendUrl = getRateTaxAPIURL()+'propertyinfo?userId='+$("#username").val();

    if(propertyid!=''){
    $.ajax({
        type:'POST',
        dataType:'json',
        url:sendUrl,
        data:{BranchID:comID,ID:propertyid},
        headers: {
            "Authorization": 'Bearer '+sessionStorage.getItem('mytoken')
          },
        success: function(data){
            
            var val = data.ReturnMsgInfo.ReturnValue;
            var description = data.ReturnMsgInfo.ReturnMessage;
            var info = data.PropertyInfo;   
            if(val=="OK"){  
                    $('#lblDesc').html(info['PropertyDescription']);
                    $('#lblAV').html(info['AnualValue']);                   
                    $('#lblOwner').html(info['FullName']);
                    $("#propertyID").val(info["ID"]);

                $(".loader").hide();
                $("#modelDiv").hide();                
                $("#divDetails").show();
            }
            else{
                $("#error").html('<h4>'+description+'</h4>');
            }
            
            
        },
        error: function (ex) {
          alert("Error : " + ex.status + ' : ' + ex.statusText);
        }
        
    });  
}    
else{
    $(".loader").hide();
    $("#modelDiv").hide();  
    $("#divDetails").hide();

}        
}); 


function confirm()
 {
  
    Swal.fire({
        title: 'Are you sure?',
        text: "I am agree to add this property to my account !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5cb85c',
        cancelButtonColor: '#d9534f',
        confirmButtonText: 'Yes, do it!'
    }).then(function (result) {
        if (result.value) {
            
            var comID = $("#listCompany").val();  
            var propertyid=$("#propertyID").val();
            var sendUrl = getRateTaxAPIURL()+'addmyproperty?userId='+$("#username").val();
            var cusId= $("#customerID").val();
            $.ajax({
                type:'POST',
                dataType:'json',
                headers: {
                    "Authorization": 'Bearer '+sessionStorage.getItem('mytoken')
                  },
        
                url:sendUrl,
                
                data:{LocationID:comID,PropertyID:propertyid,UserID:cusId},                
                success: function(data){
                    var val = data.ReturnValue;
                    var desc=data.ReturnMessage;
                    if(val=="OK"){ 
                        window.location="mylist.html";
                    }
                    else{
                        $("#error").html('<h4>'+desc+'</h4>');
                    }

                },
                error: function (ex) {
                  alert("Error : " + ex.status + ' : ' + ex.statusText);
                }
            });

        }
    });


    return false;
}

function search()
 {
    var comID = $("#listCompany").val();  
    var customNo=$("#txtCusNo").val();
    var sendUrl = getRateTaxAPIURL()+'propertyinfo?userId='+$("#username").val();
    $("#error").html('');
    if(customNo!=''){
        $(".loader").show();
        $("#modelDiv").show();    
        $.ajax({
            type:'POST',
            dataType:'json',
            url:sendUrl,
            data:{BranchID:comID,CustomNO:customNo},
            headers: {
                "Authorization": 'Bearer '+sessionStorage.getItem('mytoken')
              },
            success: function(data){
                
                var val = data.ReturnMsgInfo.ReturnValue;
                var description = data.ReturnMsgInfo.ReturnMessage;
                var info = data.PropertyInfo;
                if(val=="OK"){           
                    $('#lblDesc').html(info['PropertyDescription']);
                    $('#lblAV').html(info['AnualValue']);                   
                    $('#lblOwner').html(info['FullName']);
                    $("#propertyID").val(info["ID"]);
                    $(".loader").hide();
                    $("#modelDiv").hide();                
                    $("#divDetails").show();
                }
                else{
                    $("#error").html('<h4>'+description+'</h4>');
                    $("#divDetails").hide();
                }
                $(".loader").hide();
                $("#modelDiv").hide(); 
            },
            error: function (data) {
                alert(data.responseText);
            }
        });
    }
    else{
        $("#error").html('<h4>Please enter custom no.</h4>');
    }
    return false;
}