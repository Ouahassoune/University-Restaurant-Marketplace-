<?php
session_start();
include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ticketId = $_POST["ticketId"];
    $buyerUserId = $_SESSION["user_id"];

    // Update confirmation status in the database
    $updateQuery = "UPDATE tickets SET buyer_confirmed = 1 WHERE ticket_id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("i", $ticketId);
    $updateStmt->execute();

    // Deduct ticket price from buyer's balance
    $getTicketPriceQuery = "SELECT price, seller_user_id FROM tickets WHERE ticket_id = ?";
    $getTicketPriceStmt = $conn->prepare($getTicketPriceQuery);
    $getTicketPriceStmt->bind_param("i", $ticketId);
    $getTicketPriceStmt->execute();
    $getTicketPriceResult = $getTicketPriceStmt->get_result();
    $ticketPriceRow = $getTicketPriceResult->fetch_assoc();
    $ticketPrice = $ticketPriceRow["price"];
    $sellerUserId = $ticketPriceRow["seller_user_id"];

    // Update buyer's balance
    $updateBalanceQuery = "UPDATE users SET balance = balance - ? WHERE user_id = ?";
    $updateBalanceStmt = $conn->prepare($updateBalanceQuery);
    $updateBalanceStmt->bind_param("di", $ticketPrice, $buyerUserId);
    $updateBalanceStmt->execute();

    // Update seller's balance
    $updateSellerBalanceQuery = "UPDATE users SET balance = balance + ? WHERE user_id = ?";
    $updateSellerBalanceStmt = $conn->prepare($updateSellerBalanceQuery);
    $updateSellerBalanceStmt->bind_param("di", $ticketPrice, $sellerUserId);
    $updateSellerBalanceStmt->execute();

    $conn->close();
}
?>

