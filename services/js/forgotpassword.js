$(document).ready(function () {
  sessionStorage.setItem("mytoken",  '');
  $("#bt2").hide();
  $("#bt3").hide();
  $("#test99").hide();
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

function validateForm()
{
    if(trim(document.insert.aname.value) ==="")
    {
      alert(" Phone Number or Email is required ! ");
      document.insert.aname.focus();
      return false;
    }
}

function trim(value) {
    return value.replace(/^\s+|\s+$/g,"");
}
                                          
function mobilevalidation(obj, val, valEmpty, errormsg) {
 
  $("#" + obj).parent().find('span').remove();
  
  if (val == valEmpty) {
    $("#" + obj).parent().addClass("has-error");
    var o = $("#" + obj).parent();
    $("<span style='font-size:11px;color:red;'>" + errormsg + "</span>").appendTo(o);
    $('#txtforgotpassword').css('border-color', 'red');
    return false;
  } else {
    var pattern = /^[0]*(\d{9})*\s*$/;
    if (!pattern.test(val)) {
      $("#" + obj).parent().addClass("has-error");
      var o = $("#" + obj).parent();
      $("<span style='font-size:11px;color:red;'>Enter Valid mobile number ex.07XXXXXXXX</span>").appendTo(o);
      $('#txtforgotpassword').css('border-color', 'red');
      return false;
    } else {
      $("#" + obj).parent().removeClass("has-error");
      $('#txtforgotpassword').css('border-color', '#ced4da');
      return true;
    }
  }
}

function emailvalidation(obj,val,valEmpty,errormsg) 
{
  $("#"+obj).parent().find('span').remove();
  if(val==valEmpty){
        $("#"+obj).parent().addClass("has-error");
        var o=$("#"+obj).parent();
        $("<span style='font-size:11px;color:red;'>"+errormsg+"</span>").appendTo(o);
        $('#txtforgotpassword').css('border-color', 'red');
        return false;
  }else{
    var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
    if(!pattern.test(val))
    {
      $("#"+obj).parent().addClass("has-error");
      var o=$("#"+obj).parent();
      $("<span style='font-size:11px;color:red;'>Enter a valid email address</span>").appendTo(o);
      $('#txtforgotpassword').css('border-color', 'red');
      return false;
    }
    else{
      $("#"+obj).parent().removeClass("has-error");
      $('#txtforgotpassword').css('border-color', '#ced4da');
      return true;
    }
  }
}

$("#txtforgotpassword").blur("change",function(){
    if($.isNumeric($("#txtforgotpassword").val())){
      mobilevalidation(this.id,$("#txtforgotpassword").val(),"","Phone Number or Email is required !");
      
    }
  });

  $("#txtforgotpassword").blur("change",function(){
    if(!$.isNumeric($("#txtforgotpassword").val())){
       emailvalidation(this.id,$("#txtforgotpassword").val(),"","Phone Number or Email is  required !");
    }
  });
        
  function SubmitUserDetails() {
    var forgotpassword=true;
    var forgotpassword2=true;
    var isrequird=requiredvalidate("txtforgotpassword",$("#txtforgotpassword").val(),"","Phone Number or Email is required !");     
  
      if($.isNumeric($("#txtforgotpassword").val())){
        forgotpassword =mobilevalidation("txtforgotpassword",$("#txtforgotpassword").val(),"","Phone Number or Email is required !");     
      }else{
        forgotpassword2 =emailvalidation("txtforgotpassword",$("#txtforgotpassword").val(),""," Phone Number or Email is  required !");     
      }
      if ($('#txtforgotpassword').val() == '') {
        $('#txtforgotpassword').css('border-color', 'red');
      }else {
        $('#txtforgotpassword').css('border-color', '#ced4da');   
      }
      
      if (forgotpassword == true && forgotpassword2 == true && isrequird==true){
        $("#bt1").hide();
        $("#bt2").show();
        
        $.ajax({
          type: 'POST',
          dataType: 'json',
           url: 'https://user-api.nekfa.com//api/UserLoginDetails',
          data: { UserName: $("#txtforgotpassword").val(), LocationID: getConfigData.getlocation() },
          success: function (data) {
              if(data.ReturnMsg.ReturnValue=="OK")
              {
                $("#error").html(data.ReturnMsg.ReturnMessage).hide();
                $("#bt2").hide();
                $("#txtforgotpassword").attr("disabled", true);
                $("#submitUser").attr("disabled", true);
                if(data.LoginInfo.Mobile!=''){
                  
                  $("#verifyOptionMobile").html('Mobile - '+data.LoginInfo.Mobile);
                  $("#divMobile").css('display','block');
                }
                if(data.LoginInfo.Email!=''){
                  $("#verifyOptionEmail").html('Email - '+data.LoginInfo.Email);
                  $("#divEmail").css('display','block');
                }
                sessionStorage.setItem("userName",  $("#txtforgotpassword").val());
                sessionStorage.setItem("mytoken",  data.ReturnMsg.Token);
                $("#detailsDiv").css('display','block');
              }
              else{
                $("#error").html(data.ReturnMsg.ReturnMessage);
                $("#bt1").show();
                $("#bt2").hide();
              } 
            }
          });
      }else{
        return false;
      }
    }

function Check() {

var checkBox = document.getElementById("chMobile");
var checkEmail = document.getElementById("chEmail");

if (checkBox.checked == true && checkEmail.checked == true){
  $("#test99").hide();
} else {
  // $("#test99").show();
}

if (checkBox.checked == true && checkEmail.checked == false){
  $("#test99").hide();
} else {
  $("#test99").show();
}

if (checkBox.checked == false && checkEmail.checked == true){
  $("#test99").show();
} else {
  $("#test99").hide();
}

if (checkBox.checked == false && checkEmail.checked == false){
  $("#test99").show();
} else {
  $("#test99").hide();
}

// if (checkEmail.checked == true){
//   $("#test99").hide();
// } else {
//   $("#test99").show();
// }

  var forgotpassword=true;
  var forgotpassword2=true;
  var isrequird=requiredvalidate("txtforgotpassword",$("#txtforgotpassword").val(),"","Phone Number or Email is required !");     

    if($.isNumeric($("#txtforgotpassword").val())){
      forgotpassword =mobilevalidation("txtforgotpassword",$("#txtforgotpassword").val(),"","Phone Number or Email is required !");     
    }else{
      forgotpassword2 =emailvalidation("txtforgotpassword",$("#txtforgotpassword").val(),""," Phone Number or Email is  required !");     
    }
    if ($('#txtforgotpassword').val() == '') {
      $('#txtforgotpassword').css('border-color', 'red');
    }else {
      $('#txtforgotpassword').css('border-color', '#ced4da');
        
    }

    if (forgotpassword == true && forgotpassword2 == true && isrequird==true){
      var isMobile=$("#chMobile:checked").val();
      if(isMobile!='1')
        isMobile='0';
      var isEmail=$("#chEmail:checked").val();
      if(isEmail!='1')
        isEmail='0';
  
      var isOneSelect=false;
      if(isMobile=='1' || isEmail=='1')
        isOneSelect=true;

      if(isOneSelect){
        $("#bt4").hide();
        $("#bt3").show();
        
        $.ajax({
          type: 'POST',
          dataType: 'json',
          headers: {
            "Authorization": 'Bearer '+sessionStorage.getItem('mytoken')
          },
          url: 'https://user-api.nekfa.com//api/SendVerificationCode?userId='+$("#txtforgotpassword").val(),
          data: { UserName: $("#txtforgotpassword").val(), 
                  LocationID: getConfigData.getlocation(),
                  NeedToSendSms :isMobile,
                  NeedToSendEmail :isEmail },
          success: function (data) {
              if(data.ReturnValue=="OK")
              {
                sessionStorage.setItem("isSignup", '');
                sessionStorage.setItem("userName",  $("#txtforgotpassword").val());
                sessionStorage.setItem("isEmail",  isEmail);
                sessionStorage.setItem("isMobile",  isMobile);
                window.location="verification.html";
              }
              else{
                $("#error").html(data.ReturnMessage);
              }
              
            },
            error: function (ex) {
              alert("Error : "+ ex.status+ ' : '+ex.statusText);
            }
          });
      }
      else{
        return false;
      }
    }else{
      return false;
    } 
  }