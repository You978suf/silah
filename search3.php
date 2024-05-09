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

//get the contact name from the form sign up
$signupEmail = $_POST["signupEmail"];

//SQL query to select submissions with signupEmail
$sql = "SELECT * FROM newaccount WHERE email = '$signupEmail'";
$result = mysqli_query($conn, $sql);

//check if there are results
if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'>";
    //print all details in table
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
    //display message if no results found
    echo "You don't have an account, please create a new one";
}

//close the database connection
mysqli_close($conn);
?>
