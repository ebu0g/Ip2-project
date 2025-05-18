<?php

require_once '../config/database.php';

class Dashboard {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getDatabaseTables() {
       
        try {
            // Query to get all table names from the current database
            $query = "SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'";
            $stmt = $this->conn->query($query);
            $stmt->setFetchMode(PDO::FETCH_NUM); // Fetch as numeric array

            $tables = [];
            while ($row = $stmt->fetch()) {
                $tables[] = $row[0]; // Table name is in the first column
            }

            return $tables;

         
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function userCount() {
        try {
            $stmt = $this->conn->prepare("SELECT COUNT(*) as user_number FROM Users");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $result['user_number'];

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}
 $test = new Dashboard();
    $test->userCount();

?>