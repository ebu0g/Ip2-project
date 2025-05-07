<?php
require_once '../models/list.php';
require_once '../helpers/serializer.php';

class CategoryAPI {
    private $listData;
    public function __construct() {
        $this->listData = new ListData();
        $this->serializer = new Serializer();
    }
    
    public function getCategories() {
        
       try {
        // start output buffering to prevent header issuse   
        if(!ob_get_level()){
            ob_start();
        }

        // Fetch category data from the database
        $categories = $this->listData->categoryQuery();
        // Log the fetched data for debugging (to a file, not the browser)
        if( empty($categories)){
            
            $this->serializer->sendResponse(404, ['error'=> 'No categories found']);

            return;
        }
        // send success response with department data
        $this->serializer->sendResponse(200, $categories);
        
       } catch (Exception $e){
             
          this->serializer->sendResponse(500, ['error'=> $e->getMessage()]);
          
       }
    

    }

   
}
$data = new CategoryAPI();
$data->getCategories();