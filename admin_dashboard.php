<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php"); exit();
}

// KPI Logic
$revenue = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(amount) as total FROM payments"))['total'] ?? 0;
$expenses = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(amount) as total FROM expenses"))['total'] ?? 0;
$profit = $revenue - $expenses;
$members = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id) as count FROM users WHERE role='user'"))['count'];
$active_plans = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id) as count FROM users WHERE active_plan != 'No Active Plan'"))['count'];
$unread_msg = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id) as count FROM messages"))['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BI Dashboard | Royal Fitness Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="admin_shared.css">
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
    <div class="admin-wrapper">
        <!-- Persistent Sidebar -->
        <?php include 'admin_sidebar.php'; ?>

        <div class="main-content">
            <div class="header-flex">
                <h1>Business Overview</h1>
                <div class="date-display"><?php echo date('D, d M Y'); ?></div>
            </div>

            <!-- KPI Cards -->
            <div class="row g-4 mb-5">
                <div class="col-md-3">
                    <div class="kpi-card">
                        <i class="fas fa-wallet icon-gold"></i>
                        <div class="kpi-data">
                            <span>Total Revenue</span>
                            <h3>₹<?php echo number_format($revenue, 0); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="kpi-card">
                        <i class="fas fa-file-invoice-dollar icon-red"></i>
                        <div class="kpi-data">
                            <span>Total Expenses</span>
                            <h3>₹<?php echo number_format($expenses, 0); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="kpi-card">
                        <i class="fas fa-chart-line icon-green"></i>
                        <div class="kpi-data">
                            <span>Net Profit</span>
                            <h3>₹<?php echo number_format($profit, 0); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="kpi-card">
                        <i class="fas fa-users icon-blue"></i>
                        <div class="kpi-data">
                            <span>Active Members</span>
                            <h3><?php echo $active_plans; ?>/<?php echo $members; ?></h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visual Charts Section (Placeholders) -->
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="content-card">
                        <h4>Recent Sales Performance</h4>
                        <table class="table table-dark table-hover mt-3">
                            <thead>
                                <tr><th>User</th><th>Plan</th><th>Amount</th><th>Date</th></tr>
                            </thead>
                            <tbody>
                                <?php
                                $sales = mysqli_query($conn, "SELECT p.*, u.username FROM payments p JOIN users u ON p.user_id=u.id ORDER BY payment_date DESC LIMIT 5");
                                while($s = mysqli_fetch_assoc($sales)) {
                                    echo "<tr><td>{$s['username']}</td><td>{$s['plan_name']}</td><td class='text-gold'>₹{$s['amount']}</td><td>".date('d M', strtotime($s['payment_date']))."</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="content-card">
                        <h4>Critical Notifications</h4>
                        <div class="notif-item"><i class="fas fa-bell"></i> <?php echo $unread_msg; ?> New user inquiries</div>
                        <div class="notif-item"><i class="fas fa-tools"></i> 2 Equipments need service</div>
                        <div class="notif-item"><i class="fas fa-exclamation-triangle"></i> 5 Memberships expiring</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>