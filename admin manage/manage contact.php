<?php
include '../database.php'; 
$c = new db();
$id = "";
$phone = "";
$email = "";
$instagram = "";


if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $result = $c->conn()->query("SELECT * FROM CONTACT WHERE id=$edit_id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $phone = $row['phone'];
        $email = $row['email'];
        $instagram = $row['instagram'];
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $instagram = $_POST['instagram'];
        $c->conn()->query("INSERT INTO CONTACT (phone, email, instagram) VALUES ('$phone', '$email', '$instagram')");
        header("Location: manage contact.php");
        exit;
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $instagram = $_POST['instagram'];
        $c->conn()->query("UPDATE CONTACT SET phone='$phone', email='$email', instagram='$instagram' WHERE id=$id");
        header("Location: manage contact.php");
        exit;
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        $c->conn()->query("DELETE FROM CONTACT WHERE id=$id");
        header("Location: manage contact.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/admin.css">
    <title>Admin - Contact Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Manage Contact Information</h1>

    <!-- Form for Adding or Editing Contact Info -->
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>"> 
        <label>Phone Number:</label>
        <input type="text" name="phone" value="<?php echo $phone; ?>" required>
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $email; ?>" required>
        <label>Instagram:</label>
        <input type="text" name="instagram" value="<?php echo $instagram; ?>" required>
        
        <?php 
        if ($id == true) {
            echo '<button type="submit" name="update">Update</button>';
        } else {
            echo '<button type="submit" name="add">Add</button>';
        }
        ?>
    </form>

    <h2>Existing Contact Information</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Instagram</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = $c->conn()->query("SELECT * FROM CONTACT");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['phone']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td><a href='https://instagram.com/{$row['instagram']}' target='_blank'>{$row['instagram']}</a></td>";
            echo "<td>
                <form method='GET' action='manage contact.php'>
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
</body>
</html>
