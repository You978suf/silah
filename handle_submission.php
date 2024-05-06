<?php
// Database connection setup
$host = 'localhost';  // or your host
$dbname = 'silah';    // your database name
$username = 'root';   // your database username
$password = '';       // your database password

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, $options);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['Name'] ?? '';
    $email = $_POST['Email'] ?? '';
    $phoneNumber = $_POST['PhoneNumber'] ?? '';
    $helpType = $_POST['helpType'] ?? '';
    $message = $_POST['Message'] ?? '';

    // Validate input
    if (empty($name) || empty($email) || empty($phoneNumber) || empty($helpType) || empty($message)) {
        echo "All fields are required!";
    } else {
        // Prepare SQL statement to insert data into the 'submissions' table
        $sql = "INSERT INTO submissions (name, email, phonenumber, helptype, message) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters and execute SQL statement
        try {
            $stmt->execute([$name, $email, $phoneNumber, $helpType, $message]);
            echo "Thank you for contacting us!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
