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

        // Check if the form is submitted
        if (isset($_POST['fetchData'])) {
            // Initialize cURL session
            $curl = curl_init();

            // Set cURL options
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://hapi.fhir.org/baseR4/Patient/gtp101', // API endpoint URL
                CURLOPT_RETURNTRANSFER => true, // Return the response as a string instead of outputting it directly
                CURLOPT_SSL_VERIFYPEER => false, // Disable SSL verification (for demo purposes, consider enabling it in production)
            )
            );

            // Execute the request and store the response
            $response = curl_exec($curl);

            if ($response !== false) {
                $data = json_decode($response, true);

                if ($data !== null) {
                    // Update resourceType and ID
                    $resourceType = $data['resourceType'];
                    $id = $data['id'];
                    $name = $data['name'][0]['given'][0] . " " . $data['name'][0]['family'];
                    $birthday = $data['birthDate'];
                    $gender = $data['gender'];
                    $address = $data['address'][0]['line'][0] . ", " . $data['address'][0]['city'] . ", " . $data['address'][0]['state'] . ", " . $data['address'][0]['country'];
                    $phone = $data['telecom'][0]['value'];
                    echo "Resource Type: " . $data['resourceType'] . "<br>";
                    echo "ID: " . $data['id'] . "<br>";
                    echo "Danh xưng: " . $data['identifier'][0]['type']['coding'][0]['code'] . "<br>";
                    echo "Họ và tên: " . $data['name'][0]['given'][0] . " " . $data['name'][0]['family'] . "<br>";
                    echo "Ngày sinh: " . $data['birthDate'] . "<br>";
                    echo "Giới tính: " . $data['gender'] . "<br>";
                    echo "Địa chỉ: " . $data['address'][0]['line'][0] . ", " . $data['address'][0]['city'] . ", " . $data['address'][0]['state'] . ", " . $data['address'][0]['country'] . "<br>";
                    echo "Số điện thoại: " . $data['telecom'][0]['value'] . "<br>";
                } else {
                    echo "Error decoding JSON response";
                }
            } else {
                $error = curl_error($curl);
                echo "Error occurred: $error";
            }

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
    <title>Fetch Data from API</title>
</head>

<body>
    <div class="container">
        <h2>Fetch Data from API</h2>
        <form method="POST">
            <button type="submit" onclick="merge()" name="fetchData">Fetch Data</button>
            <br><br>
            <input type="text" name="resourceType" placeholder="This is resourceType"
                value="<?php echo htmlspecialchars($resourceType); ?>">
            <br><br>
            <input type="text" name="id" placeholder="This is ID" value="<?php echo htmlspecialchars($id); ?>">
            <br><br>
            <input type="text" name="fullname" placeholder="This is full name" value="<?php echo htmlspecialchars($name); ?>"> 
            <br><br>
            <input type="text" name="birthday" placeholder="This is birthday" value="<?php echo htmlspecialchars($birthday); ?>"> 
            <br><br>
            <input type="text" name="gender" placeholder="This is gender" value="<?php echo htmlspecialchars($gender); ?>"> 
            <br><br>
            <input type="text" name="address" placeholder="This is address" value="<?php echo htmlspecialchars($address); ?>"> 
            <br><br>
            <input type="text" name="numberphone" placeholder="This is number phone" value="<?php echo htmlspecialchars($phone); ?>">
        </form>
    </div>
</body>

</html>