/**
* @Author : KASUN
* 
*/
$(document).ready(function () {
    //var username = sessionStorage.getItem('UserName'); 
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
            var info = data.payinfo;
            if (val == "OK") {
                $("#TFee").html(info["TotFee"]);
                $("#BFee").html(info["BankFee"]);
                $("#totAmt").html(info["TotalServiceFee"]);

                $(".loader").hide();
                $("#modelDiv").hide();
            }
        },
        error: function (error) {
            alert('error; ' + eval(error));
        }
    });
});

function PBack() {
    var url_string = window.location.href;
    var url = new URL(url_string);
    var id = url.searchParams.get("id");
    window.location = "PaymentDetails.html?id=" + id;
}

$('#confirm').click(function () {
  Swal.fire({
      title: 'Are you sure?',
      text: "Continue this process !",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#5cb85c',
      cancelButtonColor: '#d9534f',
      confirmButtonText: 'Yes, do it!'
  }).then(function (result) {
      if (result.value) {
          var ClientID = getConfigData.getlocation();
          var sendUrl = getGroundAPIURL() + 'DoPayment';
          var url_string = window.location.href;
          var url = new URL(url_string);
          var id = url.searchParams.get("id");
          var amt = $("#TFee").html();
          $.ajax({
              type: "post",
              url: sendUrl,
              data: { ClientID: ClientID, RequestID: id },
              ajaxasync: true,
              success: function (data) {
                  console.log(data);

                  var order_id = data.Bank_Info['OrderID'];
                  var Amount = data.Bank_Info['PurchaseAmt'];
                  var siteUrl = getCouncilUrl();
                  console.log(siteUrl);

                  var $form = $("<form/>").attr("id", "data_form")
                      .attr("action", getGroundBankPortalUrl())
                      .attr("method", "post");
                  $("body").append($form);

                  AddParameterWithID($form, "orderID", order_id);
                  AddParameterWithID($form, "amount", amt);
                  AddParameterWithID($form, "type", "Gully");

                  //Send the Form.
                  $form[0].submit();
              },
              error: function (data) {
                  Swal.fire("Error", data.responseText, 'error');
              }
          });
      }
  });
});

function AddParameterWithID(form, name, value) {
    var $input = $("<input />").attr("type", "hidden")
        .attr("name", name).attr("id", name)
        .attr("value", value);
    form.append($input);
}