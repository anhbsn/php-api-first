<script>
    function merge() {
        const apiUrl = 'http://210.2.89.199/iFHIR/baseR4/Patient/13006?_format=json';
        const outputElement = document.getElementById('resource_id');

        let headers = new Headers();
        let encoded = window.btoa('admin:admin@fhir123');
        let auth = 'Basic ' + encoded;
        headers.append('Authorization', auth);
        console.log(auth);

        let req = new Request(apiUrl, {
            method: 'GET',
            headers: headers,
        });


        fetch(req)
            .then(function (response) {
                console.log(response);
                return response.json();
            })
            .then(function (responseJson) {
                console.log(responseJson);
                outputElement.value = responseJson.name[0].given[0];
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
    </div>
</body>

</html>