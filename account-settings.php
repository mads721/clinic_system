<?php
session_start();
// Example: Mock user data (replace this with data from the database)
$user = [
    'name' => 'Maderick Vipinosa',
    'email' => 'mvipinosa@example.com',
    'phone' => 'None',
    'age' => 19,
    'gender' => 'Male',
    'avatar' => 'https://scontent.fmnl17-1.fna.fbcdn.net/v/t39.30808-6/431980062_1190319768601276_1799489472031219118_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeGh7m-_dtoUONBNjrdRUvWVB5EusU7-OsIHkS6xTv46woyL_prnt6ssiLlayAxjNNVsSVWUAlBB2k8DkXC7T5ma&_nc_ohc=eEFnAXbBPrEQ7kNvgGbrjGZ&_nc_oc=Adh2XdzsiFD_m1PhspRgx7w8FCcyY214BTS8Wl3dok6FnF2y0WqM0KeMAeaDzZ2dNI0&_nc_zt=23&_nc_ht=scontent.fmnl17-1.fna&_nc_gid=n-vugeqPkmVKRCaZOdHvCg&oh=00_AYEyLxB2CVn0Q2i0YJQOXOoqH_ZRqjwj0qibgKu-qz0IZA&oe=67DCEDDA', // Added avatar placeholder
    'last_login' => '2025-03-16 14:30:22', // Added last login timestamp
    'account_created' => '2024-05-10', // Added account creation date
    'two_factor_enabled' => false // Added 2FA status
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings | YourApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="interactions/accsettings.css">
</head>
<body>
<div class="sidebar">
    <h4 class="text-center d-none d-md-block">Settings</h4>
    <a href="#" class="active" id="accountTab"><i class="fas fa-user"></i> <span>Account</span></a>
    <a href="#" id="securityTab"><i class="fas fa-shield-alt"></i> <span>Security</span></a>
    <a href="#" id="privacyTab"><i class="fas fa-user-secret"></i> <span>Privacy</span></a>
    <a href="#" id="billingTab"><i class="fas fa-credit-card"></i> <span>Billing</span></a>
    <a href="#" id="notificationsTab"><i class="fas fa-bell"></i> <span>Notifications</span></a>
</div>

<div class="content" id="accountSection" style="display: block;">
    <h3 class="upper-text">Account Settings</h3>
    <p class="upper-text">Manage your account details and personal information.</p>
    
    <div class="card">
        <div class="profile-header">
            <img src="<?php echo htmlspecialchars($user['avatar']); ?>" alt="Profile Avatar" class="profile-avatar">
            <div class="profile-info">
                <h4><?php echo htmlspecialchars($user['name']); ?></h4>
                <p class="text-muted"><?php echo htmlspecialchars($user['email']); ?></p>
                <p class="small">Member since: <?php echo htmlspecialchars($user['account_created']); ?></p>
                <button class="btn btn-sm btn-outline-primary">Change Avatar</button>
            </div>
        </div>
        
        <h5>Personal Information</h5>
        <form id="profileForm" method="POST" action="process-profile-update.php">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" id="phone" name="phone" class="form-control" value="<?php echo ($user['phone'] !== 'None') ? htmlspecialchars($user['phone']) : ''; ?>" placeholder="Enter phone number">
                </div>
                <div class="col-md-6">
                    <label for="gender" class="form-label">Gender</label>
                    <select id="gender" name="gender" class="form-select">
                        <option value="Male" <?php echo ($user['gender'] === 'Male') ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo ($user['gender'] === 'Female') ? 'selected' : ''; ?>>Female</option>
                        <option value="Other" <?php echo ($user['gender'] === 'Other') ? 'selected' : ''; ?>>Other</option>
                        <option value="Prefer not to say" <?php echo ($user['gender'] === 'Prefer not to say') ? 'selected' : ''; ?>>Prefer not to say</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="age" class="form-label">Age</label>
                    <input type="number" id="age" name="age" class="form-control" value="<?php echo htmlspecialchars($user['age']); ?>" min="13" max="120">
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
        </form>
    </div>
    
    <div class="card">
        <h5>Account Information</h5>
        <p><strong>Last Login:</strong> <?php echo htmlspecialchars($user['last_login']); ?></p>
        <p>
            <strong>Two-Factor Authentication:</strong> 
            <span class="status-indicator <?php echo ($user['two_factor_enabled']) ? 'status-enabled' : 'status-disabled'; ?>"></span>
            <?php echo ($user['two_factor_enabled']) ? 'Enabled' : 'Disabled'; ?>
        </p>
        <div class="d-flex gap-2">
            <button class="btn btn-danger"><i class="fas fa-trash"></i> Deactivate Account</button>
            <button class="btn btn-outline-danger"><i class="fas fa-download"></i> Download My Data</button>
        </div>
    </div>
</div>

<div class="content" id="securitySection" style="display: none;">
    <h3 class="upper-text">Security Settings</h3>
    <p class="upper-text">Manage your security options and protect your account.</p>
    
    <div class="card">
        <h5>Change Password</h5>
        <p>We recommend using a strong, unique password that you don't use for other accounts.</p>
        <p class="small text-muted">Last password change: <span id="lastPasswordChange">Never</span></p>
        
        <button class="btn btn-primary" id="showChangePassword"><i class="fas fa-key"></i> Change Password</button>
        
        <div id="changePasswordSection" style="display: none; margin-top: 20px;">
            <form id="changePasswordForm" method="POST" action="process-change-password.php">
                <div class="mb-3 password-container">
                    <label for="currentPassword" class="form-label">Current Password</label>
                    <input type="password" id="currentPassword" name="currentPassword" class="form-control" required>
                    <span class="toggle-password" data-target="currentPassword"><i class="fas fa-eye"></i></span>
                </div>
                
                <div class="mb-3 password-container">
                    <label for="newPassword" class="form-label">New Password</label>
                    <input type="password" id="newPassword" name="newPassword" class="form-control" required>
                    <span class="toggle-password" data-target="newPassword"><i class="fas fa-eye"></i></span>
                    <div class="password-strength-meter">
                        <div id="passwordStrength"></div>
                    </div>
                    <div id="passwordFeedback" class="password-feedback"></div>
                </div>
                
                <div class="mb-3 password-container">
                    <label for="confirmPassword" class="form-label">Confirm New Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required>
                    <span class="toggle-password" data-target="confirmPassword"><i class="fas fa-eye"></i></span>
                    <div id="passwordMatch" class="password-feedback"></div>
                </div>
                
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Password</button>
                    <button type="button" class="btn btn-secondary" id="cancelPasswordChange"><i class="fas fa-times"></i> Cancel</button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="card">
        <h5>Two-Factor Authentication</h5>
        <p>Add an extra layer of security to your account by enabling two-factor authentication.</p>
        
        <?php if ($user['two_factor_enabled']): ?>
        <p class="text-success"><i class="fas fa-check-circle"></i> Two-factor authentication is currently enabled.</p>
        <button class="btn btn-danger"> <i class="fas fa-times"> </i> Disable Two-Factor Authentication</button>
        <?php else: ?>
        <p class="text-muted"><i class="fas fa-info-circle"></i> Two-factor authentication is currently disabled.</p>
        <button class="btn btn-success"><i class="fas fa-shield-alt"></i> Enable Two-Factor Authentication</button>
        <?php endif; ?>
    </div>
    
    <div class="card">
        <h5>Login History</h5>
        <p>Review your recent account access for any unauthorized activity.</p>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Date & Time</th>
                        <th>IP Address</th>
                        <th>Device</th>
                        <th>Location</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo htmlspecialchars($user['last_login']); ?></td>
                        <td>192.168.1.1</td>
                        <td>Chrome on Windows</td>
                        <td>New York, USA</td>
                        <td><span class="text-success"><i class="fas fa-check-circle"></i> Success</span></td>
                    </tr>
                    <tr>
                        <td>2025-03-15 09:45:12</td>
                        <td>192.168.1.1</td>
                        <td>Chrome on Windows</td>
                        <td>New York, USA</td>
                        <td><span class="text-success"><i class="fas fa-check-circle"></i> Success</span></td>
                    </tr>
                    <tr>
                        <td>2025-03-10 18:22:45</td>
                        <td>45.67.89.10</td>
                        <td>Safari on iPhone</td>
                        <td>Boston, USA</td>
                        <td><span class="text-success"><i class="fas fa-check-circle"></i> Success</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <a href="#" class="btn btn-outline-primary"><i class="fas fa-list"></i> View Full History</a>
    </div>
</div>

<div class="content" id="privacySection" style="display: none;">
    <h3 class="upper-text">Privacy Settings</h3>
    <p class="upper-text">Control how your data is used and shared.</p>
    
    <div class="card">
        <h5>Privacy Options</h5>
        <div class="mb-3 form-check form-switch">
            <input class="form-check-input" type="checkbox" id="profileVisibility" checked>
            <label class="form-check-label" for="profileVisibility">Allow others to view my profile</label>
        </div>
        <div class="mb-3 form-check form-switch">
            <input class="form-check-input" type="checkbox" id="emailVisibility">
            <label class="form-check-label" for="emailVisibility">Show my email address to other users</label>
        </div>
        <div class="mb-3 form-check form-switch">
            <input class="form-check-input" type="checkbox" id="searchVisibility" checked>
            <label class="form-check-label" for="searchVisibility">Allow my profile to appear in search results</label>
        </div>
        <button class="btn btn-primary"><i class="fas fa-save"></i> Save Privacy Settings</button>
    </div>
</div>

<div class="content" id="billingSection" style="display: none;">
    <h3 class="upper-text">Billing Settings</h3>
    <p class="upper-text">Manage your payment methods and subscription details.</p>
    
    <div class="card">
        <h5>Current Plan</h5>
        <div class="alert alert-primary">
            <h6 class="mb-1">Free Plan</h6>
            <p class="mb-0">Upgrade to Premium for additional features and benefits.</p>
        </div>
        <button class="btn btn-success"><i class="fas fa-arrow-up"></i> Upgrade Plan</button>
    </div>
    
    <div class="card">
        <h5>Payment Methods</h5>
        <p>No payment methods available.</p>
        <button class="btn btn-primary"><i class="fas fa-credit-card"></i> Add Payment Method</button>
    </div>
</div>

<div class="content" id="notificationsSection" style="display: none;">
    <h3 class="upper-text">Notification Settings</h3>
    <p class="upper-text">Control how and when you receive notifications.</p>
    
    <div class="card">
        <h5>Email Notifications</h5>
        <div class="mb-3 form-check form-switch">
            <input class="form-check-input" type="checkbox" id="securityEmails" checked disabled>
            <label class="form-check-label" for="securityEmails">Security alerts (cannot be disabled)</label>
        </div>
        <div class="mb-3 form-check form-switch">
            <input class="form-check-input" type="checkbox" id="newsletterEmails" checked>
            <label class="form-check-label" for="newsletterEmails">Newsletter and updates</label>
        </div>
        <div class="mb-3 form-check form-switch">
            <input class="form-check-input" type="checkbox" id="marketingEmails">
            <label class="form-check-label" for="marketingEmails">Marketing emails</label>
        </div>
        <button class="btn btn-primary"><i class="fas fa-save"></i> Save Email Preferences</button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="interactions/accsettings.js"></script>
</body>
</html>