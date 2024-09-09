<?php
require_once 'config.php';

function sendWhatsAppMessage($to_number, $message) {
    $curl = curl_init();
    
    $postFields = json_encode([
        "to_number" => $to_number,
        "type" => "text",
        "message" => $message
    ]);

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.maytapi.com/api/" . PRODUCT_ID . "/" . PHONE_ID . "/sendMessage",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $postFields,
        CURLOPT_HTTPHEADER => array(
            "content-type: application/json",
            "x-maytapi-key: " . API_KEY
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return $response;
    }
}

// Example usage
$result = sendWhatsAppMessage("905301234567", "Hello World");
echo $result;