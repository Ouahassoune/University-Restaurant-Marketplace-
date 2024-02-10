<?php
session_start();
include "db_connect.php"; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loggedInUserId = $_SESSION["user_id"];
    $displayedUserId = $_POST["displayedUserId"];

    // Check if the user is already following
    $checkQuery = "SELECT * FROM followers WHERE follower_user_id = ? AND followed_user_id = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("ii", $loggedInUserId, $displayedUserId);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        // Delete the follow relationship
        $deleteQuery = "DELETE FROM followers WHERE follower_user_id = ? AND followed_user_id = ?";
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->bind_param("ii", $loggedInUserId, $displayedUserId);
        $deleteStmt->execute();
        // Update follower count in the users table for the followed user
        $updateFollowerCountQuery = "UPDATE users SET followers_count = followers_count - 1 WHERE user_id = ?";
        $updateFollowerCountStmt = $conn->prepare($updateFollowerCountQuery);
        $updateFollowerCountStmt->bind_param("i", $displayedUserId);
        $updateFollowerCountStmt->execute();
    }

    $conn->close();
}
?>
