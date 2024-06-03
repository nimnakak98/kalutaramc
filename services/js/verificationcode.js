/**
* @Author : Gihantha
* 
*/
$(document).ready(function () {
  $("#bt2").hide();
});

$(document).ready(function () {
  $("#txtverifycode").focus();
  var username = sessionStorage.getItem('userName'); 
  $("#hdUserName").val(username);
});

function requiredvalidate(obj,val,valEmpty,errormsg)
{
    $("#"+obj).parent().find('span').remove();
    if(val==valEmpty){
        $("#"+obj).parent().addClass("has-error");
        var o=$("#"+obj).parent();
        $("<span style='font-size:11px;color:red;'>"+errormsg+"</span>").appendTo(o);
        return false;
    }else{
        $("#"+obj).parent().removeClass("has-error");
        return true;
    }
}
function verifycodevalidation(obj,val,valEmpty,errormsg) 
{
  $("#"+obj).parent().find('span').remove();
  if(val==valEmpty){
        $("#"+obj).parent().addClass("has-error");
        var o=$("#"+obj).parent();
        $("<span style='font-size:12px;color:red;'>"+errormsg+"</span>").appendTo(o);
        $('#txtverifycode').css('border-color', 'red');
        
        return false;
  }else{
    var pattern= /^[0]*(\d{6})*\s*$/;
    if(!pattern.test(val))
    {
      $("#"+obj).parent().addClass("has-error");
      var o=$("#"+obj).parent();
      $("<span style='font-size:12px;color:red;'>All 6 must be digits and only 6 digits ex.XXXXXX</span>").appendTo(o);
     
      return false;
    }else{
      $("#"+obj).parent().removeClass("has-error");
      $('#txtforgotpassword').css('border-color', '#ced4da');
     
      return true;
    }
  }
}

// $("#txtverifycode").blur("change",function(){
//   verifycodevalidation(this.id,$("#txtverifycode").val(),"","Verify code is required !");
    

//   });
              
function Check() {
  var isSignup = sessionStorage.getItem('isSignup');
  var u_mobile = sessionStorage.getItem('UserMobile');
  var verifycode = verifycodevalidation("txtverifycode", $("#txtverifycode").val(), "", "verify code is  required !");

  if ($('#txtverifycode').val() == '') {
    $('#txtverifycode').css('border-color', 'red');
  }
  else {
    $('#txtforgotpassword').css('border-color', '#ced4da');
  }
  if (verifycode == true) {
    if (isSignup == null|| isSignup =='') {
      $.ajax({
        type: 'POST',
        dataType: 'json',
        headers: {
          "Authorization": 'Bearer ' + sessionStorage.getItem('mytoken')
        },
        url: 'https://user-api.nekfa.com//api/VerifyCode?userId=' + $("#hdUserName").val(),
        data: {
          UserName: $("#hdUserName").val(),
          LocationID: getConfigData.getlocation(),
          VerificationCode: $("#txtverifycode").val()
        },
        success: function (data) {
          if (data.ReturnValue == "OK") {
            sessionStorage.setItem("userName", $("#hdUserName").val());
            sessionStorage.setItem("VerificationCode", $("#txtverifycode").val());
            window.location = "resetpassword.html";
          }
          else {

            $("#error").html(data.ReturnMessage);
          }
        },
        error: function (ex) {
          alert("Error : " + ex.status + ' : ' + ex.statusText);
        }
      });
    }
    else if (isSignup == 'true') {

      $("#bt1").hide();
      $("#bt2").show();
     
      var tel = sessionStorage.getItem('tel'); 
        var mail = sessionStorage.getItem('mail'); 
        var pwd = sessionStorage.getItem('pwd'); 
        var uname = sessionStorage.getItem('uname'); 
        var add = sessionStorage.getItem('userName'); 
        var loc = getConfigData.getlocation();
      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: 'https://user-api.nekfa.com/api/verifycodeforsignup',
        data: {
          Mobile: tel,
          Email: mail,
          LocationId: getConfigData.getlocation(),
          VerificationCode: $("#txtverifycode").val()
        },
        success: function (data) {
          if (data.ReturnValue == "OK") {
            sessionStorage.setItem("userName", $("#hdUserName").val());
            sessionStorage.setItem("VerificationCode", $("#txtverifycode").val());
            $.ajax({
              type: 'POST',
              dataType: 'json',
              url: "https://user-api.nekfa.com/api.v.1/signup",
              data: { Mobile: tel, Email: mail, LocationId: loc, password: pwd, Name: uname, Address: add },
              // headers: {
              //     "x-api-key": apiKey
              // },
              success: function (data) {
                var val = data.arr.msg;
                var description = data.arr.msgdesc;
                var res = data.arr.res;

                if (res == 1) {
                  alert(data.arr.msgdesc);
                  window.location = "index.html";
                }
              }
            });
          }
          else {

            $("#error").html(data.ReturnMessage);
            $("#bt1").show();
            $("#bt2").hide();
            
          }
        },
        error: function (ex) {
          alert("Error : " + ex.status + ' : ' + ex.statusText);
        }
      });
    }
  }

}


function ResendCode() {
  var isSignup = sessionStorage.getItem('isSignup');
  if (isSignup == null|| isSignup =='') {
  $.ajax({
    type: 'POST',
    dataType: 'json',
    headers: {
      "Authorization": 'Bearer '+sessionStorage.getItem('mytoken')
    },
     url: 'https://user-api.nekfa.com//api/ResendCode?userId='+$("#hdUserName").val(),
    data: { UserName: $("#hdUserName").val(), LocationId: getConfigData.getlocation(),  
    NeedToSendSms :sessionStorage.getItem("isMobile"),
    NeedToSendEmail :sessionStorage.getItem("isEmail")
    },
    success: function (data) {
        if(data.ReturnValue=="OK")
        {
         alert('Resent verification code');
          window.location="verification.html";
        }
        else{
          alert('error');
          $("#error").html(data.ReturnMessage);
        }
        
      },
      error: function (ex) {
        alert("Error : "+ ex.status+ ' : '+ex.statusText);
      }
    });
  }
  else if (isSignup == 'true') {
    var tel = sessionStorage.getItem('tel'); 
    var mail = sessionStorage.getItem('mail'); 
    $.ajax({
      type: 'POST',
      dataType: 'json',              
      url: 'https://user-api.nekfa.com/api/sendverifycodeforsignup',
      data: {
          LocationId: getConfigData.getlocation(),
          Mobile: tel,
          Email: mail
      },
      success: function (data) {
          if (data.ReturnValue == "OK") {
              sessionStorage.setItem("isSignup", 'true');
              sessionStorage.setItem("UserMobile", tel);
              window.location = "verification.html";
          }
          else {
              $("#error").html(data.ReturnMessage);

          }

      },
      error: function (ex) {
          alert("Error : " + ex.status + ' : ' + ex.statusText);
      }
  });
  }
    return false;
}