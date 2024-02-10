<?php
include "db_connect.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ticketId = intval($_POST['ticket_id']);
    $amount = floatval($_POST['amount']);
    $buyerUserId = $_SESSION['user_id'];

    // Start a database transaction
    $conn->begin_transaction();

    try {
        // Check if the ticket is still available
        $checkAvailabilityQuery = "SELECT availability FROM tickets WHERE ticket_id = ?";
        $stmt = $conn->prepare($checkAvailabilityQuery);
        $stmt->bind_param("i", $ticketId);
        $stmt->execute();
        $result = $stmt->get_result();
        $ticket = $result->fetch_assoc();

        if ($ticket && $ticket['availability'] == 1) {
            // Mark the ticket as sold (unavailable)
            $updateQuery = "UPDATE tickets SET availability = 0 WHERE ticket_id = ?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("i", $ticketId);
            $stmt->execute();
            
            // Insert purchase record
            $purchaseDate = date('Y-m-d H:i:s');
            $insertPurchaseSql = "INSERT INTO purchasehistory (buyer_user_id, ticket_id, purchase_date) 
                                  VALUES (?, ?, ?)";
            $stmt = $conn->prepare($insertPurchaseSql);
            $stmt->bind_param("iis", $buyerUserId, $ticketId, $purchaseDate);
            $stmt->execute();
            
            // Insert transaction record
            $transactionType = 'Purchase';
            $transactionDate = $purchaseDate;
            $insertTransactionSql = "INSERT INTO transactions (user_id, transaction_type, transaction_date, amount) 
                                     VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($insertTransactionSql);
            $stmt->bind_param("isss", $buyerUserId, $transactionType, $transactionDate, $amount);
            $stmt->execute();
            
            // Commit the transaction
            $conn->commit();
            
            // Redirect to a success page or back to the marketplace
            header('Location: Marketplace.php');
            exit();
        } else {
            // The ticket is no longer available, handle accordingly
            // Rollback the transaction and provide a message to the user
            $conn->rollback();
            echo "Le ticket n'est plus disponible pour l'achat.";
        }
    } catch (Exception $e) {
        // If an error occurs, rollback the transaction
        $conn->rollback();
        echo "Une erreur est survenue : " . $e->getMessage();
    }
}
?>
