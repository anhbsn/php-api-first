<script>
    function merge() {
        const apiUrl = 'http://210.2.89.199:8080/iFHIR2/baseR4/Patient/5656/_history/1?_format=json';
        const outputElement = document.getElementById('resource_id');
        console.log(outputElement);

        let username = 'client-test';
        let password = 'client@fhir123';

        let headers = new Headers();
        headers.append('Accept', 'application/json');
        let encoded = window.btoa('client-test:client@fhir123');
        let auth = 'Basic ' + encoded;
        headers.append('Authorization', auth);
        console.log(auth);

        let req = new Request(apiUrl, {
            method: 'GET',
            headers: headers,
            mode: 'no-cors',
            credentials: 'include'
        });


        fetch(req)
            .then(function (response) {
                return response.json();
                console.log(response.json());
            })
            .then(function (responseJson) {
                console.log(responseJson);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Auth iFHIR2</title>
</head>

<body>
    <div class="swapper">
        <h2>Fetch Data from FHIR API</h2>
        <button onclick="merge()">Send</button>
        <form method="post">
            <label for="patient_id">Enter Patient ID:</label>
            <input type="text" id="patient_id" name="patient_id">
        </form>
        <!-- Insert data into input -->
        <input id="resource_id" type="text" name="resourceType" placeholder="This is resourceType" value="">
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