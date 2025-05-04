<?php
// Include the necessary files
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/web-proto/classes/Database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/web-proto/controllers/DoctorController.php';

// Create a new instance of Database to connect
$database = new Database();
$conn = $database->connect();

// Initialize the controller
$doctorController = new DoctorController($conn);

// Fetch all doctors
$doctors = $doctorController->getAllDoctors();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Doctors</title>
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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Manage Doctors</h5>
                        <a href="add_doctor.php" class="btn btn-primary btn-sm">
                            <i class="fas fa-user-md me-1"></i> Add New Doctor
                        </a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <?php if (empty($doctors)): ?>
                            <div class="text-center py-5">
                                <i class="fas fa-user-md fa-3x text-secondary mb-3"></i>
                                <p class="text-secondary">No doctors found in the system</p>
                                <a href="add_doctor.php" class="btn btn-primary btn-sm">Add Your First Doctor</a>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Photo</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Doctor Name</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Specialization</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Contact No.</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Address</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Added On</th>
                                            <th class="text-secondary opacity-7">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($doctors as $doctor): ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <?php if (!empty($doctor['docPic'])): ?>
                                                        <img src="<?php echo htmlspecialchars($doctor['docPic']); ?>" class="avatar avatar-sm me-3" alt="Doctor Photo">
                                                    <?php else: ?>
                                                        <div class="avatar avatar-sm me-3 bg-secondary">
                                                            <i class="fas fa-user-md text-white"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-0 text-sm"><?php echo htmlspecialchars($doctor['docFname'] . ' ' . $doctor['docLname']); ?></h6>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-info text-white"><?php echo htmlspecialchars($doctor['specialization']); ?></span>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0"><?php echo htmlspecialchars($doctor['contactno']); ?></p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0"><?php echo htmlspecialchars($doctor['address']); ?></p>
                                            </td>
                                            <td>
                                                <p class="text-xs text-secondary mb-0"><?php echo date('M d, Y', strtotime($doctor['creationDate'])); ?></p>
                                            </td>
                                            <td class="align-middle">
                                                <a href="edit_doctor.php?id=<?php echo $doctor['id']; ?>" class="btn btn-outline-primary btn-sm me-2" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete(<?php echo $doctor['id']; ?>)" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
    .content-wrapper {
        margin-left: 250px;
        transition: margin-left 0.3s ease;
        padding: 20px;
    }

    @media (max-width: 767.98px) {
        .content-wrapper {
            margin-left: 0;
            padding-top: 60px;
        }
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

    .btn-sm {
        font-size: 12px;
        padding: 5px 10px;
    }
    
    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function confirmDelete(doctorId) {
        if (confirm('Are you sure you want to delete this doctor?')) {
            window.location.href = 'delete_doctor.php?id=' + doctorId;
        }
    }
</script>

</body>
</html>