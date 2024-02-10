<?php
include 'db_connect.php'; // Include database connection
session_start();
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header('Location: login.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    
    // Get form inputs
    $mealType = $_POST['meal_type'];
    $date = $_POST['meal_date'];
    $description = $_POST['description'];
    $price = $_POST['price'];
  // Insert data into the database
    $userId = $_SESSION['user_id'];
    $insertQuery = "INSERT INTO tickets (seller_user_id, meal_type, meal_date, description, price) VALUES ('$userId', '$mealType', '$date', '$description', '$price')";

    if ($conn->query($insertQuery) === TRUE) {
        // Display success message or redirect to another page
        header('Location: Marketplace.php');
    } else {
        // Display error message or handle the error appropriately
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<!-- ... (rest of the HTML code) -->

