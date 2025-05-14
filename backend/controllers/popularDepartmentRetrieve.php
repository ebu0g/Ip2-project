<?php

require_once '../models/list.php';

class PopularDepartmentAPI {
    private $listModel;

    public function __construct() {
        $this->listModel = new ListData();
    }

    public function getPopularDepartments() {
        try {
            // Fetch popular department data from the database
            $popularDepartments = $this->listModel->fetchPopularDepartments();
            // log the fetched data for debugging
            error_log(print_r($popularDepartments, true), 3, 'backend_debug.log');
            // Check if data exists
            if(empty($popularDepartments)){
                $this->senderResponse(404, ['message' => 'No popular departments found.']);
                return;
            }
            
            // Send success response with department data
            $this->sendResponse(200, $popularDepartments);


 
        } catch (Exception $e){
            // Handle errors and send error response
            $this->sendResponse(500, ['error' => $e->getMessage()]);

        }
    }

    private function sendResponse($statusCode, $data) {
        // Clear any previous output
        ob_clean();

        // Set HTTP response code
        http_response_code($statusCode);

        // Set content type to JSON
        header('Content-Type: application/json');

        // Send JSON-encoded data
        echo json_encode($data);
    }

}
// instantiate the API and handle the request
$api = new PopularDepartmentAPI();
$api->getPopularDepartments();