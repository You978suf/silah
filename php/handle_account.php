<?php
// Database connection setup
$host = 'localhost';
$dbname = 'silah';
$username = 'root';
$password = '';

// Create a new connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//SQL statement to insert data into the 'newaccount' table
$sql = "INSERT INTO newaccount (name, email, passwords, phonenumber, age, gender) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

//check if SQL statement is correct, thin add data into the 'newaccount' table and display a message
if ($stmt->execute([
    $_POST['name'],
    $_POST['email'],
    $_POST['pws'],
    $_POST['number'] ?? '',
    $_POST['age'],
    $_POST['gender']
])) {
    echo "Account created successfully. Thank you for registering!";
} else {
    echo "Error: " . $conn->error;
}

//close the connection
$stmt->close();
$conn->close();
?>