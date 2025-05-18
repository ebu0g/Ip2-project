<?php 

require_once '../Admin_models/list.php';
require_once '../Admin_models/retrieve_single.php';
require_once '../helpers/serializer.php';


class AdminManagerforUser {

    private $listModel;
    private $retrieveModel;
    private $serializer;

    public function  __construct() {
        $this->listModel = new AdminList();
        $this->retrieveModel = new  AdminRetriveSingle();
        $this->serializer = new CurdSerializer();
       
    }

    public function controllerAllGetUsers(){
        try {
            $users = $this->listModel->fetchAllUsers();
            if (empty($users)){
                $this->serializer->list(404, ['message' => 'No users found']);
                exit;
                
            }
            $this->serializer->list(200, $users);
        } catch (Exception $e){
            // Handle any exceptions that may occur
            $this->serializer->list(500, ['message' => 'An error occurred while fetching users']);
        }
    }
    
    public function getBYUserId($id){
        try {


            $user = $this->retrieveModel->fetchUserById($id);
            if (empty($user)){
                $this->serializer->retriveSingle(404, ['message' => 'No user found']);
                exit;
            }
            $this->serializer->retriveSingle(200, $user);
        } catch (Exception $e){
            // Handle any exceptions that may occur
            $this->serializer->retriveSingle(500, ['message' => 'An error occurred while fetching user']);
        }
    }

   
    

}

$test = new AdminManagerforUser();
$test = new AdminManagerforUser();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $test->getBYUserId($id);
    } else {
        $test->controllerAllGetUsers();
    }
}
