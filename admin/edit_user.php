<?php
session_start();
require_once '../controllers/UserController.php';

// Check for admin session
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

require_once 'admin-process/edit_user_process.php';
?>


<!-- HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit User - Medical Admin</title>
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<?php include 'includes/sidebar.php'; ?>

<div class="content-wrapper">
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Edit User</h5>
            <a href="manage_users.php" class="btn btn-outline-secondary btn-sm">
              <i class="fas fa-arrow-left me-2"></i>Back to Users
            </a>
          </div>
          <div class="card-body">
            <?php if (!empty($errors)): ?>
              <div class="alert alert-danger"><ul class="mb-0"><?php foreach ($errors as $error): ?><li><?= htmlspecialchars($error) ?></li><?php endforeach; ?></ul></div>
            <?php endif; ?>

            <form method="POST" action="edit_user.php?id=<?= $userId ?>" id="editUserForm">
              <input type="hidden" name="id" value="<?= $userId ?>">

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="first_name">First Name</label>
                  <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($user['first_name']) ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="last_name">Last Name</label>
                  <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($user['last_name']) ?>" required>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="contact_number">Contact Number</label>
                  <input type="text" name="contact_number" class="form-control" value="<?= htmlspecialchars($user['contact_number']) ?>" required>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4 mb-3">
                  <label for="role">Role</label>
                  <select name="role" class="form-select" required>
                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="doctor" <?= $user['role'] === 'doctor' ? 'selected' : '' ?>>Doctor</option>
                    <option value="patient" <?= $user['role'] === 'patient' ? 'selected' : '' ?>>Patient</option>
                  </select>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="gender">Gender</label>
                  <select name="gender" class="form-select" required>
                    <option value="Male" <?= strcasecmp($user['gender'], 'Male') === 0 ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= strcasecmp($user['gender'], 'Female') === 0 ? 'selected' : '' ?>>Female</option>
                    <option value="Other" <?= strcasecmp($user['gender'], 'Other') === 0 ? 'selected' : '' ?>>Other</option>
                  </select>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="birthdate">Birthdate</label>
                  <input type="date" name="birthdate" class="form-control" value="<?= htmlspecialchars($user['birthdate']) ?>" required>
                </div>
              </div>

              <div class="mb-3">
                <label for="address">Address</label>
                <textarea name="address" class="form-control" rows="3" required><?= htmlspecialchars($user['address']) ?></textarea>
              </div>

              <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" onclick="window.location.href='manage_users.php'">Cancel</button>
                <button type="submit" class="btn btn-primary">
                  <i class="fas fa-save me-2"></i>Update User
                </button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
