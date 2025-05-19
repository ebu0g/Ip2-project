

<?php

class Authorization

{
   
    // Define roles and their permissions
    private static $permissions = [
        
        'admin' => [
            'access_about',
            'access_department',
            'access_reports',
            'access_contact',
            'access_report',
            'access_dashboard',
           
            'acccess_admin_panel',
            

        ],
        'user' => [
            'access_dashboard',
            'access_about',
            'access_department',
            'access_contact',
            'access_userdashboard',
            'access_report',
             
            'access_chatbot',
            
            
            
        ],
       
    ];
     // Add this method to handle session start
    private static function startSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // ...rest of your class.

    public static function isLogin() {
        self::startSession();

        if (!isset($_SESSION['user']['email'])) {
            header("Location: http://localhost:8000/frontend/login.php");
            exit();
        }
    }

    public static function hasPermission($permission) {
        self::startSession();

        if (!isset($_SESSION['user']['role'])) {
            header("Location: http://localhost:8000/frontend/login.php");
            exit();
        }

        $role = $_SESSION['user']['role'];

        if (!isset(self::$permissions[$role])) {
            header("Location: http://localhost:8000/frontend/unauthorized.html?message=" . urlencode("Role not found"));
            exit();
        }

        if (!in_array($permission, self::$permissions[$role])) {
            header("Location: http://localhost:8000/frontend/unauthorized.html?message=" . urlencode("Permission denied"));
            exit();
        }
    }
}
