<?php
include "database.php";
$obj = new db();
$result = $obj->conn()->query("SELECT * FROM PRODUCTS");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<section id="shop">
    <h2>Our Products</h2>
    <div class="product-list">
        <?php  
        
        if ($result && $result->num_rows > 0) {
           
            while ($prod = $result->fetch_assoc()) { 
                echo '<div class="product">';
                echo '<img src="' . $prod['image'] . '" alt="Product Image">';
                echo '<p>' . $prod['name'] . '</p>';
                echo '<p>$' . $prod['price'] . '</p>';

                
                echo '<form method="POST" action="add_to_cart.php">';
                echo '<input type="hidden" name="product_id" value="' . $prod['id'] . '">';
                echo '<button type="submit">Add to Cart</button>';
                echo '</form>';

                echo '</div>';
            }
        } else {
            echo '<p>No products available.</p>';
        }
        ?>

                
   
   
<section id="cart">
    <h2>Shopping Cart</h2>
    <ul id="cartItems">
    <?php
    session_start(); 
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null; 


    if (!isset($_SESSION['cart'][$userId])) {
        $_SESSION['cart'][$userId] = [];
    }


if (!isset($_SESSION['cart'][$userId])) {
    $_SESSION['cart'][$userId] = [];
}

if ($userId && !empty($_SESSION['cart'][$userId])) {
    $total = 0;
    foreach ($_SESSION['cart'][$userId] as $cartItem) {
        $price = (int)$cartItem['price']; 
        $quantity = (int)$cartItem['quantity'];  

        $itemTotal = $price * $quantity;
        $total += $itemTotal;

        echo "<li>{$cartItem['name']} ({$quantity} x $" . number_format($price, 2) . ")</li>";
    }
    echo "<p id='total'>Total: $" . number_format($total, 2) . "</p>";
} else {
    echo "<p>Your cart is empty.</p>";
}


    ?>
</ul>

<?php

if (isset($_SESSION['cart'][$userId]) && !empty($_SESSION['cart'][$userId])) {
    echo '<form method="POST" action="checkout.php">';
    echo '<button type="submit"> Checkout</button>';
    echo '</form>';
}
?>

</section>

    </body>
</html>