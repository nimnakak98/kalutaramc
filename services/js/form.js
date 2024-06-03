/**
**@Author :  Jeewantha
**/ 

$(document).ready(function () {
    $('#loading-image').hide();
    $("#modelDiv").hide();
     //MobileNo get
  var UsernName = sessionStorage.getItem('UserName');
  document.getElementById("txtPhoenNumber").value = UsernName;
  //end
    var ClientID = getConfigData.getlocation();
    var sendUrl = getLibraryAPIURL() + 'getlibrarynamelist';

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: sendUrl,
        data: { LocationID: ClientID },
        success: function (data) {
            var val = data.returnMsgInfo.ReturnValue;
            var description = data.returnMsgInfo.ReturnMessage;
            var list = data.listLibraryName;
            if (val == "OK") {
                if (list.length > 0) {
                    for (var i = 0; i < list.length; i++) {
                        $("#txtListOfLibraries").append($('<option></option>').val(list[i]["ID"]).html(list[i]["LibraryName"]));                      
                    }
                    $(".loader").hide();
                }
                else { }
                $(".loader").hide();
                $("#modelDiv").hide();
            }
            else {
                $("#error").html('<h5>' + "please add library for select" + '</h5>');
            }
        }
    });
});
$("#firstround").show();
$("#secondround").hide();
$("#thirdround").hide();
$("#fourthround").hide();


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

//only number [mobile no]
$('.phone').keypress(function(e) {
    var arr = [];
    var kk = e.which;
  
    for (i = 48; i < 58; i++)
        arr.push(i);
  
    if (!(arr.indexOf(kk)>=0))
        e.preventDefault();
  });
  //end

