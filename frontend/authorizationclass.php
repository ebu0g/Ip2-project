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

        ],
        'user' => [
            'access_dashboard',
            'access_about',
            'access_department',
            'access_contact',
            'access_userdashboard',
            'access_report',
            
            
            
        ],
       
    ];

    // Start the session if not already started
    public static function startSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Check if the user is logged in
    public static function isLogin() {
        self::startSession();

        if (!isset($_SESSION['email'])) {
            header("Location: http://localhost:8000/frontend/login.php");
            exit();
        }
    }

    // Check if the user has the required permission
    public static function hasPermission($permission) {
        self::startSession();

        // Check if the user's role is set
        if (!isset($_SESSION['role'])) {
            header("Location: http://localhost:8000/frontend/login.php");
            exit();
        }

        $role = $_SESSION['role'];

        // Check if the role exists in the permissions array
        if (!isset(self::$permissions[$role])) {
            header("Location: http://localhost:8000/frontend/unauthorized.html?message=" . urlencode("Role not found"));
            exit();
        }

        // Check if the permission exists for the role
        if (!in_array($permission, self::$permissions[$role])) {
            header("Location: http://localhost:8000/frontend/unauthorized.html?message=" . urlencode("Permission denied"));
            exit();
        }
    }
}