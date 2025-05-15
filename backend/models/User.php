<?php
require_once '../config/database.php';

class User {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function createUser($first_name, $middle_name, $last_name, $username, $email, $role, $password) {
        try {
            // Prepare the SQL query
            $stmt = $this->conn->prepare(
                "INSERT INTO users (first_name, middle_name, last_name, username, email, role, password) 
                 VALUES (:first_name, :middle_name, :last_name, :username, :email, :role, :password)"
            );

            // Bind parameters
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':middle_name', $middle_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':password', $password);

            // Execute the query
            if ($stmt->execute()) {
                return true;
            } else {
                error_log("Error: " . implode(", ", $stmt->errorInfo()));
                return false;
            }
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            return false;
        }
    }

    public function loginUser($email, $password) {
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
                // Verify the password
                if (password_verify($password, $user['password'])) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            return false;
        }
    }
}
?>