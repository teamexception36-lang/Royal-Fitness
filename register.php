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

    // Pro-level Regex Validation
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
        // 1. Check if user already exists
        $check_exists = $conn->prepare("SELECT id FROM users WHERE email=? OR phone=?");
        $check_exists->bind_param("ss", $email, $phone);
        $check_exists->execute();
        $res_exists = $check_exists->get_result();

        if ($res_exists->num_rows > 0) {
            $error = "Email or Phone already registered.";
        } else {
            // 2. Strict Role Capacity Check
            $can_proceed = true;
            if ($role === 'owner') {
                $count_owner = mysqli_query($conn, "SELECT id FROM users WHERE role='owner'");
                if (mysqli_num_rows($count_owner) >= 1) {
                    $error = "Access Denied: Royal Fitness only allows 1 Owner account.";
                    $can_proceed = false;
                }
            } elseif ($role === 'manager') {
                $count_manager = mysqli_query($conn, "SELECT id FROM users WHERE role='manager'");
                if (mysqli_num_rows($count_manager) >= 2) {
                    $error = "Access Denied: Royal Fitness already has 2 Managers.";
                    $can_proceed = false;
                }
            }

            if ($can_proceed) {
                // 3. Pro-Level Password Hashing
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                
                $sql = "INSERT INTO users (username, email, phone, password, role, active_plan, bmi_score) 
                        VALUES (?, ?, ?, ?, ?, 'No Active Plan', 0)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssss", $username, $email, $phone, $hashed_password, $role);
                
                if ($stmt->execute()) {
                    $success = "Registration Successful! Redirecting to Login...";
                    header("refresh:3;url=login.php");
                } else {
                    $error = "System Error: Registration failed.";
                }
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
                    <div class="password-field-container">
                        <input type="text" name="username" placeholder="e.g. Rahul Sawant" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <label><i class="fas fa-envelope"></i> Email</label>
                        <div class="password-field-container">
                            <input type="email" name="email" placeholder="name@email.com" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <label><i class="fas fa-phone"></i> Mobile</label>
                        <div class="password-field-container">
                            <input type="text" name="phone" placeholder="10 Digits" maxlength="10" required>
                        </div>
                    </div>
                </div>

                <div class="input-group">
                    <label><i class="fas fa-id-badge"></i> Access Role</label>
                    <div class="password-field-container">
                        <select name="role" class="form-select-custom" required>
                            <option value="user">Gym Member</option>
                            <option value="trainer">Official Trainer</option>
                            <option value="manager">Gym Manager (Max 2)</option>
                            <option value="owner">Gym Owner (Max 1)</option>
                        </select>
                    </div>
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

                <button type="submit" name="register" class="btn-royal">Create Account</button>
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