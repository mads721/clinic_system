<?php
// Add this at the beginning of reset-password.php, right after session_start()
session_start();
include 'classes/Database.php';
include 'classes/User.php';
require_once 'reset-pass-processor.php';


// Rest of your reset-password.php code follows...
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Eld Care</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="interactions/resetpass.css">
</head>
<body>
    <div class="container">
        <div class="logo-container">
            <img src="pictures/unnamed.png" alt="Eld Care Logo">
        </div>
        
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php if ($showForm): ?>
            <h2>Reset Password</h2>
            <p>Please enter your new password below</p>
            
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <div class="input-group password-field">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" id="password" name="password" class="form-control" required minlength="8">
                        <i class="toggle-password fas fa-eye" data-target="password"></i>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <div class="input-group password-field">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" required minlength="8">
                        <i class="toggle-password fas fa-eye" data-target="confirm_password"></i>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Reset Password</button>
            </form>
        <?php endif; ?>
        
        <div class="card-footer">
            <a href="index.php" class="back-link">
                <i class="fas fa-arrow-left me-1"></i> Back to Login
            </a>
        </div>
    </div>
    
    <script>
        // Toggle password visibility
        document.addEventListener('DOMContentLoaded', function() {
            const toggles = document.querySelectorAll('.toggle-password');
            
            toggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const passwordInput = document.getElementById(targetId);
                    
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        this.classList.replace('fa-eye', 'fa-eye-slash');
                    } else {
                        passwordInput.type = 'password';
                        this.classList.replace('fa-eye-slash', 'fa-eye');
                    }
                });
            });
        });
    </script>
    
    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 3rem;"></i>
                    </div>
                    <p class="text-center">Your password has been successfully updated!</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="index.php" class="btn btn-primary" id="goToLoginBtn">Go to Login</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Auto-show modal if password reset was successful -->
    <?php if (isset($_SESSION['password_reset_success'])): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
            
            // Add click event to "Go to Login" button
            document.getElementById('goToLoginBtn').addEventListener('click', function(e) {
                e.preventDefault();
                
                // Set session variable to show login modal on index page
                <?php $_SESSION['show_login_modal'] = true; ?>
                <?php $_SESSION['password_reset_message'] = "Password successfully updated. Please login with your new password."; ?>
                
                // Redirect to index page
                window.location.href = 'index.php';
            });
        });
    </script>
    <?php unset($_SESSION['password_reset_success']); ?>
    <?php endif; ?>
</body>
</html>