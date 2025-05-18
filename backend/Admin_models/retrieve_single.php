<?php

require_once '../config/database.php'; // Ensure the Database class is included

class AdminRetriveSingle {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function fetchUserById($id) {
        try {
            // Check if the database connection is established
            if (!$this->conn) {
                echo "Database connection failed.";
                return null;
            }

            // Prepare the SQL query
            $query = "SELECT first_name, last_name, email, username, profile_image FROM users WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Execute the query
            $stmt->execute();

            // Fetch the user data
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;

            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function fetchTeamById($id) {
        try {
            // Check if the database connection is established
            if (!$this->conn) {
                echo "Database connection failed.";
                return null;
            }

            // Prepare the SQL query
            $query = "SELECT image_url, name, role FROM team_members WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Execute the query
            $stmt->execute();

            // Fetch the team data
            $team = $stmt->fetch(PDO::FETCH_ASSOC);
            return $team; // Return the team data

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
}



