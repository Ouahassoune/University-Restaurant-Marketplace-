<?php
include 'db_connect.php'; // Include database connection

$usernameOrEmail = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT user_id, password_hash, verified FROM users WHERE username = ? OR email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($userId, $hashedPassword, $verified);
$stmt->fetch();
if ($stmt->num_rows === 1 && password_verify($password, $hashedPassword)) {
    // Check if the account is verified
    if ($verified == 1) {
        // Password is correct and account is verified, create session
        session_start();
        $_SESSION['user_id'] = $userId;
        header('Location: Marketplace.php'); // Redirect to the user's dashboard
        exit();
    } else {
        // Account is not verified, redirect back to login page with error message
        $loginError = "Your account is not verified. Please verify your email to continue.";
        header('Location: login.php?error=' . urlencode($loginError));
        exit();
    }
} else {
    // Invalid credentials, redirect back to login page with error message
    $loginError = "Invalid username/email or password";
    header('Location: login.php?error=' . urlencode($loginError));
    exit();
}

$stmt->close();
$conn->close();
?>
