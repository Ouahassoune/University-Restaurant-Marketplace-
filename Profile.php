<?php
// Include the check_follow_status.php script to determine if the user is following
include "check_follow_status.php";
?> 
<?php
//session_start();
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header('Location: login.php');
    exit();
	
}
include 'db_connect.php'; // Include database connection
$userId = isset($_GET['user_id']) ? $_GET['user_id'] : null;

// $userId = $_SESSION['user_id']; // Assuming you have the user's ID stored in a session

// Perform a SELECT query to retrieve the user's username
$sql = "SELECT username,email,bio,balance FROM Users WHERE user_id = ?";
$stmt = $conn->prepare($sql); // Use $conn from your connection file
$stmt->bind_param("i", $userId); // "i" for integer, bind the parameter
$stmt->execute();
$result = $stmt->get_result();

// Fetch the username from the result
$row = $result->fetch_assoc();
$username = $row['username'];
//$userBalance=$row['balance'];
$bio = $row['bio'];
$email = $row['email'];
$stmt->close();

$sqlb = "SELECT balance FROM Users WHERE user_id = ?";
$stmt = $conn->prepare($sqlb); // Use $conn from your connection file
$stmt->bind_param("i", $_SESSION['user_id']); // "i" for integer, bind the parameter
$stmt->execute();
$result = $stmt->get_result();

// Fetch the username from the result
$row = $result->fetch_assoc();

$userBalance=$row['balance'];

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
		<title>Profile </title>
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
			<div class="modal fade popup" id="popup_bid" tabindex="-1" role="dialog"
			    aria-hidden="true">
			    <div class="modal-dialog modal-dialog-centered" role="document">
			        <div class="modal-content">
			            <button type="button" class="close" data-dismiss="modal"
			                aria-label="Close">
			                <span aria-hidden="true">&times;</span>
			            </button>
			            <div class="modal-body space-y-20 p-40">
			                <h3>Place a Bid</h3>
			                <p>You must bid at least <span class="color_black">15 DH</span>
			                </p>
			                <input type="text" class="form-control"
			                    placeholder="00.00 DH">
			
			                <p>Enter quantity. <span class="color_green">5 available</span>
			                </p>
			                <input type="text" class="form-control"
			                    value="1">
			                <div class="hr"></div>
			                <div class="d-flex justify-content-between">
			                    <p> You must bid at least:</p>
			                    <p class="text-right color_black txt _bold"> 67,000 DH </p>
			                </div>
			                <div class="d-flex justify-content-between">
			                    <p> service free:</p>
			                    <p class="text-right color_black txt _bold"> 0,901 DH </p>
			                </div>
			                <div class="d-flex justify-content-between">
			                    <p> Total bid amount:</p>
			                    <p class="text-right color_black txt _bold"> 56,031 DH </p>
			                </div>
			                <a href="" class="btn btn-primary w-full"
			                    data-toggle="modal"
			                    data-target="#popup_bid_success"
			                    data-dismiss="modal"
			                    aria-label="Close"> Place a bid</a>
			            </div>
			        </div>
			    </div>
			</div>
			<!-- ====== header -->
			<?php
include "header.php";
?>
			 
			<div class="mb-100">
				<div class="hero__profile">
					<div class="cover">
					<?php
						
    // Check if a cover image path is associated with the user
    $coverImagePath = getCoverImagePathForUser($userId); // Implement this function

    if (!empty($coverImagePath)) {
        echo '<img src="' . $coverImagePath . '" alt="Profile Cover Image" id="cover_image">';
    } else {
        // If no cover image is associated, display a default one
        echo '<img src="assets/img/bg/cover.jpg" alt="cover" class="avatar avatar-lg border-0" id="cover_image">';
    }
    ?>
					</div>
					<div class="infos">
						<div class="container">
							<div class="row flex-wrap align-items-center
								justify-content-between">
								<div class="col-md-auto mr-20">
									<div class="avatars d-flex space-x-20
										align-items-center">
										<div class="avatar_wrap">
											<img class="avatar avatar-lg"
												src="assets/img/avatars/avatar_4.png"
												alt="avatar">
												<?php
						
						// Check if a cover image path is associated with the user
						$profileImagePath = getProfileImagePathForUser($userId); // Implement this function
					
						if (!empty($profileImagePath)) {
							echo '<img src="' . $profileImagePath . '" alt="avatar" class="avatar avatar-lg " >';
						} else {
							// If no cover image is associated, display a default one
							echo '<img src="assets/img/avatars/avatar_4.png" alt="avatar" class="avatar avatar-lg " >';
						}
						?> 
										</div>
										<h5><?php echo $username?></h5>
									</div>
								</div>
								<div class="col-md-auto">
									<div class="d-flex flex-wrap align-items-center
										space-x-20 mb-20_reset">
										<div class="mb-20">
											<!-- <div class="copy">
												<span class="color_text"> 13b9ebda0178...
												</span>
												<a href="#">
													<i class="ri-file-copy-line color_text"></i>
												</a>
											</div> -->
										</div>
										<div class="d-flex flex-wrap align-items-center
											space-x-20">
											<?php
