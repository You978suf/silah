<?php
$sname = "localhost";
$user = "root";
$pass = "";
$dbname = "silah";

$conn = new mysqli($sname, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$signupEmail = $_POST["signupEmail"];

$sql = "SELECT * FROM newaccount WHERE email = '$signupEmail'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>Name:</td><td>{$row['name']}</td></tr>";
        echo "<tr><td>Email:</td><td>{$row['email']}</td></tr>";
        echo "<tr><td>Password:</td><td>{$row['passwords']}</td></tr>";
        echo "<tr><td>Phone Number:</td><td>{$row['phonenumber']}</td></tr>";
        echo "<tr><td>Age:</td><td>{$row['age']}</td></tr>";
        echo "<tr><td>Gender:</td><td>{$row['gender']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "You don't have an account, please create a new one";
}

mysqli_close($conn);
?>
