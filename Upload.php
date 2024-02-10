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
		<title> - upload </title>
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
			
			<div class="hero__upload">
			    <div class="container">
			        <div class="space-y-20">
			            <a href="Marketplace.php" class="btn btn-white btn-sm
			                switch">
			                Marketplace</a>
			            <h2 class="title">Placer Votre Ticket</h2>
			
			        </div>
			    </div>
			</div><div class="modal fade popup" id="popup_preview" tabindex="-1" role="dialog"
				aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<div class="modal-body space-y-20 p-0">
							<div class="card__item three m-0 in__popup">
								<div class="card_body space-y-10">
									<!-- ???? =============== -->
									<div class="card_head">
										<img src="assets/img/items/item_4.png"
											alt="">
										<a href="#" class="likes space-x-3">
											<i class="ri-heart-3-fill"></i>
											<span class="txt_sm">2.1k</span>
										</a>
										<div class="action">
											<a href="#" class="btn btn-primary btn-sm">
												<i class="ri-pie-chart-line color_white"></i>
												Place Your Bid
											</a>
										</div>
									</div>
									<!-- ???? =============== -->
									<h6 class="card_title">
										Colorful Abstract Painting
									</h6>
									<div class="card_footer d-block space-y-10">
										<div class="d-flex justify-content-between">
											<div class="creators space-x-10">
												<div class="avatars -space-x-20">
													<a href="Profile.html">
														<img
															src="assets/img/avatars/avatar_3.png"
															alt="Avatar" class="avatar
															avatar-sm">
													</a>
													<a href="Profile.html">
														<img
															src="assets/img/avatars/avatar_2.png"
															alt="Avatar" class="avatar
															avatar-sm">
													</a>
												</div>
												<a href="Profile.html">
													<p class="avatars_name txt_sm">
														@makinzi_jamy... </p>
												</a>
											</div>
											<a href="#" class="space-x-3">
												<p class="color_green txt_sm">0.001 DH</p>
											</a>
										</div>
										<div class="hr"></div>
										<a href="#" class="d-flex align-items-center
											space-x-10">
											<i class="ri-vip-crown-line"></i>
											<p class="color_text txt_sm" style="width:
												auto;">Highest bid</p>
											<span class="color_black txt_sm">0.001 DH</span>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<form method="post" action="Upload_process.php">
			<div class="container">
				<div class="box in__upload mb-120">
					<div class="row">
						<div class="col-lg-6">
							<div class="left__part space-y-40 md:mb-20 upload_file">
								<img id="mealImage" class="img-fluid meal-image active" src="assets/img/meals/default.svg" alt="Meal Image">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group space-y-10">
								<div class="space-y-20">
									<div class="space-y-10">
									
										<span class="nameInput">Choisir Le Type de repas que vous souhaitez Placer:</span>
										<select class="form-select custom-select" aria-label="Default select example" id="mealType" name="meal_type">
											<option value="Petit-déjeuner" selected>Petit-déjeuner</option>
                                            <option value="Déjeuner">Déjeuner</option>
                                            <option value="diner" >Diner</option>
										</select>
									</div>
									<div class="space-y-10">
										<span class="nameInput">Date de repas:</span>
										<input type="date" class="form-control"  id="dob" min="<?= date('Y-m-d') ?>" name="meal_date" />
									</div>
									
									
									<div class="space-y-10">
										<span class="nameInput">Description <span
												class="color_text">
												(optional) </span></span>
										<input type="text" class="form-control"
											placeholder="Laisser Un Message Au Vendeur" name="description">
									</div>
									<div class="space-y-10">
										<span class="variationInput">Prix</span>
										<select class="form-select custom-select"
											aria-label="Default select example" name="price" id="price">
											<option>00.00 DH</option>
											<option>1.00 DH</option>
											<option>2.00 DH</option>
											<option>3.00 DH</option>
											<option>4.00 DH</option>
										</select>
									</div>
					
			
			
								</div>
							</div>
							<p class="color_black">
								<span class="color_text text-bold" > Service fee : </span>
								<span id="serviceFee">0.00</span> DH
							</p> <p class="color_black">
								<span class="color_text text-bold"> You will receive :
								</span>
								<span id="userAmount">0.00</span> DH
								</p>
						</div>
					</div>
			
				</div>
			</div>
			
			<div class="fixed_row bottom-0 left-0 right-0">
				<div class="container">
					<div class="row content justify-content-between mb-20_reset">
						<div class="col-md-auto col-12 mb-20">
							<div class="space-x-10">
								<a href="Marketplace.php" class="btn btn-white
									others_btn"> Cancel</a>
								<!-- <a href="#" class="btn btn-dark others_btn"
									data-toggle="modal"
									data-target="#popup_preview"> Preview</a> -->
			
							</div>
						</div>
						<div class="col-md-auto col-12 mb-20">
							<button href="Item-details.html" class="btn btn-grad
								btn_create" type="submit"> Create
								item</button>
						</div>
					</div>
				</div>
			</div>
			
		</div>
</form>
<!-- Add this script to the head or before the closing body tag of your HTML -->
<script>
document.addEventListener("DOMContentLoaded", function () {
  const mealTypeSelect = document.getElementById('mealType');
  const mealImage = document.getElementById('mealImage');
  
  const defaultMealType = "Petit-déjeuner";
  const defaultImagePath = `assets/img/meals/${defaultMealType}.svg`;
  
  mealTypeSelect.addEventListener('change', () => {
    const selectedMealType = mealTypeSelect.value;
    const imagePath = `assets/img/meals/${selectedMealType}.svg`;
    mealImage.src = imagePath;
  });

  // Set the default image when the page loads
  mealImage.src = defaultImagePath;

  const priceSelect = document.getElementById("price"); // Replace with the ID of your price dropdown
  const serviceFeePercentage = 0.01; // 1% service fee

  priceSelect.addEventListener("change", function () {
    const selectedPrice = parseFloat(priceSelect.value);
    const serviceFeeAmount = selectedPrice * serviceFeePercentage;
    const userAmount = selectedPrice - serviceFeeAmount;

    const serviceFeeFormatted = serviceFeeAmount.toFixed(2); // Format to 2 decimal places
    const userAmountFormatted = userAmount.toFixed(2);

    // Update the displayed values
    document.getElementById("serviceFee").textContent = serviceFeeFormatted;
    document.getElementById("userAmount").textContent = userAmountFormatted;
  });
});
</script>




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

	</body>
</html>