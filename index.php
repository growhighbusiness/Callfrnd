<?php
/**
 * CallFrend - Main Entry Point
 */

// Basic error reporting for development
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Load Configuration
require_once 'config/config.php';
require_once 'config/database.php';

// Simple Autoloader
spl_autoload_register(function ($class) {
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Load Core Logic
use App\Core\Router;

$router = new Router();

// Auth Routes
$router->add('signup', ['controller' => 'AuthController', 'action' => 'signup']);
$router->add('login', ['controller' => 'AuthController', 'action' => 'loginView']);
$router->add('auth/register', ['controller' => 'AuthController', 'action' => 'register']);
$router->add('auth/login', ['controller' => 'AuthController', 'action' => 'login']);
$router->add('logout', ['controller' => 'AuthController', 'action' => 'logout']);

// Profile Routes
$router->add('profile', ['controller' => 'ProfileController', 'action' => 'index']);
$router->add('profile/edit', ['controller' => 'ProfileController', 'action' => 'edit']);
$router->add('profile/update', ['controller' => 'ProfileController', 'action' => 'update']);

// Home Redirect
$router->add('', ['controller' => 'AuthController', 'action' => 'loginView']);

// Dispatch
$url = $_SERVER['QUERY_STRING'] ?? '';
$router->dispatch($url);
