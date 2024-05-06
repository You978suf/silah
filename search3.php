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

// Retrieve investor selection from the form
$investorId = $_POST["Investors"];

// Prepare SQL query based on selected investor
$sql = "";
if ($investorId == 0) {
    $sql = "select * from investors where name = 'Warren Buffett'";
} else if ($investorId == 1) {
    $sql = "select * from investors where name = 'Richard Branson'";
} else if ($investorId == 2) {
    $sql = "select * from investors where name = 'Mark Cuban'";
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
        echo "<tr><td>Full Information:</td><td>{$row['fullinfo']}</td></tr>";
        echo "<tr><td>Email:</td><td>{$row['email']}</td></tr>";
        echo "</table>";
    }
} else {
    echo "No results found";
}

mysqli_close($conn);
?>
