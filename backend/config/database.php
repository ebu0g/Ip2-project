

<?php
include_once('../config/config.php');

class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    public $conn;

    public function __construct() {
        // Assign values from the config file
        $this->host = $GLOBALS['db_host'];
        $this->db_name = $GLOBALS['db_name'];
        $this->username = $GLOBALS['db_user'];
        $this->password = $GLOBALS['db_password'];
        $this->conn = null;
    }

    public function connect() {
        try {
            // Establish a PDO connection for PostgreSQL
            $dsn = "pgsql:host={$this->host};dbname={$this->db_name}";
            $this->conn = new PDO($dsn, $this->username, $this->password);

            // Set PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Query to list all table names in the database
        $query = "SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'";
        $stmt = $this->conn->query($query);

            return $this->conn;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}


?>