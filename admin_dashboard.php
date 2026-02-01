<?php
session_start();
include 'config.php';

// 1. ADVANCED SECURITY: Define authorized roles for the Management Panel
$authorized = ['admin', 'owner', 'manager'];

if (!isset($_SESSION['username']) || !isset($_SESSION['role']) || !in_array($_SESSION['role'], $authorized)) {
    // Redirect unauthorized users or guests to login
    session_destroy();
    header("Location: login.php?error=unauthorized"); 
    exit();
}

// 2. PRO-LEVEL GREETING LOGIC
$roleTitle = ucfirst($_SESSION['role']); // Converts 'owner' to 'Owner'
$adminName = htmlspecialchars($_SESSION['username']);

// 3. BUSINESS INTELLIGENCE (KPI Logic)
// Total Revenue
$rev_res = mysqli_query($conn, "SELECT SUM(amount) as total FROM payments");
$revenue = mysqli_fetch_assoc($rev_res)['total'] ?? 0;

// Total Expenses
$exp_res = mysqli_query($conn, "SELECT SUM(amount) as total FROM expenses");
$expenses = mysqli_fetch_assoc($exp_res)['total'] ?? 0;

// Net Profit
$profit = $revenue - $expenses;

// Member Statistics
$members_res = mysqli_query($conn, "SELECT COUNT(id) as count FROM users WHERE role='user'");
$members = mysqli_fetch_assoc($members_res)['count'] ?? 0;

$active_plans_res = mysqli_query($conn, "SELECT COUNT(id) as count FROM users WHERE role='user' AND active_plan != 'No Active Plan'");
$active_plans = mysqli_fetch_assoc($active_plans_res)['count'] ?? 0;

// Communication Stats
$msg_res = mysqli_query($conn, "SELECT COUNT(id) as count FROM messages");
$unread_msg = mysqli_fetch_assoc($msg_res)['count'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $roleTitle; ?> Dashboard | Royal Fitness</title>
    
    <!-- Bootstrap 5 & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Standard CSS Files -->
    <link rel="stylesheet" href="admin_shared.css">
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
    <div class="admin-wrapper">
        <!-- Persistent Sidebar -->
        <?php include 'admin_sidebar.php'; ?>

        <div class="main-content">
            <!-- Header Section -->
            <div class="header-flex d-flex justify-content-between align-items-center mb-5">
                <div>
                    <h1 class="fw-bold">Business <span class="text-gold">Overview</span></h1>
                    <p class="text-muted">Welcome back, <strong><?php echo $roleTitle; ?></strong> <?php echo $adminName; ?></p>
                </div>
                <div class="text-end">
                    <div class="date-display fw-bold text-gold"><?php echo date('D, d M Y'); ?></div>
                    <span class="badge bg-dark border border-warning text-gold px-3 py-2 mt-2">
                        <i class="fas fa-user-shield me-2"></i><?php echo $roleTitle; ?> Access
                    </span>
                </div>
            </div>

            <!-- KPI Cards Row -->
            <div class="row g-4 mb-5">
                <!-- Revenue Card (Full Visibility for Owner/Admin) -->
                <div class="col-md-3">
                    <div class="kpi-card shadow-sm">
                        <i class="fas fa-wallet icon-gold"></i>
                        <div class="kpi-data">
                            <span>Total Revenue</span>
                            <h3>₹<?php echo number_format($revenue); ?></h3>
                        </div>
                    </div>
                </div>

                <!-- Expenses Card -->
                <div class="col-md-3">
                    <div class="kpi-card shadow-sm">
                        <i class="fas fa-file-invoice-dollar icon-red"></i>
                        <div class="kpi-data">
                            <span>Total Expenses</span>
                            <h3>₹<?php echo number_format($expenses); ?></h3>
                        </div>
                    </div>
                </div>

                <!-- Profit Card (Dynamic color based on value) -->
                <div class="col-md-3">
                    <div class="kpi-card shadow-sm">
                        <i class="fas fa-chart-line <?php echo ($profit >= 0) ? 'icon-green' : 'icon-red'; ?>"></i>
                        <div class="kpi-data">
                            <span>Net Profit</span>
                            <h3>₹<?php echo number_format($profit); ?></h3>
                        </div>
                    </div>
                </div>

                <!-- Active Members Card -->
                <div class="col-md-3">
                    <div class="kpi-card shadow-sm">
                        <i class="fas fa-users icon-blue"></i>
                        <div class="kpi-data">
                            <span>Active Members</span>
                            <h3><?php echo $active_plans; ?> <small class="fs-6 text-muted">/ <?php echo $members; ?></small></h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!-- Sales Performance Table -->
                <div class="col-lg-8">
                    <div class="content-card shadow-sm h-100">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="m-0 text-gold">Recent Sales Performance</h4>
                            <a href="admin_accounting.php" class="btn btn-sm btn-outline-warning">View Ledger</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                                <thead>
                                    <tr class="text-muted border-bottom border-secondary">
                                        <th>Member</th>
                                        <th>Plan</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sales_query = "SELECT p.*, u.username FROM payments p JOIN users u ON p.user_id=u.id ORDER BY payment_date DESC LIMIT 5";
                                    $sales = mysqli_query($conn, $sales_query);
                                    if(mysqli_num_rows($sales) > 0) {
                                        while($s = mysqli_fetch_assoc($sales)) {
                                            echo "<tr>
                                                    <td class='fw-bold'>".htmlspecialchars($s['username'])."</td>
                                                    <td><span class='badge bg-secondary'>".$s['plan_name']."</span></td>
                                                    <td class='text-gold fw-bold'>₹".number_format($s['amount'])."</td>
                                                    <td class='text-muted'>".date('d M', strtotime($s['payment_date']))."</td>
                                                  </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4' class='text-center py-4 text-muted'>No transactions recorded.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Notifications & Alerts Column -->
                <div class="col-lg-4">
                    <div class="content-card shadow-sm h-100">
                        <h4 class="mb-4 text-gold">Critical Notifications</h4>
                        <div class="notif-list">
                            <!-- User Message Notification -->
                            <div class="notif-item d-flex align-items-center mb-3 p-3 rounded bg-black">
                                <i class="fas fa-envelope-open text-primary me-3 fs-4"></i>
                                <div>
                                    <div class="fw-bold"><?php echo $unread_msg; ?> New Inquiries</div>
                                    <a href="admin_messages.php" class="small text-gold text-decoration-none">Review Messages →</a>
                                </div>
                            </div>

                            <!-- Inventory Alert (Example Logic) -->
                            <div class="notif-item d-flex align-items-center mb-3 p-3 rounded bg-black">
                                <i class="fas fa-tools text-warning me-3 fs-4"></i>
                                <div>
                                    <div class="fw-bold">Equipment Service</div>
                                    <p class="small text-muted mb-0">2 machines require maintenance check.</p>
                                </div>
                            </div>

                            <!-- Membership Expiry Alert (Example) -->
                            <div class="notif-item d-flex align-items-center p-3 rounded bg-black">
                                <i class="fas fa-exclamation-triangle text-danger me-3 fs-4"></i>
                                <div>
                                    <div class="fw-bold">Expiring Soon</div>
                                    <p class="small text-muted mb-0">5 members reaching end of term.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>