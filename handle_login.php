<?php
session_start();  // Start the session to handle login status

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
    $email = $_POST['email'] ?? '';
    $password = $_POST['pws'] ?? '';

    if (empty($email) || empty($password)) {
        echo "Both email and password are required!";
    } else {
        // Prepare SQL statement to check if the user exists and password is correct
        $sql = "SELECT * FROM newaccount WHERE email = ? LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // Verify password and check if user exists
        if ($user && password_verify($password, $user['passwords'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            echo "Logged in successfully. Welcome back!";
        } else {
            echo "Invalid email or password.";
        }
    }
}
?>
