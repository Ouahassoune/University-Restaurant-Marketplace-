
<?php
session_start();
include "db_connect.php"; // Include the database connection file
$userIde = $_SESSION['user_id']; // Assuming you have the user's ID stored in a session

// Perform a SELECT query to retrieve the user's username
$sql = "SELECT balance FROM Users WHERE user_id = ?";
$stmt = $conn->prepare($sql); // Use $conn from your connection file
$stmt->bind_param("i", $userIde); // "i" for integer, bind the parameter
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$userBalance=$row['balance'];

$stmt->close();
// Define meal times for each meal type


// Form submission and handling
$selectedMealType = isset($_POST['selectedMealType']) ? $_POST['selectedMealType'] : null;

$filterSold = isset($_POST['filter_sold']) ? $_POST['filter_sold'] : false;
$filterAvailable = isset($_POST['filter_available']) ? $_POST['filter_available'] : false;

$sql = "SELECT t.*, u.* FROM tickets t
        INNER JOIN users u ON t.seller_user_id = u.user_id
        WHERE 1"; // Start the query with a true condition
if ($selectedMealType) {
    $sql .= " AND t.meal_type = '$selectedMealType'";
}

if ($filterSold && !$filterAvailable) {
    $sql .= " AND t.availability = 0";
} elseif (!$filterSold && $filterAvailable) {
    $sql .= " AND t.availability = 1";
}
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $isReserved = $row['is_reserved']; // Fetch is_reserved value from the database
        $reservedUserId = $row['reserved_user_id']; // Fetch reserved_user_id value from the database
        $mealType = $row['meal_type'];
        $imagePath = 'assets/img/meals/';

        // Map meal types to image filenames
        $mealTypeToImage = [
            'Petit-déjeuner' => 'Petit-déjeuner.svg',
            'Déjeuner' => 'Déjeuner.svg',
            'diner' => 'Diner.svg'
            // Add more meal types and corresponding image filenames here
        ];

        // Check if the meal type exists in the mapping
        if (isset($mealTypeToImage[$mealType])) {
            $imageFilename = $mealTypeToImage[$mealType];
            $fullImagePath = $imagePath . $imageFilename;
        } else {
            // Use a default image if the meal type is not recognized
            $fullImagePath = $imagePath . 'default.png';
        }
        $mealTypeToTime = [
            'Petit-déjeuner' => '07:00:00',  // 7:00 AM
            'Déjeuner' => '12:30:00',         // 12:30 PM
            'diner' => '18:30:00'             // 6:30 PM
            // Add more meal types and corresponding meal times here
        ];
        // Get meal date and time
        $mealDate = $row['meal_date'];
        $mealTime = $mealTypeToTime[$mealType];
        $auctionEndTime = date('Y-m-d H:i:s', strtotime("$mealDate $mealTime") - 3600);
        

        // Calculate remaining time for auction end
        $currentTime = time();
        
        $diff = strtotime($auctionEndTime) - $currentTime;
        $hours = floor($diff / 3600);
        $minutes = floor(($diff % 3600) / 60);
        $seconds = $diff % 60;
        $userProfilePicture = $row['profile_picture'];
        
        echo '<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
            <div class="card__item four">
                <div class="card_body space-y-10">
                    <!-- =============== -->
                    <div class="creators space-x-10">
                        <div class="avatars space-x-3">
                        <a href="Profile.php?user_id=' .$row['user_id']. '">';
                        // Afficher l'image de profil de l'utilisateur
                        if (!empty($userProfilePicture)) {
                            echo '<img src="' . $userProfilePicture . '" alt="Avatar" class="avatar avatar-sm">';
                        } else {
                            // Si l'utilisateur n'a pas d'image de profil, afficher une image par défaut
                            echo '<img src="assets/img/avatars/avatar_1.png" alt="Avatardéfaut" class="avatar avatar-sm">';
                        }
                                
                           echo '</a>
                        <a href="Profile.php?user_id=' .$row['user_id']. '">
                                <p class="avatars_name txt_xs">' . $row['username'] . '</p>
                            </a>
                        </div>
                    </div>
                    <div class="card_head">
                        <a href="#">
                            <img src="' . $fullImagePath . '" alt="' . $mealType . '">
                        </a>
                        <a href="#" class="likes space-x-3">
                            <i class="ri-heart-3-fill"></i>
                            <span class="txt_sm">' . $row['followers_count'] . '</span>
                        </a>
                    </div>
                    <!-- =============== -->
                    <h6 class="card_title">' . $mealType . '</h6>
                    <div class="card_footer d-block space-y-10">
                        <div class="card_footer justify-content-between">
                            <a href="#" class="">
                                <p class="txt_sm">Prix: <span class="color_green txt_sm">' . $row['price'] . ' DH</span></p>
                            </a>
                        </div>
                        <div class="hr"></div>
                        <div class="d-flex align-items-center space-x-10 justify-content-between">';
                        if ($row['availability'] == 1) {
                            if ($diff > 0) {
                                // Display countdown timer
                                echo '<div class="auction_end" data-auction-end-time="'.$auctionEndTime.'">
                                <p class="color_text txt">AUCTION END</p>
                                <div class="d-flex justify-content-center align-items-center space-x-10 txt_lg _bold">
                                    <div class="item">
                                        <div class="number hours">'.$hours.'<span></span></div>
                                    </div>
                                    <div class="dots">:</div>
                                    <div class="item">
                                        <div class="number minutes">'.$minutes.'<span></span></div>
                                    </div>
                                    <div class="dots">:</div>
                                    <div class="item">
                                        <div class="number seconds">'.$seconds.'<span></span></div>
                                    </div>
                                </div>
                            </div>';
                            // Check if the logged-in user is the seller of the ticket
            if ($row['seller_user_id'] == $_SESSION['user_id']) {
                // Display the "Remove" button
                echo '<button class="btn btn-red remove-button" data-ticket-id="' . $row['ticket_id'] . '" onclick="removeTicket(' . $row['ticket_id'] . ')">
                    Remove Ticket</button>';
            } else {
                // Display "Acheter" button if balance is sufficient
                if ($userBalance >= $row['price']) {
                    echo '<a href="#" class="btn btn-sm btn-primary acheter-btn" 
                        data-ticket-id="' . $row['ticket_id'] . '" 
                        data-meal-type="' . $mealType . '" 
                        data-price="' . $row['price'] . '" data-is_reserved="' . $isReserved . '" 
                        data-reserved_user_id="' . $reservedUserId . '">Acheter </a>';
                        
                } else {
                    // Show the "Insufficient Balance" modal
                    echo '<a href="#" class="btn btn-sm btn-primary acheter-btn" data-toggle="modal" data-target="#insufficient_balance">Acheter</a>';
                }
            }
        } else {
            // Display "Expired" message
            echo '<p class="color_text txt">Expired</p>';
        }
    } else {
        
            echo '<button class="btn btn-orange sold-label">Sold</button>';

    }
                        
                        echo '</div>
                    </div>
                </div>
            </div>
        </div>';
        
        echo '<div class="modal fade popup" id="popup_bid_' . $row['ticket_id'] . '" tabindex="-1" role="dialog"
			            aria-hidden="true">
			            <div class="modal-dialog modal-dialog-centered" role="document">
			                <div class="modal-content">
			                    <button type="button" class="close" data-dismiss="modal"
			                        aria-label="Close">
			                        <span aria-hidden="true">&times;</span>
			                    </button>
			                    <div class="modal-body space-y-20 p-40">
			                        <h3>Acheter Ticket</h3>
			                        <p>Valider Votre commande de <span class="color_black">' . $row['meal_type'] . '</span> Le <span class="color_black">' . $row['meal_date'] . '</span>
			                        </p>
			                        <p>laisser un message au vendeur<span class="color_green">(Optional)</span>
			                        </p>
			                        <input type="text" class="form-control"
			                            value="" placeholder="Message">
			                        <div class="hr"></div>
			                        <div class="d-flex justify-content-between">
			                            <p> Subtotal:</p>
			                            <p class="text-right color_black txt _bold">' .$row['price'] .' DH </p>
			                        </div>
			                        <div class="d-flex justify-content-between">
			                            <p> service free:</p>
			                            <p class="text-right color_black txt _bold"> 0.01 DH </p>
			                        </div>
			                        <div class="d-flex justify-content-between">
			                            <p> Total :</p>
			                            <p class="text-right color_black txt _bold"> '. ($row['price'] + 0.01) .' DH </p>
			                        </div>
                                    <span id="countdown-timer_'.$row['ticket_id'].'" class="countdown-timer text-center d-flex align-items-center justify-content-center color_black"></span>
			                        <form action="purchase.php" method="post">
			                            <input type="hidden" name="ticket_id" value="' . $row['ticket_id'] . '">
			                            <input type="hidden" name="amount" value="' . ($row['price'] + 0.01) . '">
			                            <button type="submit" class="btn btn-primary w-full"> Acheter Ticket</button>
			                        </form>
                                    
			                    </div>
			                </div>
			            </div>
			        </div>';
                    echo '
					<div class="modal fade popup" id="insufficient_balance" tabindex="-1" role="dialog"
			            aria-hidden="true">
			            <div class="modal-dialog modal-dialog-centered" role="document">
			                <div class="modal-content">
			                    <button type="button" class="close" data-dismiss="modal"
			                        aria-label="Close">
			                        <span aria-hidden="true">&times;</span>
			                    </button>
			                    <div class="modal-body space-y-20 p-40">
			                        <h3>Insufficient Balance</h3>
			                        <p>Your balance <span class="color_black">'.$userBalance.' DH</span> is not enough to perform this action. Please recharge your account. 
			                        </p>
			                        <div class="d-flex justify-content-between">
			                            <p> Prix de Tickets</p>
			                            <p class="text-right color_black txt _bold">'.$row['price'].' DH </p>
			                        </div>
			                        <div class="d-flex justify-content-between">
			                            <p> Balance:</p>
			                            <p class="text-right color_black txt _bold">'.$userBalance.' DH </p>
			                        </div>
			                        
			                        <div class="modal-footer">
                                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <a href="Connect-wallet.php" class="btn btn-primary">Recharge Account</a>
                                  </div>
			                    </div>
			                </div>
			            </div>
			        </div>
					';
                    echo '
					<div class="modal fade popup" id="reserved_by_another" tabindex="-1" role="dialog"
			            aria-hidden="true">
			            <div class="modal-dialog modal-dialog-centered" role="document">
			                <div class="modal-content">
			                    <button type="button" class="close" data-dismiss="modal"
			                        aria-label="Close">
			                        <span aria-hidden="true">&times;</span>
			                    </button>
			                    <div class="modal-body space-y-20 p-40">
			                        <h3>Ticket is already reserved</h3>
			                        <p>This ticket is currently being reserved by another buyer. Please try again later.
			                        </p>
			                        
			                        
			                        <div class="modal-footer">
                                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      
                                  </div>
			                    </div>
			                </div>
			            </div>
			        </div>
					';

    }
} else {
    echo "No tickets found.";
}

$conn->close();
?>





