<?php
// File: classes/Appointment.php
class Appointment {
    private $conn;
    private $table = "appointments";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Add a new appointment
    public function addAppointment($patientId, $doctorId, $serviceId, $appointmentDate, $appointmentTime, $notes = null) {
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (patient_id, doctor_id, service_id, appointment_date, appointment_time, notes) 
                                      VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiisss", $patientId, $doctorId, $serviceId, $appointmentDate, $appointmentTime, $notes);
        return $stmt->execute();
    }

    // Get all appointments with related information
    public function getAllAppointments() {
        $query = "SELECT a.*, 
                  CONCAT(d.docFname, ' ', d.docLname) as doctor_name,
                  CONCAT(p.first_name, ' ', p.last_name) as patient_name,
                  s.name as service_name
                  FROM {$this->table} a
                  LEFT JOIN doctors d ON a.doctor_id = d.id
                  LEFT JOIN users p ON a.patient_id = p.id
                  LEFT JOIN services s ON a.service_id = s.id
                  ORDER BY a.appointment_date DESC, a.appointment_time DESC";
    
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            die("SQL Error: " . $this->conn->error);
        }
    
        $stmt->execute();
        $result = $stmt->get_result();
    
        $appointments = [];
        while ($row = $result->fetch_assoc()) {
            $appointments[] = $row;
        }
        return $appointments;
    }
    

    
    
    // Get appointments for specific patient
    public function getPatientAppointments($patientId) {
        $query = "SELECT a.*, 
                  CONCAT(d.docFname, ' ', d.docLname) as doctor_name,
                  s.name as service_name
                  FROM {$this->table} a
                  LEFT JOIN doctors d ON a.doctor_id = d.id
                  LEFT JOIN services s ON a.service_id = s.id
                  WHERE a.patient_id = ?
                  ORDER BY a.appointment_date DESC, a.appointment_time DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $patientId);
        $stmt->execute();
        $result = $stmt->get_result();

        $appointments = [];
        while ($row = $result->fetch_assoc()) {
            $appointments[] = $row;
        }
        return $appointments;
    }

    // Get appointments for specific doctor
    public function getDoctorAppointments($doctorId) {
        $query = "SELECT a.*, 
                  CONCAT(p.fname, ' ', p.lname) as patient_name,
                  s.name as service_name
                  FROM {$this->table} a
                  LEFT JOIN patients p ON a.patient_id = p.id
                  LEFT JOIN services s ON a.service_id = s.id
                  WHERE a.doctor_id = ?
                  ORDER BY a.appointment_date DESC, a.appointment_time DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $doctorId);
        $stmt->execute();
        $result = $stmt->get_result();

        $appointments = [];
        while ($row = $result->fetch_assoc()) {
            $appointments[] = $row;
        }
        return $appointments;
    }

    // Get appointment by ID with related information
    // Add this to your Appointment.php class
