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
    session_start(); // Start the session
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null; // Retrieve user_id from session


    if (!isset($_SESSION['cart'][$userId])) {
        $_SESSION['cart'][$userId] = [];
    }


    if ($userId && !empty($_SESSION['cart'][$userId])) {
        $total = 0;
        foreach ($_SESSION['cart'][$userId] as $cartItem) {
            $price = is_numeric($cartItem['price']) ? (int)$cartItem['price'] : 0; 
            $quantity = is_numeric($cartItem['quantity']) ? (int)$cartItem['quantity'] : 0;

            
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



</section>

    </body>
</html>