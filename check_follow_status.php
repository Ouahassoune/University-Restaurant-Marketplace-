<?php
session_start();
include "db_connect.php"; // Include the database connection file

$isFollowing = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["displayedUserId"])) {
    $loggedInUserId = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;
    $displayedUserId = $_POST["displayedUserId"];

    if ($loggedInUserId !== null) {
        $checkQuery = "SELECT COUNT(*) as count_follow FROM followers WHERE follower_user_id = ? AND followed_user_id = ?";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param("ii", $loggedInUserId, $displayedUserId);
        $checkStmt->execute();
        $result = $checkStmt->get_result();
        
        $row = $result->fetch_assoc();
        $isFollowing = ($row['count_follow'] > 0);
    }
}

$conn->close();

// Set the Content-Type header to JSON
//header('Content-Type: application/json');

// Return the $isFollowing value as JSON response
$response = array("isFollowing" => $isFollowing);
echo json_encode($response);


?>
