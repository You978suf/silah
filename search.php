<?php
$sname = "localhost";
$user = "root";
$pass = "";
$dbname = "silah";


$conn = new mysqli($sname, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$contactName = $_POST["contactName"];


$sql = "SELECT * FROM submissions WHERE name = '$contactName'";

$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<table border='1'>";
        echo "<tr><td>Name:</td><td>{$row['name']}</td></tr>";
        echo "<tr><td>Email:</td><td>{$row['email']}</td></tr>";
        echo "<tr><td>Phone Number:</td><td>{$row['phonenumber']}</td></tr>";
        echo "<tr><td>Help Type:</td><td>{$row['helptype']}</td></tr>";
        echo "<tr><td>Message:</td><td>{$row['message']}</td></tr>";
        echo "</table>";
    }
} else {
    echo "There is no previous contact with this name";
}

mysqli_close($conn);
?>
