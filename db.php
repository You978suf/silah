<?php
$host = 'localhost';   // Database host, typically localhost
$dbname = 'silah';     // Database name
$username = 'root';    // Database username
$password = '';        // Database password for the user

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  // Enables error mode to throw exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Sets default fetch mode to associative array
    PDO::ATTR_EMULATE_PREPARES => false, // Disables emulation of prepared statements
];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, $options);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>
