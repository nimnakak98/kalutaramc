$(document).ready(function () {
    var username = sessionStorage.getItem('UserName');
    $("#hdUserName").val(username);

    //hide button
    $("#Bhide").hide();
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
//show password
function showPassword() {
    var x = document.getElementById("txtCurPass");
    var y = document.getElementById("txtNewPass");
    var z = document.getElementById("txtConPass");

    if (x.type === "password" && y.type === "password" && z.type === "password") {
        x.type = "text";
        y.type = "text";
        z.type = "text";
    } else {
        x.type = "password";
        y.type = "password";
        z.type = "password";
    }
}
//check function
function SignUp() {

    var CurPass = requiredvalidate("txtCurPass", $("#txtCurPass").val(), "", "The current password filed is required !");
    var Newpass = requiredvalidate("txtNewPass", $("#txtNewPass").val(), "", "The new password filed is required !");
    var ConPass = requiredvalidate("txtConPass", $("#txtConPass").val(), "", "The confirm password filed is required !");

    var LocationID = getConfigData.getlocation();
    if ((CurPass == true) && (Newpass == true) && ConPass == true) {


        var CurPass = $('#txtCurPass').val();
        var Newpass = $('#txtNewPass').val();

        sessionStorage.setItem("CurPass", CurPass);
        sessionStorage.setItem("Newpass", Newpass);


        if ($("#txtNewPass").val() == $("#txtConPass").val()) {

            var userId = $("#hdUserName").val();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                headers: {
                    "Authorization": 'Bearer ' + sessionStorage.getItem('mytoken')
                },


                url: 'https://user-api.nekfa.com/api/changepassword?userId=' + $("#hdUserName").val(),

                data:
                {
                    UserName: $("#hdUserName").val(), LocationID: getConfigData.getlocation(), CurrentPassword: $("#txtCurPass").val(), NewPassword: $("#txtNewPass").val()
                },

                success: function (data) {
                    if (data.ReturnValue == "OK") {

                        alert(data.ReturnMessage);
                        window.location = "../index.html";
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
        else {

            $("#txtConPass").parent().addClass("has-error");
            var o = $("#txtConPass").parent();
            $("<span style='font-size:11px;color:red;'>Password did not match.</span>").appendTo(o);
            $("#txtConPass").focus();
        }

    };
}

//Check Strength of Password
function checkStrength(password) {
    $("#txtNewPass").parent().find('span').remove();
    $("#txtConPass").parent().removeClass("has-error");

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
        // $('#strengthMessage').removeClass()
        // $('#strengthMessage').addClass('Good')  
        return 'Good'
    } else {
        // $('#strengthMessage').removeClass()  
        // $('#strengthMessage').addClass('Strong')  
        return 'Strong'
    }
}

$("#txtNewPass").blur("change", function () {


    requiredvalidate(this.id, $("#txtNewPass").val(), "", checkStrength($("#txtNewPass").val()));

    if (checkStrength($("#txtNewPass").val()) == "Strong") {
        $("#signUp").attr("disabled", false);
        $('#msg').text("Strong");
        $('#txtNewPass').css({ 'border-color': 'green' });
        $("#msg").addClass("text-success");


    }
    else if (checkStrength($("#txtNewPass").val()) == "Weak") {
        $("#signUp").attr("disabled", true);
        $('#msg').text("Weak");
        $('#txtNewPass').css({ 'border-color': 'red' });
        $("#msg").addClass("text-success");


    }

    else if (checkStrength($("#txtNewPass").val()) == "Too Short") {
        $("#signUp").attr("disabled", true);
        $('#msg').text("Too Short");
        $('#txtNewPass').css({ 'border-color': 'red' });
        $("#msg").addClass("text-success");

    }

    else if (checkStrength($("#txtNewPass").val()) == "Good") {
        $("#signUp").attr("disabled", false);
        $('#msg').text("Good");
        $('#txtNewPass').css({ 'border-color': 'green' });
        $("#msg").addClass("text-success");


    } else {
        $('#msg').text(checkStrength($("#txtNewPass").val()))
        $("#signUp").attr("disabled", true);

    }

});
$("#txtCurPass").blur("change", function () {
    requiredvalidate(this.id, $("#txtCurPass").val(), "", "The current password filed is required !");
});

$("#txtNewPass").blur("change", function () {
    requiredvalidate(this.id, $("#txtNewPass").val(), "", "The new password filed is required !");
});
$("#txtConPass").blur("change", function () {
    requiredvalidate(this.id, $("#txtConPass").val(), "", "The confirm password filed is required !");

});

