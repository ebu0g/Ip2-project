<?php

require_once '../config/database.php';

class AuthMiddlewareVaidation {
    public function passwordvalidation($password) {
        if(strlen($password) < 6) {
            return True;
        }
       return False; 
    }

    public function strongpassword($password){
        if(!preg_match(('A-Z'))){
            return Json_encode(["error" => "Password must contain at least one uppercase letter."]);    
        }
        else if(!preg_match('a-z')) {
            return Json_encode(["error"=> "Password must contain at least one lowercase letter."]);
        }
        else if(!preg_match('0-9')) {
            return Json_encode(["error" => "Password must contain at least one number."]);
        }
        else if(!preg_match('!@#$%^&*()_+!')) {
            return Json_encode(["error" => "Password must contain at least one special character."]);
        }
       
    }

    public function validateEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return True;
        }
        return False;
    }

    public function usernameValidation($username){
        if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            return True;
        }
        return False;
    }

    public function validationRole($role) {
        if(!in_array($role, ['admin', 'user'])){
            return True;
        }
        return False;
    }
}


class AuthMiddlewareDatabase {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function checkUserEmailExists($email) {
        try {
            // Prepare the SQL query
            $query = "SELECT id FROM users WHERE email = :email LIMIT 1";
            $stmt = $this->conn->prepare($query);

            // Bind parameters
            $stmt->bindParam(':email', $email);

            // Execute the query
            $stmt->execute();

            // Fetch the result
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if any record exists
            return $user ? true : false; // Email already exists or not
        } catch (PDOException $e) {
            // Log the error and return false
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }

    public function checkUserUsernameExists($username) {
        try {
            // Prepare the SQL query
            $query = "SELECT id FROM users WHERE username = :username LIMIT 1";
            $stmt = $this->conn->prepare($query);

            // Bind parameters
            $stmt->bindParam(':username', $username);

            // Execute the query
            $stmt->execute();

            // Fetch the result
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if any record exists
            return $user ? true : false; // Username already exists or not
        } catch (PDOException $e) {
            // Log the error and return false
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }
}
?>