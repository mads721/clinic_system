<?php
// File: add_doctor_process.php

require_once $_SERVER['DOCUMENT_ROOT'] . '/web-proto/classes/Database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/web-proto/controllers/UserController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/web-proto/controllers/DoctorController.php';

class AddDoctorController {
    private $userController;
    private $doctorController;
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->connect();
        $this->userController = new UserController($this->conn);
        $this->doctorController = new DoctorController($this->conn);
    }

    public function handlePostRequest($data) {
        $errors = [];
        $successMessage = '';

        // Sanitize and extract data
        $docFname = trim($data['docFname'] ?? '');
        $docLname = trim($data['docLname'] ?? '');
        $specialization = trim($data['specialization'] ?? '');
        $contactno = trim($data['contactno'] ?? '');
        $address = trim($data['address'] ?? '');

        // Validation
        if (empty($docFname)) $errors[] = "First name is required.";
        if (empty($docLname)) $errors[] = "Last name is required.";
        if (empty($specialization)) $errors[] = "Specialization is required.";
        if (empty($contactno)) $errors[] = "Contact number is required.";
        if (empty($address)) $errors[] = "Address is required.";

        // Handle file upload for doctor's picture
        $docPic = '';
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
                } else {
                    $errors[] = "Failed to upload image.";
                }
            }
        }

        if (empty($errors)) {
            // Add doctor information using DoctorController
            $success = $this->doctorController->addDoctor(
                $docFname,
                $docLname,
                $specialization,
                $contactno,
                $address,
                $docPic
            );

            if ($success) {
                // Set success message
                $successMessage = "Doctor successfully registered!";
                header('Location: manage_doctors.php');
                exit();
            } else {
                $errors[] = "Failed to save doctor details.";
            }
        }

        return [
            'errors' => $errors,
            'successMessage' => $successMessage
        ];
    }
}