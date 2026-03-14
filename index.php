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

echo "CallFrend Base Architecture Initialized.";
// Future: Start Router here
