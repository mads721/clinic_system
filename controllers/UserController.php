<?php
// UserController.php
// Use an absolute path relative to the root of the project
require_once $_SERVER['DOCUMENT_ROOT'] . '/web-proto/classes/Database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/web-proto/classes/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/web-proto/classes/Mailer.php';

class UserController {
    private $db;
    private $userModel;
    private $mailer;


    public function __construct() {
        $this->db = new Database();
        $conn = $this->db->connect();
        $this->userModel = new User($conn); 
        $this->mailer = new Mailer();
    }

    // Register a new user
    public function registerUser($firstName, $lastName, $email, $password, $confirmPassword, $role) {
        // Check if password and confirm password match
        if ($password !== $confirmPassword) {
            return ["status" => "error", "message" => "Passwords do not match."];
        }
        
        // Connect to database
        $conn = $this->db->connect();
        $user = new User($conn);
        
        // Check if email already exists as a verified user
        $existingUser = $user->getUserByEmail($email);
        if ($existingUser) {
            return ["status" => "error", "message" => "Email already registered."];
        }
        
        // Check if email exists but is unverified
        $unverifiedUser = $user->getUnverifiedUser($email);
        $otp = null;
        
        if ($unverifiedUser) {
            // Resend OTP for existing unverified user
            $otp = $user->resendOTP($email);
            if (!$otp) {
                return ["status" => "error", "message" => "Failed to resend verification code. Please try again."];
            }
        } else {
            // Register new unverified user with OTP
            $otp = $user->registerWithOTP($firstName, $lastName, $email, $password, $role);
            if (!$otp) {
                return ["status" => "error", "message" => "Registration failed. Please try again."];
            }
        }
        
        // Send OTP email
        $subject = "Your Eld Care Verification Code";
        $body = $this->getOTPEmailTemplate($firstName, $otp);
        
        if ($this->mailer->sendMail($email, $subject, $body)) {
            return [
                "status" => "success", 
                "message" => "A verification code has been sent to your email. Please verify to complete registration.",
                "email" => $email // Return email for verification form
            ];
        } else {
            return ["status" => "error", "message" => "Registration successful but failed to send verification email. Please contact support."];
        }
    }

    public function verifyOTP($email, $otp) {
        $conn = $this->db->connect();
        $user = new User($conn);
        
        if ($user->verifyOTP($email, $otp)) {
            return ["status" => "success", "message" => "Email verified successfully! You can now log in."];
        } else {
            return ["status" => "error", "message" => "Invalid or expired verification code. Please try again."];
        }
    }
    public function getAllUsersByRole($role) {
        return $this->userModel->getAllUsersByRole($role);
    }
    
    // Method to resend OTP
    public function resendOTP($email) {
        $conn = $this->db->connect();
        $user = new User($conn);
        
        // Get unverified user info for the email
        $unverifiedUser = $user->getUnverifiedUser($email);
        if (!$unverifiedUser) {
            return ["status" => "error", "message" => "Email not found or already verified."];
        }
        
        // Resend OTP
        $otp = $user->resendOTP($email);
        if (!$otp) {
            return ["status" => "error", "message" => "Failed to resend verification code. Please try again."];
        }
        
        // Send OTP email
        $subject = "Your E/C Care Verification Code (Resent)";
        $body = $this->getOTPEmailTemplate($unverifiedUser['first_name'], $otp);
        
        if ($this->mailer->sendMail($email, $subject, $body)) {
            return ["status" => "success", "message" => "A new verification code has been sent to your email."];
        } else {
            return ["status" => "error", "message" => "Failed to send verification email. Please try again."];
        }
    }
    
    // Email template for OTP
    private function getOTPEmailTemplate($name, $otp) {
        return "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background-color: #4CAF50; color: white; padding: 10px; text-align: center; }
                .content { padding: 20px; border: 1px solid #ddd; }
                .otp-code { font-size: 24px; font-weight: bold; text-align: center; padding: 10px; background-color: #f5f5f5; letter-spacing: 5px; }
                .footer { text-align: center; font-size: 12px; color: #777; margin-top: 20px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>Email Verification</h2>
                </div>
                <div class='content'>
                    <p>Hello $name,</p>
                    <p>Thank you for registering with our Clinic System. To complete your registration, please use the verification code below:</p>
                    <div class='otp-code'>$otp</div>
                    <p>This code will expire in 15 minutes. If you did not request this verification, please ignore this email.</p>
                </div>
                <div class='footer'>
                    <p>© " . date('Y') . " E/C Care Dental Clinic . All rights reserved.</p>
                </div>
            </div>
        </body>
        </html>
        ";
    }
    // Get all users
    public function getAllUsers() {
        $conn = $this->db->connect();
        $user = new User($conn);
        return $user->getAllUsers();
    }

    // Get user by ID
    public function getUserById($userId) {
        $conn = $this->db->connect();
        $user = new User($conn);
        return $user->getUserById($userId);
    }

    // Update user details
    public function updateUser($userId, $firstName, $lastName, $email, $role, $gender, $birthdate, $contactNumber, $address) {
        $conn = $this->db->connect();
        $user = new User($conn);
        return $user->updateUser($userId, $firstName, $lastName, $email, $role, $gender, $birthdate, $contactNumber, $address);
    }

    // Get user by email
    public function getUserByEmail($email) {
        $conn = $this->db->connect();
        $user = new User($conn);
        return $user->getUserByEmail($email);
    }

    // Register user as a doctor
    public function registerUserAsDoctor($firstName, $lastName, $email, $password, $role, $contact, $gender, $birthdate, $address) {
        $conn = $this->db->connect();
        $user = new User($conn);

        // Check if email already exists
        $existingUser = $user->getUserByEmail($email);
        if ($existingUser) return false;

        // Register user with additional fields
        return $user->registerWithContactAndDetails($firstName, $lastName, $email, $password, $role, $contact, $gender, $birthdate, $address);
    }

    public function loginUser($email, $password) {
        $user = $this->userModel->loginUser($email, $password);
    
        if ($user) {
            // Debugging: Check if session values are being set correctly
            // var_dump($_SESSION); // This will show session data after login
            
            return true;
        }
    
        return false;
    }
    
    /**
     * Request password reset
     * @param string $email User's email address
     * @return bool|string True if successful, error message if not
     */
    public function requestPasswordReset($email) {
        // Generate token and get user data
        $resetData = $this->userModel->createPasswordResetToken($email);
        
        if (!$resetData) {
            return "Email not found in our system.";
        }
        
        // Here you would normally send an email with the reset link
        // For testing purposes, we'll just return the token
        return $resetData;
    }
    
    /**
     * Reset password with token
     * @param string $token Reset token
     * @param string $newPassword New password
     * @param string $confirmPassword Confirm password
     * @return bool|string True if successful, error message if not
     */
    public function resetPassword($token, $newPassword, $confirmPassword) {
        // Validate the token
        $userData = $this->userModel->validateResetToken($token);
        
        if (!$userData) {
            return "Invalid or expired reset token.";
        }
        
        // Check if passwords match
        if ($newPassword !== $confirmPassword) {
            return "Passwords do not match.";
        }
        
        // Reset the password
        if ($this->userModel->resetPassword($token, $newPassword)) {
            return true;
        } else {
            return "Password reset failed. Please try again.";
        }
    }
}
?>