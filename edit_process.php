<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header('Location: login.php');
    exit();
}

include 'db_connect.php'; // Include database connection

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle Cover Image Upload
    $coverImageTargetFile = ''; // Initialize to an empty string
    if (isset($_FILES["cover_image"]) && $_FILES["cover_image"]["error"] === UPLOAD_ERR_OK) {
        $coverImageTargetDir = "cover_image/";
        $coverImageTargetFile = $coverImageTargetDir . basename($_FILES["cover_image"]["name"]);
        move_uploaded_file($_FILES["cover_image"]["tmp_name"], $coverImageTargetFile);
    }

    // Handle Profile Image Upload
    $profileImageTargetFile = ''; // Initialize to an empty string
    if (isset($_FILES["profile_photo"]) && $_FILES["profile_photo"]["error"] === UPLOAD_ERR_OK) {
        $profileImageTargetDir = "profile_photo/";
        $profileImageTargetFile = $profileImageTargetDir . basename($_FILES["profile_photo"]["name"]);
        move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $profileImageTargetFile);
    }

    // Get other form data
    $newUsername = $_POST["new_username"];
    $newBio = $_POST["new_bio"];
    $newEmail = $_POST["new_email"];
    $userId = $_SESSION["user_id"]; // Replace with your actual session handling code

    // Check if the user uploaded a new cover image, if not, keep the old one
    if (empty($coverImageTargetFile)) {
        // Fetch the existing cover image path from the database
        $selectCoverQuery = "SELECT cover_image FROM users WHERE user_id = ?";
        $stmt = $conn->prepare($selectCoverQuery);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->bind_result($existingCoverImage);
        $stmt->fetch();
        $stmt->close();

        $coverImageTargetFile = $existingCoverImage;
    }

    // Check if the user uploaded a new profile image, if not, keep the old one
    if (empty($profileImageTargetFile)) {
        // Fetch the existing profile image path from the database
        $selectProfileQuery = "SELECT profile_picture FROM users WHERE user_id = ?";
        $stmt = $conn->prepare($selectProfileQuery);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->bind_result($existingProfileImage);
        $stmt->fetch();
        $stmt->close();

        $profileImageTargetFile = $existingProfileImage;
    }

    // Update query
    $updateQuery = "UPDATE users SET username = ?, bio = ?, email = ?, cover_image = ?, profile_picture = ? WHERE user_id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sssssi", $newUsername, $newBio, $newEmail, $coverImageTargetFile, $profileImageTargetFile, $userId);

    if ($stmt->execute()) {
        // Update successful
        $stmt->close();
        
        // Redirect or show a success message
        header("Location: edit_profile.php"); // Redirect to the user's profile page
        exit();
    } else {
        // Update failed
        echo "Error: " . $conn->error;
    }

    $conn->close();
}


?>
