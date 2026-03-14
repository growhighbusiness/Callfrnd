<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\SystemSetting;
use Database;

/**
 * AdminController - Handles Super Admin configurations
 */
class AdminController extends Controller {
    private $settingModel;

    public function __construct($route_params) {
        parent::__construct($route_params);
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Extremely strict Admin Middleware
        if (!isset($_SESSION['logged_in']) || $_SESSION['is_admin'] != 1) {
            header('HTTP/1.1 403 Forbidden');
            die('Access Denied: Super Admin Only.');
        }

        $database = new Database();
        $db = $database->connect();
        $this->settingModel = new SystemSetting($db);
    }

    /**
     * Show WebRTC Settings Panel
     */
    public function webrtcSettings() {
        $settings = $this->settingModel->getAll();
        
        $message = '';
        if (isset($_SESSION['msg'])) {
            $message = $_SESSION['msg'];
            unset($_SESSION['msg']);
        }

        $this->render('admin/webrtc_settings', [
            'settings' => $settings,
            'message' => $message
        ]);
    }

    /**
     * Update WebRTC Settings
     */
    public function updateWebrtc() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $updates = [
                'active_voice_provider' => $_POST['active_voice_provider'] ?? 'daily',
                'daily_api_key' => $_POST['daily_api_key'] ?? '',
                'agora_app_id' => $_POST['agora_app_id'] ?? '',
                'agora_app_certificate' => $_POST['agora_app_certificate'] ?? '',
                'twilio_account_sid' => $_POST['twilio_account_sid'] ?? '',
                'twilio_auth_token' => $_POST['twilio_auth_token'] ?? ''
            ];

            if ($this->settingModel->updateMultiple($updates)) {
                $_SESSION['msg'] = 'WebRTC Provider Settings Saved Successfully.';
            } else {
                $_SESSION['msg'] = 'Error saving settings.';
            }

            header('Location: /admin/settings/webrtc');
            exit;
        }
    }
}
