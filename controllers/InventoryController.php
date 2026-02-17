<?php
require_once 'models/Inventory.php';

class InventoryController {
    private $inventoryModel;

    public function __construct() {
        $this->inventoryModel = new Inventory(); // Instantiate the Inventory model
    }

    // Get all available bottles in the inventory
    public function getAvailableBottles() {
        return $this->inventoryModel->getAvailableBottles();
    }

    // Get inventory for a specific seller
    public function getInventoryBySeller($userId) {
        return $this->inventoryModel->getInventoryBySeller($userId);
    }

    // Add a new inventory item
    public function addInventory($type, $quantity, $price, $sellerId) {
        return $this->inventoryModel->addInventory($type, $quantity, $price, $sellerId);
    }

    // Update inventory item
    public function updateInventory($id, $type, $quantity, $price) {
        return $this->inventoryModel->updateInventory($id, $type, $quantity, $price);
    }

    // Delete an inventory item
    public function deleteInventory($id) {
        return $this->inventoryModel->deleteInventory($id);
    }

    public function getTotalBottlesSold() {
        return $this->inventoryModel->getTotalBottlesSold();
    }

}
?>
