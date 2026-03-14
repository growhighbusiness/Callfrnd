<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebRTC Settings | CallFrend Admin</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        .setting-section {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid var(--glass-border);
        }
        .provider-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .success-msg {
            color: var(--success);
            background: rgba(34, 197, 94, 0.1);
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            text-align: center;
            border: 1px solid var(--success);
        }
    </style>
</head>
<body>
    <div class="auth-container" style="flex-direction: column; align-items: stretch; max-width: 800px; margin: 0 auto; padding-top: 2rem;">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <div>
                <span class="logo-text" style="font-size: 1.5rem;">CallFrend</span>
                <span style="color: var(--primary); font-weight: 700; margin-left: 0.5rem;">SUPER ADMIN</span>
            </div>
            <a href="/profile" class="btn" style="background: var(--glass-border); color: white; width: auto; padding: 0.5rem 1rem;">Back to Site</a>
        </div>

        <div class="auth-card" style="max-width: none;">
            <h2 class="form-title">Voice Provider Config</h2>
            <p class="form-subtitle">Manage WebRTC APIs without touching the code.</p>

            <?php if(!empty($message)): ?>
                <div class="success-msg"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>

            <form action="/admin/settings/webrtc/update" method="POST">
                
                <div class="setting-section">
                    <h3 style="margin-bottom: 1rem;">Active Provider</h3>
                    <p style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 1rem;">Select which WebRTC service the Matching Engine should use for new calls.</p>
                    
                    <div style="display: flex; gap: 1rem;">
                        <label style="flex: 1; text-align: center; padding: 1rem; border: 1px solid var(--glass-border); background: <?php echo ($settings['active_voice_provider'] == 'daily') ? 'rgba(99, 102, 241, 0.2)' : 'rgba(255,255,255,0.05)'; ?>; border-color: <?php echo ($settings['active_voice_provider'] == 'daily') ? 'var(--primary)' : 'var(--glass-border)'; ?>; border-radius: 12px; cursor: pointer;">
                            <input type="radio" name="active_voice_provider" value="daily" style="display: none;" <?php echo ($settings['active_voice_provider'] == 'daily') ? 'checked' : ''; ?>>
                            <span style="font-weight: 600;">Daily.co</span>
                        </label>
                        <label style="flex: 1; text-align: center; padding: 1rem; border: 1px solid var(--glass-border); background: <?php echo ($settings['active_voice_provider'] == 'agora') ? 'rgba(99, 102, 241, 0.2)' : 'rgba(255,255,255,0.05)'; ?>; border-color: <?php echo ($settings['active_voice_provider'] == 'agora') ? 'var(--primary)' : 'var(--glass-border)'; ?>; border-radius: 12px; cursor: pointer;">
                            <input type="radio" name="active_voice_provider" value="agora" style="display: none;" <?php echo ($settings['active_voice_provider'] == 'agora') ? 'checked' : ''; ?>>
                            <span style="font-weight: 600;">Agora</span>
                        </label>
                        <label style="flex: 1; text-align: center; padding: 1rem; border: 1px solid var(--glass-border); background: <?php echo ($settings['active_voice_provider'] == 'twilio') ? 'rgba(99, 102, 241, 0.2)' : 'rgba(255,255,255,0.05)'; ?>; border-color: <?php echo ($settings['active_voice_provider'] == 'twilio') ? 'var(--primary)' : 'var(--glass-border)'; ?>; border-radius: 12px; cursor: pointer;">
                            <input type="radio" name="active_voice_provider" value="twilio" style="display: none;" <?php echo ($settings['active_voice_provider'] == 'twilio') ? 'checked' : ''; ?>>
                            <span style="font-weight: 600;">Twilio</span>
                        </label>
                    </div>
                </div>

                <div class="setting-section">
                    <div class="provider-header">
                        <span style="width: 12px; height: 12px; border-radius: 50%; background: #00e5ff;"></span>
                        <h3 style="margin: 0;">Daily.co Config</h3>
                    </div>
                    <div class="input-group">
                        <label>API Key</label>
                        <input type="password" name="daily_api_key" value="<?php echo htmlspecialchars($settings['daily_api_key'] ?? ''); ?>" placeholder="sk_test_...">
                    </div>
                </div>

                <div class="setting-section">
                    <div class="provider-header">
                        <span style="width: 12px; height: 12px; border-radius: 50%; background: #099dfd;"></span>
                        <h3 style="margin: 0;">Agora Config</h3>
                    </div>
                    <div class="input-group">
                        <label>App ID</label>
                        <input type="text" name="agora_app_id" value="<?php echo htmlspecialchars($settings['agora_app_id'] ?? ''); ?>" placeholder="Enter App ID">
                    </div>
                    <div class="input-group">
                        <label>App Certificate</label>
                        <input type="password" name="agora_app_certificate" value="<?php echo htmlspecialchars($settings['agora_app_certificate'] ?? ''); ?>" placeholder="Enter App Certificate">
                    </div>
                </div>

                <div class="setting-section">
                    <div class="provider-header">
                        <span style="width: 12px; height: 12px; border-radius: 50%; background: #f22f46;"></span>
                        <h3 style="margin: 0;">Twilio Config</h3>
                    </div>
                    <div class="input-group">
                        <label>Account SID</label>
                        <input type="text" name="twilio_account_sid" value="<?php echo htmlspecialchars($settings['twilio_account_sid'] ?? ''); ?>" placeholder="AC...">
                    </div>
                    <div class="input-group">
                        <label>Auth Token</label>
                        <input type="password" name="twilio_auth_token" value="<?php echo htmlspecialchars($settings['twilio_auth_token'] ?? ''); ?>" placeholder="Enter Auth Token">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" style="padding: 1rem; font-size: 1.125rem;">
                    Save Integration Settings
                </button>
            </form>

        </div>
    </div>
    <script>
        // Simple script to style radio selections dynamically
        document.querySelectorAll('input[name="active_voice_provider"]').forEach(radio => {
            radio.addEventListener('change', function() {
                // Reset styling
                document.querySelectorAll('label').forEach(label => {
                    if (label.querySelector('input[type="radio"]')) {
                        label.style.background = 'rgba(255,255,255,0.05)';
                        label.style.borderColor = 'var(--glass-border)';
                    }
                });
                // Highlight active
                this.parentElement.style.background = 'rgba(99, 102, 241, 0.2)';
                this.parentElement.style.borderColor = 'var(--primary)';
            });
        });
    </script>
</body>
</html>
