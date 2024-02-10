<?php
session_start();
include "db_connect.php"; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loggedInUserId = $_SESSION["user_id"];
    $displayedUserId = $_POST["displayedUserId"];

    // Check if the user is not already following
    $checkQuery = "SELECT * FROM followers WHERE follower_user_id = ? AND followed_user_id = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("ii", $loggedInUserId, $displayedUserId);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows === 0) {
        // Insert into followers table
        $insertQuery = "INSERT INTO followers (follower_user_id, followed_user_id, follow_date) VALUES (?, ?, NOW())";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("ii", $loggedInUserId, $displayedUserId);
        $insertStmt->execute();
        // Update follower count in the users table for the followed user
        $updateFollowerCountQuery = "UPDATE users SET followers_count = followers_count + 1 WHERE user_id = ?";
        $updateFollowerCountStmt = $conn->prepare($updateFollowerCountQuery);
        $updateFollowerCountStmt->bind_param("i", $displayedUserId);
        $updateFollowerCountStmt->execute();
    }

    $conn->close();
}
?>
