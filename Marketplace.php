 <?php

session_start();
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header('Location: login.php');
    exit();
	
}
include 'db_connect.php'; // Include database connection

$userId = $_SESSION['user_id']; // Assuming you have the user's ID stored in a session

// Perform a SELECT query to retrieve the user's username
$sql = "SELECT username,email,bio,balance FROM Users WHERE user_id = ?";
$stmt = $conn->prepare($sql); // Use $conn from your connection file
$stmt->bind_param("i", $userId); // "i" for integer, bind the parameter
$stmt->execute();
$result = $stmt->get_result();

// Fetch the username from the result
$row = $result->fetch_assoc();
$username = $row['username'];
$userBalance=$row['balance'];
$bio = $row['bio'];
$email = $row['email'];
$stmt->close();
?>



<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="title" content="Raroin" />
		<meta name="description" content="Premium NFT marketplace theme" />
		<meta
			name="keywords"
			content="bootstrap, creabik, ThemeForest, bootstrap5, agency theme, saas
			theme, sass, html5"
			/>
		<meta name="robots" content="index, follow" />
		<meta name="language" content="English" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title> - Marketplace </title>
		<meta name="msapplication-TileColor" content="#da532c" />
		<meta name="theme-color" content="#ffffff" />
		<!-- 🌈🌈🌈🌈🌈🌈🌈🌈🌈🌈🌈🌈🌈🌈🌈 STYLES -->
		<link rel="stylesheet" href="assets/css/plugins/remixicon.css" />
		<link
			rel="stylesheet"
			href="assets/css/plugins/bootstrap.min.css"
			/>
		<link
			rel="stylesheet"
			href="assets/css/plugins/swiper-bundle.min.css"
			/>
		<link rel="stylesheet" href="assets/css/style.css" />
	</head>
	<body class="body">
		<div class="overflow-hidden">
			 <div class="bg-dark py-10">
				<div class="container">
					<div
						class="text-center
						d-flex
						justify-content-between
						space-x-10
						align-items-center">
						<div class="space-x-10 d-flex align-items-center">
							<lottie-player
								src="https://assets6.lottiefiles.com/private_files/lf30_kqshlcsx.json"
								background="transparent"
								speed="2"
								style="width: 50px; height: 50px"
								loop
								autoplay></lottie-player>
							<p class="color_white">
								Dark mode is now
								<span style="color: rgb(0, 255, 170)">Available </span>
							</p>
						</div>

						<div class="mode_switcher space-x-10">
							<a href="#" class="light d-flex align-items-center is_active">
								<i class="ri-sun-fill"></i> Light
							</a>
							<a href="#" class="dark d-flex align-items-center">
								<i class="ri-moon-fill"></i> Dark
							</a>
						</div>
					</div>
				</div>
			</div> 
			<?php
include "header.php";
?>
			 <div class="hero_marketplace bg_white">
			    <div class="container">
			        <h1 class="text-center">Marketplace</h1>
			    </div>
			</div>
			<form id="filterForm" method="post">
			<div class="bg_white border-b py-20">
    <div class="container">
        <div class="d-flex justify-content-center">
            <ul class="menu_categories space-x-20">
                <li>
                    <a href="#" class="color_brand filter-link" data-meal-type="Tout">
                        <span> Tout</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="color_brand filter-link" data-meal-type="Petit-déjeuner">
                        <i class="ri-cake-line"></i> <span> Petit-déjeuner</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="color_brand filter-link" data-meal-type="Déjeuner">
                        <i class="ri-restaurant-2-fill"></i> <span> Déjeuner</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="color_brand filter-link" data-meal-type="diner">
                        <i class="ri-restaurant-line"></i> <span> Dîner </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

			<div class="container">
			    <div class="section mt-100">
			        <div class="section__head">
						<div class="nav nav-tabs d-flex space-x-40 mb-30 justify-content-between">
							<h2 class="section__title mb-20"> Tickets </h2>
							<div class="mb-20">
								<a class="btn btn-primary btn-sm" href="Upload.php"><i class="ri-donut-chart-fill
									sm"></i> Placer votre Ticket</a>
							  </div>
							  
								
							  
							
						</div>
			           
						 
			            <div class="row justify-content-between align-items-center">
						
    <div class="col-lg-auto">
        <div class="d-flex space-x-10 align-items-center">
            <span class="color_text txt_sm" style="min-width: max-content">
                FILTER BY:
            </span>
            <ul class="menu_categories space-x-20">
                <li class="d-flex space-x-10 switch_item">
                    <input type="checkbox" id="switch1" class="toggle-switch" name="filter_available" checked/>
                    <label for="switch1">Toggle</label>
                    <span> Disponible </span>
                </li>
                <li class="d-flex space-x-10 switch_item">
                    <input type="checkbox" id="switch4" class="toggle-switch" name="filter_sold" />
                    <label for="switch4">Toggle</label>
                    <span> Vendu </span>
                </li>
            </ul>
        </div>
    </div>