// Retrieve the logged-in user's information (replace with your authentication method)
$loggedInUserId = $_SESSION['user_id']; // Replace with the actual logged-in user's user_id

// Retrieve the profile user's information from the URL parameter
$displayedUserId = isset($_GET['user_id']) ? $_GET['user_id'] : null;

// Check if the logged-in user is viewing their own profile
$isOwnProfile = $loggedInUserId == $displayedUserId;
?>

<!-- Display the Follow button if it's not the logged-in user's own profile -->
<?php if (!$isOwnProfile) { ?>
	<div class="mb-20">
    <button class="btn btn-dark btn-sm follow-toggle-button">
        Follow
    </button>
</div>

<?php } ?>


											<div class="mb-20">
												<div class="share">
													<div class="icon">
														<a href="#"> <i
																class="ri-share-line"></i>
														</a>
													</div>
													<div class="dropdown__popup">
														<ul class="space-y-10">
															<li> <a href=""> <i
																		class="ri-facebook-line"></i>
																</a>
															</li>
															<li> <a href=""> <i
																		class="ri-messenger-line"></i>
																</a>
															</li>
															<li> <a href=""> <i
																		class="ri-whatsapp-line"></i>
																</a>
															</li>
															<li> <a href=""> <i
																		class="ri-youtube-line"></i>
																</a>
															</li>
														</ul>
													</div>
												</div>
											</div>
											<?php
// Retrieve the logged-in user's information (replace with your authentication method)
$loggedInUserId = $_SESSION['user_id']; // Replace with the actual logged-in user's user_id

// Retrieve the profile user's information from the URL parameter
$displayedUserId = isset($_GET['user_id']) ? $_GET['user_id'] : null;

// Check if the logged-in user is viewing their own profile
$isOwnProfile = $loggedInUserId == $displayedUserId;
?>

