<?php

class DashboardModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Get total number of users
    public function getTotalUsers() {
        $query = "SELECT COUNT(*) AS total_users FROM users";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        return $data['total_users'];
    }

    // Get total number of doctors
    public function getTotalDoctors() {
        $query = "SELECT COUNT(*) AS total_doctors FROM users WHERE role = 'doctor'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        return $data['total_doctors'];
    }

    // Get total number of appointments
    public function getTotalAppointments() {
        $query = "SELECT COUNT(*) AS total_appointments FROM appointments";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        return $data['total_appointments'];
    }

    // Get total number of active appointments
    public function getActiveAppointments() {
        $query = "SELECT COUNT(*) AS active_appointments FROM appointments WHERE status = 'confirmed'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        return $data['active_appointments'];
    }
}

?>
