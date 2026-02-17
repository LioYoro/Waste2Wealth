<?php
session_start();
require_once 'controllers/InventoryController.php';

// Instantiate the InventoryController
$inventoryController = new InventoryController();

// Fetch available bottles or items related to plastic waste
$availableItems = $inventoryController->getAvailableItems();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waste2Wealth</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /* Header Section */
        header {
            background-color: #1E2A47;
            color: white;
            text-align: center;
            padding: 20px;
        }

        header h1 {
            margin: 0;
            font-size: 36px;
        }

        nav {
            margin: 20px 0;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 18px;
        }

        /* Main content */
        main {
            padding: 40px 20px;
            text-align: center;
        }

        .container {
            width: 90%;
            margin: auto;
            padding: 20px;
        }

        .intro {
            font-size: 22px;
            color: #1E2A47;
            margin-bottom: 40px;
        }

        .features {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
        }

        .features div {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            width: 30%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .features h3 {
            color: #1E2A47;
            margin-bottom: 10px;
        }

        /* Available Items Section */
        .items-section {
            margin-top: 40px;
        }

        .items-section h2 {
            color: #1E2A47;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .items-table th, .items-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .items-table th {
            background-color: #1E2A47;
            color: white;
        }

        /* Footer Section */
        footer {
            background-color: #1E2A47;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <header>
        <h1>Waste2Wealth</h1>
        <nav>
            <a href="#home">Home</a>
            <a href="#services">Services</a>
            <a href="#contact">Contact</a>
        </nav>
    </header>

    <!-- Main Section -->
    <main>
        <div class="container">
            <p class="intro">
                Welcome to Waste2Wealth! Our mission is to transform plastic waste into valuable resources by promoting responsible consumption and connecting individuals with recycling organizations.
            </p>

            <div class="features">
                <div>
                    <h3>Responsible Consumption</h3>
                    <p>Learn how to reduce, reuse, and recycle plastic materials to contribute to a cleaner environment.</p>
                </div>
                <div>
                    <h3>Recycling Partnerships</h3>
                    <p>Find nearby recycling organizations and partners to drop off your plastic waste.</p>
                </div>
                <div>
                    <h3>Plastic-to-Wealth Initiatives</h3>
                    <p>Explore innovative ways to convert plastic waste into valuable products or items.</p>
                </div>
            </div>

            <!-- Display Available Items (Plastic-related products) -->
            <div class="items-section">
                <h2>Available Items</h2>
                <table class="items-table">
                    <tr>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                    <?php foreach ($availableItems as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($item['price']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

        </div>
    </main>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 Waste2Wealth - Reducing Plastic Waste for a Sustainable Future</p>
    </footer>

</body>
</html>
