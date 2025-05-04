<?php
// file name: Doctor.php this is a model
class Doctor {
    private $conn;
    private $table = "doctors";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Add a new doctor
    public function addDoctor($docFname, $docLname, $specialization, $contactno, $address, $docPic) {
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (docFname, docLname, specialization, contactno, address, docPic) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $docFname, $docLname, $specialization, $contactno, $address, $docPic);
        return $stmt->execute();
    }

    // Get all doctors
    public function getAllDoctors() {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} ORDER BY creationDate DESC");
        $stmt->execute();
        $result = $stmt->get_result();

        $doctors = [];
        while ($row = $result->fetch_assoc()) {
            $doctors[] = $row;
        }
        return $doctors;
    }

    // Get doctor by ID
    public function getDoctorById($doctorId) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->bind_param("i", $doctorId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Update doctor details (with image)
    public function updateDoctor($doctorId, $docFname, $docLname, $specialization, $contactno, $address, $docPic) {
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET docFname = ?, docLname = ?, specialization = ?, contactno = ?, address = ?, docPic = ? WHERE id = ?");
        $stmt->bind_param("ssssssi", $docFname, $docLname, $specialization, $contactno, $address, $docPic, $doctorId);
        return $stmt->execute();
    }

    // Update doctor details (without image)
    public function updateDoctorWithoutImage($doctorId, $docFname, $docLname, $specialization, $contactno, $address) {
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET docFname = ?, docLname = ?, specialization = ?, contactno = ?, address = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $docFname, $docLname, $specialization, $contactno, $address, $doctorId);
        return $stmt->execute();
    }

    // Delete doctor
    public function deleteDoctor($doctorId) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $stmt->bind_param("i", $doctorId);
        return $stmt->execute();
    }
}
?>
