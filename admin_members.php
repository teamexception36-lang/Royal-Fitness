<?php
session_start();
include 'config.php';

// Authorized roles
$authorized = ['admin', 'owner', 'manager'];
if (!isset($_SESSION['username']) || !in_array($_SESSION['role'], $authorized)) {
    header("Location: login.php"); exit();
}

// --- DELETE MEMBER LOGIC ---
if (isset($_GET['delete'])) {
    $id = mysqli_real_escape_string($conn, $_GET['delete']);
    
    // Prevent admin from deleting themselves
    if ($id == $_SESSION['user_id']) {
        echo "<script>alert('You cannot delete your own account!'); window.location='admin_members.php';</script>";
    } else {
        mysqli_query($conn, "DELETE FROM users WHERE id = '$id'");
        header("Location: admin_members.php?msg=deleted");
        exit();
    }
}

$members = mysqli_query($conn, "SELECT * FROM users WHERE role='user' ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Members | Royal Fitness</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="admin_shared.css">
    <link rel="stylesheet" href="admin_members.css">
</head>
<body>
    <div class="admin-wrapper">
        <?php include 'admin_sidebar.php'; ?>
        <div class="main-content">
            <h1>Member <span class="text-gold">Directory</span></h1>
            
            <?php if(isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
                <div class="alert alert-danger">Member account has been permanently removed.</div>
            <?php endif; ?>

            <div class="table-container mt-4">
                <table class="table table-dark table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Plan</th>
                            <th>BMI</th>
                            <th>Weight/Height</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($m = mysqli_fetch_assoc($members)): ?>
                        <tr>
                            <td><strong><?php echo $m['username']; ?></strong><br><small class="text-muted"><?php echo $m['email']; ?></small></td>
                            <td><span class="plan-tag"><?php echo $m['active_plan']; ?></span></td>
                            <td class="text-gold fw-bold"><?php echo $m['bmi_score']; ?></td>
                            <td><?php echo $m['weight']; ?>kg / <?php echo $m['height']; ?>cm</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <!-- Edit Button -->
                                    <a href="admin_edit_member.php?id=<?php echo $m['id']; ?>" class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <!-- Delete Button -->
                                    <a href="admin_members.php?delete=<?php echo $m['id']; ?>" 
                                       class="btn btn-sm btn-outline-danger" 
                                       onclick="return confirm('Are you sure? This will permanently delete this user account.')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>