<?php

require_once '../models/list.php';
require_once '../helpers/serializer.php';


class DepartmentAPI {
    private $listModel;

    public function __construct() {
        $this->listModel = new ListData();
        $this->serializer = new Serializer();
    }

    public function getDepartments() {
        try {
            // Start output buffering to prevent header issues
            if (!ob_get_level()) {
                ob_start();
            }

            // Fetch department data from the database
            $departments = $this->listModel->listDepartments();

            // Log the fetched data for debugging (to a file, not the browser)
            error_log(print_r($departments, true), 3, 'backend_debug.log');

            // Check if data exists
            if (empty($departments)) {
                $this->serializer->sendResponse(404, ['message' => 'No departments found.']);
                return;
            }

            // Send success response with department data
            $this->serializer->sendResponse(200, $departments);
        } catch (Exception $e) {
            // Handle errors and send error response
            $this->serializer->sendResponse(500, ['error' => $e->getMessage()]);
        }
    }

    
}

// Instantiate the API and handle the request
$api = new DepartmentAPI();
$api->getDepartments();