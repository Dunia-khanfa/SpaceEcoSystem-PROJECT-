
<?php
$servername = "localhost";
$username = "duniakh_space_eco"; 
$password = "212610471@qq";
$dbname = "duniakh_spaceeco";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL Command to delete all data from the table
$sql = "TRUNCATE TABLE waste_log";

if ($conn->query($sql) === TRUE) {
    // Alert the user and send them back to the tracking page
    echo "<script>
            alert('Database cleared successfully.');
            window.location.href='tracking.php';
          </script>";
} else {
    echo "Error clearing database: " . $conn->error;
}

$conn->close();
?>