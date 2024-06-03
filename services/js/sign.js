/**
* @Author : Vindya
* 
*/
var userApiUrl = "https://user-api.nekfa.com/api/";
$(document).ready(function () {
    $("#bt2").hide();
});


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

function swchEmail() {
    $('#lblUserName').text("Mobile :");
    $("#email").attr("placeholder", "Enter your mobile");
    $('#hdType').val('tel');
    $('#tPhone').hide();
    $('#eMail').show();
}


function swchMobile() {
    $('#lblUserName').text("Email :");
    $("#email").attr("placeholder", "Enter your email");
    $('#hdType').val('mail');
    $('#tPhone').show();
    $('#eMail').hide();
}



$(document).ready(function () {
    // $('#login-type').modal('show');
    sessionStorage.setItem("UserName", "");
    var locationMain = getConfigData.getlocation();
    var baseUrl = getConfigData.geturl();
    $('#viewlocationMain').html(locationMain);
    $('#viewlocationUrl').html(baseUrl);
    var councilName = getCouncilName();
    $('#changeTopic').html(councilName);
    var serviceType = sessionStorage.getItem('ServiceType');
    $('#serviceTyp').html(serviceType);
    swchEmail();
});

$("#email").blur(function () {
    var username = $('#email').val();
    var datType = $('#hdType').val();
    if (username != '') {
        $('#email').parent().parent().addClass('has-success');
        $('#email').parent().parent().removeClass('has-error');
        $('#spanEmail').html("");
        $('#msgErr').html("");
        $('#msgErr').removeClass("alert alert-danger");
        $('#msgSuccess').removeClass("alert alert-success");
        //alert(datType);


    } else {
        if (datType == 'mail')
            $('#spanEmail').html("Please enter email !");
        else
            $('#spanEmail').html("Please enter mobile !");

        $('#email').parent().parent().removeClass('has-success');
        $('#email').parent().parent().addClass('has-error');
        $('#msgErr').html("");
        $('#msgErr').removeClass("alert alert-danger");
    }

});

$("#pwd").blur(function () {

    if (pwd = !'') {

        $('#pwd').parent().parent().addClass('has-success');
        $('#pwd').parent().parent().removeClass('has-error');
        $('#spanPwd').html("");
    } else {
        $('#spanPwd').html("Please enter password !");
        $('#pwd').parent().parent().removeClass('has-success');
        $('#pwd').parent().parent().addClass('has-error');
    }

});

