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

//get the contact name from the form submission
$contactName = $_POST["contactName"];

//SQL query to select submissions with contactName
$sql = "SELECT * FROM submissions WHERE name = '$contactName'";
$result = mysqli_query($conn, $sql);

//check if there are results
if (mysqli_num_rows($result) > 0) {
    //print all details in table
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
    //display message if no results found
    echo "There is no previous contact with this name";
}

//close the database connection
mysqli_close($conn);
?>
