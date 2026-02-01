<?php
include 'config.php';
session_start();

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']); 

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $_SESSION['user_id']  = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['email']    = $row['email'];
        $_SESSION['role']     = $row['role'];

        $adminRoles = ['admin', 'owner', 'manager'];

        if (in_array($row['role'], $adminRoles)) {
            header("Location: admin_dashboard.php");
        } else if ($row['role'] == 'trainer') {
            header("Location: trainer_dashboard.php");
        } else {
            header("Location: dashboard.php");
        }
        exit(); 
    } else {
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>

    <div class="login-container">
        <div class="login-card">
            <div class="brand-section">
                <img src="images/Royal_fit_logo.png" alt="Logo" class="login-logo" onerror="this.style.display='none'">
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
                    <div class="password-field-container">
                        <input type="password" name="password" id="loginPass" placeholder="••••••••" required>
                        <i class="fas fa-eye toggle-password" id="toggleIcon" onclick="togglePasswordVisibility('loginPass', 'toggleIcon')"></i>
                    </div>
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

    <script>
    function togglePasswordVisibility(inputId, iconId) {
        const passwordInput = document.getElementById(inputId);
        const toggleIcon = document.getElementById(iconId);
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
    </script>
</body>
</html>