<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization, X-Requested-With");

$ch = curl_init();
$url = "https://hapi.fhir.org/baseR4/Patient/13";

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

if($e = curl_error($ch)){
    echo 'Error: '.curl_error($ch);
} else {
    $decoded = json_decode($result, true);
    print_r($decoded);
}

curl_close($ch);