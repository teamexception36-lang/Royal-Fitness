<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$uid = $_SESSION['user_id'];
$success = "";
$error = "";

// Fetch current data
$query = "SELECT * FROM users WHERE id = '$uid'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if (isset($_POST['update_profile'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // --- Profile Picture Upload Logic ---
    $profile_pic = $user['profile_pic']; // Default to current pic

    if (isset($_FILES['pic']) && $_FILES['pic']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        $filename = $_FILES['pic']['name'];
        $filesize = $_FILES['pic']['size'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            $error = "Invalid format. Only JPG, PNG, and WEBP allowed.";
        } elseif ($filesize > 2 * 1024 * 1024) { // 2MB Limit
            $error = "File too large. Maximum size is 2MB.";
        } else {
            // Create a unique name: e.g., user_5_16234567.jpg
            $new_name = "user_" . $uid . "_" . time() . "." . $ext;
            $upload_path = "uploads/profile_pics/" . $new_name;

            if (move_uploaded_file($_FILES['pic']['tmp_name'], $upload_path)) {
                // Delete old picture if it's not the default one
                if ($user['profile_pic'] != 'default_avatar.jpg' && file_exists("uploads/profile_pics/" . $user['profile_pic'])) {
                    unlink("uploads/profile_pics/" . $user['profile_pic']);
                }
                $profile_pic = $new_name;
            } else {
                $error = "Failed to upload image.";
            }
        }
    }

    if (empty($error)) {
        $update_query = "UPDATE users SET username='$username', email='$email', profile_pic='$profile_pic' WHERE id='$uid'";
        if (mysqli_query($conn, $update_query)) {
            $_SESSION['username'] = $username; // Update session
            $success = "Profile updated successfully!";
            header("refresh:2;url=dashboard.php");
        } else {
            $error = "Database error. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile | Royal Fitness</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css">
    <style>
        .edit-card {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 20px;
            padding: 40px;
            max-width: 600px;
            margin: 50px auto;
        }
        .current-pic {
            width: 120px; height: 120px;
            border-radius: 50%;
            border: 3px solid #d4af37;
            object-fit: cover;
            margin-bottom: 20px;
        }
        .custom-file-input {
            color: #888;
            background: #111;
            border: 1px solid #333;
            border-radius: 10px;
            padding: 10px;
            width: 100%;
        }
    </style>
</head>
<body style="background: #080808; color: white;">

<div class="container">
    <div class="edit-card">
        <h2 class="text-center mb-4" style="color:#d4af37">Edit Profile</h2>
        
        <?php if($success) echo "<div class='alert alert-success'>$success</div>"; ?>
        <?php if($error) echo "<div class='alert alert-danger'>$error</div>"; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="text-center">
                <!-- Display Profile Picture -->
                <img src="uploads/profile_pics/<?php echo $user['profile_pic']; ?>" class="current-pic" alt="Profile">
                <div class="mb-4">
                    <label class="form-label small text-muted">Change Profile Picture (Max 2MB)</label>
                    <input type="file" name="pic" class="custom-file-input">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control bg-dark text-white border-secondary" value="<?php echo $user['username']; ?>" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control bg-dark text-white border-secondary" value="<?php echo $user['email']; ?>" required>
            </div>

            <button type="submit" name="update_profile" class="btn btn-warning w-100 fw-bold py-3" style="background:#d4af37; border:none;">Save Changes</button>
            <a href="dashboard.php" class="d-block text-center mt-3 text-muted text-decoration-none">← Back to Dashboard</a>
        </form>
    </div>
</div>

</body>
</html>