<?php
namespace App\Models;

use PDO;
use Exception;

/**
 * User Model - Handles Database interactions for Users
 */
class User {
    private $db;
    private $table = 'users';

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Create a new user account
     */
    public function create($data) {
        try {
            $sql = "INSERT INTO {$this->table} 
                    (email, phone_number, password_hash, gender, preferred_languages, google_id) 
                    VALUES (:email, :phone_number, :password_hash, :gender, :preferred_languages, :google_id)";
            
            $stmt = $this->db->prepare($sql);
            
            // Hash password if present
            $password = isset($data['password']) ? password_hash($data['password'], PASSWORD_DEFAULT) : null;

            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':phone_number', $data['phone_number']);
            $stmt->bindParam(':password_hash', $password);
            $stmt->bindParam(':gender', $data['gender']);
            $stmt->bindParam(':preferred_languages', $data['preferred_languages']);
            $stmt->bindParam(':google_id', $data['google_id']);

            if ($stmt->execute()) {
                return $this->db->lastInsertId();
            }
            return false;
        } catch (Exception $e) {
            error_log("User Creation Error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Find user by Email
     */
    public function findByEmail($email) {
        $sql = "SELECT * FROM {$this->table} WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Find user by Phone
     */
    public function findByPhone($phone) {
        $sql = "SELECT * FROM {$this->table} WHERE phone_number = :phone LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get user by ID
     */
    public function findById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Update user profile
     */
    public function update($id, $data) {
        $fields = "";
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ", ");

        $sql = "UPDATE {$this->table} SET {$fields} WHERE user_id = :id";
        $stmt = $this->db->prepare($sql);
        $data['id'] = $id;

        return $stmt->execute($data);
    }

    /**
     * Authenticate user
     */
    public function login($credential, $password) {
        // Try email first
        $user = $this->findByEmail($credential);
        
        // If not email, try phone
        if (!$user) {
            $user = $this->findByPhone($credential);
        }

        if ($user && password_verify($password, $user['password_hash'])) {
            // Update last login
            $this->update($user['user_id'], ['last_login' => date('Y-m-d H:i:s')]);
            return $user;
        }

        return false;
    }
}
