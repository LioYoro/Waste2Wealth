<?php
class User {
    private $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'waste2wealth');
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getRole($userId) {
        $sql = "SELECT role FROM users WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        return $user['role'];
    }

    public function getTotalUsers() {
        $sql = "SELECT COUNT(*) AS total_users FROM users";
        $result = $this->db->query($sql);
        $data = $result->fetch_assoc();
        return $data['total_users'];
    }
}
?>
