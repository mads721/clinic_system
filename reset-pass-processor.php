<?php
/**
 * Reset Password Processor
 * This file contains all the PHP logic for password reset processing
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include required files
require_once 'classes/Database.php';
require_once 'classes/User.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Initialize variables to avoid undefined variable errors
$error = '';
$success = '';
$showForm = false;
$token = '';
$email = '';
$resetData = null;

// Create database and user objects
$database = new Database();
$conn = $database->connect();
$user = new User($conn);

// Check if token is in the URL
if (isset($_GET['token']) && !empty($_GET['token'])) {
    $token = $_GET['token'];
    
    // Check if the token exists in the database
    $userData = $user->getUserByResetToken($token);
    
    // Check if token is valid and not expired
    $userData = $user->validateResetToken($token);
    
    if ($userData) {
        // Token is valid, show password reset form
        $showForm = true;
        $email = $userData['email']; // Set email from userData
    } else {
        // Invalid or expired token
        $error = "Invalid or expired password reset link. Please request a new one.";
    }
    
    // Process form submission
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['password'], $_POST['confirm_password'])) {
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];
    
        if ($password !== $confirmPassword) {
            $error = "Passwords do not match.";
        } elseif (strlen($password) < 8) {
            $error = "Password must be at least 8 characters long.";
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            // Update the password in the database
            $updateSuccess = $user->updatePasswordByEmail($email, $hashedPassword);
    
            if ($updateSuccess) {
                // Clear the reset token
                $user->clearResetToken($email);
    
                // Set success message
                $success = "Password has been successfully updated. You may now login.";
                $showForm = false;
                
                // Set session variable to trigger success modal
                $_SESSION['password_reset_success'] = true;
            } else {
                $error = "Something went wrong. Please try again later.";
            }
        }
    }
}