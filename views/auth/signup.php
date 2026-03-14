<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup | CallFrend</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="logo-area">
                <span class="logo-text">CallFrend</span>
            </div>
            
            <h2 class="form-title">Create Account</h2>
            <p class="form-subtitle">Join the global anonymous conversation.</p>

            <?php if(isset($error)): ?>
                <div class="error-msg"><?php echo $error; ?></div>
            <?php endif; ?>

            <form action="/auth/register" method="POST">
                <div class="input-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="example@email.com">
                </div>

                <div class="input-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone" placeholder="+1234567890">
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" required placeholder="Min 6 characters">
                </div>

                <div class="input-group">
                    <label>Gender</label>
                    <div class="gender-options">
                        <div class="gender-option">
                            <input type="radio" name="gender" value="Male" id="male" required>
                            <label for="male" class="gender-label">Male</label>
                        </div>
                        <div class="gender-option">
                            <input type="radio" name="gender" value="Female" id="female">
                            <label for="female" class="gender-label">Female</label>
                        </div>
                        <div class="gender-option">
                            <input type="radio" name="gender" value="Other" id="other">
                            <label for="other" class="gender-label">Other</label>
                        </div>
                    </div>
                </div>

                <div class="input-group">
                    <label>Preferred Languages</label>
                    <select name="languages[]" multiple required style="height: 100px;">
                        <option value="English">English</option>
                        <option value="Hindi">Hindi</option>
                        <option value="Tamil">Tamil</option>
                        <option value="Telugu">Telugu</option>
                        <option value="Malayalam">Malayalam</option>
                    </select>
                </div>

                <div class="input-group" style="display: flex; align-items: center; gap: 0.5rem; margin-top: 1.5rem;">
                    <input type="checkbox" required id="age">
                    <label for="age" style="margin-bottom: 0; font-size: 0.75rem;">I confirm I am 18 years or older.</label>
                </div>

                <button type="submit" class="btn btn-primary" style="margin-top: 1.5rem;">Join CallFrend</button>
            </form>

            <div class="auth-footer">
                Already have an account? <a href="/login" class="auth-link">Log In</a>
            </div>
        </div>
    </div>
</body>
</html>
