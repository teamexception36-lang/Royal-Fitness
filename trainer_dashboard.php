<?php
session_start();
include 'config.php';

// Security: Trainer Only
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'trainer') {
    header("Location: login.php");
    exit();
}

$uid = $_SESSION['user_id'];

// Fetch Trainer Data & Performance Stats
$query = "SELECT u.*, tp.* FROM users u 
          LEFT JOIN trainer_performance tp ON u.id = tp.trainer_id 
          WHERE u.id = '$uid'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

// --- TPI CALCULATION LOGIC ---
$att_w = $data['attendance_score'] * 0.25;
$res_w = $data['results_score'] * 0.25;
$ret_w = $data['retention_score'] * 0.20;
$fed_w = $data['feedback_score'] * 0.15;
$rev_w = $data['revenue_score'] * 0.15;

$tpi = round($att_w + $res_w + $ret_w + $fed_w + $rev_w);

// --- BONUS LOGIC ---
$bonus_percent = 0;
if($tpi >= 90) $bonus_percent = 20;
elseif($tpi >= 80) $bonus_percent = 10;

$bonus_amount = ($data['base_salary'] * $bonus_percent) / 100;
$total_payout = $data['base_salary'] + $bonus_amount;

// Color Coding for UI
$status_color = ($tpi >= 80) ? '#2ecc71' : (($tpi >= 70) ? '#f1c40f' : '#e74c3c');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trainer Command Center | Royal Fitness</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="trainer_dashboard.css">
</head>
<body>

<div class="trainer-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="brand">
            <img src="images/Royal_fit_logo.png" alt="Logo">
            <span>ROYAL PRO</span>
        </div>
        <nav class="menu">
            <a href="trainer_dashboard.php" class="active"><i class="fas fa-chart-pie"></i> Performance</a>
            <a href="trainer_clients.php"><i class="fas fa-users"></i> My Clients</a>
            <a href="trainer_plans.php"><i class="fas fa-dumbbell"></i> Workout Plans</a>
            <a href="logout.php" class="logout"><i class="fas fa-power-off"></i> Logout</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="content">
        <header class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Trainer <span class="text-gold">Scorecard</span></h2>
                <p class="text-muted">Metrics-driven performance analysis</p>
            </div>
            <div class="trainer-profile-pill">
                <span>TRN-<?php echo str_pad($data['id'], 4, '0', STR_PAD_LEFT); ?></span>
                <div class="avatar"><?php echo substr($data['username'], 0, 1); ?></div>
            </div>
        </header>

        <div class="row g-4">
            <!-- Overall TPI Gauge -->
            <div class="col-lg-4">
                <div class="glass-card text-center">
                    <h5 class="mb-4">Performance Index (TPI)</h5>
                    <div class="tpi-gauge" style="--tpi-val: <?php echo $tpi; ?>; --tpi-clr: <?php echo $status_color; ?>;">
                        <div class="inner">
                            <span class="score"><?php echo $tpi; ?></span>
                            <span class="label">Total Score</span>
                        </div>
                    </div>
                    <div class="status-msg mt-3" style="color: <?php echo $status_color; ?>">
                        <?php 
                            if($tpi >= 90) echo "Elite Performance";
                            elseif($tpi >= 80) echo "High Achievement";
                            else echo "Review Required";
                        ?>
                    </div>
                </div>
            </div>

            <!-- Score Breakdown -->
            <div class="col-lg-8">
                <div class="glass-card">
                    <h5 class="mb-4">Metric Breakdown</h5>
                    <div class="metric-row">
                        <span>Attendance (25%)</span>
                        <div class="progress-wrap"><div class="bar gold" style="width: <?php echo $data['attendance_score']; ?>%"></div></div>
                        <span class="val"><?php echo $data['attendance_score']; ?></span>
                    </div>
                    <div class="metric-row">
                        <span>Client Results (25%)</span>
                        <div class="progress-wrap"><div class="bar gold" style="width: <?php echo $data['results_score']; ?>%"></div></div>
                        <span class="val"><?php echo $data['results_score']; ?></span>
                    </div>
                    <div class="metric-row">
                        <span>Retention (20%)</span>
                        <div class="progress-wrap"><div class="bar gold" style="width: <?php echo $data['retention_score']; ?>%"></div></div>
                        <span class="val"><?php echo $data['retention_score']; ?></span>
                    </div>
                    <div class="metric-row">
                        <span>Feedback (15%)</span>
                        <div class="progress-wrap"><div class="bar gold" style="width: <?php echo $data['feedback_score']; ?>%"></div></div>
                        <span class="val"><?php echo $data['feedback_score']; ?></span>
                    </div>
                    <div class="metric-row">
                        <span>Revenue (15%)</span>
                        <div class="progress-wrap"><div class="bar gold" style="width: <?php echo $data['revenue_score']; ?>%"></div></div>
                        <span class="val"><?php echo $data['revenue_score']; ?></span>
                    </div>
                </div>
            </div>

            <!-- Earnings & Incentives -->
            <div class="col-md-6">
                <div class="glass-card">
                    <h5 class="text-gold mb-4"><i class="fas fa-hand-holding-usd"></i> Payout Summary</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Base Salary:</span>
                        <span class="fw-bold">₹<?php echo number_format($data['base_salary']); ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Performance Bonus (<?php echo $bonus_percent; ?>%):</span>
                        <span class="text-success fw-bold">+ ₹<?php echo number_format($bonus_amount); ?></span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fs-5">
                        <span class="fw-bold">Total Payout:</span>
                        <span class="text-gold fw-bold">₹<?php echo number_format($total_payout); ?></span>
                    </div>
                </div>
            </div>

            <!-- Improvement Suggestions -->
            <div class="col-md-6">
                <div class="glass-card">
                    <h5 class="mb-3"><i class="fas fa-lightbulb text-gold"></i> Growth Action Plan</h5>
                    <ul class="suggestion-list">
                        <?php if($data['attendance_score'] < 90): ?>
                            <li>Improve punctuality to secure the 20% bonus tier.</li>
                        <?php endif; ?>
                        <?php if($data['results_score'] < 90): ?>
                            <li>Update client BMI trackers to boost 'Results Score'.</li>
                        <?php endif; ?>
                        <li>Push for 2 more plan renewals this week.</li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
</div>

</body>
</html>