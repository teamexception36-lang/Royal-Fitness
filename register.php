<?php
include 'config.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $role = 'user';

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Email already exists');</script>";
    } else {
        $sql = "INSERT INTO users (username, email, password, role)
                VALUES ('$username', '$email', '$password', '$role')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Registration successful!'); window.location='index.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="style.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-wrapper"> 
        <div class="login-card">
            <h1 class="card-title">Join Us! 🚀</h1>
            <form method="POST" class="login-form">
                
                <div class="input-group">
                  <label for="username">Username</label>
                  <input type="text" id="username" name="username" placeholder="Choose a username" required>
              </div>
                
                <div class="input-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your  email" required>
                </div>
                
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Create a strong password" required>
                </div>

                <button type="submit" name="register" class="login-button">
                    Create Account
                </button>
                
            </form>
            <p class="register-link">
                Already have an account? 
                <a href="login.php">Log In Here</a>
            </p>
        </div>
    </div>
</body>
</html>