
<?php
include '../database.php'; 
$c = new db();
$id = "";
$image = "";
$content = "";

if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $result = $c->conn()->query("SELECT * FROM ABOUT WHERE id=$edit_id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $image = $row['IMAGE'];
        $content = $row['CONTENT'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $image = $_POST['image'];
        $content = $_POST['content'];
        $c->conn()->query("INSERT INTO ABOUT (image, content) VALUES ('$image', '$content')");
        header("Location: manage about.php");
        exit;
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $image = $_POST['image'];
        $content = $_POST['content'];
        $c->conn()->query("UPDATE ABOUT SET image='$image', content='$content' WHERE id=$id");
        header("Location: manage about.php");
        exit;
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        $c->conn()->query("DELETE FROM ABOUT WHERE id=$id");
        header("Location: manage about.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/admin.css">
    <title>Admin - About Us Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Manage About Us Content</h1>

    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>"> 
        <label>Image Path:</label>
        <input type="text" name="image" value="<?php echo $image; ?>" required>
        <label>Content:</label>
        <textarea name="content" required><?php echo $content; ?></textarea>
        
        <?php 
        if ($id == true) {
            echo '<button type="submit" name="update">Update</button>';
        } else {
            echo '<button type="submit" name="add">Add</button>';
        }
        ?>
    </form>

    <h2>Existing About Us Content</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Content</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = $c->conn()->query("SELECT * FROM ABOUT");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td><img src='{$row['IMAGE']}' alt='About Us Image' style='width:100px;'></td>";
            echo "<td>{$row['CONTENT']}</td>";
            echo "<td>
                <form method='GET' action='manage about.php'>
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
