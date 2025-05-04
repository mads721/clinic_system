<?php
// forgot-password.php
session_start();
include 'classes/Database.php'; // Your DB connection
include 'classes/User.php';     // Include User class
include 'classes/Mailer.php';   // Include your Mailer class

// Create database and user objects
$database = new Database();
$conn = $database->connect();
$user = new User($conn);
$mailer = new Mailer();

$success = $error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        // Create password reset token
        $resetData = $user->createPasswordResetToken($email);

        if ($resetData) {
            // Get the site domain from server or use a config variable
            $domain = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'C:/xampp/htdocs/web-proto/';
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
            
            // Create the reset link
            $resetLink = "$protocol://$domain/web-proto/reset-password.php?token=" . $resetData['token'];
            
            // Create email message
            $subject = "E/C Care Dental Clinic - Password Reset";
            $message = "
            <html>
            <head>
                <title>Reset Your Password</title>
            </head>
            <body>
                <div style='max-width: 600px; margin: 0 auto; padding: 20px; font-family: Arial, sans-serif;'>
                    <div style='text-align: center; margin-bottom: 20px;'>
                        <img src='$protocol://$domain/web-proto/pictures/unnamed.png' alt='E/C Care Logo' style='max-height: 80px;'>
                    </div>
                    <div style='background-color: #f8f9fc; border-radius: 10px; padding: 20px; border: 1px solid #e3e6f0;'>
                        <h2 style='color: #4e73df; margin-bottom: 15px;'>Password Reset Request</h2>
                        <p>Hello,</p>
                        <p>We received a request to reset your password for your E/C Care account. Click the button below to reset your password:</p>
                        <p style='text-align: center; margin: 30px 0;'>
                            <a href='$resetLink' style='background-color: #4e73df; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; font-weight: bold;'>Reset Password</a>
                        </p>
                        <p>If you didn't request a password reset, you can ignore this email. This link will expire in 1 hour.</p>
                        <p>If the button above doesn't work, copy and paste this URL into your browser:</p>
                        <p style='background-color: #e9ecef; padding: 10px; border-radius: 5px; word-break: break-all;'>$resetLink</p>
                    </div>
                    <p style='color: #858796; text-align: center; margin-top: 20px; font-size: 12px;'>
                        © " . date('Y') . " E/C Care Dental Clinic. All rights reserved.
                    </p>
                </div>
            </body>
            </html>
            ";
            
            try {
                // Send email using your Mailer class
                $emailSent = $mailer->sendMail($email, $subject, $message);
                
                if ($emailSent) {
                    $success = "A password reset link has been sent to your email.";
                } else {
                    $error = "Could not send the password reset email. Please try again later.";
                    // Log the error for debugging
                    error_log("Failed to send password reset email to $email");
                }
            } catch (Exception $e) {
                $error = "An error occurred while sending the email. Please try again later.";
                error_log("Email error: " . $e->getMessage());
            }
        } else {
            // For security, don't reveal whether the email exists or not
            $success = "If your email is registered, a reset link has been sent.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | E/C Care</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="interactions/forgotpass.css">
    <style>
       
    </style>
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

        <h2>Forgot Password</h2>
        <p>Enter your email address to receive a password reset link.</p>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane me-2"></i>Send Reset Link
            </button>
        </form>
        <div class="card-footer">
            <a href="index.php" class="back-link">
                <i class="fas fa-arrow-left me-1"></i> Back to Login
            </a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>