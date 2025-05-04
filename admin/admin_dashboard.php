<?php
session_start();
require_once('../classes/Database.php');
require_once('../controllers/DashboardController.php');

// Check if already logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

// Set variables for sidebar and active page
$isAdminLoggedIn = true;
$activePage = 'dashboard';

// DB connection
$db = (new Database())->connect();

// Dashboard controller instance
$controller = new DashboardController($db);

// Fetch dashboard data
$dashboardData = $controller->getDashboardData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .main-content {
            min-height: 100vh;
        }
        .stat-card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .stat-card .card-body {
            padding: 1.5rem;
        }
        .stat-icon {
            font-size: 2rem;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
        }
        .chart-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
        }
        .page-header {
            padding-bottom: 1rem;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 p-0">
                <?php include_once('includes/sidebar.php'); ?>
            </div>

            <!-- Main Content -->
            <div class="col-md-11 col-lg-12 main-content p-4">
                <div class="page-header d-flex justify-content-between align-items-center">
                    <h2>Dashboard Overview</h2>
                    <div class="date-display">
                        <span class="text-muted"><?= date("l, F j, Y") ?></span>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="row mb-4">
                    <!-- Total Users -->
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card stat-card bg-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title text-muted mb-0">Total Users</h6>
                                        <h2 class="stat-number mt-2 mb-2"><?= $dashboardData['total_users'] ?></h2>
                                    </div>
                                    <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Doctors -->
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card stat-card bg-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title text-muted mb-0">Total Doctors</h6>
                                        <h2 class="stat-number mt-2 mb-2"><?= $dashboardData['total_doctors'] ?></h2>
                                    </div>
                                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                                        <i class="fas fa-user-md"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Appointments -->
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card stat-card bg-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title text-muted mb-0">Total Appointments</h6>
                                        <h2 class="stat-number mt-2 mb-2"><?= $dashboardData['total_appointments'] ?></h2>
                                    </div>
                                    <div class="stat-icon bg-info bg-opacity-10 text-info">
                                        <i class="fas fa-calendar-check"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Active Appointments -->
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card stat-card bg-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title text-muted mb-0">Active Appointments</h6>
                                        <h2 class="stat-number mt-2 mb-2"><?= $dashboardData['active_appointments'] ?></h2>
                                    </div>
                                    <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                                        <i class="fas fa-calendar-day"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="row">
                    <!-- Users Chart -->
                    <div class="col-md-6 mb-4">
                        <div class="chart-container">
                            <h5 class="mb-4">User Distribution</h5>
                            <canvas id="usersChart" height="250"></canvas>
                        </div>
                    </div>

                    <!-- Appointments Chart -->
                    <div class="col-md-6 mb-4">
                        <div class="chart-container">
                            <h5 class="mb-4">Appointment Status</h5>
                            <canvas id="appointmentsChart" height="250"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Bootstrap + Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Chart.js Scripts -->
<script>
    // User Distribution Doughnut
    const ctxUsers = document.getElementById('usersChart').getContext('2d');
    const doctors = <?= $dashboardData['total_doctors'] ?>;
    const patients = <?= $dashboardData['total_users'] - $dashboardData['total_doctors'] ?>;
    
    new Chart(ctxUsers, {
        type: 'doughnut',
        data: {
            labels: ['Doctors', 'Patients'],
            datasets: [{
                data: [doctors, patients],
                backgroundColor: ['rgba(54, 162, 235, 0.8)', 'rgba(75, 192, 192, 0.8)'],
                borderColor: ['rgba(54, 162, 235, 1)', 'rgba(75, 192, 192, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            let value = context.raw || 0;
                            let total = context.dataset.data.reduce((a, b) => a + b, 0);
                            let percentage = Math.round((value / total) * 100);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            },
            cutout: '70%'
        }
    });

    // Appointment Status Doughnut
    const ctxAppointments = document.getElementById('appointmentsChart').getContext('2d');
    const active = <?= $dashboardData['active_appointments'] ?>;
    const completed = <?= $dashboardData['total_appointments'] - $dashboardData['active_appointments'] ?>;
    
    new Chart(ctxAppointments, {
        type: 'doughnut',
        data: {
            labels: ['Active', 'Completed'],
            datasets: [{
                data: [active, completed],
                backgroundColor: ['rgba(255, 159, 64, 0.8)', 'rgba(153, 102, 255, 0.8)'],
                borderColor: ['rgba(255, 159, 64, 1)', 'rgba(153, 102, 255, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            let value = context.raw || 0;
                            let total = context.dataset.data.reduce((a, b) => a + b, 0);
                            let percentage = Math.round((value / total) * 100);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            },
            cutout: '70%'
        }
    });
</script>

</body>
</html>
