<?php
class Inventory {
    private $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'waste2wealth'); // Database connection
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    // Get all available bottles in the inventory
    public function getAvailableBottles() {
        $sql = "SELECT * FROM inventory WHERE quantity > 0"; // Query for available bottles
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Get inventory by seller
    public function getInventoryBySeller($userId) {
        $sql = "SELECT * FROM inventory WHERE seller_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $userId); // Bind user ID to query
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Add a new inventory item
    public function addInventory($type, $quantity, $price, $sellerId) {
        $sql = "INSERT INTO inventory (type, quantity, price, seller_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sdis", $type, $quantity, $price, $sellerId); // Bind parameters to query
        return $stmt->execute();
    }

    // Update an inventory item
    public function updateInventory($id, $type, $quantity, $price) {
        $sql = "UPDATE inventory SET type = ?, quantity = ?, price = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sdis", $type, $quantity, $price, $id); // Bind parameters to query
        return $stmt->execute();
    }

    // Delete an inventory item
    public function deleteInventory($id) {
        $sql = "DELETE FROM inventory WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id); // Bind inventory ID to query
        return $stmt->execute();
    }
    public function getTotalBottlesSold() {
        $sql = "SELECT SUM(quantity) AS total_bottles_sold FROM inventory WHERE quantity_sold > 0";
        $result = $this->db->query($sql);
        $data = $result->fetch_assoc();
        return $data['total_bottles_sold'];
    }

}
?>
