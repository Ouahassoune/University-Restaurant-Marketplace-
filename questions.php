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
		<title> - Frequently asked questions </title>
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
			
	<?php include 'header.php'; ?>
			<div class="hero_questions bg_white">
			    <div class="container">
			        <div class="space-y-20">
			            <h1 class="text-center">Frequently asked questions</h1>
			            <p class="text-center">You can set preferred display name, create your profile URL and manage other personal settings.</p>
			        </div>
			    </div>
			</div>
			
			<div class="questions__page mt-100">
			    <div class="row justify-content-center">
			        <div class="col-lg-8">
			            <div class="row">
			                <div class="col-lg-3 col-md-3 col-sm-4">
			                    <div class="box side">
			                        <div class="sidenav">
			                            <ul>
			                                <li class="d-flex align-items-center
			                                    space-x-10">
			                                    <i class="ri-home-2-line"></i>
			                                    <a class="text__reset" href="#General">General</a>
			                                </li>
			                                <li class="d-flex align-items-center
			                                    space-x-10">
			                                    <i class="ri-chat-1-line"></i>
			                                    <a class="text__reset" href="#Support">Support</a>
			                                </li>
			                                <li class="d-flex align-items-center
			                                    space-x-10">
			                                    <i class="ri-cloudy-line"></i>
			                                    <a class="text__reset" href="#Transaction">Transaction</a>
			                                </li>
			                                <li class="d-flex align-items-center
			                                    space-x-10">
			                                    <i class="ri-quill-pen-line"></i>
			                                    <a class="text__reset" href="#Fees">Fees</a>
			                                </li>
			                            </ul>
			                        </div>
			                    </div>
			                </div>
			                <div class="col-lg-9 col-md-9 col-sm-8">
			                    <div class="questions__box space-y-30">
			                        <!-- Accordion card -->
			                        <div class="accordion" id="accordionEx parent"
			                            role="tablist" aria-multiselectable="true">
			                            <a href="#" id="General"></a>
			                            <!-- Card header -->
			                            <div class="accordion-header" role="tab"
			                                id="headingOne1">
			                                <a data-toggle="collapse"
			                                    data-parent="#accordionEx"
			                                    href="#collapseOne1" aria-expanded="false"
			                                    aria-controls="collapseOne1"
			                                    class="accordion-button collapsed">
			                                    Comment puis-je acheter un billet de repas sur votre plateforme ?
			                                </a>
			                                <!-- Card body -->
			                                <div id="collapseOne1" class="collapse"
			                                    role="tabpanel"
			                                    aria-labelledby="headingOne1"
			                                    data-parent="#accordionEx">
			                                    <div class="accordion-desc">
			                                        Pour acheter un billet de repas sur notre plateforme, suivez ces étapes simples :
