<?php
include 'config.php';
session_start();

if (isset($_POST['login'])) {
    // 1. Sanitize and Hash
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']); 

    // 2. Query the Database
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // 3. Set Essential Session Variables
        $_SESSION['user_id']  = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['email']    = $row['email'];
        $_SESSION['role']     = $row['role'];

        // 4. Role-Based Redirection Logic (Pro Level)
        $adminRoles = ['admin', 'owner', 'manager'];

        if (in_array($row['role'], $adminRoles)) {
            // High Authority Access
            header("Location: admin_dashboard.php");
        } else if ($row['role'] == 'trainer') {
            // Trainer Access
            header("Location: trainer_dashboard.php");
        } else {
            // Regular Gym Member Access
            header("Location: dashboard.php");
        }
        exit(); // Always exit after a header redirect
    } else {
        // Login Failed
        echo "<script>alert('Invalid Email or Password. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Royal Fitness</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- External CSS -->
    <link rel="stylesheet" href="login.css">
</head>
<body>

    <div class="login-container">
        <div class="login-card">
            <div class="brand-section">
                <img src="images/Royal_fit_logo.png" alt="Royal Fit Logo" class="login-logo" onerror="this.style.display='none'">
                <h1>ROYAL <span>FITNESS</span></h1>
                <p>Welcome Back, Elite Member</p>
            </div>

            <form method="POST" action="" class="login-form">
                <div class="input-group">
                    <label><i class="fas fa-envelope"></i> Email Address</label>
                    <input type="email" name="email" placeholder="name@example.com" required>
                </div>
                
                <div class="input-group">
                    <label><i class="fas fa-lock"></i> Password</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>

                <button type="submit" name="login" class="btn-login">
                    Sign In <i class="fas fa-sign-in-alt"></i>
                </button>
            </form>

            <div class="login-footer">
                <p>Don't have an account? <a href="register.php">Join the family</a></p>
                <a href="home.php" class="back-link">← Return to Website</a>
            </div>
        </div>
    </div>

</body>
</html>