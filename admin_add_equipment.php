<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') { header("Location: login.php"); exit(); }

if (isset($_POST['save_equip'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $status = $_POST['status'];
    $p_date = $_POST['purchase_date'];
    $m_date = $_POST['maint_date'];

    $sql = "INSERT INTO equipment (name, condition_status, purchase_date, last_maintenance) 
            VALUES ('$name', '$status', '$p_date', '$m_date')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Equipment Added!'); window.location.href='admin_equipment.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Equipment | Royal Fitness</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin_shared.css">
    <style>
        .form-card { background: #1a1a1a; padding: 40px; border-radius: 20px; border: 1px solid #333; max-width: 600px; margin: 50px auto; }
        .form-control { background: #000; border: 1px solid #444; color: #fff; }
    </style>
</head>
<body style="background:#000; color:#fff;">
    <div class="admin-wrapper">
        <?php include 'admin_sidebar.php'; ?>
        <div class="main-content">
            <div class="form-card">
                <h2 class="text-gold mb-4" style="color:#d4af37">Register Equipment</h2>
                <form method="POST">
                    <div class="mb-3">
                        <label class="small text-muted">Machine Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Treadmill X5" required>
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted">Condition Status</label>
                        <select name="status" class="form-control">
                            <option value="Good">Good</option>
                            <option value="Service Required">Service Required</option>
                            <option value="Broken">Broken</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted">Purchase Date</label>
                        <input type="date" name="purchase_date" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label class="small text-muted">Last Maintenance Date</label>
                        <input type="date" name="maint_date" class="form-control" required>
                    </div>
                    <button name="save_equip" class="btn btn-warning w-100 fw-bold py-3" style="background:#d4af37">Add to Inventory</button>
                    <a href="admin_equipment.php" class="d-block text-center mt-3 text-muted">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>