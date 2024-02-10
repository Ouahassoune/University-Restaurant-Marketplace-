<?php
session_start();
include "db_connect.php"; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reporterUserId = $_SESSION["user_id"];
    $reportedUserId = $_POST["displayedUserId"];

    // Insert report into reports table
    $insertQuery = "INSERT INTO reports (reporter_user_id, reported_user_id, report_date) VALUES (?, ?, NOW())";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->bind_param("ii", $reporterUserId, $reportedUserId);
    $insertStmt->execute();

    $conn->close();
}
?>