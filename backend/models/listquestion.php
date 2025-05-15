<?php 
require_once '../config/database.php';

class ListData {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    } 

    public function FetchAllQuestionsWithAnswers() {
        try {
            $query = "
                SELECT 
                    q.id AS question_id,
                    q.question AS question_text,
                    d.name,
                    qd.answers
                FROM 
                    question_department qd
                JOIN 
                    departments d ON qd.department_id = d.id
                JOIN 
                    question q ON qd.question_id = q.id
                ORDER BY 
                    q.id, d.name
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
        

    
}






?>