<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/userController.php';


class Auth
{
    private $conn;

    private $table_name = "users";
    private $userModel;


    public function __construct()
    {
        session_start();
        $this->conn = Database::getConnection();
        $this->userModel = new User();

    }


    public function login($username, $password)
    {
        try {
            $user = $this->userModel->findByUsername($username);

            if ($user && $user['password'] === hash('sha256', $password)) {
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['is_admin'] = $user['username'] === 'admin';

                return true;
            }
            $_SESSION['logged_in'] = false;
            return false;
        } catch (Exception $e) {
            $_SESSION['logged_in'] = false;
            return false;
        }
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();
        header("Location: ./views/login.php");
        exit();
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['logged_in']);
    }

    public function isAdmin()
    {
        return isset($_SESSION['is_admin']);
    }
}
?>