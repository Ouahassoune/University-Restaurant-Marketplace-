<?php
// Check if error parameter is set in the URL
if (isset($_GET['error'])) {
    $loginError = $_GET['error'];
}
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
		<title> - Register </title>
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
	include "headerlogre.php";
	?>
			
			

			<div class="edit_profile register login">
    <div class="container">
        <div class="row">
            <div class="col-lg-7"></div>
            <div class="col-lg-5">
                <div class="right_part space-y-20">
                    <h1 class="color_white"> Welcome to Ensah Ticket </h1>
                    <p class="color_white" style="color: white !important">Don't have an account yet? <a href="register.php"> Register </a></p>
                    <form id="loginForm" method="post" action="login_process.php">
                        <div class="box edit_box w-full space-y-20">
                            <div class="space-y-10">
                                <span class="nameInput">Email </span>
                                <div class="confirm">
                                    <input type="text" class="form-control" name="username" id="usernameInput" placeholder="Username or Email" required>
                                    <span id="usernameError" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="space-y-10">
                                <span class="nameInput">Password</span>
                                <div class="confirm">
                                    <input type="password" class="form-control" name="password" id="passwordInput" placeholder="Enter your password" required>
                                    <span id="passwordError" class="text-danger"></span>
                                </div>
                            </div>
                            <button class="btn btn-white btn-sm color_green" type="submit"> Connect </button>
                            <?php if (isset($loginError)): ?>
                                <p class="color_red"><?php echo $loginError; ?></p>
                            <?php endif; ?>     
                            <a href="register.php" class="btn btn-grad w-full btn-lg "> Create an account</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript code for real-time input validation -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Select the username/email and password input fields and error message spans
        var usernameInput = document.getElementById('usernameInput');
        var passwordInput = document.getElementById('passwordInput');
        var usernameError = document.getElementById('usernameError');
        var passwordError = document.getElementById('passwordError');

        // Add input event listeners to the username/email and password input fields
        usernameInput.addEventListener('input', function() {
            var username = usernameInput.value;

            // Validate username/email (you can add your own validation logic here)
            // For example, you can check if it's a valid email format
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(username)) {
                usernameError.textContent = 'Please enter a valid email address';
                usernameError.style.display = 'block';
            } else {
                usernameError.textContent = '';
                usernameError.style.display = 'none';
            }
        });

        passwordInput.addEventListener('input', function() {
            var password = passwordInput.value;

            // Validate password (you can add your own validation logic here)
            // For example, you can check if it's at least 6 characters long
            if (password.length < 6) {
                passwordError.textContent = 'Password must be at least 6 characters long';
                passwordError.style.display = 'block';
            } else {
                passwordError.textContent = '';
                passwordError.style.display = 'none';
            }
        });
    });
</script>

			
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