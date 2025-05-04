<?php
class Database {
    private $servername = "localhost"; // Change this if using a different server
    private $username = "root";        // Your database username
    private $password = "";            // Your database password (empty for XAMPP)
    private $dbname = "clinic_system"; // Your database name

    public function connect() {
        // Create connection
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}
?>
