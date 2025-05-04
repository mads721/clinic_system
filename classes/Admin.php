<?php
class Admin {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // returns false if no match
    }
    public function getAdminUsername($adminId) {
        $sql = "SELECT username FROM admin WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $adminId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return htmlspecialchars($row['username']); // Sanitize the output
        }
        return 'Administrator'; // Default value
    }
}
?>
