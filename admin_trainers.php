<?php
session_start();
include 'config.php';
// Security Check
$authorized = ['admin', 'owner', 'manager'];
if (!isset($_SESSION['username']) || !in_array($_SESSION['role'], $authorized))
{
     header("Location: login.php"); exit();
}
        
 

$trainers = mysqli_query($conn, "SELECT * FROM trainers");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trainer Management | Royal Fitness</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="admin_shared.css">
    <link rel="stylesheet" href="admin_trainers.css">
</head>
<body>
    <div class="admin-wrapper">
        <?php include 'admin_sidebar.php'; ?>
        <div class="main-content">
            <div class="header-flex">
                <h1>Trainer Profiles</h1>
                <a href="admin_add_trainer.php" class="btn btn-warning fw-bold">+ Add New Trainer</a>
            </div>

            <div class="row g-4">
                <?php while($t = mysqli_fetch_assoc($trainers)): ?>
                <div class="col-md-4">
                    <div class="trainer-card">
                        <div class="trainer-header">
                            <div class="avatar"><?php echo substr($t['name'], 0, 1); ?></div>
                            <div>
                                <h5><?php echo $t['name']; ?></h5>
                                <span class="badge bg-gold"><?php echo $t['specialty']; ?></span>
                            </div>
                        </div>
                        <div class="trainer-body mt-3">
                            <p><i class="fas fa-phone"></i> <?php echo $t['phone']; ?></p>
                            <p><i class="fas fa-money-bill-wave"></i> ₹<?php echo number_format($t['salary'], 0); ?></p>
                        </div>
                        <div class="trainer-footer d-flex gap-2">
                            <button class="btn btn-outline-light btn-sm w-100">Pay Slip</button>
                            <button class="btn btn-outline-warning btn-sm w-100">Edit</button>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</body>
</html>