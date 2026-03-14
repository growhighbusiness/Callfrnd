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
                <?php if(!empty($user['profile_image'])): ?>
                    <img src="<?php echo $user['profile_image']; ?>" alt="Profile" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin: 0 auto 1.5rem; border: 2px solid var(--primary);">
                <?php else: ?>
                    <div style="width: 100px; height: 100px; background: var(--primary); border-radius: 50%; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 700;">
                        <?php echo substr($user['email'] ?? ($user['phone_number'] ?? 'U'), 0, 1); ?>
                    </div>
                <?php endif; ?>
                
                <h2 class="form-title">Welcome back, Anonymous</h2>
                <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255, 255, 255, 0.05); padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.75rem; border: 1px solid var(--glass-border); margin-top: 0.5rem;">
                    <span style="width: 8px; height: 8px; border-radius: 50%; background: <?php echo $user['availability_status'] == 'Always' ? '#4ade80' : ($user['availability_status'] == 'App-Open' ? '#facc15' : '#ef4444'); ?>;"></span>
                    <?php echo $user['availability_status']; ?>
                </div>
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
                    <div style="grid-column: span 2; margin-top: 0.5rem;">
                        <p style="font-size: 0.75rem; color: var(--text-muted);">SPOKEN LANGUAGES</p>
                        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap; margin-top: 0.25rem;">
                            <?php 
                            $langs = explode(',', $user['preferred_languages']);
                            foreach($langs as $lang): 
                                if(empty(trim($lang))) continue;
                            ?>
                                <span style="background: rgba(99, 102, 241, 0.2); color: #a5b4fc; padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.75rem;">
                                    <?php echo htmlspecialchars(trim($lang)); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
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
