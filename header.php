
<header class="header__1 js-header">
				<div class="container">
					<div class="wrapper js-header-wrapper space-x-10">
						<div class="header__logo">
							<a href="index.php">
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
								
								<li> <a class="color_black" href="Marketplace.php"> Marketplace</a> </li>
								<li> <a class="color_black" href="Upload.php"> Placer Votre Ticket</a> </li>
								<?php
								
     
            echo '<li> <a class="color_black" href="Profile.php?user_id=' .$_SESSION['user_id']. '"> Profile</a> </li>';
        
        ?>
		                        <li> <a class="color_black" href="Connect-wallet.php"> Charger Account</a> </li>
								<li> <a class="color_black" href="questions.php"> FAQ </a> </li>
							
							</ul>
						</div>
						<!-- ================== -->
						<div class="header__search">
							<input type="text" id="searchInput" placeholder="Search" />
							<button class="header__result" id="searchButton">
								<i class="ri-search-line"></i>
							</button>
						</div>
						<div id="searchResults"></div>
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
											<p>0.6 DH</p>
										</div>
										<span class="circle"></span>
									</div>
								</div>
							</div>
							<div class="header__avatar">
								<div class="price">
									<span><?php echo $userBalance; ?> <strong>DH</strong> </span>
								</div>
							
									<?php
									include 'user_functions.php';
						// Check if a cover image path is associated with the user
						$profileImagePath = getProfileImagePathForUser($userId); // Implement this function
					
						if (!empty($profileImagePath)) {
							echo '<img src="' . $profileImagePath . '" alt="avatar" class="avatar avatar-lg " >';
						} else {
							// If no cover image is associated, display a default one
							echo '<img src="assets/img/avatars/avatar_4.png" alt="avatar" class="avatar avatar-lg " >';
						}
						?> 
								<div class="avatar_popup space-y-20">
									
									<div class="d-flex align-items-center space-x-10">
										<img
											class="coin"
											src="assets/img/logos/coin.svg"
											alt="/"
											/>
										<div class="info">
											<p class="text-sm font-book text-gray-400">Balance</p>
											<p class="w-full text-sm font-bold text-green-500"><?php echo $userBalance; ?> DH</p>
										</div>
									</div>
									<div class="hr"></div>
									<div class="links space-y-10">
									<?php
								
     
								echo '<a class="color_black" href="Profile.php?user_id=' .$_SESSION['user_id']. '"><i class="ri-landscape-line"></i> <span> My items</span></a> ';
							
							?>
										<!-- <a href="Profile.php">
											<i class="ri-landscape-line"></i> <span> My items</span>
										</a> -->
										<a href="edit_profile.php">
											<i class="ri-pencil-line"></i> <span> Edit Profile</span>
										</a>
										<a href="logout.php">
											<i class="ri-logout-circle-line"></i> <span> Logout</span>
										</a>
									</div>
								</div>
							</div>
							<div class="header__btns">
								<a class="btn btn-primary btn-sm" href="Upload.php">Create</a>
							</div>
							<div class="header__burger js-header-burger"></div>
						</div>
						<div class="header__mobile js-header-mobile">
						
							<div class="header__mobile__menu space-y-40">
								<ul class="d-flex space-y-20">
									<li> <a class="color_black" href="Marketplace.php"> Marketplace</a> </li>
									<li> <a class="color_black" href="Upload.php"> Placer Votre Ticket</a> </li>
									<li> <a class="color_black" href="Profile.php"> Profile</a> </li>
									<li> <a class="color_black" href="questions.html"> FAQ</a> </li>
									<li><a href="logout.php">
											Logout
										</a></li>
						
								</ul>
								<div class="space-y-20">
									<div class="header__search in_mobile w-full">
										<input type="text" placeholder="Search" />
										<button class="header__result">
											<i class="ri-search-line"></i>
										</button>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>
			<!-- Add this script to the head or before the closing body tag of your HTML -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const searchButton = document.getElementById("searchButton");
    const searchResultsContainer = document.getElementById("searchResults");

    // Add event listener to search button
    searchButton.addEventListener("click", performSearch);

    // Function to perform the search
    function performSearch() {
        const searchTerm = searchInput.value.trim();

        if (searchTerm !== "") {
            // Create a new XMLHttpRequest
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        displaySearchResults(response);
                    } else {
                        console.error("Error fetching search results:", xhr.statusText);
                    }
                }
            };

            // Send the search term to the backend PHP file
            xhr.open("GET", `search-users.php?searchTerm=${encodeURIComponent(searchTerm)}`, true);
            xhr.send();
        }
    }

    // Function to display search results
    function displaySearchResults(results) {
        // Clear previous search results
        searchResultsContainer.innerHTML = "";

        if (results.length === 0) {
            searchResultsContainer.innerHTML = "No results found.";
        } else {
            results.forEach(result => {
                const resultItem = document.createElement("div");
                resultItem.classList.add("search-result");
                resultItem.innerHTML = `
                    <p>${result.title}</p>
                    <!-- Add more fields you want to display -->
                `;
                searchResultsContainer.appendChild(resultItem);
            });
        }
    }
});
</script>

