<?php
header("Content-Type: application/json");
$PaystackCallbackResponse = file_get_contents('php://input');
$logFile = "paystackresponse.json";
$log = fopen($logFile, "a");
fwrite($log, $PaystackCallbackResponse);
fclose($log);