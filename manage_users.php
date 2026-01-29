<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM users");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Users</title>
  <link rel="stylesheet" href="style.css">
  <style>
    table {
      width: 90%;
      margin: 20px auto;
      border-collapse: collapse;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: center;
    }
    th {
      background-color: #0077b6;
      color: white;
    }
    a.action-btn {
      padding: 6px 12px;
      border-radius: 5px;
      text-decoration: none;
      margin: 2px;
    }
    .edit { background: #00b4d8; color: white; }
    .delete { background: #e63946; color: white; }
  </style>
</head>
<body>
  <div class="dashboard">
    <h1>Manage Users</h1>
    <a href="admin_dashboard.php" class="btn">Back to Dashboard</a>
    <table>
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actions</th>
      </tr>
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= $row['username'] ?></td>
          <td><?= $row['email'] ?></td>
          <td><?= $row['role'] ?></td>
          <td>
            <a href="edit_user.php?id=<?= $row['id'] ?>" class="action-btn edit">Edit</a>
            <a href="delete_user.php?id=<?= $row['id'] ?>" class="action-btn delete"
               onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
          </td>
        </tr>
      <?php } ?>
    </table>
  </div>
</body>
</html>
