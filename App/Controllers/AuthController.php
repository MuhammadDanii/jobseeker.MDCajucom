<?php

namespace App\Controllers;

use Framework\Database;

class AuthController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }


    public function register()
    {
        loadView('auth/register');
    }


    public function registerUser()
    {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $passwordConfirmation = $_POST['password_confirmation'] ?? '';

        // Simple Validation Checks
        if (empty($name) || empty($email) || empty($password)) {
            echo "Please fill in all required fields.";
            return;
        }

        if ($password !== $passwordConfirmation) {
            echo "Passwords do not match.";
            return;
        }

        // Check if email already exists in your users table
        $userExist = $this->db->query('SELECT * FROM users WHERE email = :email', ['email' => $email])->fetch();

        if ($userExist) {
            echo "That email address is already registered.";
            return;
        }

        // Securely hash the password before saving
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $params = [
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword
        ];

        // Adjust column names ('name', 'email', 'password') to match your exact users table structure
        $sql = 'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)';

        try {
            $this->db->query($sql, $params);
            
            // Automatically log them in by fetching their newly created ID
            $newUser = $this->db->query('SELECT id FROM users WHERE email = :email', ['email' => $email])->fetch();
            
            $_SESSION['user'] = [
                'id' => $newUser->id,
                'name' => $name,
                'email' => $email
            ];

            header('Location: /');
            exit;
        } catch (\Exception $e) {
            echo "Registration failed: " . $e->getMessage();
        }
    }


    public function login()
{
    // Clear browser layout cache specifically for this page load
    header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
    header("Pragma: no-cache"); // HTTP 1.0.
    header("Expires: 0"); // Proxies.

    // Your existing view call
    loadView('auth/login');
}


    public function authenticate()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            echo "Please fill in all fields.";
            return;
        }

        // Fetch user information
        $user = $this->db->query('SELECT * FROM users WHERE email = :email', ['email' => $email])->fetch();

        if (!$user) {
            echo "Invalid email or password credentials.";
            return;
        }

        // Verify if hashed password matches input
        if (password_verify($password, $user->password)) {
            // Set session variables
            $_SESSION['user'] = [
                'id' => $user->id,
                'name' => $user->name, // Adjust column name if it's 'username' or split into first/last name
                'email' => $user->email
            ];

            header('Location: /');
            exit;
        } else {
            echo "Invalid email or password credentials.";
            return;
        }
    }

  
    public function logout()
{

    $_SESSION = [];


    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }


    session_destroy();


    header('Location: /');
    exit;
}
}