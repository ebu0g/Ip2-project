<?php
require_once '../models/User.php';
require_once '../middlewares/AuthMiddleware.php';
class Validator {
    private $errors = [];
    private $authMiddlewareValidations;
    private $authMiddlewareDatabase;


    public function __construct() {
        $this->authMiddlewareValidations = new AuthMiddlewareVaidation();
        $this->authMiddlewareDatabase = new AuthMiddlewareDatabase();
        
    }


    public function validate($data) {
        $first_name = $data['firstname'] ?? '';
        $middle_name = $data['middlename'] ?? '';
        $last_name = $data['lastname'] ?? '';
        $username = $data['username'] ?? '';
        $email = $data['email'] ?? '';
        $role = $data['role'] ?? '';
        $password = $data['password'] ?? '';

        if (empty($first_name)) {
            $this->errors[] = "First name is required.";
        }
        elseif (empty($middle_name)) {
            $this->errors[] = "Middle name is required.";
        }
        elseif (empty($last_name)) {
            $this->errors[] = "Last name is required.";
        }
        elseif (empty($username)) {
            $this->errors[] = "Username is required.";
        }
        elseif (empty($email)) {
            $this->errors[] = "Email is required.";
        }
        elseif (empty($role)) {
            $this->errors[] = "Role is required.";
        }
        elseif (empty($password)) {
            $this->errors[] = "Password is required.";
        }
        elseif ($this->authMiddlewareValidations->passwordvalidation($password)) {
            $this->errors[] = "Password must be at least 6 characters long.";
        }

        elseif ($this->authMiddlewareValidations->usernameValidation($username)){
            $this->errors[] = "Username can only contain letters and numbers.";
        }
      
        elseif ($this->authMiddlewareValidations->validateEmail($email)) {
            $this->errors[] = "Invalid email format.";
        }
        if ($this->authMiddlewareValidations->validationRole($role)) {
            $this->errors[] = "Invalid role. Must be either 'admin' or 'user'.";
        }

        // Check if email already exists
        if ($this->authMiddlewareDatabase->checkUserEmailExists($email)) {
            $this->errors[] = "{$email} email already exists.";
        }
             // Check if username already exists
        if ($this->authMiddlewareDatabase->checkUserUsernameExists($username)) {
            $this->errors[] = "{$username} username already exists.";    
        }
      
        if(!empty($this->errors)) {
            return $this->errors;
        }


        }
   
    }

    class loaginValidator {
        private $errors = [];
        private $authMiddlewareValidations;
        private $authMiddlewareDatabase;
        private $userModel;

        public function __construct() {
            $this->authMiddlewareValidations = new AuthMiddlewareVaidation();
            $this->authMiddlewareDatabase = new AuthMiddlewareDatabase();
            $this->userModel = new User();
            
        }

        public function loginvalidate($email, $password) {
            if (empty($email)) {
                $this->errors[] = "Email is required.";
            } elseif ($this->authMiddlewareValidations->validateEmail($email)) {
                $this->errors[] = "Invalid email format.";
            }
        
            if (empty($password)) {
                $this->errors[] = "Password is required.";
            }
        
            if (empty($this->errors)) {
                // Check if the user exists and the password is correct
                if (!$this->userModel->loginUser($email, $password)) {
                    $this->errors[] = "Invalid email or password.";
                }
            }
        
            return $this->errors;
        }


    }

    
?>