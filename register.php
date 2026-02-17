<?php
require_once 'controllers/UserController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $userController = new UserController();
    if ($userController->register($username, $password)) {
        echo "Registration successful!";
    } else {
        echo "Registration failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Link to your CSS file -->
</head>
<body>

<div class="container">
    <h1>Register</h1>

    <!-- Registration Form -->
    <form action="register.php" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>

    <!-- Error or Success Messages -->
    <?php if (isset($error)) { echo '<div class="error">' . $error . '</div>'; } ?>

    <footer>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </footer>
</div>

</body>
</html>
