<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | CallFrend</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="logo-area">
                <span class="logo-text">CallFrend</span>
            </div>
            
            <h2 class="form-title">Welcome Back</h2>
            <p class="form-subtitle">Log in to your anonymous account.</p>

            <?php if(isset($error)): ?>
                <div class="error-msg"><?php echo $error; ?></div>
            <?php endif; ?>

            <form action="/auth/login" method="POST">
                <div class="input-group">
                    <label>Email or Phone</label>
                    <input type="text" name="credential" required placeholder="Enter email or phone">
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" required placeholder="Enter password">
                </div>

                <button type="submit" class="btn btn-primary" style="margin-top: 1.5rem;">Log In</button>
            </form>

            <div class="auth-footer" style="margin-bottom: 1.5rem;">
                New to CallFrend? <a href="/signup" class="auth-link">Create Account</a>
            </div>

            <div style="text-align: center; color: var(--text-muted); font-size: 0.75rem;">
                -- OR --
            </div>

            <button class="btn" style="background: white; color: #333; margin-top: 1.5rem;">
                Sign in with Google
            </button>
        </div>
    </div>
</body>
</html>
