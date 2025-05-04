<?php
// File: manage_appointments.php

session_start();

// Include necessary files
require_once $_SERVER['DOCUMENT_ROOT'] . '/web-proto/classes/Database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/web-proto/controllers/AppointmentController.php';

// Create database connection
$database = new Database();
$conn = $database->connect();

// Initialize AppointmentController
$appointmentController = new AppointmentController($conn);

// Handle status filter
$statusFilter = isset($_GET['status']) ? $_GET['status'] : 'all';

// Get all appointments
$appointments = $appointmentController->getAllAppointments();

// Filter appointments by status if required
if ($statusFilter != 'all') {
    $appointments = array_filter($appointments, function($appointment) use ($statusFilter) {
        return $appointment['status'] == $statusFilter;
    });
}

// Handle appointment status update via AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'updateStatus') {
    $appointmentId = isset($_POST['appointmentId']) ? intval($_POST['appointmentId']) : 0;
    $newStatus = isset($_POST['status']) ? $_POST['status'] : '';
    
    if ($appointmentId > 0 && in_array($newStatus, ['scheduled', 'completed', 'cancelled', 'no-show'])) {
        $result = $appointmentController->updateAppointmentStatus($appointmentId, $newStatus);
        
        // Return JSON response for AJAX
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
}

// Handle appointment deletion
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $appointmentId = intval($_GET['id']);
    $result = $appointmentController->deleteAppointment($appointmentId);
    
    if ($result['success']) {
        $_SESSION['success'] = $result['message'];
    } else {
        $_SESSION['error'] = $result['message'];
    }
    
    // Redirect to refresh page
    header('Location: manage_appointments.php');
    exit;
}

// Get appointment stats for the top cards
$appointmentStats = $appointmentController->getAppointmentCountsByStatus();
$totalAppointments = array_sum($appointmentStats);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Appointments</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Add DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
</head>
<body>
    <?php include 'includes/sidebar.php'; ?>

    <!-- Content wrapper div -->
    <div class="content-wrapper">
        <div class="container-fluid py-4">
            <div class="row mb-4">
                <div class="col-12">
                    <h1 class="h3 mb-0 text-gray-800">Appointment Management</h1>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Appointments</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalAppointments; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Scheduled</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $appointmentStats['scheduled']; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Completed</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $appointmentStats['completed']; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Cancelled/No-Show</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo ($appointmentStats['cancelled'] + $appointmentStats['no-show']); ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar-times fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Appointments List Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Appointments</h6>
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <select id="statusFilter" class="form-select form-select-sm" onchange="window.location.href='manage_appointments.php?status=' + this.value">
                                        <option value="all" <?php echo ($statusFilter == 'all') ? 'selected' : ''; ?>>All Status</option>
                                        <option value="scheduled" <?php echo ($statusFilter == 'scheduled') ? 'selected' : ''; ?>>Scheduled</option>
                                        <option value="completed" <?php echo ($statusFilter == 'completed') ? 'selected' : ''; ?>>Completed</option>
                                        <option value="cancelled" <?php echo ($statusFilter == 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                                        <option value="no-show" <?php echo ($statusFilter == 'no-show') ? 'selected' : ''; ?>>No-Show</option>
                                    </select>
                                </div>
                                <a href="add_appointment.php" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus me-1"></i> New Appointment
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Success or error message -->
                            <?php if (isset($_SESSION['success'])) { ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?php 
                                    echo $_SESSION['success']; 
                                    unset($_SESSION['success']);
                                    ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php } ?>

                            <?php if (isset($_SESSION['error'])) { ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php 
                                    echo $_SESSION['error']; 
                                    unset($_SESSION['error']);
                                    ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php } ?>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="appointmentsTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Patient</th>
                                            <th>Doctor</th>
                                            <th>Service</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($appointments as $appointment) { ?>
                                            <tr>
                                                <td><?php echo $appointment['id']; ?></td>
                                                <td><?php echo htmlspecialchars($appointment['patient_name']); ?></td>
                                                <td><?php echo htmlspecialchars($appointment['doctor_name']); ?></td>
                                                <td><?php echo htmlspecialchars($appointment['service_name']); ?></td>
                                                <td><?php echo date('M d, Y', strtotime($appointment['appointment_date'])); ?></td>
                                                <td><?php echo date('h:i A', strtotime($appointment['appointment_time'])); ?></td>
                                                <td>
                                                    <select class="form-select form-select-sm status-select" 
                                                            data-appointment-id="<?php echo $appointment['id']; ?>">
                                                        <option value="scheduled" <?php echo ($appointment['status'] == 'scheduled') ? 'selected' : ''; ?>>Scheduled</option>
                                                        <option value="completed" <?php echo ($appointment['status'] == 'completed') ? 'selected' : ''; ?>>Completed</option>
                                                        <option value="cancelled" <?php echo ($appointment['status'] == 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                                                        <option value="no-show" <?php echo ($appointment['status'] == 'no-show') ? 'selected' : ''; ?>>No-Show</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <a href="edit_appointment.php?id=<?php echo $appointment['id']; ?>" class="btn btn-sm btn-warning me-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="manage_appointments.php?action=delete&id=<?php echo $appointment['id']; ?>"
                                                       class="btn btn-sm btn-danger"
                                                       onclick="return confirm('Are you sure you want to delete this appointment?');">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include JS libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- Custom JS -->
    <script>
        $(document).ready(function () {
            $('#appointmentsTable').DataTable();

            // Handle status update via AJAX
            $('.status-select').change(function () {
                var appointmentId = $(this).data('appointment-id');
                var newStatus = $(this).val();

                $.ajax({
                    url: 'manage_appointments.php',
                    method: 'POST',
                    data: {
                        action: 'updateStatus',
                        appointmentId: appointmentId,
                        status: newStatus
                    },
                    success: function (response) {
                        if (response.success) {
                            alert('Status updated successfully!');
                        } else {
                            alert('Failed to update status: ' + response.message);
                        }
                    },
                    error: function () {
                        alert('An error occurred while updating status.');
                    }
                });
            });
        });
    </script>
</body>
</html>
