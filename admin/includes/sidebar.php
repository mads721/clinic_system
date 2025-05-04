<?php
// Enhanced session security check
if (!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
    // Store intended destination for redirect after login
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
    header("Location: admin_login.php");
    exit;
}

require_once('../classes/Database.php');
require_once '../controllers/AdminController.php';

$db = (new Database())->connect();
$controller = new AdminController($db);
$adminName = $controller->getAdminUsername();

// Set active page based on the current script
$activePage = basename($_SERVER['PHP_SELF'], ".php");
?>

<!-- Sidebar toggle button for mobile -->
<button class="btn btn-primary d-md-none sidebar-toggle-btn position-fixed" type="button" aria-expanded="false" aria-label="Toggle navigation" 
        style="z-index: 1031; top: 10px; left: 10px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
    </svg>
</button>

<!-- Sidebar -->
<div class="sidebar bg-dark text-white py-4" id="sidebar">
    <div class="sidebar-header mb-4 px-4">
        <div class="d-flex align-items-center justify-content-between">
            <h4 class="font-weight-bold m-0">Medical Admin</h4>
            <button class="btn-close d-md-none text-white" aria-label="Close sidebar"></button>
        </div>
        <hr class="bg-secondary my-3">
    </div>
    
    <!-- Admin profile summary -->
    <div class="px-4 mb-4">
        <div class="d-flex align-items-center">
            <div class="avatar-circle bg-primary text-white mr-3" >
                <?= substr($adminName, 0, 1) ?>
            </div>
            <div>
                <div class="font-weight-bold" style="padding-left: 10px;"><?= htmlspecialchars($adminName) ?></div>
                <small class="text-muted">Administrator</small>
            </div>
        </div>
    </div>
    
   
    
    <!-- Navigation -->
    <div class="px-2">
        <small class="text-uppercase px-3 text-muted font-weight-bold">Main Navigation</small>
    </div>
    
    <ul class="nav flex-column px-2 mt-2">
        <!-- Dashboard -->
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center <?= $activePage === 'admin_dashboard' ? 'active bg-primary rounded' : 'text-white' ?>" 
               href="admin_dashboard.php" aria-current="<?= $activePage === 'admin_dashboard' ? 'page' : 'false' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-speedometer2 mr-3" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4z"/>
                    <path d="M3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707z"/>
                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M7 13.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z"/>
                </svg>
                <span>Dashboard</span>
            </a>
        </li>
        
        <!-- Manage Users -->
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center <?= $activePage === 'manage_users' ? 'active bg-primary rounded' : 'text-white' ?>" 
               href="manage_users.php" aria-current="<?= $activePage === 'manage_users' ? 'page' : 'false' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-people mr-3" viewBox="0 0 16 16">
                    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    <path d="M6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/>
                </svg>
                <span>Manage Users</span>
            </a>
        </li>
    </ul>
    
    <!-- Patient Management Section -->
    <div class="px-2 mt-4">
        <small class="text-uppercase px-3 text-muted font-weight-bold">Clinical</small>
    </div>
    
    <ul class="nav flex-column px-2 mt-2">
        <!-- Manage Appointments -->
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center <?= $activePage === 'manage_appointments' ? 'active bg-primary rounded' : 'text-white' ?>" 
               href="manage_appointments.php" aria-current="<?= $activePage === 'manage_appointments' ? 'page' : 'false' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-calendar-check mr-3" viewBox="0 0 16 16">
                    <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                </svg>
                <span>Appointments</span>
            </a>
        </li>
        
        <!-- Manage Doctors -->
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center <?= $activePage === 'manage_doctors' ? 'active bg-primary rounded' : 'text-white' ?>" 
               href="manage_doctors.php" aria-current="<?= $activePage === 'manage_doctors' ? 'page' : 'false' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-hospital mr-3" viewBox="0 0 16 16">
                    <path d="M8.5 5.034v1.1l.953-.55.5.867L9 7l.953.55-.5.866-.953-.55v1.1h-1v-1.1l-.953.55-.5-.866L7 7l-.953-.55.5-.866.953.55v-1.1h1ZM13.25 9a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5a.25.25 0 0 0 .25-.25v-.5a.25.25 0 0 0-.25-.25h-.5ZM13 11.25a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25v-.5ZM11.75 9.5a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25v-.5ZM4.25 10.25a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25v-.5ZM3 11.25a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5a.25.25 0 0 0 .25-.25v-.5a.25.25 0 0 0-.25-.25h-.5Z"/>
                    <path d="M5 1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1a1 1 0 0 1 1 1v4h3a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h3V3a1 1 0 0 1 1-1V1Z"/>
                </svg>
                <span>Doctors</span>
            </a>
        </li>

        <!-- Services -->
