<?php
session_start();
include 'config.php';
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') { header("Location: login.php"); exit(); }

$inventory = mysqli_query($conn, "SELECT * FROM equipment");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory | Royal Fitness Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="admin_shared.css">
    <link rel="stylesheet" href="admin_equipment.css">
</head>
<body>
    <div class="admin-wrapper">
        <?php include 'admin_sidebar.php'; ?>
        <div class="main-content">
            <div class="header-flex">
                <h1>Equipment Inventory</h1>
               <a href="admin_add_equipment.php" class="btn btn-warning fw-bold">+ Add Equipment</a>
            </div>

            <div class="row g-4">
                <?php while($e = mysqli_fetch_assoc($inventory)): ?>
                <div class="col-md-4">
                    <div class="equip-card">
                        <div class="status-indicator <?php echo strtolower(str_replace(' ', '-', $e['condition_status'])); ?>"></div>
                        <h5><?php echo $e['name']; ?></h5>
                        <hr style="border-color:#333">
                        <div class="small text-muted mb-2">Condition: <b><?php echo $e['condition_status']; ?></b></div>
                        <div class="small">Last Serviced: <?php echo $e['last_maintenance']; ?></div>
                        <button class="btn btn-sm btn-outline-warning mt-3 w-100">Schedule Service</button>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</body>
</html>