</form>






			            </div>
			        </div>
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
			        <div class="modal fade popup" id="popup_bid_success" tabindex="-1" role="dialog"
			            aria-hidden="true">
			            <div class="modal-dialog modal-dialog-centered" role="document">
			                <div class="modal-content">
			                    <button type="button" class="close" data-dismiss="modal"
			                        aria-label="Close">
			                        <span aria-hidden="true">&times;</span>
			                    </button>
			                    <div class="modal-body space-y-20 p-40">
			                        <h3 class="text-center">Your Bidding
			                            Successfuly Added</h3>
			                        <p class="text-center">your bid <span class="color_text txt
			                                _bold">(16DH) </span> has been listing
			                            to our database</p>
			        
			                        <a href="" class="btn btn-dark w-full"> Watch the listings</a>
			                    </div>
			                </div>
			            </div>
			        </div>
			        
					
					<div class="row mb-30_reset" id="filteredTickets">




				

			        
			        </div>    </div>
			    
			</div>
<!-- FOOTER -->
<?php
include "footer.php";
?>
		</div>
		<!-- 🌈🌈🌈🌈🌈🌈🌈🌈🌈🌈🌈🌈🌈🌈🌈 SCRIPTS -->
		<script src="assets/js/jquery-3.6.0.js"></script>
		<script src="assets/js/bootstrap.bundle.min.js"></script>
		<script src="assets/js/swiper-bundle.min.js"></script>
		<script src="assets/js/gsap.min.js"></script>
		<script src="assets/js/ScrollTrigger.min.js"></script>
		<script src="assets/js/sticky-sidebar.js"></script>
		<script src="assets/js/script.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
		<script src="https://unpkg.com/moralis/dist/moralis.js"></script>
		<script src="assets/js/nft.js"></script>
        <script src="assets/js/inactivity-timeout.js"></script>

        <script>