<li class="nav-item mb-2">
    <a class="nav-link d-flex align-items-center <?= $activePage === 'manage_services' ? 'active bg-primary rounded' : 'text-white' ?>" 
       href="manage_services.php" aria-current="<?= $activePage === 'manage_services' ? 'page' : 'false' ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-briefcase mr-3" viewBox="0 0 16 16">
            <path d="M8 0a.5.5 0 0 1 .5.5V1h7a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h7V.5a.5.5 0 0 1 .5-.5zm1 1H7V0H1a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H9v1z"/>
        </svg>
        <span>Services</span>
    </a>
</li>

<!-- Schedule -->
<li class="nav-item mb-2">
    <a class="nav-link d-flex align-items-center <?= $activePage === 'manage_schedule' ? 'active bg-primary rounded' : 'text-white' ?>" 
       href="manage_schedule.php" aria-current="<?= $activePage === 'manage_schedule' ? 'page' : 'false' ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-calendar mr-3" viewBox="0 0 16 16">
            <path d="M3 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
        </svg>
        <span>Schedule</span>
    </a>
</li>

        
       
    </ul>
    
    <!-- System Section -->
    <div class="px-2 mt-4">
        <small class="text-uppercase px-3 text-muted font-weight-bold">System</small>
    </div>
    
    <ul class="nav flex-column px-2 mt-2">
        <!-- Settings -->
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center <?= $activePage === 'settings' ? 'active bg-primary rounded' : 'text-white' ?>" 
               href="settings.php" aria-current="<?= $activePage === 'settings' ? 'page' : 'false' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-gear mr-3" viewBox="0 0 16 16">
                    <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                    <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                </svg>
                <span>Settings</span>
            </a>
        </li>
        
        <!-- Logout -->
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center text-white" href="logout.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-box-arrow-right mr-3" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                </svg>
                <span>Logout</span>
            </a>
        </li>
    </ul>
    
    <!-- Footer -->
    <div class="mt-auto px-4 pt-4 text-center">
        <small class="text-muted">MedAdmin v2.1.0</small>
    </div>
</div>

<style>
    /* Sidebar core styles */
.sidebar {
    width: 250px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    overflow-y: auto;
    z-index: 1030;
    transition: transform 0.3s ease;
    display: flex;
    flex-direction: column;
}

/* Navigation link styles */
.nav-link {
    border-radius: 5px;
    padding: 0.75rem 1rem;
    transition: all 0.25s ease;
    font-weight: 500;
}

.nav-link:hover:not(.active) {
    background-color: rgba(255, 255, 255, 0.1);
    transform: translateX(5px);
}

.nav-link.active {
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    font-weight: 600;
}

/* Admin avatar */
.avatar-circle {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 16px;
    padding: 5px; /* Fixed the missing padding value */
}

/* Mobile responsive styles */
@media (max-width: 767.98px) {
    .sidebar {
        transform: translateX(-100%); /* Hide sidebar off-screen */
    }

    .sidebar.show {
        transform: translateX(0); /* Show sidebar when it has the 'show' class */
    }

    .content-wrapper {
        margin-left: 0 !important; /* Remove left margin when sidebar is hidden */
    }
}

/* Adjust main content area */
.content-wrapper {
    margin-left: 250px; /* Default left margin when sidebar is visible */
    transition: margin-left 0.3s ease;
}


</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle sidebar visibility on mobile
    const toggleBtn = document.querySelector('.sidebar-toggle-btn');
    const closeBtn = document.querySelector('.btn-close');
    const sidebar = document.getElementById('sidebar');
    
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('show');
        });
    }
    
    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            sidebar.classList.remove('show');
        });
    }
    
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        const isClickInsideSidebar = sidebar.contains(event.target);
        const isClickOnToggleBtn = toggleBtn.contains(event.target);
        
        if (!isClickInsideSidebar && !isClickOnToggleBtn && window.innerWidth < 768 && sidebar.classList.contains('show')) {
            sidebar.classList.remove('show');
        }
    });
    
    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            sidebar.classList.remove('show');
        }
    });
});
</script>