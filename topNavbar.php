<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user_full_name = $_SESSION['user_full_name'] ?? null;
$firstLetter = $user_full_name ? strtoupper($user_full_name[0]) : '';
?>

<nav class="navbar navbar-expand-lg navbar-white bg-white fixed-top shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand logo-container" href="./#home">
            <img src="pictures/unnamed.png" class="navbar-logo">
        </a>
        <a class="navbar-brand" href="./#home">Dental Care</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="./#home">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="services.php" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" onclick="location.href='services.php';">
                        Services
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                        <li><a class="dropdown-item" href="basic-services.php">Basic Services</a></li>
                        <li><a class="dropdown-item" href="specialized-services.php">Specialized Services</a></li>
                        <li><a class="dropdown-item" href="services.php">All Services</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="./#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="./#contact">Contact</a></li>
            </ul>
        </div>

        <?php if (isset($_SESSION['user_full_name'])): ?>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a style="text-decoration: none;" class="dropdown-toggle d-flex align-items-center text-info" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="rounded-circle bg-primary text-white text-center fw-bold d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                            <?= $firstLetter ?>
                        </div>
                        <?= $_SESSION['user_full_name']; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="my_account.php">My Account</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        <?php else: ?>
            <ul class="navbar-nav d-flex align-items-center">
                <li class="nav-item">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                </li>
            </ul>
        <?php endif; ?>
    </div>
</nav>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4 rounded-4 shadow-lg" data-aos="zoom-in">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Login to Your Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <?php if (isset($_SESSION['login_error'])): ?>
                    <div class="alert alert-danger">
                        <?= $_SESSION['login_error']; ?>
                    </div>
                <?php endif; ?>
                <form action="process-login.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" required>
                            <button type="button" class="btn btn-outline-secondary" id="togglePassword">Show</button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                <div class="text-center mt-3">
                    <a href="registration.php">Create a new account</a> |
                    <a href="forgot-password.php" class="text-danger">Forgot Password?</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Password toggle script -->
<script>
    document.getElementById("togglePassword").addEventListener("click", function () {
        var passwordField = document.querySelector("input[name='password']");
        var type = passwordField.type === "password" ? "text" : "password";
        passwordField.type = type;
        this.textContent = type === "password" ? "Show" : "Hide";
    });
</script>

<!-- Auto-show modal if login error -->
<?php if (isset($_SESSION['login_error'])): ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        loginModal.show();
    });
</script>
<?php unset($_SESSION['login_error']); ?>
<?php endif; ?>
<script>
    document.getElementById("togglePassword").addEventListener("click", function() {
        var passwordField = document.querySelector("input[name='password']");
        var type = passwordField.type === "password" ? "text" : "password";
        passwordField.type = type;
        this.textContent = type === "password" ? "Show" : "Hide";
    });
</script>

