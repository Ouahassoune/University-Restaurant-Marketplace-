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
		<title> - Edit Profile </title>
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
			
			<div class="modal fade popup" id="popup_social_media" tabindex="-1" role="dialog"
			    aria-hidden="true">
			    <div class="modal-dialog modal-dialog-centered" role="document">
			        <div class="modal-content">
			            <button type="button" class="close" data-dismiss="modal"
			                aria-label="Close">
			                <span aria-hidden="true">&times;</span>
			            </button>
			            <div class="modal-body space-y-20 p-40">
			                <h3 class="text-center">Add more Social media</h3>
			                <div class="d-flex flex-column">
			                    <span class="nameInput mb-10">Telegram</span>
			                    <input type="text" class="form-control"
			                        placeholder="telegram username" />
			                    <a class="telegram-btn btn btn-primary mt-20
			                        btn-sm" href="#">
			                        <i class="ri-telegram-fill"></i>
			                        Connect to Telegram
			                    </a>
			                </div>
			                <div class="d-flex flex-column">
			                    <span class="nameInput mb-10">Instagram</span>
			                    <input type="text" class="form-control"
			                        placeholder="instagram username" />
			                    <a class="instagram-btn btn btn-primary mt-20
			                        btn-sm" href="#">
			                        <i class="ri-instagram-fill"></i>
			                        Connect to Instagram
			                    </a>
			                </div>
			                <div class="d-flex flex-column">
			                    <span class="nameInput mb-10">TikTok</span>
			                    <input type="text" class="form-control"
			                        placeholder="tiktok username" />
			                    <a class="tiktok-btn btn btn-primary mt-20
			                        btn-sm" href="#">
			                        <img class="mr-half" src="assets/img/icons/tiktok.svg" alt="" style="height: 20px;">
			                        Connect to TikTok
			                    </a>
			                </div>
			                <div class="d-flex flex-column">
			                    <span class="nameInput mb-10">Youtube</span>
			                    <input type="text" class="form-control"
			                        placeholder="youtube username" />
			                    <a class="youtube-btn btn btn-primary mt-20
			                        btn-sm" href="#">
			                        <i class="ri-youtube-fill"></i>
			                        Connect to Youtube
			                    </a>
			                </div>
			                <div class="d-flex flex-column">
			                    <span class="nameInput mb-10">Medium</span>
			                    <input type="text" class="form-control"
			                        placeholder="medium username" />
			                    <a class="medium-btn btn btn-primary mt-20
			                        btn-sm" href="#">
			                        <img src="assets/img/icons/medium.svg" alt="" style="width: 21px;">
			                        Connect to Medium
			                    </a>
			                </div>
			                <a class="discord-btn btn btn-primary
			                w-100" href="#">
			                Save
			            </a>
			            </div>
			        </div>
			    </div>
			</div><div class="edit_profile">
			    <!-- ====== header -->
				<?php
include "header.php";
?>
			 
			<div class="mb-50">
				<div class="hero__profile">
					<div class="tabs">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb default mb-0">
								<li class="breadcrumb-item"><a href="/">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Edit profile</li>
							</ol>
						</nav>
					</div>
					<form action="edit_process.php" method="POST" enctype="multipart/form-data">
					<div class="cover">
						<!-- <img src="assets/img/bg/cover.jpg" alt="cover" id="cover_image" > -->
						<?php
						include_once 'user_functions.php';
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
				</div>
			</div>
			    <div class="container">
					
			        <div class="mb-50">
			            <h3 class="mb-30">Choice your Cover image</h3>
			            <div class="row profile-img">
			                <div class="col-6 col-md-2">
			                    <div class="box
			                        in__profile
			                        d-flex
			                        justify-content-center
			                        align-items-center">
			                        <img class="icon"
			                            src="assets/img/icons/upload-plus.svg"
			                            alt="" />
			                        <input type="file" name="cover_image"   onchange="readCoverImage(this)"/>
			                    </div>
			                </div>
			               
			
			            </div>
			        </div>
			        <div>
			            <div class="avatars space-x-20 mb-30">
			                <div id="profile-container">
							<?php
						
    // Check if a cover image path is associated with the user
    $profileImagePath = getProfileImagePathForUser($userId); // Implement this function

    if (!empty($profileImagePath)) {
        echo '<img src="' . $profileImagePath . '" alt="Profile Picture" class="avatar avatar-lg border-0" id="profileImage">';
    } else {
        // If no cover image is associated, display a default one
        echo '<img src="assets/img/bg/cover.jpg" alt="cover" class="avatar avatar-lg border-0" id="profileImage">';
    }
    ?>


	
			                    
			                </div>
			                <div class="space-x-10 d-flex">
			                    <div id="boxUpload">
			                        <a href="#" class="btn btn-dark">
			                            Upload New Photoo </a>
			                        <input id="imageUpload" type="file"
			                            name="profile_photo" placeholder="Photo" 
			                            capture>
			                    </div>
			                    <a href="#" class="btn btn-white"> Delete </a>
			                </div>
			            </div>
			            <div class="box edit_box col-lg-9 space-y-30">
			                <div class="row sm:space-y-20">
			                    <div class="col-lg-6 account-info">
			                        <h3 class="mb-20">Account info 🍉</h3>
			                        <div class="form-group space-y-10 mb-0">
			                            <div class="space-y-40">
			                                <div class="space-y-10">
			                                    <span class="nameInput">Display name</span>
			                                    <input type="text" class="form-control"
			                                        value="<?php echo $username; ?>" name="new_username"/>
			                                </div>

			                                <div class="space-y-10">
			                                    <span class="nameInput d-flex
			                                        justify-content-between">Email
			                                        <span class="txt_xs">Your email for
			                                            marketplace notifications</span>
			                                    </span>
			                                    <div class="confirm">
			                                        <input type="text" class="form-control"
			                                            placeholder="Enter your email" name="new_email" value="<?php echo $email; ?>" />
			                                        <a href="#" class="confirm-btn btn
			                                            btn-dark btn-sm">Confirm</a>
			                                    </div>
			                                </div>
			                                <div class="space-y-10">
			                                    <span class="nameInput">Bio</span>
												<textarea style="min-height: 110px" name="new_bio"><?php echo trim($bio); ?></textarea>

			                                </div>
			                            </div>
			                        </div>
			                    </div>
			                  
			    </div>
			                <div class="hr"></div>
			                <p class="color_black">To update your settings you should
			                    sign message through your wallet. Click 'Update profile'
			                    then sign the message.</p>
			                <div><button type="submit" class="btn btn-grad">Update Profile</button></div>
			            </div>
			        </div>
				</form>
			    </div>
			
			</div>
			<script>
function readCoverImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('cover_image').src = e.target.result;
			
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
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
	</body>
</html>