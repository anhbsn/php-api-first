<?php
if(isset($_POST['patient_id'])) {
    // Get the patient ID entered by the user
    $patient_id = $_POST['patient_id'];
    
    // Initialize cURL session
    $curl = curl_init();

    // Set cURL options
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://hapi.fhir.org/baseR4/Patient/$patient_id", // API endpoint URL with variable
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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Data HTML</title>
</head>
<body>
    <div class="swapper">
        <h2>Fetch Data from FHIR API</h2>
        <form method="post">
            <label for="patient_id">Enter Patient ID:</label>
            <input type="text" id="patient_id" name="patient_id" required>
            <button type="submit">Send</button>
        </form>
    </div>
</body>
</html>
