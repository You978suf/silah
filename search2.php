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

//get the contact name from the form login
$loginEmail = $_POST["loginEmail"];

//SQL query to select submissions with loginEmail
$sql = "SELECT * FROM logedin WHERE email = '$loginEmail'";
$result = mysqli_query($conn, $sql);

//check if there are results
if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'>";
    $row = mysqli_fetch_assoc($result);
    mysqli_data_seek($result, 0);
    //print all details in table
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>Name:</td><td>{$row['name']}</td></tr>";
        echo "<tr><td>Email:</td><td>{$row['email']}</td></tr>";
        echo "<tr><td>Password:</td><td>{$row['passwords']}</td></tr>";
    }
    echo "</table>";
} else {
    //display message if no results found
    echo "You are not logged in with this account";
}
//close the database connection
mysqli_close($conn);
?>
