<?php
session_start();
include 'config.php';

$authorized = ['admin', 'owner', 'manager'];
if (!isset($_SESSION['username']) || !in_array($_SESSION['role'], $authorized)) {
    header("Location: login.php"); exit();
}

if (isset($_POST['save_trainer'])) {
    // ... same saving logic as before ...
}
?>
<!-- Rest of form HTML is same -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Trainer | Royal Fitness</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin_shared.css">
    <style>
        .form-card { background: #1a1a1a; padding: 40px; border-radius: 20px; border: 1px solid #333; max-width: 600px; margin: 50px auto; }
        .form-control { background: #000; border: 1px solid #444; color: #fff; padding: 12px; }
        .form-control:focus { background: #050505; border-color: #d4af37; color: #fff; box-shadow: none; }
    </style>
</head>
<body style="background:#000; color:#fff;">
    <div class="admin-wrapper">
        <?php include 'admin_sidebar.php'; ?>
        <div class="main-content">
            <div class="form-card">
                <h2 class="text-gold mb-4" style="color:#d4af37">Add New Trainer</h2>
                <form method="POST">
                    <div class="mb-3">
                        <label class="small text-muted">Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Rahul Sharma" required>
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted">Specialty</label>
                        <input type="text" name="specialty" class="form-control" placeholder="e.g. Bodybuilding / Yoga" required>
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted">Monthly Salary (₹)</label>
                        <input type="number" name="salary" class="form-control" placeholder="30000" required>
                    </div>
                    <div class="mb-4">
                        <label class="small text-muted">Phone Number</label>
                        <input type="text" name="phone" class="form-control" placeholder="+91 000..." required>
                    </div>
                    <button name="save_trainer" class="btn btn-warning w-100 fw-bold py-3" style="background:#d4af37">Enroll Trainer</button>
                    <a href="admin_trainers.php" class="d-block text-center mt-3 text-muted">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>