<?php
// Display errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config/database.php';

echo "<h2>CallFrend Database Connection Test</h2>";

$database = new Database();

try {
    $db = $database->connect();
    if ($db) {
        echo "<p style='color: green; font-weight: bold;'>SUCCESS: Connected to the testing database successfully!</p>";
    } else {
        echo "<p style='color: red; font-weight: bold;'>FAILED: connect() returned null.</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red; font-weight: bold;'>ERROR: " . $e->getMessage() . "</p>";
}
