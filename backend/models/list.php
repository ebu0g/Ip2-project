<?php
require_once '../config/database.php';

class ListData {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function listDepartments() {
        try {
            // Prepare the SQL query
            $stmt = $this->conn->prepare("SELECT * FROM departments");
            $stmt->execute();

            // Fetch all rows as an associative array
            $departments = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $departments;
        } catch (PDOException $e) {
            error_log("Error fetching departments: " . $e->getMessage());
            return [];
        }
    }

    public function fetchPopularDepartments() {
        try {
            // Prepare the SQL query
            $stmt = $this->conn->prepare("SELECT description, name, image_url FROM departments WHERE popular = TRUE");
            $stmt->execute();

            // Fetch all rows as an associative array
            $popularDepartments = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $popularDepartments;
        } catch (PDOException $e) {
            error_log("Error fetching popular departments: " . $e->getMessage());
            return [];
        }
    }

    public function categoryQuery() {
        try {
            $stmt = $this->conn->prepare("SELECT supplementaryinfo, icon, name FROM departments ");
            $stmt->execute();

            // Featch all rows as an associative array
            $categories = $stmt->fetchALL(PDO::FETCH_ASSOC);

            return $categories;
           
            
            
        } catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function countDepartments() {
        try {
            $stmt = $this->conn->prepare("SELECT COUNT(*) as department_number FROM departments");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $result['department_number'];

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}







?>