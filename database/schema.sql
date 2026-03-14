-- CallFrend Database Schema
-- Version: 1.0

CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    phone_number VARCHAR(20) UNIQUE,
    email VARCHAR(100) UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    preferred_languages TEXT, -- JSON or comma-separated list
    subscription_plan ENUM('Free', 'Trial', 'VIP', 'Black') DEFAULT 'Free',
    account_status ENUM('Active', 'Suspended') DEFAULT 'Active',
    availability_status ENUM('Always', 'App-Open', 'DND') DEFAULT 'Always',
    profile_image VARCHAR(255),
    google_id VARCHAR(100) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Indexing for performance
CREATE INDEX idx_email ON users(email);
CREATE INDEX idx_phone ON users(phone_number);
CREATE INDEX idx_status ON users(account_status);
