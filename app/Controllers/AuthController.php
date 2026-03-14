<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use Database;

/**
 * AuthController - Handles Registration, Login, and Sessions
 */
class AuthController extends Controller {
    private $userModel;

    public function __construct($route_params) {
        parent::__construct($route_params);
        $database = new Database();
        $db = $database->connect();
        $this->userModel = new User($db);

        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Show Signup Page
     */
    public function signup() {
        if ($this->isGuest()) {
            $this->render('auth/signup');
        } else {
            header('Location: /profile');
        }
    }

    /**
     * Process Signup
     */
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
                'phone_number' => filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS),
                'password' => $_POST['password'],
                'gender' => $_POST['gender'],
                'preferred_languages' => isset($_POST['languages']) ? implode(',', $_POST['languages']) : '',
                'google_id' => null
            ];

            // Simple validation
            if (empty($data['email']) && empty($data['phone_number'])) {
                $this->render('auth/signup', ['error' => 'Email or Phone is required']);
                return;
            }

            $userId = $this->userModel->create($data);

            if ($userId) {
                $this->setSession($userId);
                header('Location: /profile');
            } else {
                $this->render('auth/signup', ['error' => 'Registration failed. Try again.']);
            }
        }
    }

    /**
     * Show Login Page
     */
    public function loginView() {
        if ($this->isGuest()) {
            $this->render('auth/login');
        } else {
            header('Location: /profile');
        }
    }

    /**
     * Process Login
     */
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credential = $_POST['credential'];
            $password = $_POST['password'];

            $user = $this->userModel->login($credential, $password);

            if ($user) {
                $this->setSession($user['user_id']);
                header('Location: /profile');
            } else {
                $this->render('auth/login', ['error' => 'Invalid credentials']);
            }
        }
    }

    /**
     * Logout
     */
    public function logout() {
        session_unset();
        session_destroy();
        header('Location: /login');
    }

    /**
     * Helper: Set session data
     */
    private function setSession($user) {
        $_SESSION['user_id'] = is_array($user) ? $user['user_id'] : $user;
        $_SESSION['logged_in'] = true;
        $_SESSION['is_admin'] = (is_array($user) && isset($user['is_admin'])) ? $user['is_admin'] : 0;
    }

    /**
     * Helper: Check if guest
     */
    private function isGuest() {
        return !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true;
    }
}
