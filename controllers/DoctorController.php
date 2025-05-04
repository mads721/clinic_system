<?php
// file name: DoctorController.php
require_once $_SERVER['DOCUMENT_ROOT'] . '/web-proto/classes/Doctor.php';

class DoctorController {
    private $conn;
    private $doctor;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->doctor = new Doctor($conn);
    }

    public function getAllDoctors() {
        return $this->doctor->getAllDoctors();
    }

    public function getDoctorById($doctorId) {
        return $this->doctor->getDoctorById($doctorId);
    }

    public function addDoctor($docFname, $docLname, $specialization, $contactno, $address, $docPic) {
        return $this->doctor->addDoctor($docFname, $docLname, $specialization, $contactno, $address, $docPic);
    }

    public function updateDoctor($doctorId, $docFname, $docLname, $specialization, $contactno, $address, $docPic) {
        return $this->doctor->updateDoctor($doctorId, $docFname, $docLname, $specialization, $contactno, $address, $docPic);
    }

    public function updateDoctorWithoutImage($doctorId, $docFname, $docLname, $specialization, $contactno, $address) {
        return $this->doctor->updateDoctorWithoutImage($doctorId, $docFname, $docLname, $specialization, $contactno, $address);
    }

    public function deleteDoctor($doctorId) {
        return $this->doctor->deleteDoctor($doctorId);
    }

    // The editDoctor method can be used as an alternative to direct calls to updateDoctor/updateDoctorWithoutImage
    public function editDoctor($doctorId, $docFname, $docLname, $specialization, $contactno, $address, $docPic = null) {
        if ($docPic) {
            // Update with image
            return $this->updateDoctor($doctorId, $docFname, $docLname, $specialization, $contactno, $address, $docPic);
        } else {
            // Update without changing image
            return $this->updateDoctorWithoutImage($doctorId, $docFname, $docLname, $specialization, $contactno, $address);
        }
    }
}