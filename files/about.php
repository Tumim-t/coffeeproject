<?php
include "database.php";
$obj=new db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<section id="about" class="about">
    <?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit;
}

echo "<h5>Welcome, " . $_SESSION['user_name'] . "!</h5>";
echo "<p>You are now logged in.</p>";
echo '<a href="logout.php">Logout</a>';
?>
<div class="navbar">
   <ul>
                <li><a href="index .php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="products.php">Shop</a></li>
                <li><a href="contact.php">Contact</a></li>
                

            </ul>
</div>

<div class="main">
    <div class="about-image">
        <?php
        $result = $obj->conn()->query("SELECT * FROM ABOUT");
        $prod = $result->fetch_assoc();
        ?>
        <img id="img2" src="<?php echo $prod['IMAGE']; ?>" alt="About Us">
    </div>
    <div class="about-text">
        <h1>About <span>Us</span></h1>
        <p><?php echo $prod['CONTENT']; ?></p>
        <button type="button">Learn more</button>
    </div>
</div>
</section>

   
</body>
</html>
