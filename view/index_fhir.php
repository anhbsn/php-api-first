<?php
    if(isset($_POST['patient_id'])) {
        // Get the patient ID entered by the user
        $patient_id = $_POST['patient_id'];
        
        // Initialize cURL session
        $curl = curl_init();

        // Set cURL options
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://210.2.89.199:8080/iFHIR/baseR4/Patient/{$patient_id}?_format=json",
            CURLOPT_RETURNTRANSFER => true, // Return the response as a string instead of outputting it directly
            CURLOPT_SSL_VERIFYPEER => false, // Disable SSL verification (for demo purposes, consider enabling it in production)
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC, // Set authentication method to Basic
            CURLOPT_USERPWD => "admin:admin@fhir123", // Set username and password
        ));

        // Execute the request and store the response
        $response = curl_exec($curl);

        // Check if the request was successful
        if ($response === false) {
            $error = curl_error($curl);
            echo "Error occurred: $error";
        } else {
            // Decode the JSON response
            $data = json_decode($response, true);
            
            if ($data !== null) {
                echo "Resource Type: " . $data['resourceType'] . "<br>";
                echo "ID: " . $data['id'] . "<br>";
                echo "Meta: " . $data['meta']['lastUpdated'] . "<br>";
                echo "Danh xưng: " . $data['identifier'][0]['type']['coding'][0]['code'] . "<br>";
                echo "Họ và tên: " . $data['name'][0]['given'][0] . " " . $data['name'][0]['family'] . "<br>";
                echo "Ngày sinh: " . $data['birthDate'] . "<br>";
                echo "Giới tính: " . $data['gender'] . "<br>";
                echo "Địa chỉ: " . $data['address'][0]['line'][0] . ", " . $data['address'][0]['city'] . ", " . $data['address'][0]['state'] . ", " . $data['address'][0]['country'] . "<br>";
                echo "Số điện thoại: " . $data['telecom'][0]['value'] . "<br>";
            } else {
                echo "Error decoding JSON response";
            }
        }

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

