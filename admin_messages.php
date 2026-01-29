<?php
session_start();

// Optional: Protect this page for admin only
if(!isset($_SESSION['username']) || $_SESSION['username'] != 'admin'){
  header("Location: login.php");
  exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM messages ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - View Messages</title>
  <style>
    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      background: linear-gradient(to right, #f0f2f5, #e3e6e8);
      color: #333;
      margin: 0;
      padding: 20px;
    }

    h2 {
      text-align: center;
      color: #4CAF50;
    }

    table {
      width: 90%;
      margin: 20px auto;
      border-collapse: collapse;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      background-color: #fff;
    }

    th, td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
      text-align: left;
    }

    th {
      background-color: #4CAF50;
      color: white;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    .logout {
      display: block;
      text-align: center;
      margin-top: 20px;
      text-decoration: none;
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border-radius: 8px;
      width: 120px;
      margin-left: auto;
      margin-right: auto;
    }

    .logout:hover {
      background-color: #388E3C;
    }
  </style>
</head>
<body>
  <h2>📩 User Messages</h2>

  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Message</th>
      <th>Received On</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row['id']."</td>
                <td>".$row['name']."</td>
                <td>".$row['email']."</td>
                <td>".$row['phone']."</td>
                <td>".$row['message']."</td>
                <td>".$row['created_at']."</td>
              </tr>";
      }
    } else {
      echo "<tr><td colspan='6' style='text-align:center;'>No messages found</td></tr>";
    }
    $conn->close();
    ?>
  </table>

  <a href="logout.php" class="logout">Logout</a>
</body>
</html>
