<?php
// ... connection credentials ...
$servername = "localhost";
$username = "duniakh_space_eco"; 
$password = "212610471@qq";
$dbname = "duniakh_spaceeco";
$conn = new mysqli($servername, $username, $password, $dbname);

// Get data
$waste_date = $_POST['waste_date'];
$waste_type = $_POST['waste_type'];
$weight_kg  = $_POST['weight_kg'];
$notes      = $_POST['notes'];

$stmt = $conn->prepare("INSERT INTO waste_log (waste_date, waste_type, weight_kg, notes) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssds", $waste_date, $waste_type, $weight_kg, $notes);

if ($stmt->execute()) {
    // Correct Path: Same folder (Includes)
    echo "<script>
            alert('Data Saved Successfully!'); 
            window.location.href='tracking.php'; 
          </script>";
} else { echo "Error: " . $stmt->error; }
$stmt->close(); $conn->close();
?>