<!-- Display the Follow button if it's not the logged-in user's own profile -->
<?php if (!$isOwnProfile) { ?>
											<div class="mb-20">
												<div class="more">
													<div class="icon">
														<a href="#"> <i
																class="ri-more-fill"></i>
														</a>
													</div>
		
													<div class="dropdown__popup">
    <ul class="space-y-10">
        <li>
	
            <a href="#" class="report-link space-x-10 d-flex" data-displayed-user-id="<?php echo $displayedUserId; ?>">
                <i class="ri-flag-line"></i>
                <span> Report </span>
            </a>
        </li>
    </ul>
</div>
<?php } ?>

												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-3 col-md-7 order-md-0 order-1">
						<div class="profile__sidebar">
							<div class="space-y-40">
								<div class="space-y-10">
									<h5>Bio</h5>
									<div class="box space-y-20">
										<p>
										<?php echo $bio?>
										</p>
										<!-- <div class="row">
											<div class="col-6">
												<span class="txt_sm color_text">Collections</span>
												<h4>105</h4>
											</div>
											<div class="col-6">
												<span class="txt_sm color_text">Creations</span>
												<h4>406</h4>
											</div>
										</div> -->
									</div>
								</div>
								<div class="space-y-10">
									<h5>Follow me</h5>
									<div class="box">
										<ul class="social_profile space-y-10 overflow-hidden">
											<li>
												<a href="#">
													<i class="ri-facebook-line"></i>
													<span class="color_text">facebook/</span>
													@creabik
												</a>
											</li>
											<li>
												<a href="#">
													<i class="ri-messenger-line"></i>
													<span class="color_text"> messenger/</span>
													@creabik
												</a>
											</li>
											<li>
												<a href="#">
													<i class="ri-whatsapp-line"></i>
													<span class="color_text"> whatsapp/</span>
													@creabik
												</a>
											</li>
											<li>
												<a href="#">
													<i class="ri-youtube-line"></i>
													<span class="color_text">youtube/</span>
													@creabik
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<!-- <p class="text-center txt_sm mt-20 color_text">Since 2021</p> -->
						</div>
					</div>
					<div class="col-lg-9 col-md-12 order-md-1 order-0">
						<div class="profile__content">
							<div class=" justify-content-between">
								<div class="space-x-10">
									<div class="d-flex justify-content-between">
										<ul class="nav nav-tabs d-flex space-x-10 mb-30"
											role="tablist">
											<li class="nav-item">
												<a
													class="btn btn-white btn-sm active"
													data-toggle="tab"
													href="#tabs-1"
													role="tab">
													Tickets Achete</a>
											</li>
											 <li class="nav-item">
												<a
													class="btn btn-white btn-sm"
													data-toggle="tab"
													href="#tabs-2"
													role="tab">
													Tickets Vendu</a>
											</li> 
										</ul>
										<!-- Tab panes -->
										<div class="dropdown d-none d-sm-block">
											<button
												class="btn btn-white btn-sm dropdown-toggle"
												type="button"
			
												data-toggle="dropdown"
												aria-haspopup="true"
												aria-expanded="false">
												Recent Active
											</button>
											<div
												class="dropdown-menu">
												<a class="dropdown-item" href="#">Action</a>
												<a class="dropdown-item" href="#">Another
													action</a>
												<a class="dropdown-item" href="#">SomDHing
													else here</a>
											</div>
										</div>
									</div>
									<div class="tab-content">
									<div class="tab-pane active" id="tabs-1" role="tabpanel">
											
									<div class="row mb-30_reset">
									<?php
include "db_connect.php"; // Include the database connection file

// Define meal times for each meal type
$mealTypeToTime = [
    'Petit-déjeuner' => '07:00:00',  // 7:00 AM
    'Déjeuner' => '12:30:00',         // 12:30 PM
    'diner' => '18:30:00'             // 6:30 PM
    // Add more meal types and corresponding meal times here
];

// Form submission and handling
// $filterSold = isset($_POST['filter_sold']) ? $_POST['filter_sold'] : false;
// $filterAvailable = isset($_POST['filter_available']) ? $_POST['filter_available'] : false;

// $sql = "SELECT t.*, u.* FROM tickets t
//         INNER JOIN users u ON t.seller_user_id = u.user_id";
$userID = isset($_GET['user_id']) ? $_GET['user_id'] : null;
$selectQuery = "SELECT t.*, pt.purchase_date, u.username AS seller_username 
                FROM purchasehistory pt
                JOIN tickets t ON pt.ticket_id = t.ticket_id
                JOIN users u ON t.seller_user_id = u.user_id
                WHERE pt.buyer_user_id = ?";
$stmt = $conn->prepare($selectQuery);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();		

// if ($filterSold && !$filterAvailable) {
//     $sql .= " WHERE t.availability = 0";
// } elseif (!$filterSold && $filterAvailable) {
//     $sql .= " WHERE t.availability = 1";
// }

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mealType = $row['meal_type'];
        $imagePath = 'assets/img/meals/';
		$bc=$row['buyer_confirmed'];

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

        echo '<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
            <div class="card__item four">
                <div class="card_body space-y-10">
                    <!-- =============== -->
                    <div class="creators space-x-10">
                        <div class="avatars space-x-3">
                            <a href="Profile.html">
                                <img src="assets/img/avatars/avatar_1.png" alt="Avatar" class="avatar avatar-sm">
                            </a>
                            <a href="Profile.html">
                                <p class="avatars_name txt_xs"> Vendu PAR:' . $row['seller_username'] . '</p>
                            </a>
                        </div>
                    </div>
                    <div class="card_head">
                        <a href="#">
                            <img src="' . $fullImagePath . '" alt="' . $mealType . '">
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
                        <div class="d-flex align-items-center space-x-10 justify-content-between">
                            <div class="auction_end">
                                <p class="color_text txt">Date:</p>
                                <div class="d-flex justify-content-center align-items-center space-x-10 txt_lg _bold">
                                    <div class="item">
                                        <div >' . $mealDate . '<span></span></div>
                                    </div>
                                  
                                </div>
                            </div>';
                            
							if ( $bc== 0) {
								echo'<button class="btn btn-orange confirm-button" data-ticket-id="' . $row['ticket_id'] . '" onclick="confirmPurchase(' . $row['ticket_id'] . ')">
								Confirm Purchase </button>';
							} else {
								echo'<button class="btn btn-orange confirmed-label">Confirmed</button>';
							}
							
							
							
						   
    echo                   ' </div>
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
			                        <form action="purchase.php" mDHod="post">
			                            <input type="hidden" name="ticket_id" value="' . $row['ticket_id'] . '">
			                            <input type="hidden" name="amount" value="' . ($row['price'] + 0.01) . '">
			                            <button type="submit" class="btn btn-primary w-full"> Acheter Ticket</button>
										
			                        </form>
			                    </div>
			                </div>
			            </div>
			        </div>';
    }
} else {
    echo "No tickets found.";
}

