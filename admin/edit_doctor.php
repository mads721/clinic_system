<?php
// File: edit_doctor.php

session_start();

// Include necessary files
require_once $_SERVER['DOCUMENT_ROOT'] . '/web-proto/classes/Database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/web-proto/controllers/DoctorController.php';

// Check if ID parameter exists
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = "Invalid doctor ID.";
    header('Location: manage_doctors.php');
    exit();
}

$doctorId = intval($_GET['id']);

// Create database connection
$database = new Database();
$conn = $database->connect();

// Initialize DoctorController
$doctorController = new DoctorController($conn);

// Get doctor details
$doctor = $doctorController->getDoctorById($doctorId);

if (!$doctor) {
    $_SESSION['error'] = "Doctor not found.";
    header('Location: manage_doctors.php');
    exit();
}

// Handle form submission
$errors = [];
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and extract data
    $docFname = trim($_POST['docFname'] ?? '');
    $docLname = trim($_POST['docLname'] ?? '');
    $specialization = trim($_POST['specialization'] ?? '');
    $contactno = trim($_POST['contactno'] ?? '');
    $address = trim($_POST['address'] ?? '');

    // Validation
    if (empty($docFname)) $errors[] = "First name is required.";
    if (empty($docLname)) $errors[] = "Last name is required.";
    if (empty($specialization)) $errors[] = "Specialization is required.";
    if (empty($contactno)) $errors[] = "Contact number is required.";
    if (empty($address)) $errors[] = "Address is required.";

    // Handle file upload for doctor's picture
    $docPic = '';
    $updateImage = false;
    
    if (isset($_FILES['docPic']) && $_FILES['docPic']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['docPic']['name'];
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);
        
        // Verify file extension
        if (!in_array(strtolower($filetype), $allowed)) {
            $errors[] = "Invalid file format. Only JPG, JPEG, PNG, and GIF are allowed.";
        } else {
            // Generate unique filename
            $new_filename = uniqid('doctor_') . '.' . $filetype;
            $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/web-proto/uploads/doctors/';
            
            // Create directory if it doesn't exist
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            $upload_path = $upload_dir . $new_filename;
            
            // Move the file
            if (move_uploaded_file($_FILES['docPic']['tmp_name'], $upload_path)) {
                $docPic = 'uploads/doctors/' . $new_filename;
                $updateImage = true;

                // Delete old image if exists
                if (!empty($doctor['docPic'])) {
                    $oldImagePath = $_SERVER['DOCUMENT_ROOT'] . '/web-proto/' . $doctor['docPic'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            } else {
                $errors[] = "Failed to upload image.";
            }
        }
    }

    if (empty($errors)) {
        // Update doctor information
        if ($updateImage) {
            $success = $doctorController->updateDoctor(
                $doctorId,
                $docFname,
                $docLname,
                $specialization,
                $contactno,
                $address,
                $docPic
            );
        } else {
            $success = $doctorController->updateDoctorWithoutImage(
                $doctorId,
                $docFname,
                $docLname,
                $specialization,
                $contactno,
                $address
            );
        }

        if ($success) {
            $_SESSION['success'] = "Doctor updated successfully!";
            header('Location: manage_doctors.php');
            exit();
        } else {
            $errors[] = "Failed to update doctor details.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Doctor</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
                            <h5 class="mb-0">Edit Doctor</h5>
                            <a href="manage_doctors.php" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left me-1"></i> Back to Doctors List
                            </a>
                        </div>
                        <div class="card-body px-4 pt-0 pb-4">
                            <!-- Display any error or success messages -->
                            <?php if (!empty($errors)) { ?>
                                <div class="alert alert-danger mt-3">
                                    <ul class="mb-0">
                                        <?php foreach ($errors as $error) { ?>
                                            <li><?php echo $error; ?></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php } ?>

                            <?php if (!empty($successMessage)) { ?>
                                <div class="alert alert-success mt-3">
                                    <?php echo $successMessage; ?>
                                </div>
                            <?php } ?>

                            <!-- Form for editing doctor -->
                            <form method="POST" action="edit_doctor.php?id=<?php echo $doctorId; ?>" enctype="multipart/form-data" class="mt-4">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="docFname" class="form-label">First Name</label>
                                        <input type="text" name="docFname" id="docFname" class="form-control" value="<?php echo htmlspecialchars($doctor['docFname']); ?>" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="docLname" class="form-label">Last Name</label>
                                        <input type="text" name="docLname" id="docLname" class="form-control" value="<?php echo htmlspecialchars($doctor['docLname']); ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="specialization" class="form-label">Specialization</label>
                                        <input type="text" name="specialization" id="specialization" class="form-control" value="<?php echo htmlspecialchars($doctor['specialization']); ?>" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="contactno" class="form-label">Contact Number</label>
                                        <input type="text" name="contactno" id="contactno" class="form-control" value="<?php echo htmlspecialchars($doctor['contactno']); ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea name="address" id="address" class="form-control" rows="3" required><?php echo htmlspecialchars($doctor['address']); ?></textarea>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <label for="docPic" class="form-label">Doctor's Photo</label>
                                        <?php if (!empty($doctor['docPic'])): ?>
                                            <div class="mb-2">
                                                <img src="<?php echo htmlspecialchars($doctor['docPic']); ?>" class="img-thumbnail" style="max-width: 150px;" alt="Current Doctor Photo">
                                                <p class="small text-muted">Current photo</p>
                                            </div>
                                        <?php endif; ?>
                                        <input type="file" name="docPic" id="docPic" class="form-control" accept="image/*">
                                        <small class="form-text text-muted">Leave empty to keep the current photo</small>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="manage_doctors.php" class="btn btn-outline-secondary me-2">
                                        <i class="fas fa-times me-1"></i> Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Update Doctor
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
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>