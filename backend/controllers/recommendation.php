<?php 
require_once '../models/recommendationsRetrieve.php';
require_once '../helpers/serializer.php';
class RecommendedDepartmentController{

    private $recommendedModel;
    public function __construct() {
        $this->recommendedModel = new Recommended();
        $this->serializer = new Serializer();
    }

    public function controllerFetchAllRecommendation(){
        try {
            $recommendations = $this->recommendedModel->getRecommended();

            if (empty($recommendations)) {
                $this->serializer->sendResonse(404, ['message' => 'No recommendations found.']);
                return;
            }
            $this->serializer->sendResponse(200, $recommendations);
        } catch (Exception $e){
            $this->serializer->sendResponse(500, ['error' => $e->getMessage()]);
        }
    }
    
}

$test = new RecommendedDepartmentController();

$test->controllerFetchAllRecommendation();