// /**
// * @Author : Gihantha
// * 
// */
// $(document).ready(function(){ 
//     var ClientID = getConfigData.getlocation();   
//     var sendUrl = getTownHallAPIURL()+'gettownhalllist';
//     $.ajax({
//         type:'POST',
//         dataType:'json',
//         url:sendUrl,
//         data:{
//             LocationID : ClientID
//         },       
//         success: function(data){
//             var val = data.returnMsgInfo.ReturnValue;
//             var description = data.returnMsgInfo.ReturnMessage; 
//             var list = data.listTownHall; 
//             if(val=="OK"){  
//                 if(list.length>0){  
//                      for (var i=0; i < list.length; i++) { 
//                          $("#listHall").append($('<option></option>').val(list[i]["ID"]).html(list[i]["NameOfHall"]));            
//                      } 
//                 }
//                 else{
                    
//                 }
//                 $("#modelDiv").hide();
//             } 
//             else{
//                 $("#error").html('<h4>'+description+'</h4>');
//             } 
//         }  
//     });
// });

// function requiredvalidate(obj,val,valEmpty,errormsg)
// {
//     $("#"+obj).parent().find('span').remove();
//     if(val==valEmpty){
//         $("#"+obj).parent().addClass("has-error");
//         var o=$("#"+obj).parent();
//         $("<span style='font-size:11px;color:red;'>"+errormsg+"</span>").appendTo(o);
//         return false;
//     }else{
//         $("#"+obj).parent().removeClass("has-error");
//         return true;
//     }  
// }

// function mobilenumbervalidation(obj,val,valEmpty,errormsg) 
// {
//   $("#"+obj).parent().find('span').remove();
//   if(val==valEmpty){
//         $("#"+obj).parent().addClass("has-error");
//         var o=$("#"+obj).parent();
//         $("<span style='font-size:11px;color:red;'>"+errormsg+"</span>").appendTo(o);
//         return false;
//   }else{
//     var pattern= /^[0]*(\d{9})*\s*$/;
//     if(!pattern.test(val))
//     {
//       $("#"+obj).parent().addClass("has-error");
//       var o=$("#"+obj).parent();
//       $("<span style='font-size:11px;color:red;'>Enter Valid mobile number ex.07XXXXXXXX</span>").appendTo(o);
//       return false;
//     }else{
//       $("#"+obj).parent().removeClass("has-error");
//       return true;
//     }
//   }
// }

// function emailvalidation(obj,val,valEmpty,errormsg) 
// {
//   $("#"+obj).parent().find('span').remove();
//   if(val==valEmpty){
//         $("#"+obj).parent().addClass("has-error");
//         var o=$("#"+obj).parent();
//         $("<span style='font-size:11px;color:red;'>"+errormsg+"</span>").appendTo(o);
//         return false;
//   }else{
//     var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
//     if(!pattern.test(val))
//     {
//       $("#"+obj).parent().addClass("has-error");
//       var o=$("#"+obj).parent();
//       $("<span style='font-size:11px;color:red;'>Enter a valid email address</span>").appendTo(o);
//       return false;
//     }else{
//       $("#"+obj).parent().removeClass("has-error");
//       return true;
//     }
//   }
// }

// $("#listHall").blur('change', function () {
//      requiredvalidate("listHall",$("#listHall").val(),""," Hall name is  required !");
// });

// $("#listTime").blur('change', function () {
//     requiredvalidate("listTime",$("#listTime").val(),"","Time is  required !");
// });

// $("#listTown").blur('change', function () {
//      requiredvalidate("listTown",$("#listTown").val(),"","area is required !");
// });

// $("#listType").blur('change', function () {
//      requiredvalidate("listType",$("#listType").val(),"","Function is  required !");
// });

// $("#name_of_the_person_insitute").blur('change', function () {
//      requiredvalidate("name_of_the_person_insitute",$("#name_of_the_person_insitute").val(),"","Name of the person insitute is required !");
// });

// $("#account_number").blur('change', function () {
//      requiredvalidate("account_number",$("#account_number").val(),"","Account Number  is required !");
// });

// $("#bank_name").blur('change', function () {
//     requiredvalidate("bank_name",$("#bank_name").val(),"","Bank Name  is required !");
// });

// $("#bank_branch").blur('change', function () {
//     requiredvalidate("bank_branch",$("#bank_branch").val(),"","Bank Branch  is required !");
// });

// $("#TextArea").blur('change', function () {
//      requiredvalidate("TextArea",$("#TextArea").val(),"","Address is required !");
// });

// $("#name_of_the_application").blur('change', function () {
//      requiredvalidate("name_of_the_application",$("#name_of_the_application").val(),"","Name of the applicant is required !");
// });

//  $("#mobile_number").blur('change', function () {
//     mobilenumbervalidation("mobile_number",$("#mobile_number").val(),"","Mobile Number  is required !");
//  });

//  $("#email").blur('change', function () {
//     emailvalidation("email",$("#email").val(),"","Email  is required !");
//  });

