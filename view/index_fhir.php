<?php

// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json");
// header("Access-Control-Allow-Methods: GET");
// header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization, X-Requested-With");

// $ch = curl_init();
// $url = "https://hapi.fhir.org/baseR4/Patient/13";

// curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// $result = curl_exec($ch);

// if($e = curl_error($ch)){
//     echo 'Error: '.curl_error($ch);
// } else {
//     $decoded = json_decode($result, true);
//     print_r($decoded);
// }

// curl_close($ch);

<?php
// Initialize cURL session
$curl = curl_init();

// Set cURL options
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://hapi.fhir.org/baseR4/Patient/13', // API endpoint URL
    CURLOPT_RETURNTRANSFER => true, // Return the response as a string instead of outputting it directly
    CURLOPT_SSL_VERIFYPEER => false, // Disable SSL verification (for demo purposes, consider enabling it in production)
));

// Execute the request and store the response
$response = curl_exec($curl);

// Check if the request was successful
if ($response === false) {
    // Handle errors
    $error = curl_error($curl);
    echo "Error occurred: $error";
} else {
    // Decode the JSON response
    $data = json_decode($response, true);
    
    // Check if decoding was successful
    if ($data !== null) {
        // Display the resourceType and id from the API response
        echo "Resource Type: " . $data['resourceType'] . "<br>";
        echo "ID: " . $data['id'] . "<br>";
    } else {
        echo "Error decoding JSON response";
    }
}

// Close cURL session
curl_close($curl);
?>