function mobilenumbervalidation(obj, val, valEmpty, errormsg) {
    $("#" + obj).parent().find('span').remove();
    if (val == valEmpty) {
    //   $("#" + obj).parent().addClass("has-error");
    //   var o = $("#" + obj).parent();
    //   $("<span style='font-size:11px;color:red;'>" + errormsg + "</span>").appendTo(o);
      return true;
    } else {
      var pattern = /^\(?([0]{1})\)?[-. ]?([0-9]{2})[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
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

//phone number Check textbox type length
$("#txtadPhoenNumber").blur("change", function () {
    var a = $("#txtadPhoenNumber").val().length;
    if(a > 0){
      mobilenumbervalidation (this.id, $("#txtadPhoenNumber").val());
    }
    else{
      // return false();
      $("#" + "txtadPhoenNumber").parent().removeClass("has-error");
      $("#" + "txtadPhoenNumber").parent().find('span').remove();
    }
  });

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

function NicValidation(obj, val, valEmpty, errormsg){
    $("#" + obj).parent().find('span').remove();
    if (val == valEmpty) {
        $("#" + obj).parent().addClass("has-error");
        var o = $("#" + obj).parent();
        $("<span style='font-size:11px;color:red;'>" + errormsg + "</span>").appendTo(o);
        return false;
    } else {
        var pattern = /^([0-9]{9}[x|X|v|V]|[0-9]{12})$/;
        if (!pattern.test(val)) {
            $("#" + obj).parent().addClass("has-error");
            var o = $("#" + obj).parent();
            $("<span style='font-size:11px;color:red;'>Enter Valid NIC Number </span>").appendTo(o);
            return false;
        } else {
            $("#" + obj).parent().removeClass("has-error");
            return true;
        }
    }
}



function validateDateOfBirth(obj, val, valEmpty, errormsg) {
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
 
  var date = year+'-'+month+'-'+date;

  if(val == valEmpty ){
      // $("#" + startDate).parent().addClass("has-error");
      // var o = $("#"+ startDate).parent();
      // $("<span style='font-size:11px;color:red;'>" + errormsg + "</span>").appendTo(o);
      // return false;
  }else if(val > date){
      $("#" + startDate).parent().removeClass("has-error");
      var o = $("#" + startDate).parent();
      $("<span style='font-size:11px;color:red;'>Date of Birth should be in past</span>").appendTo(o);
      return false;
  }else{
      $("#" + startDate).parent().removeClass("has-error");
          return true;
  }
  }

//age validation
function agevalidation(obj, val, valEmpty, errormsg) {
    $("#" + obj).parent().find('span').remove();
  if (val == valEmpty) {
    $("#" + obj).parent().addClass("has-error");
    var o = $("#" + obj).parent();
    $("<span style='font-size:11px;color:red;'>" + errormsg + "</span>").appendTo(o);
    return false;
  } else {
    var pattern = /^\S[0-9]{0,3}$/;
    if (!pattern.test(val))  {
      $("#" + obj).parent().addClass("has-error");
      var o = $("#" + obj).parent();
      $("<span style='font-size:11px;color:red;'>please enter valid age</span>").appendTo(o);     
      return false;
    } 
    else {
      $("#" + obj).parent().removeClass("has-error");      
      return true;
    }
  }
  }

// FORM VALIDATION WHILE FILLING 
$("#txtNameOfApplicant").blur('change', function () {
    requiredvalidate("txtNameOfApplicant", $("#txtNameOfApplicant").val(), "", " Applicant name is  required !");
});
$("#txtAddressOfApplicant").blur('change', function () {
    requiredvalidate("txtAddressOfApplicant", $("#txtAddressOfApplicant").val(), "", " Applicant's address is  required !");
});
$("#txtNIC").blur('change', function () {
    NicValidation("txtNIC", $("#txtNIC").val(), "", " NIC number is  required !");
});
$("#fileResidentialCertificate").blur('change', function () {
    requiredvalidate("fileResidentialCertificate", $("#fileResidentialCertificate").val(), "", " Attachment  is  required !");
});
$("#fileBailiff").blur('change', function () {
    requiredvalidate("fileBailiff", $("#fileBailiff").val(), "", " Attachment is  required !");
});
$("#txtPhoenNumber").blur('change', function () {
    mobilenumbervalidation("txtPhoenNumber", $("#txtPhoenNumber").val(), "", "Contact Number  is required !");
});
// $("#txtadPhoenNumber").blur('change', function () {
//     mobilenumbervalidation("txtadPhoenNumber", $("#txtadPhoenNumber").val(), "", "Contact Number  is required !");
// });
$("#result").blur('change', function () {
    agevalidation("result", $("#result").val(), "", "Age is required !");
});
$("#txtEmailAddress").blur("change", function () {
    var a = $("#txtEmailAddress").val().length;
    if (a > 0) {
        emailvalidation(this.id, $("#txtEmailAddress").val(), "", "Email need to be valid");
    }
    else {}
});
$("#DOB").blur('change', function () {
    requiredvalidate("DOB", $("#DOB").val(), "", " Birtdate is required !");
})
$("#txtListOfLibraries").blur('change', function () {
    requiredvalidate("txtListOfLibraries", $("#txtListOfLibraries").val(), "", " Selecet a Library !");
});
$("#txtOccupation").blur('change', function () {
    requiredvalidate("txtOccupation", $("#txtOccupation").val(), "", " Occupation is  required !");
});
// $("#txtDateOfBirth").blur('change', function () {
//     requiredvalidate("txtDateOfBirth", $("#txtDateOfBirth").val(), "", " Birth Date is  required !");
// });
$("#txtinitials").blur('change', function () {
    requiredvalidate("txtinitials", $("#txtinitials").val(), "", " Name with initials is required !");
});
$("#txtgrade").blur('change', function () {
    requiredvalidate("txtgrade", $("#txtgrade").val(), "", " Grade is required !");
});
$("#txtNameOfSchool").blur('change', function () {
    requiredvalidate("txtNameOfSchool", $("#txtNameOfSchool").val(), "", " School Name is required !");
});
$("#txtAddressOfSchool").blur('change', function () {
    requiredvalidate("txtAddressOfSchool", $("#txtAddressOfSchool").val(), "", " School Address is required !");
});

function checkBoxButtonFuntion(termCheckBox) {
    if (termCheckBox.checked) {
        $("#ifStudent").show();
    } else {
        $("#ifStudent").hide();
    }
}

$(document).ready(function(){
    $('#txtListOfdivision').on('change', function() {
      if ( this.value == '0')
      {
        $("#secondround").show();
        $("#fourthround").show();
        $("#thirdround").hide();
        $("#lblGrade").text("ශ්‍රේණිය | Grade");
        $("#lblSchoolName").text("පාසලේ නම | School name");
        $("#lblSchoolAddress").text("පාසලේ ලිපිනය | School Address");
        // grade =  requiredvalidate("txtgrade", $("#txtgrade").val(), "", " Assement No is  required !");
        

 
      }
      else  if ( this.value == '1')
      {
        $("#secondround").show();
        $("#thirdround").show();
        $("#fourthround").show();
        $("#lblGrade").text("වරිපනම් අංකය | Assessment No");
        $("#lblSchoolName").text("සේවා ස්ථානයේ නම | Name of the workplace");
        $("#lblSchoolAddress").text("සේවා ස්ථානයේ ලිපිනය | Address of the workplace");
        

      }
       else  
      {
        $("#secondround").show();
      }
    });
});

//age calculation
function agecalculate() {

    // var day = document.getElementById("DOB").value;
    // var dob = new Date(day);
    // if(day==null || day=='') {
        
    //   return false; 
    // }
    
    //  else {
       
    // //calculate month difference from current date in time
    // var month_diff = Date.now() - dob.getTime();
    
    // //convert the calculated difference in date format
    // var age_dt = new Date(month_diff); 
    
    // //extract year from date    
    // var year = age_dt.getUTCFullYear();
    
    // //now calculate the age of the user
    // var age = Math.abs(year - 1970);

     
    // //display the calculated age
    //  document.getElementById("result").value =  
    //           + age + " years ";
    // $("#result").parent().find('span').remove(); 
    // $("#result").parent().removeClass("has-error");
    // }

    var userinput = document.getElementById("DOB").value;  
    var dob = new Date(userinput);  
       
    if(userinput==null || userinput==''){  
          
      return false;   
    }   
        
    else {   
    var mdate = userinput.toString();  
    var dobYear = parseInt(mdate.substring(0,4), 10);  
    var dobMonth = parseInt(mdate.substring(5,7), 10);  
    var dobDate = parseInt(mdate.substring(8,10), 10);  
       
    var today = new Date();   
    var birthday = new Date(dobYear, dobMonth-1, dobDate);  
      
    var diffInMillisecond = today.valueOf() - birthday.valueOf();        
    var year_age = Math.floor(diffInMillisecond / 31536000000);  
    var day_age = Math.floor((diffInMillisecond % 31536000000) / 86400000);  
       
     
          
     var month_age = Math.floor(day_age/30);          
     day_ageday_age = day_age % 30;  
          
     var tMnt= (month_age + (year_age*12));  
     var tDays =(tMnt*30) + day_age;  
     if (dob>today) {  
        document.getElementById("result").value= ("Invalid age input - Please try again!");
        
        var c1=$("#result").val();
      agevalidation("result", "result",  "", ""); 
      }  
      else {  
        document.getElementById("result").value = year_age ;
        $("#result").parent().find('span').remove(); 
      $("#result").parent().removeClass("has-error");  
      }  
   }  
    
             
      }

function Submit(){



//grade validation change
var grade = $("#txtListOfdivision").val();
if(grade==1){
grade =  requiredvalidate("txtgrade", $("#txtgrade").val(), "", " Assement No is  required !");

}
else{
grade =  requiredvalidate("txtgrade", $("#txtgrade").val(), "", " Grade is  required !");
    
}

//schoolname validation change
var schoolname = $("#txtListOfdivision").val();
if(schoolname==1){
schoolname =  requiredvalidate("txtNameOfSchool", $("#txtNameOfSchool").val(), "", " workplace Name is  required !");
}

else{  
schoolname =  requiredvalidate("txtNameOfSchool", $("#txtNameOfSchool").val(), "", " School Name is  required !");  
}

//schooladdress validation change
var schooladdress = $("#txtListOfdivision").val();
if(schooladdress==1){ 
schooladdress =  requiredvalidate("txtAddressOfSchool", $("#txtAddressOfSchool").val(), "", " workplace Address is  required !");

}
else{
   
schooladdress =  requiredvalidate("txtAddressOfSchool", $("#txtAddressOfSchool").val(), "", " School Address is  required !");
    
}

    $("#modelDiv").show();  
  
//  var fileUploadone = requiredvalidate("fileResidentialCertificate", $("#fileResidentialCertificate").val(), "", "Attachment is required!");  
//  var fileUploadtwo = requiredvalidate("fileBailiff", $("#fileBailiff").val(), "", "Attachment is required!");    
    var NameOfApplicant =  requiredvalidate("txtNameOfApplicant", $("#txtNameOfApplicant").val(), "", " Applicant name is  required !");
    var initials =  requiredvalidate("txtinitials", $("#txtinitials").val(), "", " Name with initials is  required !");
    var address = requiredvalidate("txtAddressOfApplicant", $("#txtAddressOfApplicant").val(), "", " Applicant's address is  required !");
    var NIC =  NicValidation("txtNIC", $("#txtNIC").val(), "", " NIC number is  required !");
    var Tele = mobilenumbervalidation("txtPhoenNumber", $("#txtPhoenNumber").val(), "", "Contact Number  is required !");
    var Telephone = mobilenumbervalidation("txtadPhoenNumber", $("#txtadPhoenNumber").val(), "", "Contact Number  is required !");
    var library =  requiredvalidate("txtListOfLibraries", $("#txtListOfLibraries").val(), "", " Selecet a Library !");
    var division =  requiredvalidate("txtListOfdivision", $("#txtListOfdivision").val(), "", " Selecet a Division !");
    var email =  emailvalidation("txtEmailAddress", $("#txtEmailAddress").val(), "", " Email is  required !");
    var birthdate =  requiredvalidate("DOB", $("#DOB").val(), "", " Birth Date is  required !");
    var age =  agevalidation("result", $("#result").val(), "", " Age is  required !");
    //var schoolname =  requiredvalidate("txtNameOfSchool", $("#txtNameOfSchool").val(), "", " School Name is  required !");
    //var schooladdress =  requiredvalidate("txtAddressOfSchool", $("#txtAddressOfSchool").val(), "", " School Address is  required !");
    //var grade =  requiredvalidate("txtgrade", $("#txtgrade").val(), "", " Grade is  required !");
    // var Occupation =  requiredvalidate("txtOccupation", $("#txtOccupation").val(), "", " Occupation is  required !");

 
  $('#error').html('');
  $("#modelDiv").hide();
 
 //here check the all fields are valid or not, if valid , call to ajax  
 
    if ((birthdate== true)&&(email==true)&& ( Telephone == true)&&(grade== true)&&(initials== true)&&(NIC==true)&&(schooladdress== true)&&(schoolname== true)&&(age== true)&&(division== true)&&(NameOfApplicant==true) && (address == true)&&(Tele == true)&&(library== true) ) {
      var locationMain = getConfigData.getlocation();
      var url = getLibraryAPIURL() + "requestlibrary";
        
        var userName = sessionStorage.getItem('UserName');
        
       
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
                $("#modelDiv").show();
                  
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: url,
                    headers: {
                      "Authorization": 'Bearer '+sessionStorage.getItem('mytoken')
                    },
                    data: {

                       
                      "LocationID":locationMain,
                      "LibraryID":$("#txtListOfLibraries").val(),
                      "NameOFApplicant":$("#txtNameOfApplicant").val(),
                      "NameWithInitials":$("#txtinitials").val(),
                      "PropertyNo":$("#txtgrade").val(),
                      "Division":$("#txtListOfdivision").val(),
                      "Age":$("#result").val(),
                      "ContactNoHome":$("#txtadPhoenNumber").val(),
                      "Address":$("#txtAddressOfApplicant").val(),
                      "Mobile":$("#txtPhoenNumber").val(),
                      "Email":$("#txtEmailAddress").val(),
                      "BirthDatee":$('#DOB').val(),
                      "Occupationn":$('#txtOccupation').val(),
                      "NIC":$("#txtNIC").val(),
                      "SchoolName":$("#txtNameOfSchool").val(),
                      "SchoolAddress":$("#txtAddressOfSchool").val(),
                      "CreatedUser":userName,
                      "FileType1":fileExtensionOne,
                      "FileType2":fileExtensionTwo,
                     
                                         
                    },
                    success: function (data) {
                        var returnMsg = data.ReturnValue;
                        var returnId = data.ReturnID;     
                        if (returnMsg == 'OK') {
                            $('#error').html('<div class="alert alert-success">' + data.ReturnMessage + '</div>'); 
                            window.location.href  = "Success.html";   
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
          
                 }

                 else if
                 ((birthdate== true)&&(email==true)&& ( Telephone == true)&&(grade== true)&&(initials== true)&&(schooladdress== true)&&(schoolname== true)&&(age== true)&&(division== true)&&(NameOfApplicant==true) && (address == true)&&(Tele == true)&&(library== true) ) 
                 {
                    var locationMain = getConfigData.getlocation();
                    var url = getLibraryAPIURL() + "requestlibrary";
                      
                      var userName = sessionStorage.getItem('UserName');

                      let adult = document.getElementById("txtListOfdivision").value;
                      
                      if(adult == 1 && (NIC !=  true )){
                        return false;
                       }
                       
                      
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
                              $("#modelDiv").show();
                                
                              $.ajax({
                                  type: 'POST',
                                  dataType: 'json',
                                  url: url,
                                  headers: {
                                    "Authorization": 'Bearer '+sessionStorage.getItem('mytoken')
                                  },
                                  data: {
              
                                     
                                    "LocationID":locationMain,
                                    "LibraryID":$("#txtListOfLibraries").val(),
                                    "NameOFApplicant":$("#txtNameOfApplicant").val(),
                                    "NameWithInitials":$("#txtinitials").val(),
                                    "PropertyNo":$("#txtgrade").val(),
                                    "Division":$("#txtListOfdivision").val(),
                                    "Age":$("#result").val(),
                                    "ContactNoHome":$("#txtadPhoenNumber").val(),
                                    "Address":$("#txtAddressOfApplicant").val(),
                                    "Mobile":$("#txtPhoenNumber").val(),
                                    "Email":$("#txtEmailAddress").val(),
                                    "BirthDatee":$('#DOB').val(),
                                    "Occupationn":$('#txtOccupation').val(),
                                    "NIC":$("#txtNIC").val(),
                                    "SchoolName":$("#txtNameOfSchool").val(),
                                    "SchoolAddress":$("#txtAddressOfSchool").val(),
                                    "CreatedUser":userName,
                                    "FileType1":fileExtensionOne,
                                    "FileType2":fileExtensionTwo,
                                   
                                                       
                                  },
                                  success: function (data) {
                                      var returnMsg = data.ReturnValue;
                                      var returnId = data.ReturnID;     
                                      if (returnMsg == 'OK') {
                                          $('#error').html('<div class="alert alert-success">' + data.ReturnMessage + '</div>'); 
                                          window.location.href  = "Success.html";   
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
                                }
                        return false;                
              
}

function Reset(){
    window.location.reload();
}

var fileExtensionOne = "";
var fileExtensionTwo = "";

//Convert base64[save]
function encodeImageFileAsURL_One(element) {

    //Get the file input element by its id 
    var fileInput = document.getElementById('fileResidentialCertificate');
    //Get the file name
    var fileName = fileInput.files[0].name;
    //Get the file Extension 
    fileExtensionOne = fileName.split('.').pop();

    /*     */
    var file = element.files[0];
    var reader = new FileReader();
    reader.onloadend = function() {
      console.log('RESULT', reader.result)
      var outputConvert = reader.result;
      var imgsrc = "<img src = "+outputConvert+">";
      var BaseCon = document.getElementById("converttext").value = imgsrc;
      localStorage.BCon = BaseCon;
    }
    reader.readAsDataURL(file);
}

//Convert base64[save]
function encodeImageFileAsURL_Two(element) {

    //Get the file input element by its id 
    var fileInput = document.getElementById('fileBailiff');
    //Get the file name
    var fileName = fileInput.files[0].name;
    //Get the file Extension 
    fileExtensionTwo = fileName.split('.').pop();     
     

    var file = element.files[0];
    var reader = new FileReader();
    reader.onloadend = function() {
      console.log('RESULT', reader.result)
      var outputConvert = reader.result;
      var imgsrc = "<img src = "+outputConvert+">";
      var BaseCon = document.getElementById("converttext").value = imgsrc;
      localStorage.BCon = BaseCon;
    }
    reader.readAsDataURL(file);
}
function PList() {
    window.location = "LibraryService.html";
  }

