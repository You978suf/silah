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

// Retrieve consultant selection from the form
$consultantId = $_POST["consultantM"];

// Prepare SQL query based on selected consultant
$sql = "";
if ($consultantId == 0) {
    $sql = "select * from consultants where name = 'Sajed Mohammed'";
} else if ($consultantId == 1) {
    $sql = "select * from consultants where name = 'Salam Suleiman'";
} else if ($consultantId == 2) {
    $sql = "select * from consultants where name = 'Stephen Curry'";
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
        echo "<tr><td>Specialization:</td><td>{$row['Specialization']}</td></tr>";
        echo "<tr><td>CV:</td><td>{$row['cv']}</td></tr>";
        echo "<tr><td>Email:</td><td>{$row['email']}</td></tr>";
        echo "</table>";
    }
} else {
    echo "No results found";
}

mysqli_close($conn);
?>
