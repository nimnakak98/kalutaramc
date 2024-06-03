/**
* @Author : Gihantha
* 
*/

$(document).ready(function () {

    var username = sessionStorage.getItem('userName');
    $("#hdUserName").val(username);
    $("#bt2").hide();

    var username = sessionStorage.getItem('UserName');  
    var url_string = window.location.href;
    var url = new URL(url_string);
    var locationMain = getClientID();
    $("#modelDiv").show();
    var url = getUserAPIURL() + 'viewuserdetails?userId='+username;
    var type = sessionStorage.getItem("DataType");
    var pass =  sessionStorage.getItem("pwd1");
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: url,
        headers: {
            "Authorization": 'Bearer '+sessionStorage.getItem('mytoken')
        },
        data: {
            "LocationId":locationMain,
            "userName":username,
            "Type":type,
            "password":pass
        },
        success: function (data) {
            var val = data.ReturnMsgInfo.ReturnValue;
            var Uinfo = data.UserInfo;
            
            if (val == "OK") {
                $('#txtName').val(Uinfo['name']);
                $('#txtAddress').val(Uinfo['address']);
                $('#txtMob').val(Uinfo['tel']);
                $('#txtEmail').val(Uinfo['email']);
            }
            $("#modelDiv").hide();
             $(".loader").hide();
        },
        error: function (ex) {
            alert("Error : " + ex.status + ' : ' + ex.statusText);
        }
    });
});

var userApiUrl="https://user-api.nekfa.com/api/";

function getUserAPIURL() {
   return userApiUrl;
}

function getClientID(){
    return locId;
}