<?php
// File: add_doctor.php

session_start();

// Include the controller
require_once $_SERVER['DOCUMENT_ROOT'] . '/web-proto/admin/admin-process/add_doctor_process.php';

// Instantiate the controller
$addDoctorController = new AddDoctorController();

// Check if form was submitted and handle the POST request
$errors = [];
$successMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = $addDoctorController->handlePostRequest($_POST);
    $errors = $response['errors'];
    $successMessage = $response['successMessage'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Doctor</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
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
                            <h5 class="mb-0">Add Doctor</h5>
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

                            <!-- Form for adding doctor -->
                            <form method="POST" action="add_doctor.php" enctype="multipart/form-data" class="mt-4">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="docFname" class="form-label">First Name</label>
                                        <input type="text" name="docFname" id="docFname" class="form-control" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="docLname" class="form-label">Last Name</label>
                                        <input type="text" name="docLname" id="docLname" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="specialization" class="form-label">Specialization</label>
                                        <input type="text" name="specialization" id="specialization" class="form-control" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="contactno" class="form-label">Contact Number</label>
                                        <input type="text" name="contactno" id="contactno" class="form-control" required>
                                    </div>
                                </div>

                              


                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea name="address" id="address" class="form-control" rows="3" required></textarea>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <label for="docPic" class="form-label">Doctor's Photo</label>
                                        <input type="file" name="docPic" id="docPic" class="form-control" accept="image/*">
                                        <small class="form-text text-muted">Upload a professional photo of the doctor</small>
                                    </div>
                                </div>

                        



                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="reset" class="btn btn-outline-secondary me-2">
                                        <i class="fas fa-undo me-1"></i> Reset
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-user-md me-1"></i> Register Doctor
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>