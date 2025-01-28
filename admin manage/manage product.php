<?php
include '../database.php'; 
$c = new db();
$id = "";
$name = "";
$price = "";
$image = "";

if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $result = $c->conn()->query("SELECT * FROM PRODUCTS WHERE id=$edit_id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $name = $row['name'];
        $price = $row['price'];
        $image = $row['image'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_POST['image'];
        $c->conn()->query("INSERT INTO PRODUCTS (name, price, image) VALUES ('$name', '$price', '$image')");
        header("Location: manage product.php");
        exit;
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_POST['image'];
        $c->conn()->query("UPDATE PRODUCTS SET name='$name', price='$price', image='$image' WHERE id=$id");
        header("Location: manage product.php");
        exit;
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        $c->conn()->query("DELETE FROM PRODUCTS WHERE id=$id");
        header("Location: manage product.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/admin.css">
    <title>Admin - Product Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Manage Products</h1>

    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>"> 
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $name; ?>" required>
        <label>Price:</label>
        <input type="number" name="price" value="<?php echo $price; ?>" required>
        <label>Image Path:</label>
        <input type="text" name="image" value="<?php echo $image; ?>" required>
        
        <?php 
        if ($id == true) {
            echo '<button type="submit" name="update">Update</button>';
        } else {
            echo '<button type="submit" name="add">Add</button>';
        }
        ?>
    </form>

    <h2>Existing Products</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = $c->conn()->query("SELECT * FROM PRODUCTS");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>\${$row['price']}</td>";
            echo "<td><img src='{$row['image']}' alt='Product Image' style='width:50px;'></td>";
            echo "<td>
                <form method='GET' action='manage product.php'>
                    <button type='submit' name='edit' value='{$row['id']}'>Edit</button>
                </form>
                <form method='POST'>
                    <button type='submit' name='delete' value='{$row['id']}'>Delete</button>
                </form>
             </td>";
            echo "</tr>";
        }
        ?>
    </table>
    <a href="adminlogout.php">logout</a>

</body>
</html>
