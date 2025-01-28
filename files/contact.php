<?php
include "database.php";
$obj = new db();
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

<section id="contact">
  <h2>Contact Us</h2>
  <?php
$result = $obj->conn()->query("SELECT * FROM CONTACT");

if ($result->num_rows > 0) {
    $phones = [];
    $emails = [];
    $instagrams = [];

    while ($prod = $result->fetch_assoc()) {
        if (!empty($prod['phone'])) {
            $phones[] = $prod['phone'];
        }
        if (!empty($prod['email'])) {
            $emails[] = $prod['email'];
        }
        if (!empty($prod['instagram'])) {
            $instagrams[] = $prod['instagram'];
        }
    }

    if (!empty($phones)) {
        echo '<h3>Phone Numbers:</h3>';
        echo '<ul>';
        foreach ($phones as $phone) {
            echo "<li>$phone</li>";
        }
        echo '</ul>';
    } else {
        echo '<p>No phone numbers available.</p>';
    }

   
    if (!empty($emails)) {
        echo '<h3>Emails:</h3>';
        echo '<ul>';
        foreach ($emails as $email) {
            echo "<li>$email</li>";
        }
        echo '</ul>';
    } else {
        echo '<p>No emails available.</p>';
    }

    
    if (!empty($instagrams)) {
        echo '<h3>Instagram Accounts:</h3>';
        echo '<ul>';
        foreach ($instagrams as $instagram) {
            echo "<li><a href='https://instagram.com/$instagram' target='_blank'>$instagram</a></li>";
        }
        echo '</ul>';
    } else {
        echo '<p>No Instagram accounts available.</p>';
    }
} else {
    echo '<p>No contact information available.</p>';
}
?>

</section>

</body>
</html>
