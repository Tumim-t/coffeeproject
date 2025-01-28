<?php
session_start();
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (!$userId) {
    echo "<p>Please log in to proceed with checkout.</p>";
    exit;
}

$userName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'User'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    
</head>
<body>

<section>
    <h2>Checkout</h2>
    
    <p>Hello, <?php echo htmlspecialchars($userName); ?>!</p> 
    <h3>Your Cart</h3>
    <ul>
    <?php
if (isset($_SESSION['cart'][$userId]) && !empty($_SESSION['cart'][$userId])) {
    $total = 0;
    foreach ($_SESSION['cart'][$userId] as $cartItem) {
        $price = (int)$cartItem['price'];
        $quantity = (int)$cartItem['quantity'];
        
        $itemTotal = $price * $quantity;
        $total += $itemTotal;

        echo "<li>{$cartItem['name']} ({$quantity} x $" . number_format($price, 2) . ")</li>";
    }
    echo "<p>Total: $" . number_format($total, 2) . "</p>";
} else {
    echo "<p>Your cart is empty.</p>";
}
?>

    </ul>

    <form method="POST" action="about.php">
        <button type="submit">Complete Checkout</button>
    </form>
</section>

</body>
</html>
