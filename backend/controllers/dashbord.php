<?php 
require_once '../models/dashbord.php';
require_once '../helpers/serializer.php';

class DashboardController {
    private $dashboardModel;
        
    public function __construct() {
        $this->dashboardModel = new Dashboard();
        $this->serializer = new Serializer();

    }
    public function controllerGetDatabaseTables(){
        
        try {

            $tables = $this->dashboardModel->getDatabaseTables();

            if (empty($tables)) {
                $this->serializer->sendResponse(404, ['message' => 'No tables found.']);
                return;
            }

            $this->serializer->sendResponse(200, $tables);

        } catch (Exception $e) {
            $this->serializer->sendResponse(500, ['error' => $e->getMessage()]);
        }
    }


}

$test = new DashboardController();
$test->controllerGetDatabaseTables();
//$test->controllerGetUserCount();