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

    $pwd_regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
    $phone_regex = "/^[0-9]{10}$/";

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif (!preg_match($phone_regex, $phone)) {
        $error = "Phone must be 10 digits.";
    } elseif (!preg_match($pwd_regex, $password)) {
        $error = "Password must be 8+ chars with Upper, Lower, Number & Symbol.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        $hashed_password = md5($password); 
        $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' OR phone='$phone'");
        if (mysqli_num_rows($check) > 0) {
            $error = "Email or Phone already exists.";
        } else {
            $sql = "INSERT INTO users (username, email, phone, password, role, active_plan, bmi_score) 
                    VALUES ('$username', '$email', '$phone', '$hashed_password', '$role', 'No Active Plan', 0)";
            if (mysqli_query($conn, $sql)) {
                $success = "Registration Successful! Redirecting...";
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

            <?php if($error): ?><div class="alert error"><?php echo $error; ?></div><?php endif; ?>
            <?php if($success): ?><div class="alert success"><?php echo $success; ?></div><?php endif; ?>

            <form method="POST" action="" class="register-form">
                <div class="input-group">
                    <label><i class="fas fa-user"></i> Full Name</label>
                    <input type="text" name="username" placeholder="e.g. Rahul Sawant" required>
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <label><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" name="email" placeholder="name@email.com" required>
                    </div>
                    <div class="input-group">
                        <label><i class="fas fa-phone"></i> Mobile</label>
                        <input type="text" name="phone" placeholder="10 Digits" maxlength="10" required>
                    </div>
                </div>

                <div class="input-group">
                    <label><i class="fas fa-id-badge"></i> Role</label>
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
                        <div class="password-field-container">
                            <input type="password" name="password" id="regPass" placeholder="8+ Chars" required>
                            <i class="fas fa-eye toggle-password" id="eye1" onclick="togglePasswordVisibility('regPass', 'eye1')"></i>
                        </div>
                    </div>
                    <div class="input-group">
                        <label><i class="fas fa-check-circle"></i> Confirm</label>
                        <div class="password-field-container">
                            <input type="password" name="confirm_password" id="confirmPass" placeholder="Repeat" required>
                            <i class="fas fa-eye toggle-password" id="eye2" onclick="togglePasswordVisibility('confirmPass', 'eye2')"></i>
                        </div>
                    </div>
                </div>

                <button type="submit" name="register" class="btn-royal">Register Now</button>
            </form>
            <div class="card-footer">
                <p>Already registered? <a href="login.php">Login</a></p>
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