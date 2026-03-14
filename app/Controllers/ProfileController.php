<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use Database;

/**
 * ProfileController - Handles User Profiles and Settings
 */
class ProfileController extends Controller {
    private $userModel;

    public function __construct($route_params) {
        parent::__construct($route_params);
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Auth Middleware
        if (!isset($_SESSION['logged_in'])) {
            header('Location: /login');
            exit;
        }

        $database = new Database();
        $db = $database->connect();
        $this->userModel = new User($db);
    }

    /**
     * Show Profile/Dashboard
     */
    public function index() {
        $user = $this->userModel->findById($_SESSION['user_id']);
        $this->render('profile/view', ['user' => $user]);
    }

    /**
     * Show Edit Profile Page
     */
    public function edit() {
        $user = $this->userModel->findById($_SESSION['user_id']);
        $this->render('profile/edit', ['user' => $user]);
    }

    /**
     * Update Profile
     */
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'gender' => $_POST['gender'],
                'preferred_languages' => isset($_POST['languages']) ? implode(',', $_POST['languages']) : '',
                'availability_status' => $_POST['availability']
            ];

            if ($this->userModel->update($_SESSION['user_id'], $data)) {
                header('Location: /profile');
            } else {
                $user = $this->userModel->findById($_SESSION['user_id']);
                $this->render('profile/edit', ['user' => $user, 'error' => 'Update failed.']);
            }
        }
    }
}
