<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Ensure the user is not an admin attempting to access the user profile 
// (though admins can still view their profile, this structure assumes 
// 'user_dashboard.php' is the default non-admin landing page)
if ($_SESSION['role'] == 'admin') {
    header("Location: admin_dashboard.php");
    exit();
}


$username = htmlspecialchars($_SESSION['username']);
$email = isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'email@example.com'; 

// NOTE: To display the correct email, you must modify your index.php
// to store the email in the session after a successful login:
// $_SESSION['email'] = $row['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $username; ?>'s Profile</title>
    <link rel="stylesheet" href="style.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-wrapper"> <div class="login-card profile-card"> <h1 class="card-title">My Profile 👤</h1>
            
            <div class="profile-details">
                
                <div class="detail-group">
                    <label>Username</label>
                    <p class="detail-value"><?php echo $username; ?></p>
                </div>
                
                <div class="detail-group">
                    <label>Email Address</label>
                    <p class="detail-value"><?php echo $email; ?></p>
                </div>

            </div>
            
            <a href="logout.php" class="login-button logout-button">
                Logout
            </a>
            
        </div>
    </div>
</body>
</html>