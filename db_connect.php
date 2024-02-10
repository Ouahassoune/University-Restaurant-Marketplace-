<?php
// Replace these values with your actual database credentials
$host = "localhost";
$username = "root";
$password = "";
$database = "ensahticket";

// Create a new MySQLi instance
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the default character set to utf8mb4
$conn->set_charset("utf8mb4");

// Return the database connection instance
return $conn;
?>
