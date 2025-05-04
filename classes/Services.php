<?php

class ServiceModel {
    private $db;
    private $table = 'services';

    /**
     * Constructor
     * 
     * @param mysqli $db
     */
    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Get all services
     * @return array
     */
    public function getAllServices() {
        $services = [];
        $query = "SELECT * FROM {$this->table} ORDER BY id DESC";
        
        $stmt = $this->db->prepare($query);
        if ($stmt) {
            $stmt->execute();
            $result = $stmt->get_result();
            $services = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
        }

        return $services;
    }

    /**
     * Get service by ID
     * @param int $id
     * @return array|false
     */
    public function getServiceById($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    /**
     * Add a new service
     * @param string $name
     * @param string $description
     * @param float $price
     * @param int $duration
     * @param string|null $image_path
     * @return bool
     */
    public function addService($name, $description, $price, $duration, $image_path = null) {
        $query = "INSERT INTO {$this->table} (name, description, price, duration, image_path, status, created_at)
                  VALUES (?, ?, ?, ?, ?, 1, NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssdis", $name, $description, $price, $duration, $image_path);
    
        return $stmt->execute();
    }
    

    /**
     * Update an existing service
     * @param int $id
     * @param array $data
     * @return bool
     */
   // Assuming you are working with a database connection $this->conn
public function updateService($serviceId, $data) {
    // Prepare the query
    $query = "UPDATE services SET name = ?, description = ?, price = ?, duration = ?, image_path = ? WHERE id = ?";

    // Prepare the statement
    $stmt = $this->db->prepare($query);

    // Check if the query preparation failed
    if ($stmt === false) {
        die('Error preparing the query: ' . $this->db->error);
    }

    // Bind parameters
    $stmt->bind_param('ssdsis', 
        $data['service_name'], 
        $data['description'], 
        $data['price'], 
        $data['duration'], 
        $data['image_path'], 
        $serviceId
    );

    // Execute the statement
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


    /**
     * Delete a service
     * @param int $id
     * @return bool
     */
    public function deleteService($id) {
        $query = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    /**
     * Change service status (active/inactive)
     * @param int $id
     * @param int $status (0: inactive, 1: active)
     * @return bool
     */
    public function changeServiceStatus($id, $status) {
        $query = "UPDATE {$this->table} SET status = ?, updated_at = NOW() WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $status, $id);

        return $stmt->execute();
    }

    /**
     * Search services by name or description
     * @param string $keyword
     * @return array
     */
    public function searchServices($keyword) {
        $search = "%" . $keyword . "%";
        $query = "SELECT * FROM {$this->table} WHERE name LIKE ? OR description LIKE ? ORDER BY id DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $search, $search);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get active services only
     * @return array
     */
    public function getActiveServices() {
        $query = "SELECT * FROM {$this->table} WHERE status = 1 ORDER BY id DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Count total services
     * @return int
     */
    public function countServices() {
        $query = "SELECT COUNT(*) as total FROM {$this->table}";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc()['total'] ?? 0;
    }

    /**
     * Get paginated services
     * @param int $page
     * @param int $limit
     * @return array
     */
    public function getPaginatedServices($page = 1, $limit = 10) {
        $offset = ($page - 1) * $limit;
        $query = "SELECT * FROM {$this->table} ORDER BY id DESC LIMIT ? OFFSET ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
