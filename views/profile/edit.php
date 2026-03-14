<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile | CallFrend</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <h2 class="form-title">Edit Profile</h2>
            <p class="form-subtitle">Update your search preferences.</p>

            <form action="/profile/update" method="POST">
                <div class="input-group">
                    <label>Gender</label>
                    <select name="gender">
                        <option value="Male" <?php echo $user['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo $user['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                        <option value="Other" <?php echo $user['gender'] == 'Other' ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>

                <div class="input-group">
                    <label>Availability</label>
                    <select name="availability">
                        <option value="Always" <?php echo $user['availability_status'] == 'Always' ? 'selected' : ''; ?>>Always Available</option>
                        <option value="App-Open" <?php echo $user['availability_status'] == 'App-Open' ? 'selected' : ''; ?>>Only When App Is Open</option>
                        <option value="DND" <?php echo $user['availability_status'] == 'DND' ? 'selected' : ''; ?>>Do Not Disturb</option>
                    </select>
                </div>

                <div class="input-group">
                    <label>Languages (Select Multiple)</label>
                    <select name="languages[]" multiple style="height: 120px;">
                        <?php 
                        $langs = explode(',', $user['preferred_languages']);
                        $options = ['English', 'Hindi', 'Tamil', 'Telugu', 'Malayalam', 'Kannada', 'Marathi'];
                        foreach($options as $opt): ?>
                            <option value="<?php echo $opt; ?>" <?php echo in_array($opt, $langs) ? 'selected' : ''; ?>>
                                <?php echo $opt; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="/profile" class="btn" style="background: var(--glass-border); color: white;">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
