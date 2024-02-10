<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Include the database connection file
include 'db_connect.php';
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// } else {
//     echo "Connected successfully";

//     // Execute a test query
//     $result = $conn->query("SELECT 1");
//     if ($result === FALSE) {
//         echo "Query failed: " . $conn->error;
//     } else {
//         echo "Query executed successfully";
//     }
// }


// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $displayName = $_POST['username'];
    $password = $_POST['password_hash'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];

    // Validate and sanitize form data (you should add proper validation)

    // Upload ID card image and get its file path
    $idCardImagePath = ''; // This will store the file path of the uploaded ID card image
    if (isset($_FILES['id_card_picture'])) {
		$uploadDir = 'uploads/';  // The directory where you want to store uploaded files
		$idCardImageName = $_FILES['id_card_picture']['name'];
		$idCardImagePath = $uploadDir . $idCardImageName;
	
		if (move_uploaded_file($_FILES['id_card_picture']['tmp_name'], $idCardImagePath)) {
			// File was successfully uploaded
		} else {
			// Error occurred during file upload
		}
    }

    // Upload profile picture image and get its file path
    // $profileImagePath = ''; // This will store the file path of the uploaded profile picture
    // if (isset($_FILES['profile_photo'])) {
    //     // Handle file upload (you should add proper validation and error handling)
    //     // Move uploaded file to a designated directory
    //     // $profileImagePath = 'path_to_uploaded_profile_picture';
    // }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
	// Generate a unique verification token
    $verification_token = md5(uniqid(rand(), true));

	 //Instantiation and passing `true` enables exceptions
	 $mail = new PHPMailer(true);
 
	 try {
		 //Enable verbose debug output
		 $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;

		 //Send using SMTP
		 $mail->isSMTP();

		 //Set the SMTP server to send through
		 $mail->Host = 'smtp.gmail.com';

		 //Enable SMTP authentication
		 $mail->SMTPAuth = true;

		 //SMTP username
		 $mail->Username = 'easy.make.home@gmail.com';

		 //SMTP password
		 $mail->Password = 'staexvfjgjgilvve';

		 //Enable TLS encryption;
		 $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

		 //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
		 $mail->Port = 587;

		 //Recipients
		 $mail->setFrom('Ensah@Ticket.com', 'EnsahTicket');

		 //Add a recipient
		 $mail->addAddress($email, $displayName);

		 //Set email format to HTML
		 $mail->isHTML(true);

		

		 $mail->Subject = 'Email verification EnsahTicket';
		
		 $mail->Body    = "Please click the following link to verify your email address: http://ensah.org/Rarointest/verify.php?token=$verification_token";

		 $mail->send();
		 // echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}


    // Insert data into the database
    $sql = "INSERT INTO users (username, password_hash, email, bio, id_card_picture,verification_token,verified) 
            VALUES (?, ?, ?, ?, ?,?,?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $displayName, $hashedPassword, $email, $bio, $idCardImagePath,$verification_token,$verified);
	$verified=0;

    if ($stmt->execute()) {
        // Redirect to a success page or display success message
        header('Location:login.php'); //line 699
        exit();
    } else {
        // Display an error message
        echo "Error: " . $conn->error;
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="title" content="Raroin" />
	<meta name="description" content="Premium NFT marketplace theme" />
	<meta name="keywords" content="bootstrap, creabik, ThemeForest, bootstrap5, agency theme, saas
			theme, sass, html5" />
	<meta name="robots" content="index, follow" />
	<meta name="language" content="English" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title> - Register </title>
	<meta name="msapplication-TileColor" content="#da532c" />
	<meta name="theme-color" content="#ffffff" />
	<!-- 🌈🌈🌈🌈🌈🌈🌈🌈🌈🌈🌈🌈🌈🌈🌈 STYLES -->
	<link rel="stylesheet" href="assets/css/plugins/remixicon.css" />
	<link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css" />
	<link rel="stylesheet" href="assets/css/style.css" />
</head>

<body class="body">
	<div class="overflow-hidden">
		<div class="bg-dark py-10">
			<div class="container">
				<div class="text-center
						d-flex
						justify-content-between
						space-x-10
						align-items-center">
					<div class="space-x-10 d-flex align-items-center">
						<lottie-player src="https://assets6.lottiefiles.com/private_files/lf30_kqshlcsx.json"
							background="transparent" speed="2" style="width: 50px; height: 50px" loop
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
	include "headerlogre.php";
	?>

<!-- Your HTML form goes here -->

		<div class="edit_profile register">
			<div class="container">
				<div class="row">
					<div class="col-lg-3"></div>
					<div class="col-lg-9">
						<div class="right_part space-y-20">
							<h1 class="color_white"> Register new account</h1>
							<p class="color_white" style="color: white !important">You can set preferred display name,
								create your profile URL and
								manage other personal settings.</p>
							<form id="registrationForm" method="post" action="" enctype="multipart/form-data">
								<div class="box edit_box w-full space-y-20">
									<div class="row">
										<div class="col-lg-6 account-info">
											<div class="avatars space-x-20 mb-30">
												<div id="profile-container">
													<img id="profileImage" src="assets/img/avatars/avatar_3.png"
														alt="Avatar" class="avatar avatar-lg border-0" />
												</div>
												<div>
													<h6 class="mb-1">Carte Etudiant photo</h6>
													<p class="mb-1">We recommend an image of at least 400x400. Gifs work
														too
														🙌</p>
													<div id="boxUpload">
														<a href="#" class="btn btn-sm btn-dark"> Upload </a>
														<input id="imageUpload" type="file" name="id_card_picture"
															placeholder="Photo" accept="image/*"  capture=""/>
													</div>
												</div>
											</div>
											<h3 class="mb-20"> 🍉 Account info </h3>
											<div class="form-group space-y-10 mb-0">
												<div class="space-y-20">
													<div class="space-y-10">
														<span class="nameInput">Display name</span>
														<input type="text" class="form-control"
														name="username"  id="displayNameInput" placeholder="Your display name" required />
														<span id="displayNameError" class="text-danger"></span>
													</div>
													<div class="space-y-10">
														<span class="nameInput">Password</span>
														<input type="password" class="form-control"
														name="password_hash" id="passwordInput" placeholder="Password" required />
														<span id="passwordError" class="text-danger"></span>
													</div>
													<div class="space-y-10">
														<span class="nameInput d-flex justify-content-between">Email
															<span class="txt_xs color_text">Your email for marketplace
																notifications</span>
														</span>
														<div class="confirm">
															<input id="emailInput" type="email" class="form-control"
																placeholder="Enter email" name="email" required />
																<span id="emailError" class="text-danger"></span>
															<a href="#"
																class="confirm-btn btn btn-dark btn-sm">Confirm</a>
														</div>
													</div>
													<div class="space-y-10">
														<span class="nameInput">Bio (Optional)</span>
														<textarea style="min-height: 110px" name="bio" placeholder="Add your bio"></textarea>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6 social-media">
										
											<h3 class="mb-20 mt-40">📮 Notifications </h3>
											<ul class="space-y-10">
											
												<li class="d-flex space-x-10 switch_item">
													<input type="checkbox" id="switch3" checked="" /><label
														for="switch3">Toggle</label>
													<span class="color_text"> Item Purchased </span>
												</li>
											
											</ul>
										</div>
									</div>
									<div class="hr"></div>
									<p class="color_black">Please take a few minutes to read and understand Stacks Terms
										of
										Service. To continue, you’ll need to accept the terms of services
										by checking the boxes.</p>
										<button type="submit" class="btn btn-grad">Register</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
<!-- JavaScript code for real-time validation -->
<script>
    // Add an event listener when the document is fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Select the display name input field and error message span
        var displayNameInput = document.getElementById('displayNameInput');
        var displayNameError = document.getElementById('displayNameError');

        // Add an input event listener to the display name input field
        displayNameInput.addEventListener('input', function() {
            // Get the current value of the display name input field
            var displayName = displayNameInput.value;

            // Display name validation (minimum length)
            if (displayName.length < 3) {
                displayNameError.textContent = 'Display name must be at least 3 characters long.';
                displayNameError.style.display = 'block'; // Show the error message
            } else {
                displayNameError.textContent = ''; // Clear any previous error message
                displayNameError.style.display = 'none'; // Hide the error message
            }
        });

        // Select the email input field and error message span
        var emailInput = document.getElementById('emailInput');
        var emailError = document.getElementById('emailError');

        // Add an input event listener to the email input field
        emailInput.addEventListener('input', function() {
            // Get the current value of the email input field
            var email = emailInput.value;

            // Email validation
            var emailRegex = /^[a-zA-Z0-9._%+-]+@etu\.uae\.ac\.ma$/; // Example email regex
            if (!emailRegex.test(email)) {
                emailError.textContent = 'Please use an email address ending with @etu.uae.ac.ma';
                emailError.style.display = 'block'; // Show the error message
            } else {
                emailError.textContent = ''; // Clear any previous error message
                emailError.style.display = 'none'; // Hide the error message
            }
        });

        // Select the password input field and error message span
        var passwordInput = document.getElementById('passwordInput');
        var passwordError = document.getElementById('passwordError');

        // Add an input event listener to the password input field
        passwordInput.addEventListener('input', function() {
            // Get the current value of the password input field
            var password = passwordInput.value;

            // Password validation (at least 6 characters and one special character)
            var passwordRegex = /^(?=.*[!@#$%^&*]).{6,}$/; // Password policy: at least 6 characters and one special character
            if (!passwordRegex.test(password)) {
                passwordError.textContent = 'Password must contain at least 6 characters and one special character.';
                passwordError.style.display = 'block'; // Show the error message
            } else {
                passwordError.textContent = ''; // Clear any previous error message
                passwordError.style.display = 'none'; // Hide the error message
            }
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


</body>

</html>