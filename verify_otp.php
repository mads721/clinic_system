<?php
// verify_otp.php - OTP verification page
session_start();

// Redirect if email is not set in session
if (!isset($_SESSION['verify_email'])) {
    header("Location: registration.php");
    exit();
}

// Include necessary files
require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'controllers/UserController.php';
require_once 'classes/Mailer.php';

$db = new Database();
$mailer = new Mailer();
$userController = new UserController($db, $mailer);

$message = '';
$status = '';
$email = $_SESSION['verify_email'];
$firstName = isset($_SESSION['user_details']['first_name']) ? $_SESSION['user_details']['first_name'] : '';
$redirectToLogin = false;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['verify_otp'])) {
        // Verify OTP
        $otp = trim($_POST['otp']);
        $result = $userController->verifyOTP($email, $otp);
        
        $status = $result['status'];
        $message = $result['message'];
        
        if ($status === 'success') {
            // Clear session variables
            unset($_SESSION['verify_email']);
            unset($_SESSION['user_details']);
            
            // Set success message for index page
            $_SESSION['registration_success_message'] = "Account created successfully. Please log in.";
            $_SESSION['show_login_modal'] = true;
            
            // Set flag to redirect after showing success message
            $redirectToLogin = true;
        }
    } elseif (isset($_POST['resend_otp'])) {
        // Resend OTP
        $result = $userController->resendOTP($email);
        
        $status = $result['status'];
        $message = $result['message'];
    }
}

// Mask the email for display
function maskEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        list($first, $domain) = explode('@', $email);
        $first = strlen($first) <= 2 ? $first : substr($first, 0, 1) . str_repeat('*', strlen($first) - 2) . substr($first, -1);
        $domain_parts = explode('.', $domain);
        $domain_first = strlen($domain_parts[0]) <= 2 ? $domain_parts[0] : substr($domain_parts[0], 0, 1) . str_repeat('*', strlen($domain_parts[0]) - 2) . substr($domain_parts[0], -1);
        $masked_domain = $domain_first . '.' . $domain_parts[1];
        return $first . '@' . $masked_domain;
    }
    return $email;
}

$maskedEmail = maskEmail($email);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification - Eld Care</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="interactions/registration.css">
    <style>
        .verification-card {
            max-width: 550px;
            margin: 50px auto;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        
        .card-header {
            background-color: #f8f9fa;
            padding: 25px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }
        
        .logo-container img {
            max-height: 60px;
            margin-bottom: 15px;
        }
        
        .card-body {
            padding: 30px;
        }
        
        .otp-input {
            letter-spacing: 12px;
            font-weight: bold;
            font-size: 24px;
            text-align: center;
            border-radius: 8px;
        }
        
        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
            padding: 10px 20px;
            font-weight: 600;
            border-radius: 8px;
        }
        
        .btn-primary:hover {
            background-color: #3a5fc8;
            border-color: #3a5fc8;
        }
        
        .timer {
            font-size: 14px;
            color: #666;
            text-align: center;
            margin-top: 15px;
        }
        
        .notification {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            display: none;
            max-width: 90%;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        
        .notification.success {
            background-color: #28a745;
        }
        
        .notification.error {
            background-color: #dc3545;
        }
        
        .link-muted {
            color: #6c757d;
            text-decoration: none;
        }
        
        .link-muted:hover {
            color: #4e73df;
            text-decoration: underline;
        }
        
        .verification-subtitle {
            color: #6c757d;
            margin-bottom: 20px;
        }
        
        .email-sent-icon {
            font-size: 48px;
            color: #4e73df;
            margin-bottom: 20px;
        }

        /* Add fade out animation */
        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }
        
        .fade-out {
            animation: fadeOut 1s ease forwards;
        }
    </style>
</head>
<body>

<!-- Custom success notification container -->
<div class="notification success" id="verificationNotification" style="<?php echo (!empty($message) && $status === 'success') ? 'display:block;' : ''; ?>">
    <?php echo $message; ?>
</div>

<!-- Error notification container -->
<div class="notification error" id="errorNotification" style="<?php echo (!empty($message) && $status === 'error') ? 'display:block;' : ''; ?>">
    <?php echo $message; ?>
