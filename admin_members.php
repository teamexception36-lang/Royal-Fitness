<?php
session_start();
include 'config.php';

$authorized = ['admin', 'owner', 'manager'];
if (!isset($_SESSION['username']) || !in_array($_SESSION['role'], $authorized)) {
    header("Location: login.php"); exit();
}

$members = mysqli_query($conn, "SELECT * FROM users WHERE role='user' ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Members | Royal Fitness Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin_shared.css">
    <link rel="stylesheet" href="admin_members.css">
</head>
<body>
    <div class="admin-wrapper">
        <?php include 'admin_sidebar.php'; ?>
        <div class="main-content">
            <h1>Member <span class="text-gold">Directory</span></h1>
            <div class="table-container mt-4">
                <table class="table table-dark table-hover align-middle">
                    <thead>
                        <tr><th>Name</th><th>Active Plan</th><th>BMI</th><th>Weight/Height</th><th>Joined</th></tr>
                    </thead>
                    <tbody>
                        <?php while($m = mysqli_fetch_assoc($members)): ?>
                        <tr>
                            <td><strong><?php echo $m['username']; ?></strong><br><small class="text-muted"><?php echo $m['email']; ?></small></td>
                            <td><span class="plan-tag"><?php echo $m['active_plan']; ?></span></td>
                            <td class="text-gold fw-bold"><?php echo $m['bmi_score']; ?></td>
                            <td><?php echo $m['weight']; ?>kg / <?php echo $m['height']; ?>cm</td>
                            <td><?php echo date('d M Y', strtotime($m['created_at'])); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>