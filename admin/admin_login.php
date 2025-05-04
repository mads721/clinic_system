<?php
session_start();
require_once('../classes/Database.php');
require_once('../classes/Admin.php');

// Check if already logged in
if (isset($_SESSION['admin_id'])) {
    header("Location: admin_dashboard.php");
    exit;
}

// DB connection
$db = (new Database())->connect();
$adminModel = new Admin($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $admin = $adminModel->login($username, $password);

    if ($admin) {
        $_SESSION['admin_id'] = $admin['id'];
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Invalid username or password.";
        header("Location: admin_login.php");
        exit;
    }
}

// Show error if exists and clear it after
$error_message = '';
if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Admin Login</h4>
                </div>
                <div class="card-body">
                    <?php if ($error_message): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $error_message ?>
                        </div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
                <div class="card-footer text-muted text-center">
                    &copy; <?= date("Y") ?> Clinic System
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
