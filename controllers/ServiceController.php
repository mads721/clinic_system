<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/web-proto/classes/Database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/web-proto/classes/Services.php';

class ServiceController {
    private $serviceModel;
    private $conn;

    /**
     * Constructor
     * 
     * @param mysqli $db
     */
    public function __construct($db) {
        $this->conn = $db;
        $this->serviceModel = new ServiceModel($db);
    }

    /**
     * Get all services
     */
    public function getAllServices() {
        $services = $this->serviceModel->getAllServices();
        return $services;
    }

    /**
     * Get service by ID
     * @param int $id
     */
    public function getServiceById($id) {
        return $this->serviceModel->getServiceById($id);
    }

    /**
     * Add a new service
     * @param array $data
     * @return bool
     */
    public function addService($data) {
        // Expecting $data to be an array
        return $this->serviceModel->addService(
            $data['service_name'],
            $data['description'],
            $data['price'],
            $data['duration'],
            $data['image_path'] ?? null
        );
    }
    
    

    /**
     * Update an existing service
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateService($id, $data) {
        return $this->serviceModel->updateService($id, $data);
    }

    /**
     * Delete a service
     * @param int $id
     * @return bool
     */
    public function deleteService($id) {
        return $this->serviceModel->deleteService($id);
    }

    /**
     * Change service status (active/inactive)
     * @param int $id
     * @param int $status
     * @return bool
     */
    public function changeServiceStatus($id, $status) {
        return $this->serviceModel->changeServiceStatus($id, $status);
    }

    /**
     * Search services
     * @param string $keyword
     * @return array
     */
    public function searchServices($keyword) {
        return $this->serviceModel->searchServices($keyword);
    }

    /**
     * Get active services only
     * @return array
     */
    public function getActiveServices() {
        return $this->serviceModel->getActiveServices();
    }

    /**
     * Count total services
     * @return int
     */
    public function countServices() {
        return $this->serviceModel->countServices();
    }

    /**
     * Get paginated services
     * @param int $page
     * @param int $limit
     * @return array
     */
    public function getPaginatedServices($page, $limit) {
        return $this->serviceModel->getPaginatedServices($page, $limit);
    }
}
?>
