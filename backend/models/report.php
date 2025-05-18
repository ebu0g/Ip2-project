
<?php 

require_once '../config/database.php';

class ReportModel {

    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function fetchReport() {
        try {
            // Prepare the SQL query
            $query = "SELECT name, colors, percent FROM departments";

            // Execute the query
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            // Fetch the results
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

