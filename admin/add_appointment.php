<?php
// File: add_appointment.php

session_start();

// Include necessary files
require_once $_SERVER['DOCUMENT_ROOT'] . '/web-proto/classes/Database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/web-proto/controllers/AppointmentController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/web-proto/controllers/DoctorController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/web-proto/controllers/ServiceController.php';
// You'll need to create a PatientController similar to DoctorController
require_once $_SERVER['DOCUMENT_ROOT'] . '/web-proto/controllers/UserController.php';

// Create database connection
$database = new Database();
$conn = $database->connect();

// Initialize controllers
$appointmentController = new AppointmentController($conn);
$doctorController = new DoctorController($conn);
$serviceController = new ServiceController($conn);
$patientController = new UserController($conn);

$role = "patient";
// Get available doctors, services and patients for the form
$doctors = $doctorController->getAllDoctors();
$services = $serviceController->getAllServices();
$patients = $patientController->getAllUsersByRole($role);

// Initialize variables for form
$patientId = '';
$doctorId = '';
$serviceId = '';
$appointmentDate = '';
$appointmentTime = '';
$notes = '';
$availableTimeSlots = [];

// Handle time slot AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'getTimeSlots') {
    $doctorId = isset($_POST['doctorId']) ? intval($_POST['doctorId']) : 0;
    $appointmentDate = isset($_POST['date']) ? $_POST['date'] : '';
    $serviceId = isset($_POST['serviceId']) ? intval($_POST['serviceId']) : 0;
    
    if ($doctorId > 0 && !empty($appointmentDate) && $serviceId > 0) {
        $availableTimeSlots = $appointmentController->getAvailableTimeSlots($doctorId, $appointmentDate);
        
        // Return JSON response
        header('Content-Type: application/json');
        echo json_encode(['timeSlots' => $availableTimeSlots]);
        exit;
    }
    
    // If parameters are not valid, return empty array
    header('Content-Type: application/json');
    echo json_encode(['timeSlots' => []]);
    exit;
}

