/**
* @Author : ME
*/

$(document).ready(function () {
    $('#loading-image').hide();
    $("#modelDiv").hide();
    var ClientID = "VGVzdFVDLzE=";
    var sendUrl = getGroundAPIURL() + 'GetGroundNameList';

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: sendUrl,
        data: { LocationID: ClientID },
        success: function (data) {
            var val = data.returnMsgInfo.ReturnValue;
            var description = data.returnMsgInfo.ReturnMessage;
            var list = data.listGroundName;
            if (val == "OK") {
                if (list.length > 0) {
                    for (var i = 0; i < list.length; i++) {
                        $("#listGround").append($('<option></option>').val(list[i]["ID"]).html(list[i]["NameOfGround"]));                      
                    }
                    $(".loader").hide();
                }
                else { }
                $(".loader").hide();
                $("#modelDiv").hide();
            }
            else {
                $("#error").html('<h4>' + description + '</h4>');
            }
        }
    });
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

function validateStartingDate(startDate, val, valEmpty, errormsg) {
    $("#" + startDate).parent().find('span').remove();
    var today = new Date();
    var year = today.getFullYear();
    var month = today.getMonth()+1;
    var date = today.getDate();
    if(month<10){
        month = '0'+month;
    }
    if(date<10){
        date = '0'+date;
    }
    var hour = today.getHours();
    var minute = today.getMinutes();
    if(hour <10){
        hour = '0'+hour;
    }
    if(minute < 10){
        minute = '0'+minute;
    }
    var date = year+'-'+month+'-'+date;
    var time = hour + ":" + minute ;
    var currentDate = date+'T'+time;

    if(val == valEmpty ){
        $("#" + startDate).parent().addClass("has-error");
        var o = $("#"+ obj).parent();
        $("<span style='font-size:11px;color:red;'>" + errormsg + "</span>").appendTo(o);
        return false;
    }else if(val < currentDate){
        $("#" + startDate).parent().removeClass("has-error");
        var o = $("#" + startDate).parent();
        $("<span style='font-size:11px;color:red;'>starting date should not be in the past</span>").appendTo(o);
        return false;
    }else{
        $("#" + startDate).parent().removeClass("has-error");
            return true;
    }
}

function validatetime(startDate, endDate,  val1, val2, valEmpty, errormsg) {
    $("#" + startDate).parent().find('span').remove();
    $("#" + endDate).parent().find('span').remove();
    if(val1 == valEmpty || val2 == valEmpty){
        $("#" + endDate).parent().addClass("has-error");
        var o = $("#"+ val2).parent();
        $("<span style='font-size:11px;color:red;'>" + errormsg + "</span>").appendTo(o);
        return false;
    }else if(val1>= val2){
        $("#" + endDate).parent().removeClass("has-error");
        var o = $("#" + endDate).parent();
        $("<span style='font-size:11px;color:red;'>ending date should be highet than starting date</span>").appendTo(o);
        return false;
    }else{
        $("#" + endDate).parent().removeClass("has-error");
            return true;
    }
}

function mobilenumbervalidation(obj, val, valEmpty, errormsg) {
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
        } else {
            $("#" + obj).parent().removeClass("has-error");
            return true;
        }
    }
}

$("#emailAddress").blur("change", function () {
    var a = $("#emailAddress").val().length;
    if (a > 0) {
        emailvalidation(this.id, $("#emailAddress").val());
    }
    else {}
});

$("#listGround").blur('change', function () {
    requiredvalidate("listGround", $("#listGround").val(), "", " Graound name is  required !");
});
$("#personOrInstituteName").blur('change', function () {
    requiredvalidate("personOrInstituteName", $("#personOrInstituteName").val(), "", " Person's or Institute name is  required !");
});
$("#startingDateTime").blur('change', function () {
    validateStartingDate("startingDateTime", $("#startingDateTime").val(), "", " Starting date should be valid!");
});
// $("#endingDateTime").blur('change', function () {
//     requiredvalidate("endingDateTime", $("#endingDateTime").val(), "", " Ending date and time are  required !");
// });
$("#endingDateTime").blur('change', function () {
    validatetime("startingDateTime","endingDateTime",  $("#startingDateTime").val(), $("#endingDateTime").val(), "", " Ending date is invalid !");
});
$("#NameOfTheApplicant").blur('change', function () {
    requiredvalidate("NameOfTheApplicant", $("#NameOfTheApplicant").val(), "", " Applicant's name is  required !");
});
$("#applicatsAddress").blur('change', function () {
    requiredvalidate("applicatsAddress", $("#applicatsAddress").val(), "", " Address field is  required !");
});
$("#phoenNumber").blur('change', function () {
    mobilenumbervalidation("phoenNumber", $("#phoenNumber").val(), "", "Mobile Number  is required !");
});
$("#NIC").blur('change', function () {
    requiredvalidate("NIC", $("#NIC").val(), "", " NIC number is  required !");
});
$("#reasonForReservation").blur('change', function () {
    requiredvalidate("reasonForReservation", $("#reasonForReservation").val(), "", " Reason for reservation is  required !");
});


