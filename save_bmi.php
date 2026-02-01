<?php
session_start();
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "Error: User not logged in.";
    exit();
}

if (isset($_POST['bmi'])) {
    $uid = $_SESSION['user_id'];
    $bmi = $_POST['bmi'];
    $h = $_POST['height'];
    $w = $_POST['weight'];

    // Update the database
    $sql = "UPDATE users SET bmi_score = '$bmi', height = '$h', weight = '$w' WHERE id = '$uid'";
    
    if (mysqli_query($conn, $sql)) {
        echo "Success: Data saved for User ID: " . $uid;
    } else {
        echo "Database Error: " . mysqli_error($conn);
    }
} else {
    echo "Error: No data received.";
}
?>