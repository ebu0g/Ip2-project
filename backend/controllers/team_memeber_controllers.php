<?php

require_once '../models/team_list.php';
require_once '../helpers/serializer.php';

class teamMemberControllerApi {
    
    public function __construct() {
        $this->team_list = new TeamList();
        $this->serializer = new Serializer();
    }

    public function getTeamMembersApi() {
        try{
            $teamMembers = $this->team_list->fetchTeamMembers();
            if (empty($teamMembers)) {
                $this->serializer->sendResponse(404, ['messsage'=> 'no team found'] );
            }

            $this->serializer->sendResponse(200, $teamMembers);
        } catch (Exception $e){
            $this->serializer->sendResponse(500, ['error' => $e->getMessage()]);

        }
        
    }
}

$teamMemberControllerApi = new teamMemberControllerApi();
$teamMemberControllerApi->getTeamMembersApi();