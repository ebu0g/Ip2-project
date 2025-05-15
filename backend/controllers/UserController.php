
<?php 
include "../models/User.php";

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function createUser($first_name, $middle_name, $last_name, $username, $email, $role, $password) {
        // Validate input
        if (empty($first_name) || empty($last_name) || empty($username) || empty($middle_name) || empty($email) || empty($role) || empty($password)) {
            return "All fields are required.";
        }

       
        return $this->userModel->createUser($first_name, $middle_name, $last_name, $username, $email, $role, $password);
    }
}
?>