<?php
$sname = "localhost";
$user = "root";
$pass = "";
$dbname = "silah";

$conn = new mysqli($sname, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$loginEmail = $_POST["loginEmail"];

$sql = "SELECT * FROM logedin WHERE email = '$loginEmail'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'>";
    $row = mysqli_fetch_assoc($result);

    mysqli_data_seek($result, 0);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>Name:</td><td>{$row['name']}</td></tr>";
        echo "<tr><td>Email:</td><td>{$row['email']}</td></tr>";
        echo "<tr><td>Password:</td><td>{$row['passwords']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "You are not logged in with this account";
}

mysqli_close($conn);
?>
