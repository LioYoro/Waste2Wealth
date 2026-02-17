<?php
session_start();
require_once 'controllers/InventoryController.php';
$inventoryController = new InventoryController();

// Check if user is logged in and has 'seller' role
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $bottle_type = $_POST['bottle_type'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $seller_id = $_SESSION['user_id']; // Assuming the seller's ID is stored in the session

    // Add the new inventory item
    $result = $inventoryController->addInventory($bottle_type, $quantity, $price, $seller_id);

    if ($result) {
        // Redirect to the dashboard if inventory is added successfully
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<p>Error adding inventory. Please try again.</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Inventory</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Include your CSS file here -->
</head>
<body>
    <div class="container">
        <h2>Add Inventory</h2>
        <form action="add_inventory.php" method="POST">
            <label for="bottle_type">Bottle Type:</label>
            <input type="text" id="bottle_type" name="bottle_type" required>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required min="1">

            <label for="price">Price per Bottle:</label>
            <input type="number" id="price" name="price" required min="0.01" step="0.01">

            <button type="submit">Add Inventory</button>
        </form>
    </div>
</body>
</html>
