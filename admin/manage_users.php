<?php
session_start();
require_once '../controllers/UserController.php';

$userController = new UserController();
$role = "patient";

// Fetch all users
$users = $userController->getAllUsersByRole($role);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<?php
include 'includes/sidebar.php';
?>

<!-- Add this content-wrapper div -->
<div class="content-wrapper">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Manage Users</h5>
                        
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Contact</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Address</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Created</th>
                                        <th class="text-secondary opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></h6>
                                                    <p class="text-xs text-secondary mb-0"><?php echo htmlspecialchars($user['gender']); ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?php echo htmlspecialchars($user['email']); ?></p>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?php echo ($user['role'] === 'admin') ? 'primary' : 'secondary'; ?> text-white"><?php echo htmlspecialchars($user['role']); ?></span>
                                        </td>
                                        <td>
                                            <p class="text-xs text-secondary mb-0"><?php echo htmlspecialchars($user['contact_number']); ?></p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?php echo htmlspecialchars($user['address']); ?></p>
                                        </td>
                                        <td>
                                            <p class="text-xs text-secondary mb-0"><?php echo htmlspecialchars(date('M d, Y', strtotime($user['created_at']))); ?></p>
                                        </td>
                                        <td class="align-middle">
                                            <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="text-secondary font-weight-bold text-xs me-3" data-toggle="tooltip" title="Edit user">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add this style block -->
<style>
    /* Content wrapper styles to accommodate sidebar */
    .content-wrapper {
        margin-left: 250px;
        transition: margin-left 0.3s ease;
        padding: 20px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 767.98px) {
        .content-wrapper {
            margin-left: 0;
            padding-top: 60px; /* Space for mobile toggle button */
        }
    }
    
    /* Enhance table styles */
    .table {
        min-width: 1000px; /* Ensures horizontal scrolling on small screens */
    }
    
    .table th {
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }
    
    .table td {
        font-size: 14px;
        vertical-align: middle;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function confirmDelete(userId) {
        if (confirm('Are you sure you want to delete this user?')) {
            window.location.href = 'delete_user.php?id=' + userId;
        }
    }
</script>
</body>
</html>