<?php 

require_once '../config/database.php';

class AdminDelete {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function deleteTable($tableName){
        
            // check if the database connection is established
            if(!$this->conn){
                echo "Database connection failed.";
                return null;
            } 

            try {
                 $query = "Drop table $tableName";
                 $stmt = $this->conn->prepare($query);
                 $stmt->execute();

                return true;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }



        // Fix: deleteAllUsers should return true only if rows were deleted
        public function deleteAllUsers(){
            try {
                $query = "DELETE FROM users";
                $stmt = $this->conn->prepare($query);
                $stmt->execute();
                // rowCount() returns the number of rows affected
                return $stmt->rowCount() > 0;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

       




     public function deleteAllTeams(){
        try {
            $query = "TRUNCATE TABLE team_members";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt->rowCount() > 0;
            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
        

     }





     public function deleteUserById($id) {
        try {
            $query = "DELETE FROM users WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
     }

    public function deleteTeamById($id) {
            try {
                $query = "DELETE FROM team_members WHERE id = :id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
    
               
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
    }    
    
}

