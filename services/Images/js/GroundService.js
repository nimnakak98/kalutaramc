/**
* @Author : KASUN
* 
*/
$(document).ready(function () {
    //var username = sessionStorage.getItem('UserName'); 
    $('#loading-image').show();
    $("#modelDiv").show();
    var locationMain = getClientID();
    var url = getGroundAPIURL() + 'MyrequestList';
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: url,
        data: {
            "LocationId": locationMain, 
            "UserName": "0712517962"
        },
        success: function (data) {
            var returnMsg = data.ReturnMsgInfo.ReturnValue;
            var list = data.BookingList;
            if (returnMsg == "OK") {
                if (list.length > 0) {
                    $("#modelDiv").show();
                    $(".loader").show();
                    var tbl = "<table class='table' width='100%'><thead><tr><th>Applicant Name</th><th>Request For</th><th>Allocated Start DateTime</th><th>Allocated End DateTime</th><th>PaymentDueDate</th><th>Total Service Fee</th></tr></thead><tbody>";
                    for (var i = 0; i < list.length; i++) {
                        tbl = tbl + "<tr><td>" + list[i]["NameOFApplicant"] + "</td><td>" + list[i]["RequestFor"] + "</td><td>" + list[i]["AllocatedStartDateTime"] + "</td><td>" + list[i]["AllocatedEndDateTime"] + "</td><td>" + list[i]["PaymentDueDate"] + "</td><td align = 'right'>" + list[i]["TotalServiceFee"] + "</td><td><a class='btn btn-info' href='PaymentDetails.html?id=" + list[i]["BookingID"] + "'>Payment</a></td></tr>"
                    }
                    tbl = tbl + "</tbody></table>";
                    $("#GroundRequestList").html(tbl);  
                }
            } else {
                $('#error').html('<div class="alert alert-danger">' + data.ReturnMsgInfo.ReturnMessage + '</div>');
            }
            $('#loading-image').hide();
            $("#modelDiv").hide();
        },
        error: function (error) {
            alert('error; ' + eval(error));
        }
    });
});

