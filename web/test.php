<?php

header('Content-Type: text/html; charset=utf-8');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$url = 'http://10.28.101.120/FWS/canonical-informing-service/message/send';
$user = 'asr_start_deb';
$password = 'test';

$base64 = base64_encode("$user:$password");

$jsonData = array(
    "external-id1" => "center",
    "external-id3" => "eip",
    "messages" => [
        "message-id" => "1",
        "template-id" => "513",
        "recipient" => "79510511300",
        "variables" => [
            "name" => "Тест"
        ]
    ]
);
$jsonDataEncoded = json_encode($jsonData);
$curl = curl_init($url);
$headers = [];

array_push($headers, 'Authorization1: Basic ' . $base64);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonDataEncoded);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($curl);
print_r($result);