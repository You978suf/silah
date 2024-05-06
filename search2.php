<?php
$sname = "localhost";
$user = "root";
$pass = "";
$dbname = "silahinfo";

// Create connection
$conn = new mysqli($sname, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve team member selection from the form
$teamMemberId = $_POST["teamMember"];

// Prepare SQL query based on selected team member
$sql = "";
if ($teamMemberId == 0) {
    $sql = "select * from teammembers where name = 'Yousuf alshaaili'";
} else if ($teamMemberId == 1) {
    $sql = "select * from teammembers where name = 'Ibrahim Altoubi'";
} else if ($teamMemberId == 2) {
    $sql = "select * from teammembers where name = 'Qusay Alshueili'";
} else {
    echo "Invalid selection";
}


// Execute SQL query
$result = mysqli_query($conn, $sql);

// Check if any rows are returned
if (mysqli_num_rows($result) > 0) {
    // Loop through each row and display the information
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<table border='1'>";
        echo "<tr><td>Name:</td><td>{$row['name']}</td></tr>";
        echo "<tr><td>Education:</td><td>{$row['education']}</td></tr>";
        echo "<tr><td>Skills:</td><td>{$row['skills']}</td></tr>";
        echo "<tr><td>Information:</td><td>{$row['informations']}</td></tr>";
        echo "</table>";
    }
} else {
    echo "No results found";
}

mysqli_close($conn);
?>
