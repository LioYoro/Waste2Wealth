<?php
class Feedback {
    private $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'waste2wealth');
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getFeedback() {
        $sql = "SELECT * FROM feedback";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