</div>

<div class="container">
    <div class="verification-card">
        <div class="card-header">
            <div class="logo-container">
                <img src="pictures/unnamed.png" alt="Eld Care Logo">
            </div>
            <h2>Verify Your Email</h2>
            <p class="verification-subtitle">We've sent a verification code to your email</p>
        </div>
        <div class="card-body">
            <div class="text-center mb-4">
                <div class="email-sent-icon">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <p>Please enter the 6-digit verification code sent to:</p>
                <p><strong><?php echo htmlspecialchars($maskedEmail); ?></strong></p>
                <?php if (!empty($firstName)): ?>
                    <p>Hi <?php echo htmlspecialchars($firstName); ?>, we're excited to have you join us!</p>
                <?php endif; ?>
            </div>
            
            <form method="POST" action="">
                <div class="mb-4">
                    <input type="text" class="form-control otp-input" name="otp" id="otp" maxlength="6" required placeholder="------" autocomplete="off">
                </div>
                <div class="d-grid gap-2 mb-3">
                    <button type="submit" name="verify_otp" class="btn btn-primary">Verify & Continue</button>
                </div>
            </form>
            
            <div class="timer text-center" id="timer">Code expires in <span id="countdown">15:00</span></div>
            
            <hr class="my-4">
            
            <div class="text-center">
                <p>Didn't receive the code?</p>
                <form method="POST" action="">
                    <button type="submit" name="resend_otp" class="btn btn-link link-muted" id="resend-btn">
                        <i class="fas fa-redo-alt me-1"></i> Resend Code
                    </button>
                </form>
                <a href="registration.php" class="btn btn-link link-muted">
                    <i class="fas fa-arrow-left me-1"></i> Back to Registration
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    // Handle success redirection with delay
    <?php if ($redirectToLogin): ?>
    window.onload = function() {
        // Store success message in sessionStorage
        sessionStorage.setItem('show_login_modal', 'true');
        sessionStorage.setItem('registration_success_message', 'Account created successfully. Please log in.');
        
        // Show the success notification
        const notification = document.getElementById('verificationNotification');
        notification.style.display = 'block';
        
        // After 3 seconds, fade out the notification and form
        setTimeout(function() {
            notification.classList.add('fade-out');
            document.querySelector('.verification-card').classList.add('fade-out');
            
            // After fadeout, redirect to index page
            setTimeout(function() {
                window.location.href = 'index.php';
            }, 600); // Wait for fade animation to complete
        }, 3000); // Show notification for 3 seconds
    };
    <?php endif; ?>
    
    // Show notification if exists
    const errorNotification = document.getElementById("errorNotification");
    if (errorNotification && errorNotification.style.display === 'block') {
        setTimeout(function() {
            errorNotification.style.display = "none";
        }, 5000);
    }
    
    // Timer functionality
    let minutes = 15;
    let seconds = 0;
    const countdownEl = document.getElementById('countdown');
    const resendBtn = document.getElementById('resend-btn');
    
    // Disable resend button initially for 1 minute
    resendBtn.disabled = true;
    
    const timer = setInterval(function() {
        if (seconds === 0) {
            if (minutes === 0) {
                clearInterval(timer);
                countdownEl.innerHTML = "Expired";
                resendBtn.disabled = false;
                return;
            }
            minutes--;
            seconds = 59;
        } else {
            seconds--;
        }
        
        // Enable resend button after 1 minute
        if (minutes <= 14 && seconds <= 0) {
            resendBtn.disabled = false;
        }
        
        // Format display
        const displayMinutes = minutes < 10 ? "0" + minutes : minutes;
        const displaySeconds = seconds < 10 ? "0" + seconds : seconds;
        
        countdownEl.innerHTML = displayMinutes + ":" + displaySeconds;
    }, 1000);
    
    // Restrict OTP input to numbers only
    document.getElementById('otp').addEventListener('input', function (e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    
    // Auto focus next input and auto submit when complete
    document.getElementById('otp').addEventListener('keyup', function() {
        if (this.value.length === 6) {
            // Could auto-submit the form here if desired
            // document.querySelector('button[name="verify_otp"]').click();
        }
    });
</script>

</body>
</html>