<ul>
<li>les offres disponibles sur la page d'accueil.</li>
<li>Cliquez sur l'offre qui vous intéresse pour obtenir plus de détails.</li>
<li>Si vous avez un solde suffisant, cliquez sur le bouton "Acheter" pour réserver le billet.</li> 
<li>Sinon, rechargez votre compte en cliquant sur "Recharger le compte".</li> 
</ul>
			                                    </div>
			                                </div>
			                            </div>
			                        </div>
			                        <!-- Accordion card -->
			                        <div class="accordion" id="accordionEx" role="tablist"
			                            aria-multiselectable="true">
			                            <a href="#" id="Support"></a>
			                            <!-- Card header -->
			                            <div class="accordion-header" role="tab"
			                                id="headingOne2">
			                                <a data-toggle="collapse"
			                                    data-parent="#accordionEx"
			                                    href="#collapseOne2" aria-expanded="false"
			                                    aria-controls="collapseOne2"
			                                    class="accordion-button collapsed">
			                                    Comment puis-je vendre un billet de repas sur votre plateforme ?
			                                </a>
			                                <!-- Card body -->
			                                <div id="collapseOne2" class="collapse"
			                                    role="tabpanel"
			                                    aria-labelledby="headingOne2"
			                                    data-parent="#accordionEx">
			                                    <div class="accordion-desc">
			                                        <div class="article-body"><p>Vous pouvez facilement vendre un billet de repas sur notre plateforme en suivant ces étapes :</p>
			                                            <ul>
			                                                <li>Connectez-vous à votre compte.</li>
			                                                <li>Cliquez sur "Vendre un Billet" dans le menu.</li>
			                                                <li>Choose relevant categories</li>
			                                                <li>Remplissez les détails de votre billet, y compris le type de repas, la date, l'heure, le prix, etc.</li>
															<li>Cliquez sur "Publier" pour mettre en vente votre billet.</li>
			                                            </ul></div>
			                                    </div>
			                                </div>
			                            </div>
			                        </div>
			                        <!-- Accordion card -->
			                        <div class="accordion" id="accordionEx parent"
			                            role="tablist" aria-multiselectable="true">
			                            <a href="#" id="Transaction"></a>
			                            <!-- Card header -->
			                            <div class="accordion-header" role="tab"
			                                id="headingOne3">
			                                <a data-toggle="collapse"
			                                    data-parent="#accordionEx"
			                                    href="#collapseOne3" aria-expanded="false"
			                                    aria-controls="collapseOne3"
			                                    class="accordion-button collapsed">
			                                    Comment fonctionne la gestion du temps pour les billets de repas ?
			                                </a>
			                                <!-- Card body -->
			                                <div id="collapseOne3" class="collapse"
			                                    role="tabpane3"
			                                    aria-labelledby="headingOne3"
			                                    data-parent="#accordionEx">
			                                    <div class="accordion-desc">
			                                        Chaque annonce de billet de repas indique l'heure à laquelle le repas sera servi. Un compte à rebours est également affiché, démarrant une heure avant la date et l'heure du repas spécifiées. Pendant cette période d'une heure, les acheteurs ont la possibilité d'acheter le billet. Si le billet n'est pas vendu pendant cette période d'une heure, il sera marqué comme expiré, ce qui signifie qu'il n'est plus disponible à l'achat. 
			                                    </div>
			                                </div>
			                            </div>
			                        </div>
			                        <!-- Accordion card -->
			                        <div class="accordion" id="accordionEx" role="tablist"
			                            aria-multiselectable="true">
			                            <a id="Fees" href="#"></a>
			                            <!-- Card header -->
			                            <div class="accordion-header" role="tab"
			                                id="headingOne4">
			                                <a data-toggle="collapse"
			                                    data-parent="#accordionEx"
			                                    href="#collapseOne4" aria-expanded="false"
			                                    aria-controls="collapseOne4"
			                                    class="accordion-button collapsed">
			                                    Que se passe-t-il si un billet est déjà réservé par quelqu'un d'autre ?
			                                </a>
			                                <!-- Card body -->
			                                <div id="collapseOne4" class="collapse"
			                                    role="tabpane4"
			                                    aria-labelledby="headingOne4"
			                                    data-parent="#accordionEx">
			                                    <div class="accordion-desc">
			                                        Si un billet de repas est déjà réservé par un autre utilisateur, vous ne pourrez pas le réserver à moins que la réservation précédente ne soit annulée. Vous serez averti si un billet est en cours de réservation par un autre utilisateur.


			                                    </div>
			                                </div>
			                            </div>
			                        </div>
									<div class="accordion" id="accordionEx" role="tablist"
			                            aria-multiselectable="true">
			                            <a id="Fees" href="#"></a>
			                            <!-- Card header -->
			                            <div class="accordion-header" role="tab"
			                                id="headingOne4">
			                                <a data-toggle="collapse"
			                                    data-parent="#accordionEx"
			                                    href="#collapseOne4" aria-expanded="false"
			                                    aria-controls="collapseOne4"
			                                    class="accordion-button collapsed">
			                                    Comment puis-je contacter le vendeur d'un billet de repas ?
			                                </a>
			                                <!-- Card body -->
			                                <div id="collapseOne4" class="collapse"
			                                    role="tabpane4"
			                                    aria-labelledby="headingOne4"
			                                    data-parent="#accordionEx">
			                                    <div class="accordion-desc">
			                                        Vous pouvez contacter le vendeur d'un billet de repas en cliquant sur son profil et en utilisant la fonction de messagerie interne. Posez vos questions ou discutez des détails de la réservation directement avec le vendeur.


			                                    </div>
			                                </div>
			                            </div>
			                        </div>
									<div class="accordion" id="accordionEx" role="tablist"
			                            aria-multiselectable="true">
			                            <a id="Fees" href="#"></a>
			                            <!-- Card header -->
			                            <div class="accordion-header" role="tab"
			                                id="headingOne4">
			                                <a data-toggle="collapse"
			                                    data-parent="#accordionEx"
			                                    href="#collapseOne4" aria-expanded="false"
			                                    aria-controls="collapseOne4"
			                                    class="accordion-button collapsed">
			                                    Comment modifier mes informations de profil ?
			                                </a>
			                                <!-- Card body -->
			                                <div id="collapseOne4" class="collapse"
			                                    role="tabpane4"
			                                    aria-labelledby="headingOne4"
			                                    data-parent="#accordionEx">
			                                    <div class="accordion-desc">
			                                        Pour modifier vos informations de profil, connectez-vous à votre compte, accédez à la section "Profil", et vous pourrez mettre à jour vos informations personnelles, votre photo de profil, etc.


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
		
			<?php 
			   include 'footer.php'; ?>
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