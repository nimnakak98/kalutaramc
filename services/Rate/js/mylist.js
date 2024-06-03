/**
* @Author : Vindya
* 
*/

$(document).ready(function(){
  
    var ClientID = getConfigData.getlocation();   
 
    $("#topic").html("My Property");   
    var username = sessionStorage.getItem('UserName');  
     var sendUrl = getRateTaxAPIURL()+'MyProperty?userId='+username;
        var apiKey =  getapiKey();
        var customerId = sessionStorage.getItem('CustomerID');  
        
        $("#customerID").val(customerId); 
        $.ajax({
        type:'POST',
        dataType:'json',
        headers: {
            "Authorization": 'Bearer '+sessionStorage.getItem('mytoken')
          },
        url:sendUrl,
        data:{LocationID:ClientID,UserName:username},        
        success: function(data){
            
            var val = data.ReturnMsgInfo.ReturnValue;
            var description = data.ReturnMsgInfo.ReturnMessage; 
            var listProperty = data.ListPropertyInfo; 
            if(val=="OK"){  
                if(listProperty.length>0){  
                    var tbl="<table class='table'><thead><tr><th>#</th><th>Custom NO</th><th>Branch / Div / Street / Property No</th><th>Owner Name</th><th>Description</th><th>Annual Value</th><th></th><tr></thead><tbody>";               
                    for (var i=0; i < listProperty.length; i++) {             
                        tbl=tbl+"<tr><td>"+(i+1)+".</td><td>"+listProperty[i]["CustomNO"]+"</td><td>"+listProperty[i]["BranchName"]+"<br/>"+listProperty[i]["Division"]+"<br/>"+listProperty[i]["StreerName"]+"<br/>"+listProperty[i]["PropertyNO"]+"</td>";
                        tbl=tbl+"<td>"+listProperty[i]["FullName"]+"</td><td>"+listProperty[i]["PropertyDescription"]+"</td><td>"+listProperty[i]["AnualValue"]+"</td><td><a class='btn btn-info' href='rate-tax-info.html?id="+listProperty[i]["ID"]+"&loc="+listProperty[i]["BranchID"]+"'>View / Payment</a><br><a href='#'  onclick='return deleteproperty("+listProperty[i]["ID"]+");' class='btn btn-danger' style='margin-top:4px'>Remove</a></td></tr>";
                    }
                    tbl=tbl+"</tbody></table>";
                    $("#list").html(tbl);
                    $(".loader").hide();
                }
                else{
                    $(".loader").hide();
                }
            }
            else{
                $("#error").html('<h4>'+description+'</h4>');
                $(".loader").hide();
            }
            
            
        }
        
    });
 });



 function deleteproperty(id)
 {
  
    Swal.fire({
        title: 'Are you sure?',
        text: "Continue this delete !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5cb85c',
        cancelButtonColor: '#d9534f',
        confirmButtonText: 'Yes, delete it!'
    }).then(function (result) {
        if (result.value) {
            var sendUrl = getRateTaxAPIURL()+'deletemyproperty?userId='+sessionStorage.getItem('UserName');
            var ClientID = getConfigData.getlocation();   
            $.ajax({
                type:'POST',
                dataType:'json',
                url:sendUrl,
                headers: {
                    "Authorization": 'Bearer '+sessionStorage.getItem('mytoken')
                },
                data:{ "LocationID":ClientID,"UserID":$("#customerID").val(),"PropertyID":id},                
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


 function newproperty()
 {
    sessionStorage.setItem("userName",$("#userName").val()); 
    sessionStorage.setItem("loginType",$("#loginType").val()); 
    sessionStorage.setItem("customerID",$("#customerID").val()); 
    window.location="newproperty.html";
 }
 