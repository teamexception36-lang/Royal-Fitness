<?php
include 'config.php';
session_start();

$error = "";
$success = "";

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    // --- Standard Validation Rules ---
    
    // 1. Password Strength Regex
    $pwd_regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
    
    // 2. Phone Number Regex (10 Digits)
    $phone_regex = "/^[0-9]{10}$/";

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif (!preg_match($phone_regex, $phone)) {
        $error = "Phone number must be exactly 10 digits.";
    } elseif (!preg_match($pwd_regex, $password)) {
        $error = "Password must be 8+ chars with Uppercase, Lowercase, Number & Symbol.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        $hashed_password = md5($password); 

        // Check if email or phone already exists
        $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' OR phone='$phone'");
        if (mysqli_num_rows($check) > 0) {
            $error = "Email or Phone Number is already registered.";
        } else {
            $sql = "INSERT INTO users (username, email, phone, password, role, active_plan, bmi_score) 
                    VALUES ('$username', '$email', '$phone', '$hashed_password', '$role', 'No Active Plan', 0)";
            
            if (mysqli_query($conn, $sql)) {
                $success = "Registration Successful! Redirecting to login...";
                header("refresh:3;url=login.php");
            } else {
                $error = "System Error: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Royal Fitness Pro</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="register.css">
</head>
<body>

    <div class="register-container">
        <div class="register-card">
            <div class="brand-header">
                <img src="images/Royal_fit_logo.png" alt="Logo" class="logo-img">
                <h1>ROYAL <span>FITNESS</span></h1>
                <p>Join the High-Performance Community</p>
            </div>

            <?php if($error): ?>
                <div class="alert error"><i class="fas fa-shield-alt"></i> <?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php if($success): ?>
                <div class="alert success"><i class="fas fa-check-double"></i> <?php echo $success; ?></div>
            <?php endif; ?>

            <form method="POST" action="" class="register-form">
                <div class="input-group">
                    <label><i class="fas fa-user"></i> Full Name</label>
                    <input type="text" name="username" placeholder="e.g. Rahul Sawant" required>
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <label><i class="fas fa-envelope"></i> Email Address</label>
                        <input type="email" name="email" placeholder="name@email.com" required>
                    </div>
                    <div class="input-group">
                        <label><i class="fas fa-phone"></i> Mobile Number</label>
                        <input type="text" name="phone" placeholder="10 Digit Number" maxlength="10" required>
                    </div>
                </div>

                <div class="input-group">
                    <label><i class="fas fa-id-badge"></i> Account Authority</label>
                    <select name="role" class="form-select-custom" required>
                        <option value="user">Gym Member</option>
                        <option value="trainer">Official Trainer</option>
                        <option value="manager">Gym Manager</option>
                        <option value="owner">Gym Owner</option>
                    </select>
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <label><i class="fas fa-lock"></i> Password</label>
                        <input type="password" name="password" placeholder="8+ Strong Chars" required>
                    </div>
                    <div class="input-group">
                        <label><i class="fas fa-check-circle"></i> Confirm</label>
                        <input type="password" name="confirm_password" placeholder="Repeat Password" required>
                    </div>
                </div>

                <!-- Password hint for user guidance -->
                <p class="pwd-hint">Password must contain Uppercase, Lowercase, Number & Symbol.</p>

                <button type="submit" name="register" class="btn-royal">
                    Secure Registration <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </form>

            <div class="card-footer">
                <p>Already registered? <a href="login.php">Login to Dashboard</a></p>
                <a href="home.php" class="back-home">← Back to Homepage</a>
            </div>
        </div>
    </div>

</body>
</html>