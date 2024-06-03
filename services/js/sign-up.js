/**
* @Author : Gihantha
* 
*/
$(document).ready(function () {
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

function emailvalidation(obj, val, valEmpty, errormsg) {
    $("#" + obj).parent().find('span').remove();
    if (val == valEmpty) {
        $("#" + obj).parent().addClass("has-error");
        var o = $("#" + obj).parent();
        $("<span style='font-size:11px;color:red;'>" + errormsg + "</span>").appendTo(o);
        return false;
    } else {
        var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
        if (!pattern.test(val)) {
            $("#" + obj).parent().addClass("has-error");
            var o = $("#" + obj).parent();
            $("<span style='font-size:11px;color:red;'>Enter a valid email address</span>").appendTo(o);
            return false;
        }
        else {
            $("#" + obj).parent().removeClass("has-error");
            return true;
        }
    }
}

function mobilevalidation(obj, val, valEmpty, errormsg) {
    $("#" + obj).parent().find('span').remove();
    if (val == valEmpty) {
        $("#" + obj).parent().addClass("has-error");
        var o = $("#" + obj).parent();
        $("<span style='font-size:11px;color:red;'>" + errormsg + "</span>").appendTo(o);
        return false;
    } else {
        var pattern = /^[0]*(\d{9})*\s*$/;
        if (!pattern.test(val)) {
            $("#" + obj).parent().addClass("has-error");
            var o = $("#" + obj).parent();
            $("<span style='font-size:11px;color:red;'>Enter Valid mobile number ex.07XXXXXXXX</span>").appendTo(o);
            return false;
        } else {
            $("#" + obj).parent().removeClass("has-error");
            return true;
        }
    }
}

$("#txtName").blur(function () {
    requiredvalidate(this.id, $("#txtName").val(), "", "Enter Your Name !");
});

$("#txtAddress").blur(function () {
    requiredvalidate(this.id, $("#txtAddress").val(), "", "Enter Your Address !");
});

$("#txtMob").blur(function () {
    mobilevalidation(this.id, $("#txtMob").val(), "", "Enter Your Mobile Number !");
});

$("#txtEmail").blur(function () {
    emailvalidation(this.id, $("#txtEmail").val(), "", "Enter Your Email Address !");
});

// $("#txtPass").blur(function () {
//     requiredvalidate(this.id, $("#txtPass").val(), "", "Enter Your Password !");
// });

// $("#txtConfPass").blur(function () {
//     requiredvalidate(this.id, $("#txtConfPass").val(), "", "Enter Confirm Password !");
// });

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
    // alert('test');
    var name = requiredvalidate("txtName", $("#txtName").val(), "", "Name is required !");
    var address = requiredvalidate("txtAddress", $("#txtAddress").val(), "", "Address is required !");
    var mobile = mobilevalidation("txtMob", $("#txtMob").val(), "", "Mobile Number is required !");
    // var email = emailvalidation("txtEmail", $("#txtEmail").val(), "", "Email is required !");
    var pass = requiredvalidate("txtPass", $("#txtPass").val(), "", "Password is required !");
    var confpass = requiredvalidate("txtConfPass", $("#txtConfPass").val(), "", "Confirm Password is required !");
    var loc = getConfigData.getlocation();
    if ((name == true) && (address == true) && (mobile == true)
        && (pass == true) && confpass == true) {
        var tel = $('#txtMob').val();
        var mail = $('#txtEmail').val();
        var pwd = $('#txtPass').val();
        var uname = $('#txtName').val();
        var add = $("#txtAddress").val();

        sessionStorage.setItem("tel", tel);
        sessionStorage.setItem("mail", mail);
        sessionStorage.setItem("pwd", pwd);
        sessionStorage.setItem("uname", uname);
        sessionStorage.setItem("add", add);

        if ($("#txtPass").val() == $("#txtConfPass").val()) {
            $("#bt1").hide();
            $("#bt2").show();
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
                        $("#bt1").show();
                        $("#bt2").hide();
                    }

                },
                error: function (ex) {
                    alert("Error : " + ex.status + ' : ' + ex.statusText);
                }
            });

        }
        else {
            $("#txtConfPass").parent().addClass("has-error");
            var o = $("#txtConfPass").parent();
            $("<span style='font-size:11px;color:red;'>Password did not match.</span>").appendTo(o);
            $("#txtConfPass").focus();
        }
    };
}


//Check Strength of Password
function checkStrength(password) {
    $("#txtPass").parent().find('span').remove();
    $("#txtConfPass").parent().removeClass("has-error");
    //return password;
    var strength = 0
    if (password == "") {
        $('#strengthMessage').removeClass()
        $('#strengthMessage').addClass('Short')
        return ''
    }


    if (password.length < 6) {
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

$("#txtPass").blur("change", function () {


    requiredvalidate(this.id, $("#txtPass").val(), "", checkStrength($("#txtPass").val()));


    if (checkStrength($("#txtPass").val()) == "Strong") {
        $("#signUp").attr("disabled", false);
        $('#msg').text("Strong");
        $('#txtPass').css({ 'border-color': 'green' });
        $("#msg").addClass("text-success");


    } else if (checkStrength($("#txtPass").val()) == "Weak") {
        $("#signUp").attr("disabled", true);
        $("#msg").addClass("text-danger");
        $('#msg').text("Weak");


    } else if (checkStrength($("#txtPass").val()) == "Too Short") {
        $("#signUp").attr("disabled", true);
        $("#msg").addClass("text-danger");
        $('#msg').text("Too Short");

    } else if (checkStrength($("#txtPass").val()) == "Good") {
        $("#signUp").attr("disabled", false);
        $("#msg").addClass("text-warning");
        $('#msg').text("Good");

    } else {
        $('#msg').text(checkStrength($("#txtPass").val()))
        $("#signUp").attr("disabled", true);
    }
});
$("#txtConfPass").blur("change", function () {
    requiredvalidate(this.id, $("#txtConfPass").val(), "", "Confirm password is  required !");
});

$("#txtPass").blur("change", function () {
    requiredvalidate(this.id, $("#txtPass").val(), "", "password is  required !");
});