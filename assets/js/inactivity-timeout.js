// Set the inactivity timeout duration in milliseconds (e.g., 30 minutes)
const inactivityTimeoutDuration = 30 * 60 * 1000; // 30 minutes

let inactivityTimeout; // Variable to store the timeout ID

// Function to reset the inactivity timeout
function resetInactivityTimeout() {
    clearTimeout(inactivityTimeout); // Clear the previous timeout
    inactivityTimeout = setTimeout(logoutUser, inactivityTimeoutDuration);
}

// Function to log out the user
function logoutUser() {
    // Perform the logout action, e.g., redirect to the logout page
    window.location.href = "logout.php"; // Replace with your logout logic
}

// Attach event listeners to reset the timeout on user interaction
document.addEventListener("mousemove", resetInactivityTimeout);
document.addEventListener("keydown", resetInactivityTimeout);

// Initialize the timeout when the page loads
resetInactivityTimeout();
