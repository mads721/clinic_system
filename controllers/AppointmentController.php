<?php
// File: controllers/AppointmentController.php
require_once $_SERVER['DOCUMENT_ROOT'] . '/web-proto/classes/Appointment.php';

class AppointmentController {
    private $conn;
    private $appointment;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->appointment = new Appointment($conn);
    }

    // Get all appointments
    public function getAllAppointments() {
        return $this->appointment->getAllAppointments();
    }

    // Get appointment by ID
    public function getAppointmentById($appointmentId) {
        return $this->appointment->getAppointmentById($appointmentId);
    }

    // Get appointments for a specific patient
    public function getPatientAppointments($patientId) {
        return $this->appointment->getPatientAppointments($patientId);
    }

    // Get appointments for a specific doctor
    public function getDoctorAppointments($doctorId) {
        return $this->appointment->getDoctorAppointments($doctorId);
    }

    // Add a new appointment
    public function addAppointment($patientId, $doctorId, $serviceId, $appointmentDate, $appointmentTime, $notes = null) {
        // Check for conflicting appointments before adding
        if ($this->appointment->checkConflictingAppointments($doctorId, $appointmentDate, $appointmentTime, $serviceId)) {
            return [
                'success' => false,
                'message' => 'The selected time slot is not available. Please choose another time.'
            ];
        }
        
        $success = $this->appointment->addAppointment($patientId, $doctorId, $serviceId, $appointmentDate, $appointmentTime, $notes);
        
        if ($success) {
            return [
                'success' => true,
                'message' => 'Appointment scheduled successfully.'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Failed to schedule appointment. Please try again.'
            ];
        }
    }

    // Update an appointment
    public function updateAppointment($appointmentId, $patientId, $doctorId, $serviceId, $appointmentDate, $appointmentTime, $status, $notes = null) {
        // Check for conflicting appointments before updating
        if ($this->appointment->checkConflictingAppointments($doctorId, $appointmentDate, $appointmentTime, $serviceId, $appointmentId)) {
            return [
                'success' => false,
                'message' => 'The selected time slot is not available. Please choose another time.'
            ];
        }
        
        $success = $this->appointment->updateAppointment($appointmentId, $patientId, $doctorId, $serviceId, $appointmentDate, $appointmentTime, $status, $notes);
        
        if ($success) {
            return [
                'success' => true,
                'message' => 'Appointment updated successfully.'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Failed to update appointment. Please try again.'
            ];
        }
    }

    // Update appointment status only
    public function updateAppointmentStatus($appointmentId, $status) {
        $success = $this->appointment->updateAppointmentStatus($appointmentId, $status);
        
        if ($success) {
            return [
                'success' => true,
                'message' => 'Appointment status updated successfully.'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Failed to update appointment status. Please try again.'
            ];
        }
    }

    // Delete an appointment
    public function deleteAppointment($appointmentId) {
        $success = $this->appointment->deleteAppointment($appointmentId);
        
        if ($success) {
            return [
                'success' => true,
                'message' => 'Appointment deleted successfully.'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Failed to delete appointment. Please try again.'
            ];
        }
    }

    // Get available time slots for a specific doctor on a specific date
    public function getAvailableTimeSlots($doctorId, $appointmentDate, $intervalMinutes = 30) {
        return $this->appointment->getAvailableTimeSlots($doctorId, $appointmentDate, $intervalMinutes);
    }

    // Get appointment statistics for dashboard
    public function getAppointmentCountsByStatus() {
        return $this->appointment->getAppointmentCountsByStatus();
    }

    // Get upcoming appointments for the next X days
    public function getUpcomingAppointments($days = 7) {
        return $this->appointment->getUpcomingAppointments($days);
    }

    // Check if time slot is available
    public function isTimeSlotAvailable($doctorId, $appointmentDate, $appointmentTime, $serviceId, $appointmentId = null) {
        return !$this->appointment->checkConflictingAppointments($doctorId, $appointmentDate, $appointmentTime, $serviceId, $appointmentId);
    }
}