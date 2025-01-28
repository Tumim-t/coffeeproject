<?php
session_start(); 
include "database.php"; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    $db = new db();
    
    $result = $db->conn()->query("SELECT * FROM PRODUCTS WHERE id = '$productId'");
    $product = $result->fetch_assoc();

    if ($product) {
        $userId = $_SESSION['user_id']; 
        
        if (!isset($_SESSION['cart'][$userId])) {
            $_SESSION['cart'][$userId] = []; 
        }

        
        $found = false;
        foreach ($_SESSION['cart'][$userId] as &$cartItem) {
            if ($cartItem['id'] == $product['id']) {
                $cartItem['quantity'] += 1; 
                $found = true;
                break;
            }
        }

        if (!$found) {
            $_SESSION['cart'][$userId][] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => (int)$product['price'], 
                'quantity' => 1 
            ];
        }

        
        header("Location: products.php");
        exit();
    } else {
        echo "Product not found.";
    }
} else {
    echo "Invalid request.";
}
?>
