<?php
//database connection setup
$sname = "localhost";
$user = "root";
$pass = "";
$dbname = "silah";

//create connection
$conn = new mysqli($sname, $user, $pass, $dbname);

//check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//SQL statement to delete data from the 'submissions' table
$stmt = $conn->prepare("DELETE FROM submissions WHERE name = ?");
$stmt->bind_param("s", $contactName);

$contactName = $_POST["contactName"];

//check if SQL statement is correct, thin delete data from the 'submissions' table and display a message
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
//close the connection
$stmt->close();
$conn->close();
?>
