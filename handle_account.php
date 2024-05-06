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
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['pws'] ?? '';
    $phoneNumber = $_POST['number'] ?? '';  // Optional field
    $age = $_POST['age'] ?? '';
    $gender = $_POST['gender'] ?? '';

    // Validate input
    if (empty($name) || empty($email) || empty($password) || empty($age) || empty($gender)) {
        echo "Please fill all required fields!";
    } else {
        // Prepare SQL statement to insert data into the 'newaccount' table
        $sql = "INSERT INTO newaccount (name, email, passwords, phonenumber, age, gender) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters and execute SQL statement
        try {
            $stmt->execute([$name, $email, $password, $phoneNumber, $age, $gender]);
            echo "Account created successfully. Thank you for registering!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