// $("#nic").blur('change', function () {
//      requiredvalidate("nic",$("#nic").val(),"","NIC  is required !");
// });

// $("#tax_no_and_road").blur('change', function () {
//     requiredvalidate("tax_no_and_road",$("#tax_no_and_road").val(),"","Tax no and road  is required !");
// });

// $("#TextAreareason").blur('change', function () {
//      requiredvalidate("TextAreareason",$("#TextAreareason").val(),"","Reason is required !");
// });

// function booking(){
//     var hallname= requiredvalidate("listHall",$("#listHall").val(),""," Hall name is required !");
//     var time= requiredvalidate("listTime",$("#listTime").val(),"","Time  is required !");
//     var area= requiredvalidate("listTown",$("#listTown").val(),"","Area is required !");
//     var functiontype= requiredvalidate("listType",$("#listType").val(),"","Function is required !");
//     var personName= requiredvalidate("name_of_the_person_insitute",$("#name_of_the_person_insitute").val(),"","Name of the person insitute is required !");
//     var accountNumber= requiredvalidate("account_number",$("#account_number").val(),"","Account Number  is required !");
//     var bankName= requiredvalidate("bank_name",$("#bank_name").val(),"","Bank Name  is required !");
//     var bankBranch= requiredvalidate("bank_branch",$("#bank_branch").val(),"","Bank Branch  is required !");
//     var address= requiredvalidate("TextArea",$("#TextArea").val(),"","Address is required !");
//     var applicantName= requiredvalidate("name_of_the_application",$("#name_of_the_application").val(),"","Name of the applicant is required !");
//     var mobNum= mobilenumbervalidation("mobile_number",$("#mobile_number").val(),"","Mobile Number  is required !");
//     var email= emailvalidation("email",$("#email").val(),"","Email  is required !");
//     var nic= requiredvalidate("nic",$("#nic").val(),"","NIC  is required !");
//     var taxNo= requiredvalidate("tax_no_and_road",$("#tax_no_and_road").val(),"","Tax no and road  is required !");
//     var reason= requiredvalidate("TextAreareason",$("#TextAreareason").val(),"","Reason is required !");

//     if((hallname == true) && (time == true) && (area == true) && (functiontype == true) && (personName == true) &&
//         (accountNumber == true) && (bankName == true) && (bankBranch == true) && (address == true) && (applicantName == true)
//         && (mobNum == true) && (email == true) && (nic == true) && (taxNo == true) && (reason == true)){

//             var locationMain =  getConfigData.getlocation();
//             var url=getTownHallAPIURL()+'createadminbooking';
//             $.ajax({
//                 type:'POST',
//                 dataType:'json',
//                 url:url,
//                 data:{
//                     "ClientID" : locationMain,
//                     "RequestFor": $("#name_of_the_person_insitute").val(),
//                     "NameOFApplicant":$("#name_of_the_application").val(),
//                     "Address":$("#TextArea").val(),
//                     "Mobile":$("#mobile_number").val(),
//                     "Email":$("#email").val(),
//                     "CreatedUser":'56',
//                     "Comments": $("#TextAreareason").val(),
//                     "AccountNumber":$("#account_number").val(),
//                     "BankName":$("#bank_name").val(),
//                     "BankBranch":$("#bank_branch").val(),
//                     "NIC":$("#nic").val(),
//                     "PropertyDesc":$("#tax_no_and_road").val(),
//                     "PurposeOfHire":"",
//                     "HallID":$("#listHall").val(),
//                     "BookingDate":$("#txtDate").val(),
//                     "BookingTime":$('#listTime').val(),
//                     "FunctionID":$("#listType").val()
//                 },
//                 success: function(data){
//                     var returnMsg=data.returnMsgInfo.ReturnValue;
//                     if(returnMsg=='OK')
//                     {
//                         $("#name_of_the_person_insitute").val('');
//                         $("#name_of_the_application").val('');
//                         $("#TextArea").val('');
//                         $("#mobile_number").val('');
//                         $("#email").val('');
//                         $("#TextAreareason").val('');
//                         $("#account_number").val('');
//                         $("#bank_name").val('');
//                         $("#bank_branch").val('');
//                         $("#nic").val('');
//                         $("#tax_no_and_road").val('');
//                         $("#listHall").val('');
//                         $("#txtDate").val('');
//                         $("#listTime").val('');
//                         $("#listType").val('');
//                         //clear all controls, show success message
//                         $('#error').html('<div class="alert alert-success">'+data.returnMsgInfo.ReturnMessage+'</div>');  
//                     }else{
//                          $('#error').html('<div class="alert alert-danger">'+data.returnMsgInfo.ReturnMessage+'</div>');
//                        // $('#error').html('<div class="alert alert-danger">test</div>');
//                     }
//                 },
//                 error: function (error) {
//                     alert('error; ' + eval(error));
//                 }
//             });
//             return false;
//         }
// }