$conn->close();
?>



									
</div>
                            </div> 
							<div class="tab-pane " id="tabs-2" role="tabpanel">
							<div class="row mb-30_reset">
    <!-- Fetch and display the tickets that the user has sold -->
    <?php
	include "db_connect.php"; 
	$userIDD=$_SESSION['user_id'];
    $selectSoldQuery = "SELECT t.*, pt.purchase_date, u.username AS buyer_username 
                        FROM purchasehistory pt
                        JOIN tickets t ON pt.ticket_id = t.ticket_id
                        JOIN users u ON pt.buyer_user_id = u.user_id
                        WHERE t.seller_user_id = ?";
    $stmtSold = $conn->prepare($selectSoldQuery);
    $stmtSold->bind_param("i", $userIDD);
    $stmtSold->execute();
    $resultSold = $stmtSold->get_result();

    if ($resultSold->num_rows > 0) {
        while ($rowSold = $resultSold->fetch_assoc()) {
			$mealType = $rowSold['meal_type'];
			$imagePath = 'assets/img/meals/';
			$bc=$rowSold['buyer_confirmed'];
	
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
	
			// Get meal date and time
			$mealDate = $rowSold['meal_date'];
			$mealTime = $mealTypeToTime[$mealType];
			$auctionEndTime = date('Y-m-d H:i:s', strtotime("$mealDate $mealTime") - 3600);
	
			// Calculate remaining time for auction end
			$currentTime = time();
			$diff = strtotime($auctionEndTime) - $currentTime;
			$hours = floor($diff / 3600);
			$minutes = floor(($diff % 3600) / 60);
			$seconds = $diff % 60;
	
			echo '<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
				<div class="card__item four">
					<div class="card_body space-y-10">
						<!-- =============== -->
						<div class="creators space-x-10">
							<div class="avatars space-x-3">
								<a href="Profile.html">
									<img src="assets/img/avatars/avatar_1.png" alt="Avatar" class="avatar avatar-sm">
								</a>
								<a href="Profile.html">
									<p class="avatars_name txt_xs"> Achete PAR:' . $rowSold['buyer_username'] . '</p>
								</a>
							</div>
						</div>
						<div class="card_head">
							<a href="#">
								<img src="' . $fullImagePath . '" alt="' . $mealType . '">
							</a>
							
						</div>
						<!-- =============== -->
						<h6 class="card_title">' . $mealType . '</h6>
						<div class="card_footer d-block space-y-10">
							<div class="card_footer justify-content-between">
								<a href="#" class="">
									<p class="txt_sm">Prix: <span class="color_green txt_sm">' . $rowSold['price'] . ' DH</span></p>
								</a>
							</div>
							<div class="hr"></div>
							<div class="d-flex align-items-center space-x-10 justify-content-between">
								<div class="auction_end">
									<p class="color_text txt">Date:</p>
									<div class="d-flex justify-content-center align-items-center space-x-10 txt_lg _bold">
										<div class="item">
											<div >' . $mealDate . '<span></span></div>
										</div>
									  
									</div>
								</div>';
								
								if ( $bc== 0) {
									echo'<button class="btn btn-orange confirm-button" >
									En Attente</button>';
								} else {
									echo'<button class="btn btn-orange confirmed-label">Confirmed</button>';
								}
								
								
								
							   
		echo                   ' </div>
						</div>
					</div>
				</div>
			</div>';
			
			echo '<div class="modal fade popup" id="popup_bid_' . $rowSold['ticket_id'] . '" tabindex="-1" role="dialog"
							aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<button type="button" class="close" data-dismiss="modal"
										aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<div class="modal-body space-y-20 p-40">
										<h3>Acheter Ticket</h3>
										<p>Valider Votre commande de <span class="color_black">' . $rowSold['meal_type'] . '</span> Le <span class="color_black">' . $rowSold['meal_date'] . '</span>
										</p>
										<p>laisser un message au vendeur<span class="color_green">(Optional)</span>
										</p>
										<input type="text" class="form-control"
											value="" placeholder="Message">
										<div class="hr"></div>
										<div class="d-flex justify-content-between">
											<p> Subtotal:</p>
											<p class="text-right color_black txt _bold">' .$rowSold['price'] .' DH </p>
										</div>
										<div class="d-flex justify-content-between">
											<p> service free:</p>
											<p class="text-right color_black txt _bold"> 0.01 DH </p>
										</div>
										<div class="d-flex justify-content-between">
											<p> Total :</p>
											<p class="text-right color_black txt _bold"> '. ($rowSold['price'] + 0.01) .' DH </p>
										</div>
										<form action="purchase.php" mDHod="post">
											<input type="hidden" name="ticket_id" value="' . $rowSold['ticket_id'] . '">
											<input type="hidden" name="amount" value="' . ($rowSold['price'] + 0.01) . '">
											<button type="submit" class="btn btn-primary w-full"> Acheter Ticket</button>
											
										</form>
									</div>
								</div>
							</div>
						</div>';
        }
    } else {
        echo "No sold tickets foundD.";
    }

    $conn->close();
    ?>
