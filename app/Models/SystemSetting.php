<?php
namespace App\Models;

use PDO;
use Exception;

/**
 * SystemSetting Model - Handles key-value configuration pairs
 */
class SystemSetting {
    private $db;
    private $table = 'system_settings';

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Get all settings as an associative array
     */
    public function getAll() {
        $sql = "SELECT setting_key, setting_value FROM {$this->table}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        $results = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[$row['setting_key']] = $row['setting_value'];
        }
        return $results;
    }

    /**
     * Get a specific setting value
     */
    public function get($key) {
        $sql = "SELECT setting_value FROM {$this->table} WHERE setting_key = :key LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':key', $key);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['setting_value'] : null;
    }

    /**
     * Bulk update settings
     */
    public function updateMultiple($settingsArray) {
        try {
            $this->db->beginTransaction();
            
            $sql = "UPDATE {$this->table} SET setting_value = :val WHERE setting_key = :key";
            $stmt = $this->db->prepare($sql);
            
            foreach ($settingsArray as $key => $value) {
                // Remove whitespace from keys
                $value = trim($value);
                $stmt->bindParam(':key', $key);
                $stmt->bindParam(':val', $value);
                $stmt->execute();
            }
            
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            error_log("Settings Update Error: " . $e->getMessage());
            return false;
        }
    }
}
