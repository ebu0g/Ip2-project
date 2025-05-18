<?php
require_once '../Admin_models/list.php';
require_once '../Admin_models/retrieve_single.php';
require_once '../helpers/serializer.php';


class AdminManagerforTeam {
    private $listModel;
    private $retrieveModel;
    private $serializer;

    public function __construct() {
        $this->listModel = new AdminList();
        $this->serializer = new CurdSerializer();
        $this->retrieveModel = new AdminRetriveSingle();
    }

    public function controllerAllGetTeams() {
        try {
            $teams = $this->listModel->fetchALLTeams();
            if (empty($teams)) {
                $this->serializer->list(404, ['message' => 'No teams found']);
                exit;
            }
            $this->serializer->list(200, $teams);
        } catch (Exception $e) {
            // Handle any exceptions that may occur
            $this->serializer->list(500, ['message' => 'An error occurred while fetching teams']);
        }
    }

    public function controllersgetBYTeamId($id) {
        try {
            $team = $this->retrieveModel->fetchTeamById($id);
            if (empty($team)) {
                $this->serializer->retriveSingle(404, ['message' => 'No team found']);
                exit;
            }
            $this->serializer->retriveSingle(200, $team);
        } catch (Exception $e) {
            // Handle any exceptions that may occur
            $this->serializer->retriveSingle(500, ['message' => 'An error occurred while fetching team']);
        }
    }

}


$adminManager = new AdminManagerforTeam();
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'] ?? null;
if ($id) {
    $adminManager->controllersgetBYTeamId($id);
} else {
    $adminManager->controllerAllGetTeams();
}