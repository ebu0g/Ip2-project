<?php 

// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['user']['email'])) {
    // Store the username for the logout message
    $email = $_SESSION['user']['email'];

    // Prepare a success message
    $message = "{$email} logged out successfully.";
    $status = true;

    // Unset all session variables
    session_unset();
    // Destroy the session
    session_destroy();

    // Start a new session to store the message and status
    session_start();
    $_SESSION['user']['message'] = $message;
    $_SESSION['user']['status'] = $status;
} else {
    // Start a new session to store the failure message
    session_start();
    $_SESSION['user']['message'] = "Logout failed. No active session found.";
    $_SESSION['user']['status'] = false;
}

// Redirect to the login page
header('Location: http://localhost:8000/frontend/login.php');
exit();
?>