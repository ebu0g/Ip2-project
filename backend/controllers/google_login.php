<?php
require_once '../vendor/autoload.php';
/*
The google_client class is part of the google api php librart
it the core class that helps you interact with google's OAuth 2.0 authentication and APIS.
It act like a setup manager for all your interaction with google APIS
Google_Client is a PHP class used to:

Authenticate users via Google (OAuth 2.0)

Get access tokens

Send authenticated API requests (like Gmail, Drive, Calendar, YouTube, etc.)
*/

session_start();


// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

//Set up Google Client
$client = new Google_Client();
$client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
$client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
$client->setRedirectUri('http://localhost:8000/backend/controllers/google_callback.php');
// Add required scopes
$client->addScope('email');
$client->addScope('profile');




// Generate Google Login URL
$loginUrl = $client->createAuthUrl();

?>


<!DOCTYPE html>
<html>
<head>
    <title>Login with Google</title>
</head>
<body>
    <h2>Login with Google</h2>
    <a href="<?php echo htmlspecialchars($loginUrl); ?>">Login with Google</a>
</body>
</html>

