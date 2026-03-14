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

            // Handle Profile Image Upload
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['profile_image']['tmp_name'];
                $fileName = $_FILES['profile_image']['name'];
                $fileSize = $_FILES['profile_image']['size'];
                $fileType = $_FILES['profile_image']['type'];
                
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
                
                // Allow only specific extensions
                $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'webp');
                
                if (in_array($fileExtension, $allowedfileExtensions) && $fileSize < 2000000) { // 2MB Limit
                    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                    $uploadFileDir = APP_ROOT . '/public/uploads/profiles/';
                    $dest_path = $uploadFileDir . $newFileName;
                    
                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        $data['profile_image'] = '/public/uploads/profiles/' . $newFileName;
                    }
                }
            }

            if ($this->userModel->update($_SESSION['user_id'], $data)) {
                header('Location: /profile');
            } else {
                $user = $this->userModel->findById($_SESSION['user_id']);
                $this->render('profile/edit', ['user' => $user, 'error' => 'Update failed.']);
            }
        }
    }
}
