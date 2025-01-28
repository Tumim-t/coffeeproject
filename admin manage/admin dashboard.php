<?php
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: adminlogin.php"); 
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>

    <h1>Welcome to the Admin Dashboard</h1>
    <p>Hello, <?php echo htmlspecialchars($username); ?>!</p>

    <h3>Manage the Website:</h3>
    <ul>
        <li><a href="manage product.php">Manage Products</a></li>
        <li><a href="manage contact.php">Manage Contact Information</a></li>
        <li><a href="manage about.php">Manage About Us</a></li>
    </ul>

   
</body>
</html>
