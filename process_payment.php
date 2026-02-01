<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $uid = $_SESSION['user_id'];
    $plan = mysqli_real_escape_string($conn, $_POST['plan_name']);
    $txn_id = mysqli_real_escape_string($conn, $_POST['txn_id']);
    
    // Determine Price based on Plan (Matching your membership page)
    $amount = 0;
    if ($plan == 'Monthly') $amount = 1100;
    elseif ($plan == 'Elite-Yearly') $amount = 8500;
    elseif ($plan == 'Student') $amount = 2200;
    // Add more conditions for other plans...

    // 1. Log the transaction into the payments table
    $log_query = "INSERT INTO payments (user_id, plan_name, amount, transaction_id, status) 
                  VALUES ('$uid', '$plan', '$amount', '$txn_id', 'Verified')";
    
    // 2. Update user's active status
    $update_user = "UPDATE users SET active_plan = '$plan' WHERE id = '$uid'";

    if (mysqli_query($conn, $log_query) && mysqli_query($conn, $update_user)) {
        echo "<script>
                alert('Payment Success! Your $plan plan is active.');
                window.location.href='dashboard.php';
              </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>