<?php
session_start();
require_once '../config/database.php';
require_once '../helpers/validator.php';
require_once '../models/User.php';
class loginroutes{
    private $conn;
    private $loginvalidation;
    private $errors = [];
    public function __construct(){
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

    public function sessionManagment($email){
       
        try {
            // Prepare the SQL query
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        
            // Bind parameters
            $stmt->bindParam(':email', $email);
        
            // Execute the query
            $stmt->execute();
        
            // Fetch the result
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($user) {
                // Set session variables
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
            }
        
            // Check if session was created
            if (isset($_SESSION['email'])) {
                echo json_encode(["success" => "User logged in successfully"]);
                echo json_encode($_SESSION);
            } else {
                echo json_encode(["error" => "Failed to create session."]);
            }
        } catch (PDOException $e) {
            // Log the error and return false
            error_log("Error: " . $e->getMessage());
            echo json_encode(["error" => "Database error occurred."]);
            return false;
        }
       

        if (isset($_SESSION['email'])) {
            echo json_encode(["success" => "User logged in successfully"]);
            echo json_encode($_SESSION);
        } else {
            echo json_encode(["error" => "Failed to create session."]);
        }

    
        
    }


}
$he = new loginroutes();
$he->login();

?>