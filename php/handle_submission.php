<?php
//database connection setup
$host = 'localhost';  
$dbname = 'silah';    
$username = 'root';  
$password = '';      
//create a new connection
$conn = new mysqli($host, $username, $password, $dbname);
//check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//SQL statement to insert data into the 'submissions' table
$sql = "INSERT INTO submissions (name, email, phonenumber, helptype, message) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
//check if SQL statement is correct, thin add data into the 'submissions' table and display a message
if ($stmt) {
    $name = $_POST['Name'] ?? '';
    $email = $_POST['Email'] ?? '';
    $phoneNumber = $_POST['PhoneNumber'] ?? '';
    $helpType = $_POST['helpType'] ?? '';
    $message = $_POST['Message'] ?? '';

    $stmt->bind_param("sssss", $name, $email, $phoneNumber, $helpType, $message);
    $stmt->execute();

    echo "Thank you for contacting us!";
} else {
    //isplay the error message
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>