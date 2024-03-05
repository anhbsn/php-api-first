<!-- Fetch Data form Databases (open_emr) PHPMyAdmin -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Data HTML</title>
</head>
<body>
    <div class="swapper">
        <h2>Fetch Data from Database and display HTML view</h2>
        <input type="text" id="nameInput" placeholder="enter your name">
        <button onclick="merge()">Merge</button>
        <?php 
            require '../inc/dbcon_emr.php';
            $query_wait = "SELECT * FROM patient_data";
            $query_resolve = mysqli_query($conn, $query_wait);
            while($row = mysqli_fetch_assoc($query_resolve)) {
                echo "<p>".$row['id']."</p>";
                echo "<p>".$row['fname']."</p>";
                echo "<p>".$row['lname']."</p>";
                echo "<p>".$row['DOB']."</p>";
            }
        ?>
    </div>
    <script>
        function merge() {
            // Get the value of the name from PHP loop
            <?php
                $query_wait = "SELECT * FROM patient_data";
                $query_resolve = mysqli_query($conn, $query_wait);
                $names = array();
                while($row = mysqli_fetch_assoc($query_resolve)) {
                    $names[] = $row['fname'] . " " . $row['lname'];
                }
            ?>
            var names = <?php echo json_encode($names); ?>;

            // Randomly choose a name from the array
            var randomIndex = Math.floor(Math.random() * names.length);
            var selectedName = names[randomIndex];
            
            // Set the input value to the selected name
            document.getElementById('nameInput').value = selectedName;
        }
    </script>
</body>
</html>