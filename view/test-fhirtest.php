<script>
    function merge() {
        const patientId = document.getElementById('patient_id').value;
        const apiUrl = `http://210.2.89.199/iFHIRtest/baseR4/Patient/${patientId}`;
        // const apiUrl = `http://210.2.89.199/iFHIR2/baseR4/Patient/${patientId}?_format=json`;
        const outputElement = document.getElementById('resource_id');
        const errorMessage = document.getElementById('error_message');

        fetch(apiUrl, {
            method: 'GET',
            // mode: 'no-cors',
        })
            .then(function (response) {
                console.log(response);
                return response.json();
            })
            .then(function (responseJson) {
                if (!responseJson || !responseJson.name || !responseJson.name[0] || !responseJson.name[0].given || !responseJson.name[0].given[0]) {
                    errorMessage.style.display = 'block';
                    outputElement.value = '';
                } else {
                    errorMessage.style.display = 'none';
                    console.log(responseJson);
                    outputElement.value = responseJson.name[0].given[0];
                }
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
    <title>Show Data HTML</title>
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
        <p id="error_message" style="color: red; display: none;">Không tồn tại patient_Id này</p>
    </div>
</body>

</html>