<?php
include 'db_connect.php';
// Get the verification token from the URL
$verification_token = $_GET['token'];

// Retrieve the user's email and verification token from the database
$sql = "SELECT email FROM users WHERE verification_token='$verification_token' AND verified=0";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // If the verification token is valid, mark the user's email as verified
    $row = $result->fetch_assoc();
    $email = $row['email'];

    // Update the user's record in the database to mark email as verified
    $update_sql = "UPDATE users SET verified=1 WHERE email='$email'";
    $conn->query($update_sql);

    // Notify the user that their email has been verified
    header('Location:login.php'); //line 699
    exit();
} else {
    echo "Invalid verification token.";
}

$conn->close();
?>
