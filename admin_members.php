<?php
session_start();
include 'config.php';
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') { header("Location: login.php"); exit(); }

$query = "SELECT * FROM users WHERE role = 'user' ORDER BY created_at DESC";
$members = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Members | Royal Fitness Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="admin_shared.css">
    <link rel="stylesheet" href="admin_members.css">
</head>
<body>
    <div class="admin-wrapper">
        <?php include 'admin_sidebar.php'; ?>
        <div class="main-content">
            <div class="header-flex">
                <h1>Member Directory</h1>
                <div class="search-box">
                    <input type="text" placeholder="Search members..." class="form-control bg-dark text-white border-secondary">
                </div>
            </div>

            <div class="table-container">
                <table class="table table-dark table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Member</th>
                            <th>Active Plan</th>
                            <th>BMI Score</th>
                            <th>Measurements</th>
                            <th>Joined Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($m = mysqli_fetch_assoc($members)): ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="user-avatar"><?php echo substr($m['username'], 0, 1); ?></div>
                                    <div>
                                        <div class="fw-bold"><?php echo $m['username']; ?></div>
                                        <div class="small text-muted"><?php echo $m['email']; ?></div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="plan-tag"><?php echo $m['active_plan']; ?></span></td>
                            <td><span class="text-gold fw-bold"><?php echo $m['bmi_score'] ?: '--'; ?></span></td>
                            <td><small><?php echo $m['height']; ?>cm / <?php echo $m['weight']; ?>kg</small></td>
                            <td><?php echo date('d M Y', strtotime($m['created_at'])); ?></td>
                            <td><span class="status-dot active"></span> Active</td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>