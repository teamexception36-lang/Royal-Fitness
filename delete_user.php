<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM users WHERE id=$id");
echo "<script>alert('User deleted successfully!'); window.location='manage_users.php';</script>";
?>
