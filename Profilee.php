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
$sql = "SELECT username,email,bio FROM Users WHERE user_id = ?";
$stmt = $conn->prepare($sql); // Use $conn from your connection file
$stmt->bind_param("i", $userId); // "i" for integer, bind the parameter
$stmt->execute();
$result = $stmt->get_result();

// Fetch the username from the result
$row = $result->fetch_assoc();
$username = $row['username'];
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
		<title> - Profile </title>
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
			                        _bold">(16ETH) </span> has been listing
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
			                <p>You must bid at least <span class="color_black">15 ETH</span>
			                </p>
			                <input type="text" class="form-control"
			                    placeholder="00.00 ETH">
			
			                <p>Enter quantity. <span class="color_green">5 available</span>
			                </p>
			                <input type="text" class="form-control"
			                    value="1">
			                <div class="hr"></div>
			                <div class="d-flex justify-content-between">
			                    <p> You must bid at least:</p>
			                    <p class="text-right color_black txt _bold"> 67,000 ETH </p>
			                </div>
			                <div class="d-flex justify-content-between">
			                    <p> service free:</p>
			                    <p class="text-right color_black txt _bold"> 0,901 ETH </p>
			                </div>
			                <div class="d-flex justify-content-between">
			                    <p> Total bid amount:</p>
			                    <p class="text-right color_black txt _bold"> 56,031 ETH </p>
			                </div>
			                <a href="" class="btn btn-primary w-full"
			                    data-toggle="modal"
			                    data-target="#popup_bid_success"
			                    data-dismiss="modal"
			                    aria-label="Close"> Place a bid</a>
			            </div>
			        </div>
			    </div>
			</div><!-- ====== header -->
			<header class="header__1 js-header">
				<div class="container">
					<div class="wrapper js-header-wrapper space-x-10">
						<div class="header__logo">
							<a href="/">
								<img
									class="header__logo"
									id="logo_js"
									src="assets/img/logos/Logo.svg"
									alt="logo"
									/>
							</a>
						</div>
						<!-- ==================  -->
						<div class="header__menu">
							<ul class="d-flex space-x-20">
								<li class="has_popup">
									<a class="color_black" href="#">Homes <i class="ri-more-2-fill"></i></a>
									<ul class="menu__popup space-y-20">
										<li>
											<a href="Home1.html">
												<i class="ri-home-smile-2-line"></i>
												Home page 1
											</a>
										</li>
										<li>
											<a href="Home2.html">
												<i class="ri-home-2-line"></i> Home page 2</a>
										</li>
										<li>
											<a href="Home3.html">
												<i class="ri-home-5-line"></i> Home page 3</a>
										</li>
									</ul>
								</li>
								<li> <a class="color_black" href="Marketplace.html"> Marketplace</a> </li>
								<li> <a class="color_black" href="Collections.html"> Collections</a> </li>
								<li> <a class="color_black" href="Profile.html"> Profile</a> </li>
								<li> <a class="color_black" href="Creators.html"> Creators</a> </li>
								<li> <a class="color_black" href="kit.html"> Ui Kit </a> </li>
								<li class="has_popup2">
									<a class="color_black is_new" href="#">Pages <i class="ri-more-2-fill"></i></a>
									<ul class="menu__popup2 space-y-20">
										<div class="row sub_menu_row">
										
											<div class="col-lg-6 space-y-10">
												<!-- =============== -->
												<li>
													<a href="Activity.html">
														<i class="ri-line-chart-line"></i>
														Activity
													</a>
												</li>
												<!-- =============== -->
												<li>
													<a class="is_new" href="edit_profile.html">
														<i class="ri-edit-line"></i>
														Edit Profile
													</a>
												</li>
										
												<!-- =============== -->
												<li>
													<a href="Item-details.html">
														<i class="ri-gallery-line"></i>
														Item details
													</a>
												</li>
												<!-- =============== -->
												<li>
													<a class="is_new" href="Live_Auctions.html">
														<i class="ri-auction-line"></i>
														Live Auctions
													</a>
												</li>
												<!-- =============== -->
												<li>
													<a href="Upcoming_projects.html">
														<i class="ri-upload-line"></i>
														Upcoming projects
													</a>
												</li>
												<!-- =============== -->
												<li>
													<a class="is_new" href="ranking.html">
														<i class="ri-funds-line"></i>
														Ranking
													</a>
												</li>
										
												<!-- =============== -->
												<li>
													<a class="is_new" href="newsletter.html">
														<i class="ri-mail-open-line"></i>
														Newsletter
													</a>
												</li>
												<!-- =============== -->
												<li>
													<a href="forum.html">
														<i class="ri-discuss-line"></i>
														Forum & community
													</a>
												</li>
												<!-- =============== -->
												<li>
													<a href="post_details.html">
														<i class="ri-chat-check-line"></i>
														Forum details
													</a>
												</li>
										
												<!-- =============== -->
												<li>
													<a href="no_results.html">
														<i class="ri-file-search-line"></i>
														No Result
													</a>
												</li>
										
												<!-- =============== -->
												<li>
													<a class="is_new" href="Contact.html">
														<i class="ri-customer-service-2-line"></i>
														Contact
													</a>
												</li>
										
											</div>
										
										
										
										
										
										
										
											<div class="col-lg-6 space-y-10">
										
												<!-- =============== -->
												<li>
													<a href="Upload-type.html">
														<i class="ri-upload-line"></i>
														Upload Types
													</a>
												</li>
												<!-- =============== -->
												<li>
													<a href="Connect-wallet.html">
														<i class="ri-wallet-3-line"></i>
														Connect wallet
													</a>
												</li>
										
												<!-- =============== -->
												<li>
													<a href="questions.html">
														<i class="ri-question-line"></i>
														FAQ
													</a>
												</li>
												<!-- =============== -->
												<li>
													<a class="is_new" href="Submit_request.html">
														<i class="ri-share-forward-line"></i>
														Submit request
													</a>
												</li>
												<!-- =============== -->
												<li>
													<a class="is_new" href="Submit_request.html">
														<i class="ri-message-3-line"></i>
														Request chat
													</a>
												</li>
												<!-- =============== -->
												<li>
													<a class="is_new" href="blog.html">
														<i class="ri-layout-line"></i>
														Blog
													</a>
												</li>
												<!-- =============== -->
												<li>
													<a class="is_new" href="article.html">
														<i class="ri-newspaper-line"></i>
														Article
													</a>
												</li>
												<!-- =============== -->
												<li>
													<a href="register.html">
														<i class="ri-lock-line"></i>
														Register
													</a>
												</li>
												<!-- =============== -->
												<li>
													<a href="login.html">
														<i class="ri-shield-user-line"></i>
														Login
													</a>
												</li>
												<!-- =============== -->
												<li>
													<a href="Privacy.html">
														<i class="ri-file-text-line"></i>
														Privacy Policy
													</a>
												</li>
												<!-- =============== -->
												<li>
													<a c href="404.html">
														<i class="ri-file-damage-line"></i>
														404
													</a>
												</li>
											</div>
										</div>						</ul>
								</li>
							</ul>
						</div>
						<!-- ================== -->
						<div class="header__search">
							<input type="text" placeholder="Search" />
							<button class="header__result">
								<i class="ri-search-line"></i>
							</button>
						</div>
						<div class="d-flex align-items-center space-x-20">
							<div class="header__notifications">
								<div class="js-notifications-icon">
									<i class="ri-notification-3-line"></i>
								</div>
								<div class="notifications_popup space-y-20">
									<div class="d-flex justify-content-between">
										<h5> Notifications</h5>
										<a href="Activity.html" class="badge color_white">View all</a>
									</div>
									<div
										class="item
										space-x-20
										d-flex
										justify-content-between
										align-items-center">
										<img
											class="thumb"
											src="assets/img/notifications/1.png"
											alt="..."
											/>
										<div class="details">
											<a href="activity.html"> <h6>Money revieved</h6> </a>
											<p>0.6 ETH</p>
										</div>
										<span class="circle"></span>
									</div>
								</div>
							</div>
							<div class="header__avatar">
								<div class="price">
									<span>2.45 <strong>ETH</strong> </span>
								</div>
								<img
									class="avatar"
									src="assets/img/avatars/avatar_2.png"
									alt="avatar"
									/>
								<div class="avatar_popup space-y-20">
									<div class="d-flex align-items-center justify-content-between">
										<span> 13b9ebda035r178... </span>
										<a href="/" class="ml-2">
											<i class="ri-file-copy-line"></i>
										</a>
									</div>
									<div class="d-flex align-items-center space-x-10">
										<img
											class="coin"
											src="assets/img/logos/coin.svg"
											alt="/"
											/>
										<div class="info">
											<p class="text-sm font-book text-gray-400">Balance</p>
											<p class="w-full text-sm font-bold text-green-500">16.58 ETH</p>
										</div>
									</div>
									<div class="hr"></div>
									<div class="links space-y-10">
										<a href="#">
											<i class="ri-landscape-line"></i> <span> My items</span>
										</a>
										<a href="edit_profile.html">
											<i class="ri-pencil-line"></i> <span> Edit Profile</span>
										</a>
										<a href="#">
											<i class="ri-logout-circle-line"></i> <span> Logout</span>
										</a>
									</div>
								</div>
							</div>
							<div class="header__btns">
								<a class="btn btn-primary btn-sm" href="Upload-type.html">Create</a>
							</div>
							<div class="header__burger js-header-burger"></div>
						</div>
						<div class="header__mobile js-header-mobile">
							<div class="header__mobile__menu space-y-40">
								<ul class="d-flex space-y-20">
									<li> <a class="color_black" href="Marketplace.html"> Marketplace</a> </li>
									<li> <a class="color_black" href="Collections.html"> Collections</a> </li>
									<li> <a class="color_black" href="Profile.html"> Profile</a> </li>
									<li> <a class="color_black" href="Creators.html"> Creators</a> </li>
						
								</ul>
								<div class="space-y-20">
									<div class="header__search in_mobile w-full">
										<input type="text" placeholder="Search" />
										<button class="header__result">
											<i class="ri-search-line"></i>
										</button>
									</div>
									<a class="btn btn-grad btn-sm" href="Connect-wallet.html">Connect
										wallet</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>
			 
			<div class="mb-100">
				<div class="hero__profile">
					<div class="cover">
						<img src="assets/img/bg/prrofile.png" alt="">
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
										</div>
										<h5>@ayoub fennouni</h5>
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
											<div class="mb-20">
												<a href="btn" class="btn btn-dark btn-sm">
													Follow
												</a>
			
											</div>
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
																<a href="#"
																	class="space-x-10
																	d-flex">
																	<i class="ri-flag-line"></i>
																	<span> Report </span>
																</a>
															</li>
														</ul>
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
			</div>
			
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-3 col-md-7 order-md-0 order-1">
						<div class="profile__sidebar">
							<div class="space-y-40">
								<div class="space-y-10">
									<h5>About me</h5>
									<div class="box space-y-20">
										<p>
											I make art with the simple goal of giving you
											something
											pleasing to look at for a few seconds.
										</p>
										<div class="row">
											<div class="col-6">
												<span class="txt_sm color_text">Collections</span>
												<h4>105</h4>
											</div>
											<div class="col-6">
												<span class="txt_sm color_text">Creations</span>
												<h4>406</h4>
											</div>
										</div>
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
							<div class="d-flex justify-content-between">
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
													Creations</a>
											</li>
											<!-- <li class="nav-item">
												<a
													class="btn btn-white btn-sm"
													data-toggle="tab"
													href="#tabs-2"
													role="tab">
													Collections</a>
											</li> -->
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
												<a class="dropdown-item" href="#">Something
													else here</a>
											</div>
										</div>
									</div>
			
									<div class="tab-content">
										<div class="tab-pane active" id="tabs-1"
											role="tabpanel">
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
												$userID = $_SESSION['user_id'];
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
																		<a href="Item-details.html">
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
																				<p class="color_text txt">AUCTION END</p>
																				<div class="d-flex justify-content-center align-items-center space-x-10 txt_lg _bold">
																					<div class="item">
																						<div class="number hours">' . $hours . '<span></span></div>
																					</div>
																					<div class="dots">:</div>
																					<div class="item">
																						<div class="number minutes">' . $minutes . '<span></span></div>
																					</div>
																					<div class="dots">:</div>
																					<div class="item">
																						<div class="number seconds">' . $seconds . '<span></span></div>
																					</div>
																				</div>
																			</div>
																			
																	<a class="btn btn-orange" href="#">Vendu</a>
																		</div>
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
																					<form action="purchase.php" method="post">
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
										<div class="tab-pane" id="tabs-2" role="tabpanel">
											<div class="row justify-content-center mb-30_reset">
												<div class="col-lg-6 col-md-6 col-sm-8">
													<div class="collections space-y-10 mb-30">
														<div class="collections_item">
															<div class="images-box space-y-10">
																<div class="d-flex space-x-10">
																	<img style="width: 33.33%;"
																		src="assets/img/items/item_1.png"
																		alt="">
																	<img style="width: 33.33%;"
																		src="assets/img/items/item_2.png"
																		alt="">
																	<img style="width: 33.33%;"
																		src="assets/img/items/item_3.png"
																		alt="">
																</div>
																<div>
																	<img src="assets/img/items/item_4.png"
																		alt="">
																</div>
															</div>
														</div>
														<div class="collections_footer justify-content-between">
															<h5 class="collection_title"><a href="Profile.html">Creative Art collection
																</a></h5>
															<a href="#" class="likes space-x-3">
																<i class="ri-heart-3-fill"></i>
																<span class="txt_md">2.1k</span>
															</a>
														</div>
														<div class="creators space-x-10">
															<span class="color_text txt_md"> 5 items · Created by</span>
															<div class="avatars space-x-5">
																<a href="Profile.html">
																	<img
																		src="assets/img/avatars/avatar_1.png"
																		alt="Avatar" class="avatar avatar-sm">
																</a>
															</div>
															<a href="Profile.html">
																<p class="avatars_name txt_sm"> @william_jamy... </p>
															</a>
														</div>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-8">
													<div class="collections space-y-10 mb-30">
														<div class="collections_item">
															<div class="images-box space-y-10">
																<div class="d-flex space-x-10">
																	<img style="width: 33.33%;"
																		src="assets/img/items/item_5.png"
																		alt="">
																	<img style="width: 33.33%;"
																		src="assets/img/items/item_6.png"
																		alt="">
																	<img style="width: 33.33%;"
																		src="assets/img/items/item_7.png"
																		alt="">
																</div>
																<div>
																	<img src="assets/img/items/item_8.png"
																		alt="">
																</div>
															</div>
														</div>
														<div class="collections_footer justify-content-between">
															<h5 class="collection_title"><a href="Profile.html">Colorful Abstract collection
																</a></h5>
															<a href="#" class="likes space-x-3">
																<i class="ri-heart-3-fill"></i>
																<span class="txt_md">3.5k</span>
															</a>
														</div>
														<div class="creators space-x-10">
															<span class="color_text txt_md"> 7 items · Created by</span>
															<div class="avatars space-x-5">
																<a href="Profile.html">
																	<img
																		src="assets/img/avatars/avatar_2.png"
																		alt="Avatar" class="avatar avatar-sm">
																</a>
															</div>
															<a href="Profile.html">
																<p class="avatars_name txt_sm"> @alexis_fenn... </p>
															</a>
														</div>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-8">
													<div class="collections space-y-10 mb-30">
														<div class="collections_item">
															<div class="images-box space-y-10">
																<div class="d-flex space-x-10">
																	<img style="width: 33.33%;"
																		src="assets/img/items/item_2.png"
																		alt="">
																	<img style="width: 33.33%;"
																		src="assets/img/items/item_6.png"
																		alt="">
																	<img style="width: 33.33%;"
																		src="assets/img/items/item_3.png"
																		alt="">
																</div>
																<div>
																	<img src="assets/img/items/item_7.png"
																		alt="">
																</div>
															</div>
														</div>
														<div class="collections_footer justify-content-between">
															<h5 class="collection_title"><a href="Profile.html">Photography Art collection
																</a></h5>
															<a href="#" class="likes space-x-3">
																<i class="ri-heart-3-fill"></i>
																<span class="txt_md">7.2k</span>
															</a>
														</div>
														<div class="creators space-x-10">
															<span class="color_text txt_md"> 2 items · Created by</span>
															<div class="avatars space-x-5">
																<a href="Profile.html">
																	<img
																		src="assets/img/avatars/avatar_3.png"
																		alt="Avatar" class="avatar avatar-sm">
																</a>
															</div>
															<a href="Profile.html">
																<p class="avatars_name txt_sm"> @Joshua_Bren... </p>
															</a>
														</div>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-8">
													<div class="collections space-y-10 mb-30">
														<div class="collections_item">
															<div class="images-box space-y-10">
																<div class="d-flex space-x-10">
																	<img style="width: 33.33%;"
																		src="assets/img/items/item_1.png"
																		alt="">
																	<img style="width: 33.33%;"
																		src="assets/img/items/item_2.png"
																		alt="">
																	<img style="width: 33.33%;"
																		src="assets/img/items/item_3.png"
																		alt="">
																</div>
																<div>
																	<img src="assets/img/items/item_4.png"
																		alt="">
																</div>
															</div>
														</div>
														<div class="collections_footer justify-content-between">
															<h5 class="collection_title"><a href="Profile.html">Fantasy Art collection
																</a></h5>
															<a href="#" class="likes space-x-3">
																<i class="ri-heart-3-fill"></i>
																<span class="txt_md">2.1k</span>
															</a>
														</div>
														<div class="creators space-x-10">
															<span class="color_text txt_md"> 5 items · Created by</span>
															<div class="avatars space-x-5">
																<a href="Profile.html">
																	<img
																		src="assets/img/avatars/avatar_4.png"
																		alt="Avatar" class="avatar avatar-sm">
																</a>
															</div>
															<a href="Profile.html">
																<p class="avatars_name txt_sm"> @william_jamy... </p>
															</a>
														</div>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-8">
													<div class="collections space-y-10 mb-30">
														<div class="collections_item">
															<div class="images-box space-y-10">
																<div class="d-flex space-x-10">
																	<img style="width: 33.33%;"
																		src="assets/img/items/item_5.png"
																		alt="">
																	<img style="width: 33.33%;"
																		src="assets/img/items/item_6.png"
																		alt="">
																	<img style="width: 33.33%;"
																		src="assets/img/items/item_7.png"
																		alt="">
																</div>
																<div>
																	<img src="assets/img/items/item_8.png"
																		alt="">
																</div>
															</div>
														</div>
														<div class="collections_footer justify-content-between">
															<h5 class="collection_title"><a href="Profile.html">Pop Art collection
																</a></h5>
															<a href="#" class="likes space-x-3">
																<i class="ri-heart-3-fill"></i>
																<span class="txt_md">3.5k</span>
															</a>
														</div>
														<div class="creators space-x-10">
															<span class="color_text txt_md"> 7 items · Created by</span>
															<div class="avatars space-x-5">
																<a href="Profile.html">
																	<img
																		src="assets/img/avatars/avatar_5.png"
																		alt="Avatar" class="avatar avatar-sm">
																</a>
															</div>
															<a href="Profile.html">
																<p class="avatars_name txt_sm"> @alexis_fenn... </p>
															</a>
														</div>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-8">
													<div class="collections space-y-10 mb-30">
														<div class="collections_item">
															<div class="images-box space-y-10">
																<div class="d-flex space-x-10">
																	<img style="width: 33.33%;"
																		src="assets/img/items/item_2.png"
																		alt="">
																	<img style="width: 33.33%;"
																		src="assets/img/items/item_6.png"
																		alt="">
																	<img style="width: 33.33%;"
																		src="assets/img/items/item_3.png"
																		alt="">
																</div>
																<div>
																	<img src="assets/img/items/item_7.png"
																		alt="">
																</div>
															</div>
														</div>
														<div class="collections_footer justify-content-between">
															<h5 class="collection_title"><a href="Profile.html">Contemporary Art collection
																</a></h5>
															<a href="#" class="likes space-x-3">
																<i class="ri-heart-3-fill"></i>
																<span class="txt_md">7.2k</span>
															</a>
														</div>
														<div class="creators space-x-10">
															<span class="color_text txt_md"> 2 items · Created by</span>
															<div class="avatars space-x-5">
																<a href="Profile.html">
																	<img
																		src="assets/img/avatars/avatar_6.png"
																		alt="Avatar" class="avatar avatar-sm">
																</a>
															</div>
															<a href="Profile.html">
																<p class="avatars_name txt_sm"> @Joshua_Bren... </p>
															</a>
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
				</div>
			</div>
			
			<footer class="footer__1">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 space-y-20">
							<div class="footer__logo">
								<a href="/">
									<img src="assets/img/logos/Logo.svg" alt="logo" id="logo_js_f">
								</a>
							</div>
							<p class="footer__text">
								raroin is a shared liquidity NFT market smart contract
							</p>
							<div>
								<ul class="footer__social space-x-10 mb-40">
									<li> <a href=""> <i class="ri-facebook-line"></i> </a>
									</li>
									<li> <a href=""> <i class="ri-messenger-line"></i> </a>
									</li>
									<li> <a href=""> <i class="ri-whatsapp-line"></i> </a>
									</li>
									<li> <a href=""> <i class="ri-youtube-line"></i> </a>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-lg-2 col-6">
							<h6 class="footer__title">Raroin</h6>
							<ul class="footer__list">
								<li> <a href="Home1.html"> Home1 </a>
								</li>
								<li> <a href="Home2.html"> Home2
									</a> </li>
								<li> <a href="Home3.html"> Home3 </a> </li>
								<li> <a href="Marketplace.html"> Marketplace
									</a>
								</li>
							</ul>
						</div>
						<div class="col-lg-2 col-6">
							<h6 class="footer__title">Assets</h6>
							<ul class="footer__list">
								<li> <a href="Profile.html"> Profile </a>
								</li>
								<li> <a href="Creators.html"> Creators </a>
								</li>
								<li> <a href="Collections.html"> Colletctions </a>
								</li>
								<li> <a href="Activity.html"> Activity
									</a> </li>
							</ul>
						</div>
						<div class="col-lg-2 col-6">
							<h6 class="footer__title">Company</h6>
							<ul class="footer__list">
								<li> <a href="Upload-type.html"> Upload Types </a>
								</li>
								<li> <a href="Upload.html"> Upload </a> </li>
								<li> <a href="Connect-wallet.html"> Connect wallet
									</a> </li>
								<li> <a href="Item-details.html"> Item details </a>
								</li>
							</ul>
						</div>
					</div>
					<p class="copyright text-center">
						Copyright © 2021. Created with love by creabik.
					</p>
				</div>
			</footer>
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
		
	</body>
</html>