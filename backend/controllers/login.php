<?php

session_start();
require_once '../config/database.php';
require_once '../helpers/validator.php';
require_once '../models/User.php';

class loginroutes {
    private $conn;
    private $loginvalidation;
    private $errors = [];
    public function __construct() {
        $this->loginvalidation = new loaginValidator();
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            // Validate login credentials
            $this->errors = $this->loginvalidation->loginvalidate($email, $password);

            // Check for validation errors
            if (!empty($this->errors)) {
                echo json_encode(["errors" => $this->errors]);
                exit;
            }

            $this->sessionManagment($email);
        } else {
            echo json_encode(["error" => "Invalid request method."]);
        }
    }

    public function sessionManagment($email) {
        try {
            // Prepare the SQL query
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Set session variables as an array for consistency
                $_SESSION['user'] = [
                    'name' => $user['username'],
                    'email' => $user['email'],
                    'role' => $user['role'],
                    'profile_picture' => $user['profile_image'] ?? ''
                ];
                header("Location: http://localhost:8000/frontend/index.php");
                exit;
            } else {
                header("Location: http://localhost:8000/frontend/login.php?error=Invalid credentials");
                exit;
            }
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            header("Location: http://localhost:8000/frontend/login.php?error=Database error");
            exit;
        }
    }
}

$he = new loginroutes();
$he->login();
?>