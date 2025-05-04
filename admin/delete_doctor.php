<?php
// File: delete_doctor.php

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

// Try to get doctor details before deletion (for image handling)
$doctor = $doctorController->getDoctorById($doctorId);

if (!$doctor) {
    $_SESSION['error'] = "Doctor not found.";
    header('Location: manage_doctors.php');
    exit();
}

// Delete the doctor
$result = $doctorController->deleteDoctor($doctorId);

if ($result) {
    // Delete the doctor's image if it exists
    if (!empty($doctor['docPic'])) {
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/web-proto/' . $doctor['docPic'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
    
    $_SESSION['success'] = "Doctor deleted successfully.";
} else {
    $_SESSION['error'] = "Failed to delete doctor.";
}

// Redirect back to manage doctors page
header('Location: manage_doctors.php');
exit();