<?php 
require_once '../models/dashbord.php'; // Include the parent class file
require_once '../helpers/serializer.php';

class DashboardControllerUser  {
    
    // Override the constructor to inherit only the initialization logic
    public function __construct() {

        $this->dashboardModel = new Dashboard(); // Initialize the model   
        $this->serializer = new Serializer();
    }

   
    // Add or override other methods specific to DashboardControllerUser
    public function controllerGetUserCount() {
        try {
            $total_users = $this->dashboardModel->userCount();
            if (empty($total_users)) {
                $this->serializer->activeUser(404, ['message' => 'No users found.']);
                return;
            }
            $this->serializer->activeUser(200, $total_users);
        } catch (Exception $e) {
            $this->serializer->activeUser(500, ['error' => $e->getMessage()]);
        }
    }
}

// Example usage
$test = new DashboardControllerUser();
$test->controllerGetUserCount();