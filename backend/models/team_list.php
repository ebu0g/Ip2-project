<?php 

require_once '../config/database.php';


class TeamList {
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function fetchTeamMembers() {
        try {
            $stmt = $this->conn->prepare("SELECT name, role, image_url, instagram_url, twitter_url, linkedin_url FROM team_members");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

          return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

$teamlist = new TeamList();
$teamlist->fetchTeamMembers();
?>