</div>
</div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
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
    var displayedUserId = <?php echo $displayedUserId; ?>;
    var followButton = $(".follow-toggle-button");

    // Function to update the button text and style
    function updateFollowButton(isFollowing) {
        if (isFollowing) {
            followButton.text("Unfollow");
            followButton.removeClass("btn-dark").addClass("btn-danger");
        } else {
            followButton.text("Follow");
            followButton.removeClass("btn-danger").addClass("btn-dark");
        }
    }

    // Check initial follow status
    $.ajax({
        type: "POST",
        url: "check_follow_status.php",
        data: { displayedUserId: displayedUserId },
        dataType: "json",
        success: function(response) {
            var isFollowing = response.isFollowing;
            updateFollowButton(isFollowing);
        }
    });

    // Follow/Unfollow button click event
    followButton.click(function() {
        var isFollowing = followButton.text() === "Unfollow";

        $.ajax({
            type: "POST",
            url: isFollowing ? "unfollow.php" : "follow.php",
            data: { displayedUserId: displayedUserId },
            success: function(response) {
                updateFollowButton(!isFollowing);
            }
        });
    });
});

</script>




<script>
// Assuming you're using jQuery for simplicity
$(".report-link").on("click", function(event) {
    event.preventDefault();

    const displayedUserId = $(this).data("displayed-user-id");

    // Make an AJAX request to report_user.php
    $.ajax({
        url: "report.php",
        method: "POST",
        data: {
            displayedUserId: displayedUserId
            // You can add more data here if needed
        },
        success: function(response) {
            // Handle the response (e.g., display a success message)
        },
        error: function(xhr, status, error) {
            // Handle errors
        }
    });
});

</script>
<script>
        $(document).ready(function () {
            $('.confirm-button').on('click', function () {
                const ticketId = $(this).data('ticket-id');
                
                // Show confirmation dialog
                const isConfirmed = confirm('Are you sure you want to confirm this purchase?');
                if (isConfirmed) {
                    // Send AJAX request to update confirmation status
                    $.ajax({
                        url: 'confirm_purchase.php', // Replace with your PHP endpoint
                        method: 'POST',
                        data: { ticketId: ticketId },
                        success: function (response) {
                            // Reload the page
                            location.reload();
                        },
                        error: function (error) {
                            // Handle error
                            alert('An error occurred. Please try again later.');
                        }
                    });
                }
            });
        });
    </script>
	</body>
</html>