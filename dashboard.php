<?php
session_start();
require_once 'controllers/UserController.php';
require_once 'controllers/InventoryController.php';
require_once 'controllers/TransactionController.php';
require_once 'controllers/FeedbackController.php';

$userController = new UserController();
$inventoryController = new InventoryController();
$transactionController = new TransactionController();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$role = $userController->getRole($_SESSION['user_id']); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard_style.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="container">
        <?php
        if ($role === 'admin') {
            echo "<h1>Admin Dashboard</h1>";
            echo "<h2>Platform Statistics</h2>";
            $totalUsers = $userController->getTotalUsers();
            $totalBottles = $inventoryController->getTotalBottlesSold();
            echo "<p>Total Users: $totalUsers</p>";
            echo "<p>Total Bottles Sold: $totalBottles</p>";
            echo "<h2>Feedback</h2>";
            $feedbacks = $userController->getFeedback();
            echo "<ul>";
            foreach ($feedbacks as $feedback) {
                echo "<li><strong>{$feedback['user_name']}</strong>: {$feedback['message']}</li>";
            }
            echo "</ul>";
        } elseif ($role === 'seller') {
            echo "<h1>Seller Dashboard</h1>";
            echo "<h2>Your Inventory</h2>";
            $inventory = $inventoryController->getInventoryBySeller($_SESSION['user_id']);
            echo "<table><tr><th>Type</th><th>Quantity</th><th>Actions</th></tr>";
            foreach ($inventory as $item) {
                echo "<tr>
                        <td>{$item['type']}</td>
                        <td>{$item['quantity']}</td>
                        <td><a href='edit_inventory.php?id={$item['inventory_id']}'>Edit</a> | <a href='delete_inventory.php?id={$item['inventory_id']}'>Delete</a></td>
                    </tr>";
            }
            echo "</table>";
            echo "<h2>Your Transaction History</h2>";
            $transactions = $transactionController->getTransactionsBySeller($_SESSION['user_id']);
            echo "<table><tr><th>Transaction ID</th><th>Date</th><th>Status</th><th>Amount</th></tr>";
            foreach ($transactions as $transaction) {
                echo "<tr>
                        <td>{$transaction['transaction_id']}</td>
                        <td>{$transaction['date']}</td>
                        <td>{$transaction['status']}</td>
                        <td>{$transaction['amount']}</td>
                    </tr>";
            }
            echo "</table>";
            echo "<a href='add_inventory.php'>Add New Bottles</a>";
        } else {
            echo "<h1>Buyer Dashboard</h1>";
            echo "<h2>Available Plastic Bottles</h2>";
            $availableBottles = $inventoryController->getAvailableBottles();
            echo "<table><tr><th>Type</th><th>Quantity</th><th>Price</th><th>Actions</th></tr>";
            foreach ($availableBottles as $bottle) {
                echo "<tr>
                        <td>{$bottle['type']}</td>
                        <td>{$bottle['quantity']}</td>
                        <td>{$bottle['price']}</td>
                        <td><a href='purchase.php?id={$bottle['id']}'>Purchase</a></td>
                    </tr>";
            }
            echo "</table>";
            echo "<h2>Your Purchase History</h2>";
            $purchases = $transactionController->getPurchasesByBuyer($_SESSION['user_id']);
            echo "<table><tr><th>Transaction ID</th><th>Date</th><th>Status</th><th>Amount</th></tr>";
            foreach ($purchases as $purchase) {
                echo "<tr>
                        <td>{$purchase['transaction_id']}</td>
                        <td>{$purchase['date']}</td>
                        <td>{$purchase['status']}</td>
                        <td>{$purchase['amount']}</td>
                    </tr>";
            }
            echo "</table>";
        }
        ?>
    </div>
</body>
</html>
