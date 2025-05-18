<?php
require_once '../Admin_models/delete.php';
require_once '../helpers/serializer.php';
class AdminDeleteUser {
    private $deleteModel;
    private $serializer;

    public function __construct() {
        $this->deleteModel = new AdminDelete();
        $this->serializer = new CurdSerializer();
    }



    public function controllerDeleteUser($id) {
        try {
            $result = $this->deleteModel->deleteUserById($id);
            if ($result == true) {
                $this->serializer->delete(200, ['message' => 'User deleted successfully']);
            } else {
                $this->serializer->delete(404, ['message' => 'User not found or could not be deleted']);
            }
        } catch (Exception $e) {
            // Handle any exceptions that may occur
            $this->serializer->delete(500, ['message' => 'An error occurred while deleting user']);
        }
    }



    public function controllerDeleteAllUsers() {
        try {
            $result = $this->deleteModel->deleteAllUsers();
            // Now deleteAllUsers returns true if rows were deleted, false otherwise
            if ($result === true) {
                $this->serializer->delete(200, ['message' => 'All users deleted successfully']);
            } else {
                $this->serializer->delete(404, ['message' => 'No users found or could not be deleted']);
            }
        } catch (Exception $e) {
            // Handle any exceptions that may occur
            $this->serializer->delete(500, ['message' => 'An error occurred while deleting all users']);
        }
    }
}

$manager = new AdminDeleteUser();

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'] ?? null;

if ($id) {

    $manager->controllerDeleteUser($id);
} else {
    echo json_encode(['success' => false, 'message' => 'No user ID provided']);
}