<?php 
require_once '../config/database.php';
class AdminList {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
        
    
    }

    public function fetchAllUsers() {
       try {
            $query = "SELECT id, first_name,last_name, email, username, profile_image From users";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $users= $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $users;
            
    
       } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        
    }
    public function fetchALLTeams(){
        try {
            $query = "SELECT id, image_url, name,  role FROM team_members";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $teams= $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $teams;
    
       } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


}




