/**
* @Author : KASUN
* 
*/
$(document).ready(function () {
    var username = sessionStorage.getItem('UserName'); 
    var url_string = window.location.href;
    var url = new URL(url_string);
    var id = url.searchParams.get("id");
    $("#modelDiv").show();
    var locationMain = getConfigData.getlocation();
    var url = getGroundAPIURL() + 'adminstatusoverview';
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: url,
        data: {
            "LocationID": locationMain,
            "ClientID": id
        },
        success: function (data) {
            var val = data.ReturnMsgInfo.ReturnValue;
            var info = data.ClientInfo;
            var payment = data.payinfo;
            var i = 0;
            if (val == "OK") {
                if (payment["IsValidForPayment"] == 'TRUE') {
                    $("#datahave").show();
                    $("#datanot").hide();
                    $("#id-error").hide()

                    $('#txtname').val(info['NameOFApplicant']);
                    $('#txtaddress').val(info['Address']);
                    $('#txtgroundname').val(payment['GroundName']);
                    $('#txtallocatedstartDdate').val(payment['AllocatedStartDateTime']);
                    $('#txtallocatedendDdate').val(payment['AllocatedEndDateTime']);
                    $('#txtservicefee').val(payment['ServiceFee']);
                    $('#txtdepositamount').val(payment['DepositAmount']);
                    $('#txtextrapayment').val(payment['ExtraPayment']);
                    $('#txttotalfee').val(payment['TotFee']);
                    $('#txtpaymentduedate').val(payment['PaymentDueDate']);

                    //payemt data get
                    var one = (payment['GroundName']);
                    var two = (payment['AllocatedStartDateTime']);
                    var three = (payment['AllocatedEndDateTime']);
                    var four = (payment['TotFee']);
                    var five = (payment['PaymentDueDate']);
                    var six = (payment['PaymentType']);

                    sessionStorage.setItem("ONE", one);
                    sessionStorage.setItem("TWO", two);
                    sessionStorage.setItem("THREE", three);
                    sessionStorage.setItem("FOUR", four);
                    sessionStorage.setItem("FIVE", five);
                    sessionStorage.setItem("SIX", six);
                    //end
                }
                else {
                    $("#datanot").show();
                    $("#datahave").hide();
                    $("#id-error").hide()
                }
            }
            else{
                $("#datahave").hide();
                $("#datanot").hide(); 
                window.location = "404NotFound.html";
            }
            $("#modelDiv").hide();
            $(".loader").hide();
        },
        error: function (error) {
            alert('error; ' + eval(error));
        }
    });
});

function payment() {
    var url_string = window.location.href;
    var url = new URL(url_string);
    var id = url.searchParams.get("id");
    window.location = "GroundPayment.html?id=" + id;
}

function BackList(){
    window.location = "GroundService.html";
}