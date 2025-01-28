<?php
include "database.php"; 

$obj = new db();  

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['customerName']);
    $email = htmlspecialchars($_POST['customerEmail']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

  
    if (!empty($name) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password) && !empty($confirmPassword)) {
        
       
        $checkEmailQuery = "SELECT * FROM CUSTOMER WHERE email = '$email'";
        $result = $obj->conn()->query($checkEmailQuery);

        if ($result->num_rows > 0) {
            echo "<h2>Error: This email is already registered!</h2>";
        } else {
            if ($password === $confirmPassword) {
                
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                $sql = "INSERT INTO CUSTOMER (name, password, email) VALUES ('$name', '$hashedPassword', '$email')";
                
                if ($obj->conn()->query($sql) === TRUE) {
                    header("Location: login.php");
                    exit();
                } else {
                    echo "<h2>Error: " . $obj->conn()->error . "</h2>";
                }
            } else {
                echo "<h2>Error: Passwords do not match!</h2>";
            }
        }
    } else {
        echo "<h2>Error: Invalid input!</h2>";
    }
}
?>
