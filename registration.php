<?php
session_start();
require_once 'controllers/UserController.php';
require_once 'classes/Mailer.php'; // Include your Mailer class

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    // Create database connection (assuming it's required by your UserController)
    require_once 'classes/Database.php';
    $db = new Database();
    
    // Create mailer instance
    $mailer = new Mailer();
    
    // Initialize UserController with DB and Mailer
    $userController = new UserController($db, $mailer);

    // Always set role as patient for this registration page
    $role = 'patient'; 

    $firstName = $_POST['first_name'] ?? '';
    $lastName = $_POST['last_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    // Register user with OTP verification
    $result = $userController->registerUser($firstName, $lastName, $email, $password, $confirmPassword, $role);

    if ($result['status'] === 'success') {
        // Store email in session for OTP verification
        $_SESSION['verify_email'] = $email;
        
        // Store user details in session for potential use in verification page
        $_SESSION['user_details'] = [
            'first_name' => $firstName,
            'last_name' => $lastName
        ];
        
        // Redirect to OTP verification page
        header("Location: verify_otp.php");
        exit;
    } else {
        // Registration failed
        $_SESSION['message'] = $result['message'];
        header("Location: registration.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - Eld Care</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="interactions/registration.css">
  <style>
    .notification {
      position: absolute;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 1000;
      background-color: #28a745;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      display: none;
    }
    #passwordMessage {
      font-size: 0.85em;
      color: red;
      margin-top: 5px;
    }
    .notification.error {
      background-color: #dc3545;
    }
  </style>
</head>
<body>

<?php if (isset($_SESSION['message'])): ?>
  <div class="notification <?php echo (strpos($_SESSION['message'], 'error') !== false) ? 'error' : ''; ?>" id="registrationNotification">
    <?php echo $_SESSION['message']; ?>
    <?php unset($_SESSION['message']); ?>
  </div>
<?php endif; ?>

<div class="container">
  <div class="registration-card">
    <div class="row g-0">
      <div class="col-md-8">
        <div class="card-header">
          <div class="logo-container">
            <img src="pictures/unnamed.png" alt="Eld Care Logo">
          </div>
          <h2>Create an Account</h2>
          <p class="subtitle">Join EC Care and start your caregiving journey</p>
        </div>
        <div class="card-body">
          <div class="form-separator"></div>
          <form action="registration.php" method="POST">
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" id="firstName" name="first_name" class="form-control" required minlength="2">
              </div>
              <div class="col-md-6">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" id="lastName" name="last_name" class="form-control" required minlength="2">
              </div>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" id="email" name="email" class="form-control" placeholder="your@email.com" required>
            </div>
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                  <input type="password" id="password" name="password" class="form-control" required minlength="8">
                  <span class="input-group-text" onclick="togglePassword('password', this)">
                    <i class="fas fa-eye"></i>
                  </span>
                </div>
                <div id="passwordMessage"></div> <!-- Message container -->
              </div>
              <div class="col-md-6">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <div class="input-group">
                  <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required minlength="8">
                  <span class="input-group-text" onclick="togglePassword('confirmPassword', this)">
                    <i class="fas fa-eye"></i>
                  </span>
                </div>
              </div>
            </div>
            <input type="hidden" name="role" value="patient">
            <button type="submit" name="register" class="btn btn-primary">Create Account</button>
          </form>
          <a href="index.php" class="login-link">Already have an account? Login here</a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card-side">
          <h3>Benefits of Joining</h3>
          <div class="feature-item">
            <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
            <div>Access to verified caregiving resources</div>
          </div>
          <div class="feature-item">
            <div class="feature-icon"><i class="fas fa-calendar-check"></i></div>
            <div>Schedule appointments and reminders</div>
          </div>
          <div class="feature-item">
            <div class="feature-icon"><i class="fas fa-users"></i></div>
            <div>Connect with professional care network</div>
          </div>
          <div class="feature-item">
            <div class="feature-icon"><i class="fas fa-file-medical"></i></div>
            <div>Securely store important documents</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Show registration message
  if (document.getElementById("registrationNotification")) {
    document.getElementById("registrationNotification").style.display = "block";
    setTimeout(function() {
      document.getElementById("registrationNotification").style.display = "none";
    }, 5000);
  }

  function togglePassword(fieldId, icon) {
    let field = document.getElementById(fieldId);
    if (field.type === "password") {
      field.type = "text";
      icon.innerHTML = '<i class="fas fa-eye-slash"></i>';
    } else {
      field.type = "password";
      icon.innerHTML = '<i class="fas fa-eye"></i>';
    }
  }

  // Show password length message
  document.getElementById('password').addEventListener('input', function () {
    const messageBox = document.getElementById('passwordMessage');
    if (this.value.length > 0 && this.value.length < 8) {
      messageBox.textContent = "Password must be 8 characters for better security";
    } else {
      messageBox.textContent = "";
    }
  });
</script>
</body>
</html>