<?php

define ('HMAC_SHA256', 'sha256');
//define ('SECRET_KEY', '<REPLACE WITH SECRET KEY>');
define ('SECRET_KEY', '4b9af8a8d96d437c9cfcd9da20808fdc1562e54f480b407eaf7c6afe21c512f2e7afa64219e0463f8d5aed81d415c0b175e7b7eee26f4d33ba5b9d9095205af2712599adbe0642f9aa4fe46e7ff3c4e33e9307a01c2d42528e4a5f8a8081868f77938c434a284414a0bee59efb80a5af2cae82e70a7f4495a323a2e05c7a5e61');
function sign ($params) {
  return signData(buildDataToSign($params), SECRET_KEY);
}

function signData($data, $secretKey) {
    return base64_encode(hash_hmac('sha256', $data, $secretKey, true));
}

function buildDataToSign($params) {
        $signedFieldNames = explode(",",$params["signed_field_names"]);
        foreach ($signedFieldNames as $field) {
           $dataToSign[] = $field . "=" . $params[$field];
        }
        return commaSeparate($dataToSign);
}

function commaSeparate ($dataToSign) {
    return implode(",",$dataToSign);
}

?>
