<?php
include 'db_connect.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ticketId = $_POST['ticketId'];
    $userId = $_POST['userId'];
    $reservationStatus = isset($_POST['reservationStatus']) ? $_POST['reservationStatus'] : 1; // Default to 1 if not specified

    // Update the database
    $updateQuery = "UPDATE tickets SET is_reserved = $reservationStatus, reserved_user_id = $userId WHERE ticket_id = $ticketId";
    if ($conn->query($updateQuery)) {
        echo "Database updated successfully";
    } else {
        echo "Error updating database: " . $conn->error;
    }
}
?>
