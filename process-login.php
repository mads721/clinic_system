<?php
session_start();
include_once 'controllers/UserController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email and password from POST data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Create an instance of UserController
    $userController = new UserController();

    // Attempt to log the user in
    $loginSuccess = $userController->loginUser($email, $password);

    if ($loginSuccess) {
        // Redirect to the dashboard or the page the user should be taken to after logging in
        header("Location: index.php"); // Adjust this to your desired page
        exit();
    } else {
        // Login failed, redirect back to the login page or display an error message
        $_SESSION['login_error'] = "Invalid email or password!";
        header("Location: index.php?login=failed");
        exit();
        
    }
}
?>
