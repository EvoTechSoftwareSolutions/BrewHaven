<?php
// Database connection info
$host = "localhost";
$username = "root";
$password = "";
$database = "brewhaven_db";

try {
    // Create connection
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    
    // Set error mode so we can see mistakes
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
