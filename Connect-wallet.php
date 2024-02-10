<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header('Location: login.php');
    exit();}
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
		<title> - wallets </title>
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
			
			<!-- ====== header -->
			<?php
include "header.php";
?>
			<div class="modal fade popup" id="popup_connected" tabindex="-1" role="dialog"
			    aria-hidden="true">
			    <div class="modal-dialog modal-dialog-centered" role="document">
			        <div class="modal-content">
			            <button type="button" class="close" data-dismiss="modal"
			                aria-label="Close">
			                <span aria-hidden="true">&times;</span>
			            </button>
			            <div class="modal-body space-y-20 p-40">
			                <h3 class="text-center">WhatsApp!</h3>
			                <p class="text-center">Pour recharger votre compte, veuillez contacter notre service clientèle via WhatsApp au 0624563048. Nous sommes là pour vous aider !</p>
			                <div class="d-flex justify-content-center space-x-20">
			                    <a href="#" data-dismiss="modal" class="btn btn-dark">
			                        Close</a>
			                    <a href="https://api.whatsapp.com/send?phone=+212624563048" class="btn btn-grad"> Contact Number</a>
			                </div>
			            </div>
			        </div>
			    </div>
			</div><div class="modal fade popup" id="popup_error" tabindex="-1" role="dialog"
			    aria-hidden="true">
			    <div class="modal-dialog modal-dialog-centered" role="document">
			        <div class="modal-content">
			            <button type="button" class="close" data-dismiss="modal"
			                aria-label="Close">
			                <span aria-hidden="true">&times;</span>
			            </button>
			            <div class="modal-body space-y-20 p-40">
			                <h3 class="color_red">Error!</h3>
			                <p>User rejected the request.. <br>
			                    If the problem persist please Contact support</p>
			
			                <a href="" class="btn btn-primary"> Try again</a>
			            </div>
			        </div>
			    </div>
			</div><div class="effect">
				<div class="container">
					 <a href="Marketplace.php" class="btn btn-white btn-sm mt-20">
						Back to home</a>
					<div class="hero__wallets pt-100 pb-50">
						<div class="space-y-20 d-flex flex-column align-items-center">
							<div class="logo">
								<img src="assets/img/icons/logo.svg" alt="">
							</div>
							<h2 class="text-center">Charge your wallet</h2>
							<p class="text-center">Connect with one of available wallet
								providers or create a new wallet.
							</p>
						</div>
					</div>		<div class="row justify-content-center">
						<div class="col-lg-9">
							<div class="wallets">
								<div class="row mb-20_reset">
									<!-- ================= item -->
									<div class="col-lg-4">
										<a href="#" class="box in__wallet space-y-10"
											data-toggle="modal"
											data-target="#popup_connected">
											<div class="logo">
												<img
													src="assets/img/icons/WhatsApp.svg"
													alt="logo_community">
											</div>
											<h5 class="text-center">whatsapp</h5>
											<p class="text-center">Faite Charger votre account a travers l'un de nos agents </p>
										</a>
									</div>
									<!-- ================= item -->
									<div class="col-lg-4">
										<a href="#" class="box in__wallet space-y-10"
											data-toggle="modal"
											data-target="#popup_error">
											<div class="logo">
												<img
													src="assets/img/icons/cih.svg"
													alt="logo_community">
											</div>
											<h5 class="text-center">CIH</h5>
											<p class="text-center">Under Maintenance</p>
										</a>
									</div>
									<!-- ================= item -->
									<!-- <div class="col-lg-4">
										<a href="#" class="box in__wallet space-y-10"
											data-toggle="modal"
											data-target="#popup_connected">
											<div class="logo">
												<img
													src="assets/img/icons/torus.svg"
													alt="logo_community">
											</div>
											<h5 class="text-center">torus</h5>
											<p class="text-center">Log in with Google,  Facebook, or other OAuth providers</p>
										</a>
									</div> -->
									<!-- ================= item -->
									<!-- <div class="col-lg-4">
										<a href="#" class="box in__wallet space-y-10"
											data-toggle="modal"
											data-target="#popup_error">
											<div class="logo">
												<img
													src="assets/img/icons/fortmatic.svg"
													alt="logo_community">
											</div>
											<h5 class="text-center">fortmatic</h5>
											<p class="text-center">wallet that allows you to  sign up with your phone number on any device</p>
										</a>
									</div> -->
									<!-- ================= item -->
									<!-- <div class="col-lg-4">
										<a href="#" class="box in__wallet space-y-10"
											data-toggle="modal"
											data-target="#popup_connected">
											<div class="logo">
												<img
													src="assets/img/icons/bitski.svg"
													alt="logo_community">
											</div>
											<h5 class="text-center">bitski</h5>
											<p class="text-center">wallet that allows you to  sign in with an email and password</p>
										</a>
									</div> -->
									<!-- ================= item -->
									<!-- <div class="col-lg-4">
										<a href="#" class="box in__wallet space-y-10"
											data-toggle="modal"
											data-target="#popup_error">
											<div class="logo">
												<img
													src="assets/img/icons/walletconnect.svg"
													alt="logo_community">
											</div>
											<h5 class="text-center">walletconnect</h5>
											<p class="text-center">Log in with Google,  Facebook, or other OAuth provider</p>
										</a>
									</div> -->
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
		
	</body>
</html>