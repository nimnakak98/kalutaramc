/**
* @Author : Vindya
* 
*/
var locId = "Ka7Fkskjohs14smmsTwyNp0m28x";
//var locId = "TmVnb21ib01DLzE=";
//var baseurl = "https://z3fxze7eah.execute-api.ap-south-1.amazonaws.com/dev/streetlineapi/";
// var baseurl = "http://localhost:3000/";
var baseurl = "http://localhost:39094//api/";
var bsUrl = "http://regular-tax-api.nekfa.com";
var hostedUrl = "https://kalutara.uc.gov.lk/";

// var siteUrl = "http://kesbewa.uc.gov.lk/online-services/payment-result.php";
var siteUrl = "http://lgsweb.nekfa.com/business-tax/payment-result.php";
// var domain="https://wattala.uc.gov.lk";
var domain = "https://kalutara.uc.gov.lk/";
// var domain = "http://localhost/online-services-web";    

var apiKey = "12345"; //beruwala-uc API key-  6gNooeJS5135IHO2G60vn2hnhKyNsF0U3zcwGTPB kesbewa-uc API key- qSDtIbgvCr91iFYpxFKnHah6APn5Dy7t3pQ7JunC


var contactNumber="+94 (342) 222275";
var contactEmail="uckalutara22@gmail.com";
var council = "කළුතර නගර සභාව";
var councilEng = "Kalutara Urban Council";
var councilPay = "කළුතර නගර සභාවේ";
function getContactNumber(){
    return contactNumber;
}
function getContactEmail(){
    return contactEmail;
}
function getCouncilName() {
    return council;
}
function getCouncilEnglishName() {
    return councilEng;
}

function getHostedURL() {
    return hostedUrl;
}

function getDomain() {
    return domain;
}

function getPayCouncilName() {
    return councilPay;
}

function getCouncilUrl() {
    return siteUrl;
}

function getapiKey() {
    return apiKey;
}

var getConfigData = {
    locationId: locId,
    baseUrl: baseurl,
    bsBaseUrl: bsUrl,
    getlocation: function () {
        return this.locationId;
    },
    geturl: function () {
        return this.baseUrl;
    },
    get_bs_url: function () {
        return this.bsBaseUrl;
    },
    getClientID: function () {
        return this.locationId;
    }
    
};


function toHome() {
    window.location.href = domain;
}


