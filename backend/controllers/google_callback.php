<?php 
require_once '../vendor/autoload.php';
require_once '../middlewares/AuthMiddleware.php';
require_once '../models/User.php';

session_start();

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

session_start();

$client = new Google_Client();


// **Override the HTTP client to use streams instead of cURL**
$stack   = \GuzzleHttp\HandlerStack::create(new \GuzzleHttp\Handler\StreamHandler());
$guzzle  = new \GuzzleHttp\Client([ 'handler' => $stack ]);
$client->setHttpClient($guzzle);

$client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
$client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
$client->setRedirectUri('http://localhost:8000/backend/controllers/google_callback.php');


// Authenticate the user
if (isset($_GET['code'])) {
    try {
        // Fetch the access token
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

        // Check for errors in the token response
        if (isset($token['error'])) {
            throw new Exception('Error fetching access token: ' . $token['error_description']);
        }

        // Debugging: Output the token for verification
        // echo "Access Token: " . json_encode($token); exit();

        // Set the access token
        $client->setAccessToken($token);

        // Get user profile information
        $googleService = new Google_Service_Oauth2($client);
        $userInfo = $googleService->userinfo->get();

        // Store user information in session or database
        $_SESSION['user']['email'] = $userInfo->email;
        $_SESSION['user']['name'] = $userInfo->name;
        $_SESSION['user']['picture'] = $userInfo->picture;
        $_SESSION['user']['first_name'] = $userInfo->givenName;
        $_SESSION['user']['last_name'] = $userInfo->familyName;
        $_SESSION['user']['middle_name'] = null; // Assuming middle name is not provided by Google
        $_SESSION['user']['username'] = $userInfo->username;
        $_SESSION['user']['role'] = 'user';
    
        
         

        // Redirect to the frontend or dashboard
        header('Location: http://localhost:8000/frontend/index.php');
        exit();
    } catch (Exception $e) {
        // Log the error and display a user-friendly message
        error_log('Google Login Error: ' . $e->getMessage());
        echo 'An error occurred during Google login. Please try again later.';
        exit();
    }
} else {
    echo "Google login failed. No authorization code provided.";
    exit();
}
?>