$(document).ready(function() {
    // Function to update the countdown timer
    function updateCountdownTimer(ticketId, seconds) {
        $('#countdown-timer_' + ticketId).text('Closing in ' + seconds + ' seconds');
    }
    // Function to close the modal, reset the timer, and update the reservation status
    function closePurchaseModalAndResetTimer(ticketId) {
        $('#popup_bid_' + ticketId).modal('hide');
        clearTimeout(timers[ticketId]); // Clear the timer for this specific modal

        // Update the reservation status in the database
        $.ajax({
            type: 'POST',
            url: 'update_reservation.php',
            data: {
                ticketId: ticketId,
                userId: <?php echo $_SESSION['user_id']; ?>, // User ID of the logged-in user
                reservationStatus: 0 // Set the reservation status to 0 (not reserved)
            },
            success: function(response) {
                // Database updated successfully
                console.log('Database updated:', response);

                // Perform other actions as needed
            },
            error: function(xhr, status, error) {
                console.error('Error updating database:', error);
            }
        });
    }
    var timers = {}; // Store timers for each modal
    // Use event delegation with a common class for the buttons
    $('body').on('click', '.acheter-btn', function(event) {
        var ticketId = $(this).data('ticket-id');
        var mealType = $(this).data('meal-type');
        var price = $(this).data('price');
        var userBalance = <?php echo $userBalance; ?>;
        var isReserved = $(this).data('is_reserved');
        var reservedUserId = $(this).data('reserved_user_id'); 


        if (userBalance >= price) {
            if (isReserved === 1 && reservedUserId !== <?php echo $_SESSION['user_id']; ?>) {
                // Display the "Reserved by another user" modal
                $('#popup_bid_' + ticketId).modal('hide'); // Hide the current modal
                $('#reserved_by_another').modal('show'); // Show the reserved modal
            } else {
                // Open the normal purchase modal
                $('#popup_bid_' + ticketId).find('.meal-type').text(mealType);
                $('#popup_bid_' + ticketId).find('.price').text(price + ' DH');
                $('#popup_bid_' + ticketId).find('input[name="ticket_id"]').val(ticketId);
                $('#popup_bid_' + ticketId).find('input[name="amount"]').val(price);

                // Optional: Clear the message input field
                $('#popup_bid_' + ticketId).find('input[name="message"]').val('');

                // Update the database with reservation status and user ID
                $.ajax({
                    type: 'POST',
                    url: 'update_reservation.php', // Create a new PHP file to handle this update
                    data: {
                        ticketId: ticketId,
                        userId: <?php echo $_SESSION['user_id']; ?> // User ID of the logged-in user
                    },
                    success: function(response) {
                        // Database updated successfully
                        console.log('Database updated:', response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating database:', error);
                    }
                });

                // Open the normal purchase modal
                $('#popup_bid_' + ticketId).modal('show');
                    // Set a timer to close the modal after 10 seconds
                    var countdown = 60; // Countdown duration in seconds
                updateCountdownTimer(ticketId, countdown); // Display initial countdown
                timers[ticketId] = setInterval(function() {
                    countdown--;
                    if (countdown <= 0) {
                        clearInterval(timers[ticketId]);
                        closePurchaseModalAndResetTimer(ticketId);
                    } else {
                        updateCountdownTimer(ticketId, countdown); // Update countdown in modal
                    }
                }, 1000); // Update every 1 second (1000 milliseconds)
            }
        } else {
            // Insufficient balance, open the insufficient balance modal
            $('#popup_bid_' + ticketId).modal('hide'); // Hide the current modal
            $('#insufficient_balance').modal('show'); // Show the insufficient balance modal
        }
    });
});

</script>




<script>
   document.addEventListener('DOMContentLoaded', function () {
    const filterLinks = document.querySelectorAll('.menu_categories a.filter-link');
    const checkboxes = document.querySelectorAll('.toggle-switch');

    filterLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default link behavior

            console.log('Meal type link clicked:', link.dataset.mealType);

            // Remove the "color_brand" class from all links
            filterLinks.forEach(link => {
                link.classList.remove('color_brand');
            });

            // Add the "color_brand" class to the clicked link
            link.classList.add('color_brand');

            let selectedMealType = link.dataset.mealType;
            if (selectedMealType === 'Tout') {
                selectedMealType = ''; // Clear the meal type filter if "Tout" is clicked
            }

            filterTickets(selectedMealType); // Pass the meal type as an argument
        });
    });

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            filterTickets();
        });
    });

    function filterTickets(selectedMealType = '') {
        console.log('Filtering tickets with meal type:', selectedMealType);

        const formData = new FormData(document.getElementById('filterForm'));
        formData.append('selectedMealType', selectedMealType); // Add selected meal type to form data

        fetch('filter.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('filteredTickets').innerHTML = data;
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    // Initial filtering on page load
    filterTickets();
});

</script>

|<script>
function updateCountdown() {
    var countdownElements = document.querySelectorAll('.auction_end');

    countdownElements.forEach(function (element) {
        var endTime = new Date(element.getAttribute('data-auction-end-time'));
        var now = new Date();

        var timeLeft = endTime - now;

        var hours = Math.floor(timeLeft / 3600000);
        var minutes = Math.floor((timeLeft % 3600000) / 60000);
        var seconds = Math.floor((timeLeft % 60000) / 1000);

        if (hours < 10) { hours = "0" + hours; }
        if (minutes < 10) { minutes = "0" + minutes; }
        if (seconds < 10) { seconds = "0" + seconds; }

        element.querySelector('.hours').textContent = hours;
        element.querySelector('.minutes').textContent = minutes;
        element.querySelector('.seconds').textContent = seconds;
    });
}

updateCountdown(); // Initial update

// Schedule the countdown to update every second
setInterval(updateCountdown, 1000);


</script>
<script>// Function to fetch and update tickets
function fetchAndRefreshTickets() {
    fetch('filter.php', {
        method: 'POST',
        body: new FormData(document.getElementById('filterForm'))
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('filteredTickets').innerHTML = data;
    })
    .catch(error => {
        console.error('Error fetching tickets:', error);
    });
}

// Periodically fetch and update tickets (e.g., every 10 seconds)
const fetchInterval = 10000; // 10 seconds
setInterval(fetchAndRefreshTickets, fetchInterval);

// Initial fetch and update on page load
fetchAndRefreshTickets();
</script>


	</body>


</html>