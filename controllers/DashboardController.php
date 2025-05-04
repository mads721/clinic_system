<?php

require_once('../classes/Dashboard.php');
require_once('../classes/Database.php');

class DashboardController {

    private $model;

    public function __construct($db) {
        $this->model = new DashboardModel($db);
    }

    public function getDashboardData() {
        // Fetch data using the model
        $totalUsers = $this->model->getTotalUsers();
        $totalDoctors = $this->model->getTotalDoctors();
        $totalAppointments = $this->model->getTotalAppointments();
        $activeAppointments = $this->model->getActiveAppointments();

        return [
            'total_users' => $totalUsers,
            'total_doctors' => $totalDoctors,
            'total_appointments' => $totalAppointments,
            'active_appointments' => $activeAppointments
        ];
    }
}

?>
