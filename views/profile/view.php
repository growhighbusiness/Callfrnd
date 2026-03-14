<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | CallFrend</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="auth-container" style="flex-direction: column; align-items: stretch; max-width: 600px; margin: 0 auto; padding-top: 4rem;">
        <div class="auth-card" style="max-width: none;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <span class="logo-text" style="font-size: 1.5rem;">CallFrend</span>
                <a href="/logout" class="auth-link" style="font-size: 0.875rem;">Log Out</a>
            </div>

            <div style="text-align: center; margin-bottom: 2.5rem;">
                <div style="width: 100px; height: 100px; background: var(--primary); border-radius: 50%; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 700;">
                    <?php echo substr($user['email'] ?? 'U', 0, 1); ?>
                </div>
                <h2 class="form-title">Welcome back, Anonymous</h2>
                <p class="form-subtitle">Your identity remains hidden.</p>
            </div>

            <div style="background: rgba(255, 255, 255, 0.03); padding: 1.5rem; border-radius: 16px; margin-bottom: 2rem;">
                <h3 style="font-size: 1rem; margin-bottom: 1rem; color: var(--text-muted);">ACCOUNT OVERVIEW</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div>
                        <p style="font-size: 0.75rem; color: var(--text-muted);">GENDER</p>
                        <p style="font-weight: 600;"><?php echo $user['gender']; ?></p>
                    </div>
                    <div>
                        <p style="font-size: 0.75rem; color: var(--text-muted);">PLAN</p>
                        <p style="font-weight: 600; color: #4ade80;"><?php echo $user['subscription_plan']; ?></p>
                    </div>
                </div>
            </div>

            <div style="display: flex; gap: 1rem;">
                <a href="/profile/edit" class="btn btn-primary">Edit Profile</a>
                <button class="btn" style="background: var(--glass-border); color: white;">Call History</button>
            </div>
        </div>

        <div class="auth-card" style="max-width: none; margin-top: 1.5rem; text-align: center; border-color: var(--primary);">
            <p style="font-weight: 600; margin-bottom: 1rem;">Ready for a conversation?</p>
            <button class="btn btn-primary" style="padding: 1rem 2rem; font-size: 1.25rem;">Start Call</button>
        </div>
    </div>
</body>
</html>
