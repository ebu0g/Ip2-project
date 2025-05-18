<?php
require_once '../config/config.php';
require_once '../helpers/validator.php';
require_once '../models/User.php';
require_once '../middlewares/AuthMiddleware.php';

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = trim($_POST['firstname'] ?? '');
    $middlename = trim($_POST['middlename'] ?? '');
    $last_name = trim($_POST['lastname'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $role = trim($_POST['role'] ?? '');
    $password = $_POST['password'] ?? '';
    $profileImage = '';

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = __DIR__ . '/../uploads/'; // Use absolute path to avoid issues

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Create the directory with full permissions
        }

        $uniqueFileName = uniqid() . '_' . basename($_FILES['image']['name']);
        $profileImage = $uploadDir . $uniqueFileName;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $profileImage)) {
            echo json_encode(["error" => "Failed to upload image"]);
            exit;
        }

        // Store the relative path to the uploaded image
        $profileImage = 'uploads/' . $uniqueFileName;
    }

    // Validate input
    $validator = new Validator();
    $errors = $validator->validate([
        'firstname' => $first_name,
        'middlename' => $middlename,
        'lastname' => $last_name,
        'username' => $username,
        'email' => $email,
        'role' => $role,
        'password' => $password
    ]);

    if (!empty($errors)) {
        echo json_encode(["errors" => $errors]);
        exit;
    }

    

// Create user
$userModel = new User();
$result = $userModel->createUser(
    $first_name,
    $middlename,
    $last_name,
    $username,
    $email,
    $role,
    password_hash($password, PASSWORD_BCRYPT),
    $profileImage // Pass the profile image URL
);

if ($result) {
    echo json_encode(["success" => "User registered successfully"]);
} else {
    echo $result;
}
}
?>