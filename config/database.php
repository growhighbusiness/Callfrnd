<?php
/**
 * Database Connection Layer
 */

class Database {
    private $host = 'localhost';
    private $db_name = 'u217507402_callfrnd';
    private $username = 'u217507402_callfrnd';
    private $password = 'Callfrnd@123';
    private $conn;

    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            // In production, we'd log this instead of echoing
            // echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