function booking() {
    var groundName = requiredvalidate("listGround", $("#listGround").val(), "", " Ground name is required !");
    var nameOfThePersonOrInstitute = requiredvalidate("personOrInstituteName", $("#personOrInstituteName").val(), "", "  Person's name is required !");
    var startingDateTime = validateStartingDate("startingDateTime", $("#startingDateTime").val(), "", " Starting date and time are  required !");
    var endingDateTime = validatetime("startingDateTime","endingDateTime",  $("#startingDateTime").val(), $("#endingDateTime").val(), "", " Ending date is invalid !");
    var applicantName = requiredvalidate("NameOfTheApplicant", $("#NameOfTheApplicant").val(), "", " Applicant's name is  required !");
    var address = requiredvalidate("applicatsAddress", $("#applicatsAddress").val(), "", " Address field is  required !");
    var telephoneNumber = mobilenumbervalidation("phoenNumber", $("#phoenNumber").val(), "", "Mobile Number  is required !");
    var NIC = requiredvalidate("NIC", $("#NIC").val(), "", " NIC number is  required !");
    var reasonFonReservation = requiredvalidate("reasonForReservation", $("#reasonForReservation").val(), "", " Reason for reservation is  required !");

    if ((groundName == true) && (nameOfThePersonOrInstitute == true) && (startingDateTime == true) && (endingDateTime == true) && (applicantName == true) &&
        (address == true) && (telephoneNumber == true) && (NIC == true) && (reasonFonReservation == true)) {
        var locationMain = getClientID;
        var url = getGroundAPIURL() + "requestground";
        var UId = sessionStorage.getItem('UserId');

        Swal.fire({
            title: 'Are you sure?',
            text: "Continue this request !",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5cb85c',
            cancelButtonColor: '#d9534f',
            confirmButtonText: 'Yes, do it!'
        }).then(function (result) {
            if (result.value) {
                $('#loading-image').show();
                $("#modelDiv").show()               
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: url,
                    data: {
                        "LocationID": locationMain,
                        "RequestFor": $("#personOrInstituteName").val(),
                        "NameOFApplicant": $("#NameOfTheApplicant").val(),
                        "Address": $("#applicatsAddress").val(),
                        "Mobile": $("#phoenNumber").val(),
                        "Email": $("#emailAddress").val(),
                        "PurposeOfHire": $("#reasonForReservation").val(),
                        "NIC": $("#NIC").val(),
                        "GroundID":$("#listGround").val(), 
                        "PayAmount":"20500", 
                        "PaymentID":"4562",
                        "CreatedUser":UId,
                        "Comments":"Yes",                             
                        "RequestStartDate":$("#startingDateTime").val(), 
                        "RequestEndDate":$("#endingDateTime").val(),                  
                    },
                    success: function (data) {
                        var returnMsg = data.ReturnValue;
                        if (returnMsg == 'OK') {
                            $('#error').html('<div class="alert alert-success">' + data.ReturnMessage + '</div>');
                            Reset();
                            // window.location = "Success.html";
                            window.localStorage = "booking.html";
                        } else {
                            $('#error').html('<div class="alert alert-danger">' + data.ReturnMessage + '</div>');
                        }
                        $('#loading-image').hide();
                        $("#modelDiv").hide();
                    },
                    error: function (error) {
                        alert('error: ' + eval(error));
                    }
                });
            }
        });
        return false;
    };
}
function Reset() {
    window.location.reload();
}