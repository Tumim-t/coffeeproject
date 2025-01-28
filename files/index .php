<?php
include "database.php";
$obj=new db();
$result = $obj->conn()->query("SELECT * FROM HOME");
        $prod = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Sell Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="cover">
        <div class="navbar">
            <img src="<?php echo $prod['image-logo']?>" alt="logo" class="logo">
            
        </div>
        <section id="Home">
            <div class="content">
                <h1>Order your coffee</h1>
                <p>Coffee helps you think faster and clearer and work better!</p>
                
                <div id="customerForm" >
                    <h2>Become a Customer</h2>
                    <form id="customerInfoForm" action="login.php" method="POST">
    <label for="customerName">Name:</label>
    <input type="text" id="customerName" name="customerName" required>

    <label for="customerEmail">Email:</label>
    <input type="email" id="customerEmail" name="customerEmail" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <label for="confirmPassword">Confirm Password:</label>
    <input type="password" id="confirmPassword" name="confirmPassword" required>

    <button type="submit" name="submit">Submit</button>
</form>
<h5>already have an account</h5>
<a href="login.php"> log in</a>
                </div>
            </div>
        </section>
    </div>
    
    
  
  
</body>
</html>