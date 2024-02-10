<?php
// Start the session
session_start();

// Clear all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to a login page or another location
header("Location: login.php"); // Change "login.php" to the appropriate page
exit();
?>
