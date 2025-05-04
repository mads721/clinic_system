<?php
session_start();
include 'classes/Database.php';
include 'controllers/ServiceController.php';
include 'controllers/DoctorController.php';

$database = new Database();
$conn = $database->connect();

$serviceController = new ServiceController($conn);
$doctorController = new DoctorController($conn);

$services = $serviceController->getAllServices();
$doctors = $doctorController->getAllDoctors();

// Check if user is logged in
$userContactNumber = '';
if(isset($_SESSION['user_id'])) {
    // Get user contact number from database if available
    $userId = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT contact_number FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if($row = $result->fetch_assoc()) {
        $userContactNumber = $row['contact_number'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book an Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="interactions/style.css">
    <style>
        .appointment-container { margin-top: 50px; }
        .doctor-option { cursor: pointer; transition: all 0.3s ease; }
        .doctor-option:hover { border: 2px solid #007bff; transform: translateY(-3px); }
        .doctor-option.active { border: 2px solid #007bff; background-color: #f8f9fa; }
        body { padding-top: 60px; }
        .doctor-pagination { margin-top: 20px; }
        .doctor-pagination .page-link { cursor: pointer; }
        .doctor-container { min-height: 400px; }
        .summary-card { position: sticky; top: 80px; }
    </style>
</head>
<body>
<?php include 'topNavbar.php'; ?>

<div class="container appointment-container">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="fw-bold">Book an Appointment</h1>
            <p class="text-muted">Complete the form below to schedule your appointment with one of our specialists</p>
        </div>
    </div>

    <form action="submit_appointment.php" method="POST" id="appointmentForm">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Appointment Details</h4>
                    </div>
                    <div class="card-body">
                        <!-- Services -->
                        <div class="mb-4">
                            <label for="serviceSelect" class="form-label fw-bold">Select Service</label>
                            <select class="form-select form-select-lg" name="service_id" id="serviceSelect" required>
                                <option selected disabled>Choose a service...</option>
                                <?php foreach ($services as $service): ?>
                                    <option value="<?= $service['id']; ?>">
                                        <?= htmlspecialchars($service['name']) ?> - 
                                        <?= htmlspecialchars($service['duration']) ?> mins (₱<?= htmlspecialchars($service['price']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Contact Number -->
                        <div class="mb-4">
                            <label for="contactNumber" class="form-label fw-bold">Contact Number</label>
                            <div class="input-group">
                                <span class="input-group-text">+63</span>
                                <input type="tel" class="form-control" id="contactNumber" name="contact_number" 
                                       placeholder="9XXXXXXXXX" pattern="[0-9]{10}" maxlength="10"
                                       value="<?= htmlspecialchars($userContactNumber) ?>" required>
                            </div>
                            <div class="form-text">Enter your 10-digit mobile number without the leading zero</div>
                        </div>

                        <!-- Doctor Selection -->
                        <div class="mb-4">
                            <label for="doctorSelect" class="form-label fw-bold">Select Doctor</label>
                            <select class="form-select form-select-lg" name="doctor_id" id="doctorSelect" required>
                                <option selected disabled>Choose a doctor...</option>
                                <?php foreach ($doctors as $doctor): ?>
                                    <option value="<?= $doctor['id']; ?>">
                                        <?= htmlspecialchars($doctor['docFname'] . ' ' . $doctor['docLname']) ?> - 
                                        <?= htmlspecialchars($doctor['specialization']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <!-- Available Doctors Display -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Available Doctors</label>
                            <div class="doctor-container">
                                <div class="row" id="doctorContainer">
                                    <!-- Doctors will be loaded here via JavaScript -->
                                </div>
                            </div>
                            
                            <!-- Pagination controls -->
                            <nav class="doctor-pagination">
                                <ul class="pagination justify-content-center" id="doctorPagination">
                                    <!-- Pagination will be generated here -->
                                </ul>
                            </nav>
                        </div>

                        <!-- Date -->
                        <div class="mb-4">
                            <label for="appointmentDate" class="form-label fw-bold">Select Appointment Date</label>
                            <input type="date" name="appointment_date" id="appointmentDate" class="form-control form-control-lg" required>
                        </div>

                        <!-- Time -->
                        <div class="mb-4">
                            <label for="appointmentTime" class="form-label fw-bold">Select Time</label>
                            <select class="form-select form-select-lg" name="appointment_time" id="appointmentTime" required>
                                <option selected disabled>Select a time...</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg">Book Appointment</button>
                    </div>
                </div>
            </div>

            <!-- Summary -->
            <div class="col-md-4">
                <div class="card p-3 summary-card">
                    <h5 class="card-header bg-light">Appointment Summary</h5>
                    <div class="card-body">
                        <p><strong>Service:</strong> <span id="summaryService">-</span></p>
                        <p><strong>Doctor:</strong> <span id="summaryDoctor">-</span></p>
                        <p><strong>Date:</strong> <span id="summaryDate">-</span></p>
                        <p><strong>Time:</strong> <span id="summaryTime">-</span></p>
                        <p><strong>Contact:</strong> <span id="summaryContact">-</span></p>
                        
                        <div class="alert alert-info mt-3">
                            <small>Please ensure all information is correct before submitting.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Store all doctors
    const allDoctors = <?= json_encode($doctors) ?>;
    
    // Pagination settings
    const doctorsPerPage = 4;
    let currentPage = 1;
    
    // Initialize on load
    document.addEventListener('DOMContentLoaded', function() {
        setupDoctorPagination();
        updateDoctorDisplay();
        
        // Update summary when contact number changes
        document.getElementById('contactNumber').addEventListener('input', function() {
            document.getElementById('summaryContact').innerText = '+63' + this.value;
        });
        
        // Initialize contact number in summary if available
        const contactNumber = document.getElementById('contactNumber').value;
        if(contactNumber) {
            document.getElementById('summaryContact').innerText = '+63' + contactNumber;
        }
    });

    function setupDoctorPagination() {
        const totalPages = Math.ceil(allDoctors.length / doctorsPerPage);
        const pagination = document.getElementById('doctorPagination');
        
        if(totalPages <= 1) {
            pagination.style.display = 'none';
            return;
        }
        
        // Previous button
        pagination.innerHTML = `
            <li class="page-item" id="previousPage">
                <a class="page-link" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        `;
        
        // Page numbers
        for(let i = 1; i <= totalPages; i++) {
            pagination.innerHTML += `
                <li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link page-number" data-page="${i}">${i}</a>
                </li>
            `;
        }
        
        // Next button
        pagination.innerHTML += `
            <li class="page-item" id="nextPage">
                <a class="page-link" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        `;
        
        // Add event listeners
        document.getElementById('previousPage').addEventListener('click', function() {
            if(currentPage > 1) {
                currentPage--;
                updateDoctorDisplay();
                updatePaginationActive();
            }
        });
        
        document.getElementById('nextPage').addEventListener('click', function() {
            if(currentPage < totalPages) {
                currentPage++;
                updateDoctorDisplay();
                updatePaginationActive();
            }
        });
        
        document.querySelectorAll('.page-number').forEach(item => {
            item.addEventListener('click', function() {
                currentPage = parseInt(this.getAttribute('data-page'));
                updateDoctorDisplay();
                updatePaginationActive();
            });
        });
    }
    
    function updatePaginationActive() {
        document.querySelectorAll('.page-item').forEach(item => {
            item.classList.remove('active');
        });
        
        const activePageItem = document.querySelector(`.page-item:nth-child(${currentPage + 1})`);
        if(activePageItem) {
            activePageItem.classList.add('active');
        }
        
        // Update previous/next button states
        const totalPages = Math.ceil(allDoctors.length / doctorsPerPage);
        document.getElementById('previousPage').classList.toggle('disabled', currentPage === 1);
        document.getElementById('nextPage').classList.toggle('disabled', currentPage === totalPages);
    }
    
    function updateDoctorDisplay() {
        const container = document.getElementById('doctorContainer');
        container.innerHTML = '';
        
        const start = (currentPage - 1) * doctorsPerPage;
        const end = start + doctorsPerPage;
        const displayedDoctors = allDoctors.slice(start, end);
        
        displayedDoctors.forEach(doctor => {
            const doctorCard = document.createElement('div');
            doctorCard.className = 'col-md-6 mb-3';
            doctorCard.innerHTML = `
                <div class="card doctor-option" onclick="highlightDoctor(this, ${doctor.id})">
                    <div class="card-body d-flex align-items-center">
                        <img src="assets/images/default-avatar.png" class="me-3 rounded-circle" width="60" height="60" alt="Doctor">
                        <div>
                            <h6 class="mb-0">${doctor.docFname} ${doctor.docLname}</h6>
                            <span class="badge bg-primary mb-2">${doctor.specialization}</span>
                            <p class="text-muted mb-0"><small>Available for consultations</small></p>
                        </div>
                    </div>
                </div>
            `;
            container.appendChild(doctorCard);
        });
    }

    function highlightDoctor(element, id) {
        // Just highlight the doctor card without selecting it
        document.querySelectorAll(".doctor-option").forEach(card => {
            card.classList.remove("active");
        });
        element.classList.add("active");
    }

    document.getElementById("serviceSelect").addEventListener("change", function () {
        let text = this.options[this.selectedIndex].text;
        document.getElementById("summaryService").innerText = text;
    });
    
    document.getElementById("doctorSelect").addEventListener("change", function () {
        let doctorText = this.options[this.selectedIndex].text;
        document.getElementById("summaryDoctor").innerText = doctorText;
        
        if (document.getElementById("appointmentDate").value) {
            loadAvailableTimes();
        }
    });

    document.getElementById("appointmentDate").addEventListener("change", function () {
        let date = new Date(this.value);
        let formattedDate = date.toLocaleDateString('en-US', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        document.getElementById("summaryDate").innerText = formattedDate;
        loadAvailableTimes();
    });

    document.getElementById("appointmentTime").addEventListener("change", function () {
        document.getElementById("summaryTime").innerText = this.value;
    });

    function loadAvailableTimes() {
        let doctorId = document.getElementById("doctorSelect").value;
        let date = document.getElementById("appointmentDate").value;

        if (!doctorId || !date) {
            document.getElementById("appointmentTime").innerHTML = "<option disabled selected>Select a time...</option>";
            return;
        }

        fetch(`get_times.php?doctor_id=${doctorId}&date=${date}`)
            .then(res => res.json())
            .then(data => {
                let timeSelect = document.getElementById("appointmentTime");
                timeSelect.innerHTML = "<option disabled selected>Select a time...</option>";

                if (data.length > 0) {
                    data.forEach(time => {
                        timeSelect.innerHTML += `<option value="${time}">${time}</option>`;
                    });
                } else {
                    timeSelect.innerHTML = "<option disabled>No available slots</option>";
                }
            })
            .catch(() => {
                alert("Error fetching available times.");
            });
    }
    
    // Form validation before submission
    document.getElementById('appointmentForm').addEventListener('submit', function(e) {
        const contactNumber = document.getElementById('contactNumber').value;
        if(contactNumber.length !== 10 || !/^[0-9]{10}$/.test(contactNumber)) {
            e.preventDefault();
            alert('Please enter a valid 10-digit contact number');
            return false;
        }
        
        // Update contact number in backend via AJAX (before form submission)
        if(<?= isset($_SESSION['user_id']) ? 'true' : 'false' ?>) {
            const userId = <?= isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'null' ?>;
            
            fetch('update_contact.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `user_id=${userId}&contact_number=${contactNumber}`
            })
            .then(response => response.json())
            .then(data => {
                if(!data.success) {
                    console.log('Contact number update failed');
                }
            })
            .catch(error => {
                console.error('Error updating contact number:', error);
            });
        }
    });
</script>

<?php include 'footer.php'; ?>
</body>
</html>