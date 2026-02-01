<?php
session_start();
include 'config.php';

// Security Check
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$uid = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = '$uid'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    header("Location: logout.php");
    exit();
}

// Professional Logic: BMI Category
$bmi = $user['bmi_score'];
$bmi_status = "Not Calculated";
$bmi_class = "text-muted";

if($bmi > 0) {
    if($bmi < 18.5) { $bmi_status = "Underweight"; $bmi_class = "text-info"; }
    else if($bmi < 25) { $bmi_status = "Healthy"; $bmi_class = "text-success"; }
    else if($bmi < 30) { $bmi_status = "Overweight"; $bmi_class = "text-warning"; }
    else { $bmi_status = "Obese"; $bmi_class = "text-danger"; }
}

// Professional Logic: Member ID
$member_id = "RF-" . str_pad($user['id'], 4, '0', STR_PAD_LEFT);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Hub | Royal Fitness</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <img src="images/Royal_fit_logo.png" alt="Logo" class="logo-icon">
                <span class="brand-name">ROYAL FIT</span>
            </div>
            
            <nav class="side-nav">
                <a href="dashboard.php" class="nav-item active">
                    <i>🏠</i> <span>Overview</span>
                </a>
                <a href="membership.php" class="nav-item">
                    <i>💎</i> <span>My Membership</span>
                </a>
                <a href="bmi.php" class="nav-item">
                    <i>⚖️</i> <span>BMI Tracker</span>
                </a>
                <a href="services.php" class="nav-item">
                    <i>🏋️</i> <span>Workout Plans</span>
                </a>
                <hr class="nav-divider">
                <a href="home.php" class="nav-item">
                    <i>🌐</i> <span>Visit Site</span>
                </a>
                <a href="logout.php" class="nav-item logout">
                    <i>🚪</i> <span>Logout</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="content-header">
                <div class="header-left">
                    <h1>Dashboard</h1>
                    <p class="text-muted">Welcome back, <?php echo htmlspecialchars($user['username']); ?>!</p>
                </div>
                <div class="header-right">
                    <div class="user-pill">
                        <span class="member-tag">PRO MEMBER</span>
                        <div class="avatar-sm">
    <img src="uploads/profile_pics/<?php echo $user['profile_pic']; ?>" 
         style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
</div>
                    </div>
                </div>
            </header>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <span class="card-icon">🏆</span>
                    <div class="stat-info">
                        <label>Active Plan</label>
                        <h3><?php echo $user['active_plan']; ?></h3>
                    </div>
                </div>
                <div class="stat-card">
                    <span class="card-icon">⚡</span>
                    <div class="stat-info">
                        <label>Current BMI</label>
                        <h3><?php echo ($bmi > 0) ? $bmi : '--'; ?> <small class="<?php echo $bmi_class; ?> fs-6"><?php echo $bmi_status; ?></small></h3>
                    </div>
                </div>
                <div class="stat-card">
                    <span class="card-icon">🔥</span>
                    <div class="stat-info">
                        <label>Consistency</label>
                        <h3>12 Days <small class="text-success fs-6">Streak</small></h3>
                    </div>
                </div>
                <div class="stat-card">
                    <span class="card-icon">🆔</span>
                    <div class="stat-info">
                        <label>Member ID</label>
                        <h3><?php echo $member_id; ?></h3>
                    </div>
                </div>
            </div>

            <!-- Profile & Training Section -->
            <div class="row g-4 mt-2">
                <!-- Profile Section -->
                <div class="col-lg-4">
                    <div class="glass-card profile-card">
                        <h4>Account Details</h4>
                        <div class="profile-meta">
                            <div class="meta-item">
                                <label>Email Address</label>
                                <p><?php echo htmlspecialchars($user['email']); ?></p>
                            </div>
                            <div class="meta-item">
                                <label>Height / Weight</label>
                                <p><?php echo $user['height']; ?> cm / <?php echo $user['weight']; ?> kg</p>
                            </div>
                            <div class="meta-item">
                                <label>Role</label>
                                <p><?php echo ucfirst($user['role']); ?></p>
                            </div>
                        </div>
                        <a href="profile.php" class="btn-edit">Edit Profile Setting</a>
                    </div>
                </div>

                <!-- Training Progress -->
                <div class="col-lg-8">
                    <div class="glass-card training-card">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4>Current Training Program</h4>
                            <span class="badge-gold">Week 3</span>
                        </div>
                        
                        <div class="program-detail">
                            <div class="routine-box">
                                <h5>Today's Focus: <span class="text-gold">Legs & Core</span></h5>
                                <p class="text-muted">4 Exercises • 45 Minutes</p>
                            </div>
                            
                            <div class="progress-section mt-4">
                                <div class="d-flex justify-content-between small mb-2">
                                    <span>Program Completion</span>
                                    <span>72%</span>
                                </div>
                                <div class="progress-bar-bg">
                                    <div class="progress-bar-fill" style="width: 72%;"></div>
                                </div>
                            </div>

                            <div class="action-footer mt-4">
                                <a href="workout_viewer.php" class="btn-royal-sm">View Full Routine</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>