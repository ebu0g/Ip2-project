<?php 
 
require_once '../config/database.php';

class Recommended {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }
     public function getRecommended() {
        try {
            $query = "
                SELECT 
                    qd.reason,
                    d.name,
                    d.image_url As department_image,
                    qd.skill
                FROM 
                    recommendations qd
                JOIN 
                    departments d ON qd.department_id = d.id
                
                ORDER BY 
                    qd.department_id
            ";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($result)) {
                echo "No data found.";
                return;
            }


            return $result;

           
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
        
};



