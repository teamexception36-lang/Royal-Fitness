<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id=$id"));

if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    mysqli_query($conn, "UPDATE users SET username='$username', email='$email', role='$role' WHERE id=$id");
    echo "<script>alert('User updated successfully!'); window.location='manage_users.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit User</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h2>Edit User</h2>
    <form method="POST">
      <input type="text" name="username" value="<?= $user['username'] ?>" required><br>
      <input type="email" name="email" value="<?= $user['email'] ?>" required><br>
      <select name="role">
        <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
      </select><br><br>
      <button type="submit" name="update">Update</button>
      <a href="manage_users.php" class="btn">Cancel</a>
    </form>
  </div>
</body>
</html>
