<?php
session_start();

include '../database.php';
$obj = new db();

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $result = $obj->conn()->query("SELECT * FROM admins WHERE name='$username'");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (($password===$row['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $row['name'];

            header("Location: admin dashboard.php");
            exit;
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "No user found with that username!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>

    <h2>Login to Admin Dashboard</h2>

    <?php if ($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>

        <button type="submit">Login</button>
    </form>

</body>
</html>
