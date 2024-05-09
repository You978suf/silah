<?php

//start the session to handle login status
session_start();
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

//get the form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['pws'];

//SQL statement to insert to logedin table
$sql = "INSERT INTO logedin (name, email, passwords) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $password);

// check if it added successfully and display appropriate message 
if ($stmt->execute()) {
    echo "You logged in successfully";
} else {

    echo "Error: " . $sql . "<br>" . $conn->error;
}



//close the connection
$stmt->close();
$conn->close();
?>