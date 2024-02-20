<?php
// Database credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'aci_leave');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Establish a mysqli connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check if the mysqli connection was successful
if (!$conn) {
    die("Mysqli Connection Error: " . mysqli_connect_error());
}

// Establish a PDO connection
try {
    $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  // Enable error reporting
    ]);
} catch (PDOException $e) {
    die("PDO Connection Error: " . $e->getMessage());
}

// Now you can use $conn for mysqli queries and $dbh for PDO queries
?>
