<?php 
require_once '../models/list.php';
require_once '../helpers/serializer.php';

class AboutController {
    private $listData;
    public function __construct() {
        $this->listData = new ListData();
        $this->serializer = new Serializer();
        
    }
    public function numberOfDepartments() {
        try {
            if(!ob_get_level()){
                ob_start();
            }
            $numberofDepartments['number'] = $this->listData->countDepartments();
            if(empty($numberofDepartments)){
                $this->serializer->SendNumberResponse(404, ['error'=> 'No departments number found']);
            }
            $this->serializer->SendNumberResponse(200, $numberofDepartments['number']);
        } catch (Exception$e) {
            $this->serializer->SendNumberResponse(500, ['error' => $e->getMessage()]);
        }
    }
}

$data = new AboutController();
$data->numberOfDepartments();