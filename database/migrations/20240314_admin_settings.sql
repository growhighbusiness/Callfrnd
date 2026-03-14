-- Admin System Settings migration
CREATE TABLE IF NOT EXISTS system_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default voice provider settings
INSERT IGNORE INTO system_settings (setting_key, setting_value) VALUES 
('active_voice_provider', 'daily'),
('daily_api_key', ''),
('agora_app_id', ''),
('agora_app_certificate', ''),
('twilio_account_sid', ''),
('twilio_auth_token', '');

-- Add is_admin flag to users table
ALTER TABLE users ADD COLUMN is_admin TINYINT(1) DEFAULT 0;

-- Optional: Make first user an admin (if needed)
-- UPDATE users SET is_admin = 1 WHERE user_id = 1;
