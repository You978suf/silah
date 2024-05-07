<?php
$sname = "localhost";
$user = "root";
$pass = "";
$dbname = "silah";

// Create connection
$conn = new mysqli($sname, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Using prepared statements to avoid SQL injection
$stmt = $conn->prepare("DELETE FROM submissions WHERE name = ?");
$stmt->bind_param("s", $contactName);

$contactName = $_POST["contactName"];

// Execute the query
if ($stmt->execute()) {
    // Check if any row was actually deleted
    if ($stmt->affected_rows > 0) {
        echo "Deleted successfully";
    } else {
        echo "There is no previous contact with this name";
    }
} else {
    echo "Error deleting record: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
