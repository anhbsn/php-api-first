<script>
    function merge() {
        <?php
        session_start(); // Start PHP session
        
        // Initialize variables for resourceType and ID
        $resourceType = '';
        $id = '';

        // Check if the form is submitted
        if (isset($_POST['fetchData'])) {
            // Initialize cURL session
            $curl = curl_init();

            // Set cURL options
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://hapi.fhir.org/baseR4/Patient/13', // API endpoint URL
                CURLOPT_RETURNTRANSFER => true, // Return the response as a string instead of outputting it directly
                CURLOPT_SSL_VERIFYPEER => false, // Disable SSL verification (for demo purposes, consider enabling it in production)
            )
            );

            // Execute the request and store the response
            $response = curl_exec($curl);

            // Check if the request was successful
            if ($response !== false) {
                // Decode the JSON response
                $data = json_decode($response, true);

                // Check if decoding was successful
                if ($data !== null) {
                    // Update resourceType and ID
                    $resourceType = $data['resourceType'];
                    $id = $data['id'];
                    echo "Resource Type: " . $data['resourceType'] . "<br>";
                    echo "ID: " . $data['id'] . "<br>";
                } else {
                    echo "Error decoding JSON response";
                }
            } else {
                // Handle errors
                $error = curl_error($curl);
                echo "Error occurred: $error";
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
        </form>
    </div>
</body>

</html>