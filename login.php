<?php
session_start();
include 'database.php';  

$obj = new db();  

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT id, name, password FROM CUSTOMER WHERE email = '$email'";
    $result = $obj->conn()->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $name = $row['name'];
        $hashedPassword = $row['password'];

        
        if (password_verify($password, $hashedPassword)) {
            
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;

            echo "<h2>Login successful! Welcome, $name.</h2>";
            echo "<p>Redirecting to dashboard...</p>";
            header("refresh:2; url=about.php");  
            exit;
        } else {
            echo "<h2>Error: Incorrect password.</h2>";
        }
    } else {
        echo "<h2>Error: No account found with that email.</h2>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>
