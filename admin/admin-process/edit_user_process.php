<?php
require_once '../controllers/UserController.php';

$userController = new UserController();
$errors = [];
$successMessage = '';
$user = null;

// Get user data if ID is provided
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $userId = (int)$_GET['id'];
    $user = $userController->getUserById($userId);

    if (!$user) {
        $_SESSION['error_message'] = "User not found!";
        header('Location: manage_users.php');
        exit();
    }
} else {
    $_SESSION['error_message'] = "Invalid user ID!";
    header('Location: manage_users.php');
    exit();
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $firstName = trim($_POST['first_name'] ?? '');
    $lastName = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $role = $_POST['role'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $birthdate = $_POST['birthdate'] ?? '';
    $contactNumber = trim($_POST['contact_number'] ?? '');
    $address = trim($_POST['address'] ?? '');

    // Validate inputs
    if (empty($firstName)) $errors[] = "First name is required";
    if (empty($lastName)) $errors[] = "Last name is required";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required";
    } else {
        $existingUser = $userController->getUserByEmail($email);
        if ($existingUser && $existingUser['id'] != $userId) {
            $errors[] = "Email already in use by another account";
        }
    }
    if (empty($contactNumber)) $errors[] = "Contact number is required";

    // If no errors, update user
    if (empty($errors)) {
        try {
            $result = $userController->updateUser(
                $userId,
                $firstName,
                $lastName,
                $email,
                $role,
                $gender,
                $birthdate,
                $contactNumber,
                $address
            );

            if ($result) {
                $_SESSION['success_message'] = "User information updated successfully!";
                header('Location: manage_users.php');
                exit();
            } else {
                $errors[] = "Failed to update user information. Please try again.";
            }
        } catch (Exception $e) {
            $errors[] = "Error: " . $e->getMessage();
        }
    }

    // Update $user with latest form data for sticky form
    $user = [
        'first_name' => $firstName,
        'last_name' => $lastName,
        'email' => $email,
        'role' => $role,
        'gender' => $gender,
        'birthdate' => $birthdate,
        'contact_number' => $contactNumber,
        'address' => $address
    ];
}
?>
