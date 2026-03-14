<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config/config.php';
require_once 'config/database.php';

// Auto-loader that maps the App namespace to the lowercase 'app' directory
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/app/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) { return; }
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) { require_once $file; }
});

echo "<h2>CallFrend Demo Admin Creator</h2>";

$database = new Database();
$db = $database->connect();

if (!$db) {
    die("<p style='color:red;'>Failed to connect to the database.</p>");
}

// 1. Check if the is_admin column exists, if not, try to create it and the settings table playfully just in case they didn't run the SQL.
try {
    $db->exec("ALTER TABLE users ADD COLUMN IF NOT EXISTS is_admin TINYINT(1) DEFAULT 0");
    $db->exec("CREATE TABLE IF NOT EXISTS system_settings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        setting_key VARCHAR(100) UNIQUE NOT NULL,
        setting_value TEXT,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )");
    $db->exec("INSERT IGNORE INTO system_settings (setting_key, setting_value) VALUES 
        ('active_voice_provider', 'daily'),
        ('daily_api_key', ''),
        ('agora_app_id', ''),
        ('agora_app_certificate', ''),
        ('twilio_account_sid', ''),
        ('twilio_auth_token', '')");
} catch (Exception $e) {
    // Ignore errors if columns/tables exist
}

// 2. Create the User via the Model
$userModel = new App\Models\User($db);

$demoData = [
    'email' => 'admin@callfrend.com',
    'phone_number' => '+10000000000',
    'password' => 'Admin123!',
    'gender' => 'Other',
    'preferred_languages' => 'English',
    'google_id' => null
];

// Check if admin already exists
$existing = $userModel->findByEmail($demoData['email']);

if ($existing) {
    echo "<p style='color:orange;'>Admin user already exists!</p>";
    $userId = $existing['user_id'];
} else {
    $userId = $userModel->create($demoData);
    if ($userId) {
        echo "<p style='color:green;'>Admin user created successfully.</p>";
    } else {
        die("<p style='color:red;'>Failed to create user. Check database constraints.</p>");
    }
}

// 3. Make them an admin
try {
    $stmt = $db->prepare("UPDATE users SET is_admin = 1, subscription_plan = 'Black' WHERE user_id = :id");
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
    echo "<p style='color:green;'>User privileges upgraded to Super Admin.</p>";
} catch (Exception $e) {
    echo "<p style='color:red;'>Failed to upgrade privileges: " . $e->getMessage() . "</p>";
}

echo "<h3>Your Login Credentials:</h3>";
echo "<strong>Email/Phone:</strong> admin@callfrend.com<br>";
echo "<strong>Password:</strong> Admin123!<br><br>";
echo "<a href='/login'>Go to Login Page</a>";
