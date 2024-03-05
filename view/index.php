<!-- Fetch Data form FHIR (201.2.89.199), find patient by patient_id and display into input (merge in input) -->

<script>
    function merge() {
        <?php
        session_start(); // Start PHP session
        
        // Initialize variables for resourceType and ID
        $resourceType = '';
        $id = '';
        $name = '';
        $birthday = '';
        $gender = '';
        $address = '';
        $phone = '';

        if (isset($_POST['patient_id'])) {
            // Get the patient ID entered by the user
            $patient_id = $_POST['patient_id'];

            // Initialize cURL session
            $curl = curl_init();

            // Set cURL options
            curl_setopt_array(
                $curl,
                array(
                    // CURLOPT_URL => "{$_ENV['CURLOPT_URL']}/Patient/{$patient_id}?_format=json", // API endpoint URL with variable
                    CURLOPT_URL => "http://210.2.89.199:8080/iFHIR/baseR4/Patient/{$patient_id}?_format=json", // API endpoint URL with variable
                    CURLOPT_RETURNTRANSFER => true, // Return the response as a string instead of outputting it directly
                    CURLOPT_SSL_VERIFYPEER => false, // Disable SSL verification (for demo purposes, consider enabling it in production)
                    CURLOPT_HTTPAUTH => CURLAUTH_BASIC, // Set authentication method to Basic
                    CURLOPT_USERPWD => "admin:admin@fhir123", // Set username and password
                )
            );

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
                    // Update resourceType and ID
                    $resourceType = $data['resourceType'];
                    $id = $data['id'];
                    $name = $data['name'][0]['given'][0] . " " . $data['name'][0]['family'];
                    $birthday = $data['birthDate'];
                    $gender = $data['gender'];
                    $address = $data['address'][0]['line'][0] . ", " . $data['address'][0]['city'] . ", " . $data['address'][0]['state'] . ", " . $data['address'][0]['country'];
                    $phone = $data['telecom'][0]['value'];
                    // Display the resourceType, id, and lastUpdated from the API response
                    echo "Resource Type: " . $data['resourceType'] . "<br>";
                    echo "ID: " . $data['id'] . "<br>";
                    echo "Last Updated: " . $data['meta']['lastUpdated'] . "<br>";
                    "<br>";
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

            // Close cURL session
            curl_close($curl);
        }
        ?>
    }
</script>

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
        <!-- Insert data into input -->
        <input type="text" name="resourceType" placeholder="This is resourceType"
            value="<?php echo htmlspecialchars($resourceType); ?>">
        <br><br>
        <input type="text" name="id" placeholder="This is ID" value="<?php echo htmlspecialchars($id); ?>">
        <br><br>
        <input type="text" name="fullname" placeholder="This is full name"
            value="<?php echo htmlspecialchars($name); ?>">
        <br><br>
        <input type="text" name="birthday" placeholder="This is birthday"
            value="<?php echo htmlspecialchars($birthday); ?>">
        <br><br>
        <input type="text" name="gender" placeholder="This is gender" value="<?php echo htmlspecialchars($gender); ?>">
        <br><br>
        <input type="text" name="address" placeholder="This is address"
            value="<?php echo htmlspecialchars($address); ?>">
        <br><br>
        <input type="text" name="numberphone" placeholder="This is number phone"
            value="<?php echo htmlspecialchars($phone); ?>">
    </div>
</body>

</html>