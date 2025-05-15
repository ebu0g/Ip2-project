<?php 


class ListValidation {
   
    public function validateListDepartments($departments) {
        if (empty($departments)){
            return array("status" => false, "message" => "No departments found.");
        } else {
            return array("status" => true, "data" => $departments);
        }

    }
}