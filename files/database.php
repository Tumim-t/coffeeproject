<?php
class db {
    function conn() {
        $conn = new mysqli("localhost", "root", "", "coffee shop");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            
            return $conn;
        }
    }
}




?>