$('#logUser').click(function () {
    var username = $('#email').val();
    var loc = $('#viewlocationMain').text();
    var datType = $('#hdType').val();
    var pwd = $('#pwd').val();
    var baseUrl = $('#viewlocationUrl').text();
    var serviceTyp = $('#serviceTyp').text();
    sessionStorage.setItem("ServiceType", serviceTyp);

    var pageType = getUrlVars()["type"];


    selectUrl = userApiUrl + 'login';
    if (username != '') {
        if (pwd != '') {
            $("#bt1").hide();
            $("#bt2").show();


            $('#pwd').parent().parent().addClass('has-success');
            $('#pwd').parent().parent().removeClass('has-error');
            $('#spanPwd').html("");
            $('#msgErr').html("");

            $('#msgErr').removeClass("alert alert-danger");
            $('#msgSuccess').removeClass("alert alert-success");

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: selectUrl,
                data: { userName: username, Type: datType, LocationId: loc, password: pwd },
                success: function (data) {
                    var val = data.arr.msg;
                    var description = data.arr.msgdesc;
                    var res = data.arr.res;
                    if (res == 1) {
                        
                        var userinfo = data.id;

                        sessionStorage.setItem("UserId", userinfo);

                        $('#msgSuccess').html(description + "!");
                        $('#msgSuccess').addClass("alert alert-success");
                        sessionStorage.setItem("mytoken", data.token);
                        sessionStorage.setItem("CustomerID", userinfo);
                        sessionStorage.setItem("UserName", username);
                        sessionStorage.setItem("DataType", datType);
                        

                        if (pageType == 'BUSINESSTAX') {
                            var id = getUrlVars()["id"];
                            if (id != null) {
                                window.location.href = "BT/business-tax-info.html?id=" + id + "";
                            }
                            else {
                                window.location.href = "BT/mylist.html?type=BUSINESSTAX";
                            }
                        }
                        else if (pageType == 'Rate') {
                            window.location.href = "Rate/mylist.html";
                        }
                        else if (pageType == 'TownHall') {
                            window.location.href = "townhall/index.html";
                        }
                        else if (pageType == 'GARBAGEFEE') {
                            var id = getUrlVars()["id"];
                            if (id != null) {
                                window.location.href = "Garbage/garbage-tax-info.html?id=" + id + "";
                            }
                            else {
                                window.location.href = "Garbage/mylist.html?type=GARBAGEFEE";
                            }
                        }
                        else if (pageType == 'Boutique') {
                            window.location.href = "boutique/mylist.html";
                        }
                        else if (pageType == 'GULLY') {
                            window.location.href = "gully/GullyService.html";
                        }
                        else if (pageType == 'STREETLINE') {
                            window.location.href = "streetline/instructions.html?type=STREETLINE";
                        }
                        else if (pageType == 'NONAQUI') {
                            window.location.href = "streetline/instructions.html?type=NONAQUI";
                        }
                        else if (pageType == 'INVOICE') {
                            window.location.href = "invoice/Service.html?type=INVOICE";
                        }
                        else if (pageType == 'SalesItem') {
                            window.location.href = "SalesItem/index.html?type=SalesItem";
                        }
                        else if (pageType == 'Ground') {
                            window.location.href = "Ground/GroundService.html";
                        }
                        else if (pageType == 'Library') {
                            window.location.href = " Library/LibraryService.html";
                        }
                        else if (pageType == 'Cemetery') {
                            window.location.href = "Cemetery/CemeteryService.html";
                        }
                        else if (pageType == 'Preschool') {
                            window.location.href = " preschool/preschoolapply.html";
                        }
                        else if (pageType == 'Crematoriums') {
                            window.location.href = " Crematoriums/CrematoriumService.html";
                        }
                        else if (pageType == 'Water') {
                            window.location.href = "Water/WaterService.html";
                        }
                        else if (pageType == 'PNM') {
                            window.location.href = "PNM/PNMService.html";
                        }
                        else if (pageType == 'TAXRELIEF') {
                            window.location.href = "TaxRelief/TaxReliefService.html?type=TAXRELIEF";
                        }
                        else if (pageType == 'NewPropertyNo') {
                            window.location.href = "NewPropertyNo/NewPropertyNoService.html?type=NewPropertyNo";
                        }
                        else if (pageType == 'WaterBill') {
                            window.location.href = "WaterBill/WaterBillList.html?type=WaterBill";
                        }
                        else if (pageType == 'Scenery') {
                            window.location.href = "Scenery/SceneryService.html?type=Scenery";
                        }
                        else if (pageType == 'FestivalHall') {
                            window.location.href = "FestivalHall/index.html";
                        }
                        else if (pageType == 'Procument') {
                            window.location.href = "Procument/instruction.html?type=Procument";
                        }
                        else if (pageType == 'Photoshoot') {
                            window.location.href = "Photoshoot/instruction.html?type=Photoshoot";
                        }
                        else if (pageType == 'WalkingLane') {
                            window.location.href = "WalkingLane/instruction.html?type=Photoshoot";
                        }
                        else if (pageType == 'RateCertificate') {
                            getUserEmail();
                            window.location.href = "RateCertificate/instruction.html?type=RateCertificate";
                        }
                        else if (pageType == 'FireCertificate') {
                            window.location.href = "FireCertificate/instruction.html?type=FireCertificate";                       
                        }


                    } else {

                        $('#msgErr').addClass("alert alert-danger");
                        $('#msgErr').html(description);
                        $("#bt1").show();
                        $("#bt2").hide();
                    }

                }

            });
        } else {
            $('#spanPwd').html("Please enter password !");
            $('#pwd').parent().parent().removeClass('has-success');
            $('#pwd').parent().parent().addClass('has-error');
            $('#msgErr').html("");
            $('#msgErr').removeClass("alert alert-danger");
        }
    }
    else {
        $('#email').parent().parent().addClass('has-success');
        $('#email').parent().parent().removeClass('has-error');
        $('#spanEmail').html("");
        $('#msgErr').removeClass("alert alert-danger");
        $('#msgSuccess').removeClass("alert alert-success");
    }

    if (username != '') {
        $('#email').parent().parent().addClass('has-success');
        $('#email').parent().parent().removeClass('has-error');
        $('#spanEmail').html("");
        $('#msgErr').removeClass("alert alert-danger");
        $('#msgSuccess').removeClass("alert alert-success");
    } else {
        if (datType == 'mail')
            $('#spanEmail').html("Please enter email !");
        else
            $('#spanEmail').html("Please enter mobile !");

        $('#email').parent().parent().removeClass('has-success');
        $('#email').parent().parent().addClass('has-error');
        $('#msgErr').html("");
        $('#msgErr').removeClass("alert alert-danger");
    }

});

function toHome() {
    window.location.href = "http://ps.jaela.ps.gov.lk";
}

function street() {
    var serviceType = 'Street-Line';
    sessionStorage.setItem("Service", serviceType);
}

function nonAqui() {
    var serviceType = 'Non-Acquisition';
    sessionStorage.setItem("Service", serviceType);
}

function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

function getUserEmail (){
    var username = $('#email').val();
    var loc = $('#viewlocationMain').text();
    var datType = $('#hdType').val();
    var pwd = $('#pwd').val();
    var url = getUserAPIURL() + 'viewuserdetails?userId='+username;
    var token = sessionStorage.getItem('mytoken');

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: url,
        headers: {
            "Authorization": 'Bearer '+token
        },
        data: {
            "LocationId":loc,
            "userName":username,
            "Type":datType,
            "password":pwd
        },
        success: function (data) {
            var val = data.ReturnMsgInfo.ReturnValue;
            var Uinfo = data.UserInfo;
            
            if (val == "OK") {
                var email = Uinfo['email'];
                sessionStorage.setItem("LoggedMail", email);
            }
            $("#modelDiv").hide();
             $(".loader").hide();
        },
        error: function (xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            alert(err.Message);
        }
    });
    
}

function getUserAPIURL() {
    return userApiUrl;
 }