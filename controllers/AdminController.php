<?php
// Include model
require_once '../classes/Admin.php';

// Controller class
class AdminController {
    private $model;

    public function __construct($conn) {
        $this->model = new Admin($conn);
    }

    // Function to get the admin's username and pass to the view
    public function getAdminUsername() {
        // Ensure admin is logged in
        if (isset($_SESSION['admin_id'])) {
            $adminId = $_SESSION['admin_id'];
            return $this->model->getAdminUsername($adminId);
        }
        return 'Administrator'; // Default value if no admin is logged in
    }
}
?>
