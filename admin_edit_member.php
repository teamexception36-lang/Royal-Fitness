<?php
session_start();
include 'config.php';

$authorized = ['admin', 'owner', 'manager'];
if (!isset($_SESSION['username']) || !in_array($_SESSION['role'], $authorized)) {
    header("Location: login.php"); exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$user_res = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
$user = mysqli_fetch_assoc($user_res);

if (isset($_POST['update_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $plan = $_POST['active_plan'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET username='$username', email='$email', active_plan='$plan', role='$role' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: admin_members.php?msg=updated");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Member | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin_shared.css">
</head>
<body style="background:#000; color:#fff;">
    <div class="container mt-5">
        <div class="card bg-dark border-secondary p-4 mx-auto" style="max-width: 500px;">
            <h3 class="text-gold">Edit Member Details</h3>
            <form method="POST">
                <div class="mb-3">
                    <label class="small text-muted">Username</label>
                    <input type="text" name="username" class="form-control bg-black text-white" value="<?php echo $user['username']; ?>">
                </div>
                <div class="mb-3">
                    <label class="small text-muted">Email</label>
                    <input type="email" name="email" class="form-control bg-black text-white" value="<?php echo $user['email']; ?>">
                </div>
                <div class="mb-3">
                    <label class="small text-muted">Assign Plan</label>
                    <select name="active_plan" class="form-control bg-black text-white">
                        <option value="No Active Plan" <?php if($user['active_plan']=='No Active Plan') echo 'selected'; ?>>No Active Plan</option>
                        <option value="Monthly" <?php if($user['active_plan']=='Monthly') echo 'selected'; ?>>Monthly</option>
                        <option value="Elite-Yearly" <?php if($user['active_plan']=='Elite-Yearly') echo 'selected'; ?>>Elite-Yearly</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="small text-muted">Account Role</label>
                    <select name="role" class="form-control bg-black text-white">
                        <option value="user" <?php if($user['role']=='user') echo 'selected'; ?>>User (Member)</option>
                        <option value="trainer" <?php if($user['role']=='trainer') echo 'selected'; ?>>Trainer</option>
                        <option value="manager" <?php if($user['role']=='manager') echo 'selected'; ?>>Manager</option>
                    </select>
                </div>
                <button name="update_user" class="btn btn-warning w-100 fw-bold">Update Account</button>
                <a href="admin_members.php" class="d-block text-center mt-3 text-muted">Cancel</a>
            </form>
        </div>
    </div>
</body>
</html>