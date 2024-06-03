$(document).ready(function () {
  //  $("#txtPass").focus();
   var username = sessionStorage.getItem('userName');
   $("#hdUserName").val(username);
   $("#bt2").hide();
 });

 function requiredvalidate(obj, val, valEmpty, errormsg) {
  $("#" + obj).parent().find('span').remove();
  if (val == valEmpty) {
      $("#" + obj).parent().addClass("has-error");
      var o = $("#" + obj).parent();
      $("<span style='font-size:11px;color:red;'>" + errormsg + "</span>").appendTo(o);
      return false;
  } else {
      $("#" + obj).parent().removeClass("has-error");
      return true;
  }
}

$("#txtPass").blur(function () {
  requiredvalidate(this.id, $("#txtPass").val(), "", "Enter Your Password !");
});

$("#txtConfPass").blur(function () {
  requiredvalidate(this.id, $("#txtConfPass").val(), "", "Enter Your Confirm Password !");
});

function showPassword() {
  var x = document.getElementById("txtPass");
  var y = document.getElementById("txtConfPass");

  if (x.type === "password" && y.type === "password") {
      x.type = "text";
      y.type = "text";
  } else {
      x.type = "password";
      y.type = "password";
  }
}

function SignUp() {

  var pass = requiredvalidate("txtPass",$("#txtPass").val(),"","Password is required !");
  var confpass = requiredvalidate("txtConfPass",$("#txtConfPass").val(),"","Confirm Password is required !");

  if ( (pass == true)  && confpass == true ) {
          if($("#txtPass").val()==$("#txtConfPass").val()){
          var verifycode=sessionStorage.getItem('VerificationCode');
         if( verifycode!=null || verifycode!="")
      {
        $("#bt1").hide();
            $("#bt2").show();

        var a=$("#hdUserName").val();
         $.ajax({
           type: 'POST',
           dataType: 'json',
           headers: {
             "Authorization": 'Bearer '+sessionStorage.getItem('mytoken')
           },
            url: 'https://user-api.nekfa.com//api/ResetPassword?userId='+$("#hdUserName").val(),         
           data: { UserName: $("#hdUserName").val(), LocationID: getConfigData.getlocation(),Password:$("#txtPass").val(),verifyCode:verifycode},
           success: function (data) {
               if(data.ReturnValue=="OK")
               {
                 alert(data.ReturnMessage);
                 window.location="index.html";
               }
               else{
                 $("#error").html(data.ReturnMessage);
                 $("#bt1").show();
                    $("#bt2").hide();
               }
             },
             error: function (ex) {
               alert("Error : "+ ex.status+ ' : '+ex.statusText);
               $("#bt1").show();
                    $("#bt2").hide();
             }
           });
         }
         else{
          
         }
       }
          else{
              $("#txtConfPass").parent().addClass("has-error");
              var o=$("#txtConfPass").parent();
              $("<span style='font-size:11px;color:red;'>Password did not match.</span>").appendTo(o);
              $("#txtConfPass").focus();
            }
      };
}

// Check Strength of Password
function checkStrength(password) {  
  $("#txtPass").parent().find('span').remove();
  $("#txtConfPass").parent().removeClass("has-error");
  //return password;
  var strength = 0  
  if(password ==""){
    $('#strengthMessage').removeClass()  
    $('#strengthMessage').addClass('Short')  
      return ''
  }

  if (password.length < 6 ) {  
      $('#strengthMessage').removeClass()  
      // $('#strengthMessage').addClass('Short')  
        return 'Too Short'
  }  
  if (password.length > 7) strength += 1  
  // If password contains both lower and uppercase characters, increase strength value.  
  if (password.match(/([a-z].[A-Z])|([A-Z].[a-z])/)) strength += 1  
  // If it has numbers and characters, increase strength value.  
  if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1  
  // If it has one special character, increase strength value.  
  if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1  
  // If it has two special characters, increase strength value.  
  if (password.match(/(.[!,%,&,@,#,$,^,,?,,~].[!,%,&,@,#,$,^,,?,,~])/)) strength += 1  
  // Calculated strength value, we can return messages  
  // If value is less than 2  
  if (strength < 2) {  
      // $('#strengthMessage').removeClass()  
      // $('#strengthMessage').addClass('Weak')  
      return 'Weak'  
  } else if (strength == 2) {  
      $('#strengthMessage').removeClass()  
      // $('#strengthMessage').addClass('Good')  
      return 'Good'  
  } else {  
      // $('#strengthMessage').removeClass()  
      // $('#strengthMessage').addClass('Strong')  
      return 'Strong'  
  }  
}

$("#txtPass").blur("change",function(){
requiredvalidate(this.id,$("#txtPass").val(),"",checkStrength($("#txtPass").val()));
if(checkStrength($("#txtPass").val())=="Strong"){
$("#signUp").attr("disabled", false);
$('#msg').text("Strong");
  $('#txtPass').css({'border-color': 'green'});
  $("#msg").addClass("text-success");


}else if(checkStrength($("#txtPass").val())=="Weak"){
$("#signUp").attr("disabled", true);
$('#txtPass').css({'border-color': 'red'});
$("#msg").addClass("text-danger");
$('#msg').text("Weak");


}else if(checkStrength($("#txtPass").val())=="Too Short"){
  $("#signUp").attr("disabled",true);
  $('#txtPass').css({'border-color': 'red'});
$("#msg").addClass("text-danger");
  $('#msg').text("Too Short");

}else if(checkStrength($("#txtPass").val())=="Good"){
$("#signUp").attr("disabled", false);
$('#txtPass').css({'border-color': 'green'});
$("#msg").addClass("text-success");
$('#msg').text("Good");

}else{
$('#msg').text(checkStrength($("#txtPass").val()))
$("#signUp").attr("disabled", true);
}
});

$("#txtPass").blur("change",function(){
  requiredvalidate(this.id,$("#txtPass").val(),"","Enter Your Password !");
});