public function getAppointmentById($appointmentId) {
    // Debug the appointment ID
    echo "<!-- Debug: Appointment ID = " . $appointmentId . " -->\n";
    
    // Use a simpler query first to debug
    $query = "SELECT * FROM {$this->table} WHERE id = ?";
    
    // Debug the SQL query
    echo "<!-- Debug: SQL Query = " . htmlspecialchars($query) . " -->\n";
    
    // Check connection
    if ($this->conn->connect_error) {
        echo "<!-- Debug: Connection failed: " . $this->conn->connect_error . " -->\n";
        return false;
    }
    
    // Try prepare statement
    $stmt = $this->conn->prepare($query);
    
    // Check if prepare statement was successful
    if ($stmt === false) {
        echo "<!-- Debug: Prepare failed: " . $this->conn->error . " -->\n";
        return false;
    }
    
    // Bind parameter and execute
    $stmt->bind_param("i", $appointmentId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if we got a result
    if ($result === false) {
        echo "<!-- Debug: Execute failed: " . $stmt->error . " -->\n";
        return false;
    }
    
    // Return the result or false if no rows
    if ($result->num_rows > 0) {
        $appointment = $result->fetch_assoc();
        
        // Now get the related data with separate queries to avoid join issues
        // Get doctor info
        $doctorQuery = "SELECT id, docFname, docLname, specialization FROM doctors WHERE id = ?";
        $doctorStmt = $this->conn->prepare($doctorQuery);
        if ($doctorStmt) {
            $doctorStmt->bind_param("i", $appointment['doctor_id']);
            $doctorStmt->execute();
            $doctorResult = $doctorStmt->get_result();
            if ($doctorResult && $doctorResult->num_rows > 0) {
                $doctor = $doctorResult->fetch_assoc();
                $appointment['doctor_name'] = $doctor['docFname'] . ' ' . $doctor['docLname'];
            }
            $doctorStmt->close();
        }
        
        // Get patient info
        $patientQuery = "SELECT id, fname, lname FROM patients WHERE id = ?";
        $patientStmt = $this->conn->prepare($patientQuery);
        if ($patientStmt) {
            $patientStmt->bind_param("i", $appointment['patient_id']);
            $patientStmt->execute();
            $patientResult = $patientStmt->get_result();
            if ($patientResult && $patientResult->num_rows > 0) {
                $patient = $patientResult->fetch_assoc();
                $appointment['patient_name'] = $patient['fname'] . ' ' . $patient['lname'];
            }
            $patientStmt->close();
        }
        
        // Get service info
        $serviceQuery = "SELECT id, name, price, duration FROM services WHERE id = ?";
        $serviceStmt = $this->conn->prepare($serviceQuery);
        if ($serviceStmt) {
            $serviceStmt->bind_param("i", $appointment['service_id']);
            $serviceStmt->execute();
            $serviceResult = $serviceStmt->get_result();
            if ($serviceResult && $serviceResult->num_rows > 0) {
                $service = $serviceResult->fetch_assoc();
                $appointment['service_name'] = $service['name'];
                $appointment['service_price'] = $service['price'];
                $appointment['service_duration'] = $service['duration'];
            }
            $serviceStmt->close();
        }
        
        return $appointment;
    } else {
        echo "<!-- Debug: No appointment found with ID " . $appointmentId . " -->\n";
        return false;
    }
}

    // Update appointment details
    public function updateAppointment($appointmentId, $patientId, $doctorId, $serviceId, $appointmentDate, $appointmentTime, $status, $notes = null) {
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET patient_id = ?, doctor_id = ?, service_id = ?, 
                                     appointment_date = ?, appointment_time = ?, status = ?, notes = ?
                                     WHERE id = ?");
        $stmt->bind_param("iiissssi", $patientId, $doctorId, $serviceId, $appointmentDate, $appointmentTime, $status, $notes, $appointmentId);
        return $stmt->execute();
    }

    // Update appointment status only
    public function updateAppointmentStatus($appointmentId, $status) {
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $appointmentId);
        return $stmt->execute();
    }

    // Delete appointment
    public function deleteAppointment($appointmentId) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $stmt->bind_param("i", $appointmentId);
        return $stmt->execute();
    }

    // Check for conflicting appointments
    public function checkConflictingAppointments($doctorId, $appointmentDate, $appointmentTime, $serviceId, $excludeAppointmentId = null) {
        // Get service duration
        $durationStmt = $this->conn->prepare("SELECT duration FROM services WHERE id = ?");
        $durationStmt->bind_param("i", $serviceId);
        $durationStmt->execute();
        $durationResult = $durationStmt->get_result();
        $durationRow = $durationResult->fetch_assoc();
        $serviceDuration = $durationRow ? (int)$durationRow['duration'] : 30; // Default to 30 minutes if not found
        
        // Convert appointment time to DateTime for calculations
        $appointmentDateTime = new DateTime("$appointmentDate $appointmentTime");
        $endDateTime = clone $appointmentDateTime;
        $endDateTime->add(new DateInterval("PT{$serviceDuration}M"));
        
        $endTime = $endDateTime->format('H:i:s');
        
        // Check for conflicts with existing appointments
        $query = "SELECT a.*, s.duration
                  FROM {$this->table} a
                  JOIN services s ON a.service_id = s.id
                  WHERE a.doctor_id = ? 
                  AND a.appointment_date = ?
                  AND a.status != 'cancelled'
                  AND (
                      (a.appointment_time <= ? AND ADDTIME(a.appointment_time, SEC_TO_TIME(s.duration * 60)) > ?)
                      OR 
                      (a.appointment_time < ? AND ADDTIME(a.appointment_time, SEC_TO_TIME(s.duration * 60)) >= ?)
                  )";
                  
        $params = [$doctorId, $appointmentDate, $appointmentTime, $appointmentTime, $endTime, $endTime];
        $types = "ississ";
        
        // Exclude the current appointment if we're editing
        if ($excludeAppointmentId) {
            $query .= " AND a.id != ?";
            $params[] = $excludeAppointmentId;
            $types .= "i";
        }
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->num_rows > 0;
    }

    // Get available time slots for a doctor on a specific date
    public function getAvailableTimeSlots($doctorId, $appointmentDate, $intervalMinutes = 30) {
        // Get doctor's schedule (this is a placeholder - you would need to implement doctor schedules)
        $startTime = '09:00:00'; // Example: doctor works from 9 AM
        $endTime = '17:00:00';   // to 5 PM
        
        // Get all appointments for the doctor on the specified date
        $query = "SELECT a.appointment_time, s.duration
                  FROM {$this->table} a
                  JOIN services s ON a.service_id = s.id
                  WHERE a.doctor_id = ? 
                  AND a.appointment_date = ?
                  AND a.status != 'cancelled'
                  ORDER BY a.appointment_time ASC";
                  
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $doctorId, $appointmentDate);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $bookedSlots = [];
        while ($row = $result->fetch_assoc()) {
            $startSlot = strtotime($row['appointment_time']);
            $duration = (int)$row['duration'];
            $endSlot = $startSlot + ($duration * 60);
            
            $bookedSlots[] = [
                'start' => $startSlot,
                'end' => $endSlot
            ];
        }
        
        // Generate all possible time slots
        $availableSlots = [];
        $currentTime = strtotime($startTime);
        $endTimeStamp = strtotime($endTime);
        
        while ($currentTime < $endTimeStamp) {
            $slotStart = $currentTime;
            $slotEnd = $slotStart + ($intervalMinutes * 60);
            
            // Check if this slot overlaps with any booked appointment
            $isAvailable = true;
            foreach ($bookedSlots as $bookedSlot) {
                if (
                    ($slotStart >= $bookedSlot['start'] && $slotStart < $bookedSlot['end']) || 
                    ($slotEnd > $bookedSlot['start'] && $slotEnd <= $bookedSlot['end']) ||
                    ($slotStart <= $bookedSlot['start'] && $slotEnd >= $bookedSlot['end'])
                ) {
                    $isAvailable = false;
                    break;
                }
            }
            
            if ($isAvailable) {
                $availableSlots[] = date('H:i:s', $slotStart);
            }
            
            $currentTime = $slotEnd;
        }
        
        return $availableSlots;
    }

    // Get appointments count by status for dashboard
    public function getAppointmentCountsByStatus() {
        $query = "SELECT status, COUNT(*) as count FROM {$this->table} GROUP BY status";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $counts = [
            'scheduled' => 0,
            'completed' => 0,
            'cancelled' => 0,
            'no-show' => 0
        ];
        
        while ($row = $result->fetch_assoc()) {
            $counts[$row['status']] = (int)$row['count'];
        }
        
        return $counts;
    }

    // Get upcoming appointments for the next X days
    public function getUpcomingAppointments($days = 7) {
        $query = "SELECT a.*, 
                  CONCAT(d.docFname, ' ', d.docLname) as doctor_name,
                  CONCAT(p.fname, ' ', p.lname) as patient_name,
                  s.name as service_name
                  FROM {$this->table} a
                  LEFT JOIN doctors d ON a.doctor_id = d.id
                  LEFT JOIN patients p ON a.patient_id = p.id
                  LEFT JOIN services s ON a.service_id = s.id
                  WHERE a.appointment_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL ? DAY)
                  AND a.status = 'scheduled'
                  ORDER BY a.appointment_date ASC, a.appointment_time ASC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $days);
        $stmt->execute();
        $result = $stmt->get_result();

        $appointments = [];
        while ($row = $result->fetch_assoc()) {
            $appointments[] = $row;
        }
        return $appointments;
    }
}