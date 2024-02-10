<?php
// user_functions.php

// Function to get the cover image path for a user based on their user ID
function getCoverImagePathForUser($userId) {
    // Connect to your database (you may have already done this in your code)
$host = "localhost";
$username = "root";
$password = "";
$database = "ensahticket";

// Create a new MySQLi instance
$conn = new mysqli($host, $username, $password, $database);

    // Check for a successful database connection
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Query the database to retrieve the cover image path
    $query = "SELECT cover_image FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($coverImagePath);

    if ($stmt->fetch()) {
        // Return the cover image path if found
        return $coverImagePath;
    } else {
        // Return an empty string if no cover image path is found
        return "";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
function getProfileImagePathForUser($userId) {
    // Connect to your database (you may have already done this in your code)
$host = "localhost";
$username = "root";
$password = "";
$database = "ensahticket";

// Create a new MySQLi instance
$conn = new mysqli($host, $username, $password, $database);

    // Check for a successful database connection
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Query the database to retrieve the cover image path
    $query = "SELECT profile_picture FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($coverImagePath);

    if ($stmt->fetch()) {
        // Return the cover image path if found
        return $coverImagePath;
    } else {
        // Return an empty string if no cover image path is found
        return "";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>