// Handle form submission
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['action'])) {
    // Sanitize and extract data
    $patientId = isset($_POST['patient_id']) ? intval($_POST['patient_id']) : 0;
    $doctorId = isset($_POST['doctor_id']) ? intval($_POST['doctor_id']) : 0;
    $serviceId = isset($_POST['service_id']) ? intval($_POST['service_id']) : 0;
    $appointmentDate = isset($_POST['appointment_date']) ? $_POST['appointment_date'] : '';
    $appointmentTime = isset($_POST['appointment_time']) ? $_POST['appointment_time'] : '';
    $notes = isset($_POST['notes']) ? trim($_POST['notes']) : '';
    
    // Basic validation
    if ($patientId <= 0) $errors[] = "Please select a patient.";
    if ($doctorId <= 0) $errors[] = "Please select a doctor.";
    if ($serviceId <= 0) $errors[] = "Please select a service.";
    if (empty($appointmentDate)) $errors[] = "Please select an appointment date.";
    if (empty($appointmentTime)) $errors[] = "Please select an appointment time.";
    
    // Validate date is not in past
    $today = date('Y-m-d');
    if ($appointmentDate < $today) {
        $errors[] = "Appointment date cannot be in the past.";
    }
    
    // Check for time slot availability
    if ($doctorId > 0 && !empty($appointmentDate) && !empty($appointmentTime) && $serviceId > 0) {
        if (!$appointmentController->isTimeSlotAvailable($doctorId, $appointmentDate, $appointmentTime, $serviceId)) {
            $errors[] = "The selected time slot is not available. Please choose another time.";
        }
    }
    
    if (empty($errors)) {
        $result = $appointmentController->addAppointment($patientId, $doctorId, $serviceId, $appointmentDate, $appointmentTime, $notes);
        
        if ($result['success']) {
            $_SESSION['success'] = $result['message'];
            header('Location: manage_appointments.php');
            exit;
        } else {
            $errors[] = $result['message'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Appointment</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Add Flatpickr for better date/time picker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Add Select2 for better dropdowns -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>
    <?php include 'includes/sidebar.php'; ?>

    <!-- Content wrapper div -->
    <div class="content-wrapper">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Add New Appointment</h5>
                            <a href="manage_appointments.php" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left me-1"></i> Back to Appointments List
                            </a>
                        </div>
                        <div class="card-body px-4 pt-0 pb-4">
                            <!-- Display errors if any -->
                            <?php if (!empty($errors)) { ?>
                                <div class="alert alert-danger mt-3">
                                    <ul class="mb-0">
                                        <?php foreach ($errors as $error) { ?>
                                            <li><?php echo $error; ?></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php } ?>

                            <!-- Appointment Form -->
                            <form method="POST" action="add_appointment.php" class="mt-4">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="patient_id" class="form-label">Patient <span class="text-danger">*</span></label>
                                        <select name="patient_id" id="patient_id" class="form-select select2" required>
                                            <option value="">Select Patient</option>
                                            <?php foreach ($patients as $patient) { ?>
                                                <option value="<?php echo $patient['id']; ?>" <?php echo ($patientId == $patient['id']) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($patient['first_name'] . ' ' . $patient['last_name']); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="doctor_id" class="form-label">Doctor <span class="text-danger">*</span></label>
                                        <select name="doctor_id" id="doctor_id" class="form-select select2" required>
                                            <option value="">Select Doctor</option>
                                            <?php foreach ($doctors as $doctor) { ?>
                                                <option value="<?php echo $doctor['id']; ?>" <?php echo ($doctorId == $doctor['id']) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($doctor['docFname'] . ' ' . $doctor['docLname'] . ' (' . $doctor['specialization'] . ')'); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="service_id" class="form-label">Service <span class="text-danger">*</span></label>
                                        <select name="service_id" id="service_id" class="form-select select2" required>
                                            <option value="">Select Service</option>
                                            <?php foreach ($services as $service) { ?>
                                                <option value="<?php echo $service['id']; ?>" 
                                                        data-duration="<?php echo $service['duration']; ?>"
                                                        data-price="<?php echo $service['price']; ?>"
                                                        <?php echo ($serviceId == $service['id']) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($service['name'] . ' - ' . $service['duration'] . ' min - $' . $service['price']); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="appointment_date" class="form-label">Appointment Date <span class="text-danger">*</span></label>
                                        <input type="date" name="appointment_date" id="appointment_date" class="form-control datepicker" 
                                               value="<?php echo $appointmentDate; ?>" min="<?php echo date('Y-m-d'); ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="appointment_time" class="form-label">Appointment Time <span class="text-danger">*</span></label>
                                        <select name="appointment_time" id="appointment_time" class="form-select" required disabled>
                                            <option value="">Select Date, Doctor & Service First</option>
                                        </select>
                                        <small class="form-text text-muted">Available time slots will appear after selecting date, doctor and service.</small>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="appointment_details" class="form-label">Appointment Details</label>
                                        <div id="appointment_details" class="border rounded p-3 h-100 d-flex align-items-center">
                                            <p class="mb-0 text-muted">Select all fields to see appointment details.</p>
                                        </div>
                                    </div>
                                </div>

                               
                                    <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="notes" class="form-label">Notes (Optional)</label>
                                        <textarea name="notes" id="notes" class="form-control" rows="3"><?php echo htmlspecialchars($notes); ?></textarea>
                                    </div>
                                </div>
                                

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="manage_appointments.php" class="btn btn-outline-secondary me-2">
                                        <i class="fas fa-times me-1"></i> Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-calendar-plus me-1"></i> Schedule Appointment
                                    </button>
                                </div>
                            </form>
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
        
        .select2-container {
            width: 100% !important;
        }
        
        .select2-container .select2-selection--single {
            height: 38px !important;
            padding: 5px 0;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2();
            
            // Initialize Flatpickr for date
            $(".datepicker").flatpickr({
                minDate: "today",
                dateFormat: "Y-m-d",
                disable: [
                    function(date) {
                        // Disable weekends (0 = Sunday, 6 = Saturday)
                        return (date.getDay() === 0 || date.getDay() === 6);
                    }
                ]
            });
            
            // Function to load time slots
            function loadTimeSlots() {
                const doctorId = $('#doctor_id').val();
                const appointmentDate = $('#appointment_date').val();
                const serviceId = $('#service_id').val();
                
                if (doctorId && appointmentDate && serviceId) {
                    // Show loading indicator
                    $('#appointment_time').html('<option value="">Loading time slots...</option>');
                    
                    // Send AJAX request
                    $.ajax({
                        url: 'add_appointment.php',
                        type: 'POST',
                        data: {
                            action: 'getTimeSlots',
                            doctorId: doctorId,
                            date: appointmentDate,
                            serviceId: serviceId
                        },
                        dataType: 'json',
                        success: function(response) {
                            const timeSlots = response.timeSlots;
                            
                            // Enable time dropdown
                            $('#appointment_time').prop('disabled', false);
                            
                            if (timeSlots.length > 0) {
                                // Populate time dropdown
                                let options = '<option value="">Select Time</option>';
                                
                                timeSlots.forEach(function(slot) {
                                    // Convert to AM/PM format for display
                                    const time = new Date('2000-01-01T' + slot);
                                    const formattedTime = time.toLocaleTimeString('en-US', {
                                        hour: '2-digit',
                                        minute: '2-digit'
                                    });
                                    
                                    options += `<option value="${slot}">${formattedTime}</option>`;
                                });
                                
                                $('#appointment_time').html(options);
                            } else {
                                $('#appointment_time').html('<option value="">No available time slots</option>');
                            }
                        },
                        error: function() {
                            $('#appointment_time').html('<option value="">Error loading time slots</option>');
                        }
                    });
                } else {
                    $('#appointment_time').html('<option value="">Select Date, Doctor & Service First</option>');
                    $('#appointment_time').prop('disabled', true);
                }
            }
            
            // Load time slots when date, doctor or service changes
            $('#doctor_id, #appointment_date, #service_id').change(function() {
                loadTimeSlots();
                updateAppointmentDetails();
            });
            
            // Update appointment details
            function updateAppointmentDetails() {
    const doctorId = $('#doctor_id').val();
    const appointmentDate = $('#appointment_date').val();
    const serviceId = $('#service_id').val();
    const appointmentTime = $('#appointment_time').val();

    const $detailsContainer = $('#appointment_details');

    if (doctorId && appointmentDate && serviceId) {
        const doctorName = $('#doctor_id option:selected').text();
        const serviceName = $('#service_id option:selected').text();
        const serviceDuration = $('#service_id option:selected').data('duration');
        const servicePrice = $('#service_id option:selected').data('price');

        const formattedDetails = `
            <ul class="list-unstyled mb-0">
                <li><strong>Service:</strong> ${serviceName}</li>
                <li><strong>Duration:</strong> ${serviceDuration} minutes</li>
                <li><strong>Doctor:</strong> ${doctorName}</li>
                <li><strong>Price:</strong> ₱${servicePrice}</li>
            </ul>
        `;

        $detailsContainer.html(formattedDetails);
    } else {
        $detailsContainer.html('<p class="text-muted mb-0">Please select doctor, date, and service to view appointment details.</p>');
    }
}

            
            // Update details when time changes
            $('#appointment_time').change(function() {
                updateAppointmentDetails();
            });
        });
    </script>
</body>
</html>