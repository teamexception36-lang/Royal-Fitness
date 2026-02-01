<?php
session_start();
include 'config.php';

$authorized = ['admin', 'owner', 'manager'];
if (!isset($_SESSION['username']) || !in_array($_SESSION['role'], $authorized)) {
    header("Location: login.php"); exit();
}

$inventory = mysqli_query($conn, "SELECT * FROM equipment ORDER BY purchase_date DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory | Royal Fitness</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin_shared.css">
    <link rel="stylesheet" href="admin_equipment.css">
</head>
<body>
    <div class="admin-wrapper">
        <?php include 'admin_sidebar.php'; ?>
        <div class="main-content">
            <div class="header-flex d-flex justify-content-between">
                <h1>Equipment <span class="text-gold">Inventory</span></h1>
                <a href="admin_add_equipment.php" class="btn btn-warning fw-bold">+ Add Machine</a>
            </div>
            <div class="row g-4 mt-2">
                <?php while($e = mysqli_fetch_assoc($inventory)): ?>
                <div class="col-md-4">
                    <div class="equip-card">
                        <div class="status-indicator <?php echo strtolower(str_replace(' ', '-', $e['condition_status'])); ?>"></div>
                        <h5><?php echo $e['name']; ?></h5>
                        <hr style="border-color:#333">
                        <p class="small text-muted mb-1">Purchased: <?php echo $e['purchase_date']; ?></p>
                        <p class="small text-muted">Last Service: <?php echo $e['last_maintenance']; ?></p>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</body>
</html>