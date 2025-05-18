<?php
require_once '../models/report.php';
require_once '../helpers/serializer.php';

class ReportAPI {
    
    public function __construct() {
        $this->reportModel = new ReportModel();
        $this->serializer = new Serializer();
    }

    public function getReport() {
        try {
            $reportData = $this->reportModel->fetchReport();
            if (empty($reportData)) {
                $this->serializer->sendResponse(404, ["message" => "No data found."]);
            }
            $this->serializer->sendResponse(200, $reportData);
        } catch (Exception $e) {
            $this->serializer->sendResponse(500, ["error" => $e->getMessage()]);
        }
    }

    
}

$test = new ReportAPI();
$test->getReport();