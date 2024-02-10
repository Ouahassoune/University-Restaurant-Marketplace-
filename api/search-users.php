<?php
// Connect to your database (replace with your database connection code)
$mysqli = new mysqli("localhost", "root", "", "ensahticket");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$searchTerm = $_GET['query'];
$searchTermSafe = '%' . $searchTerm . '%';

// Perform a search query to retrieve matching user records
$searchResults = performUserSearch($mysqli, $searchTermSafe);

// Close the database connection
$mysqli->close();

// Return the search results as JSON response
header('Content-Type: application/json');
echo json_encode($searchResults);

// Function to perform the user search
function performUserSearch($mysqli, $searchTerm) {
    $sql = "SELECT * FROM users WHERE username LIKE ? OR name LIKE ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    $results = [];
    while ($row = $result->fetch_assoc()) {
        $results[] = $row;
    }
    return $results;
}
?>
