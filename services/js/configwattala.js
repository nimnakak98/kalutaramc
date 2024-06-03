/**
* @Author : Vindya
* 
*/
var locId="SmFlbGFQUy8x";//WattalaUC - V2F0dGFsYVVDLzE= | GampahaPS -  R2FtcGFoYVBTLzE= / PanaduraUC -UGFuYWR1cmFVQy8x / KesbewaUC - S2VzYmV3YVVDLzE=

var baseurl = "http://localhost:39094//api/";
var bsUrl = "http://regular-tax-api.nekfa.com";
var hostedUrl="http://localhost/online-services/";

// var siteUrl = "http://kesbewa.uc.gov.lk/online-services/payment-result.php";
var siteUrl = "http://wattala.uc.gov.lk/business-tax/payment-result.php";
var domain="http://wattala.uc.gov.lk";


var apiKey="12345"; //beruwala-uc API key-  6gNooeJS5135IHO2G60vn2hnhKyNsF0U3zcwGTPB kesbewa-uc API key- qSDtIbgvCr91iFYpxFKnHah6APn5Dy7t3pQ7JunC

var council = "වත්තල නගර සභාව";
var councilPay = "වත්තල නගර සභාවේ";

function getCouncilName(){
    return council;
}

function getHostedURL(){
    return hostedUrl;
}

function getDomain(){
    return domain;
}

function getPayCouncilName(){
    return councilPay;
}

function getCouncilUrl(){
    return siteUrl;
}

function getapiKey(){
    return apiKey;
}

var getConfigData ={
    locationId:locId,
    baseUrl:baseurl,
    bsBaseUrl:bsUrl,
    getlocation: function (){
        return this.locationId;
    },
    geturl: function (){
        return this.baseUrl;
    },
    get_bs_url: function (){
        return this.bsBaseUrl;
    }  
};



