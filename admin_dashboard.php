<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="dashboard-wrapper">
        <header class="dashboard-header">
            <div class="header-content">
                <h1 class="header-title">Admin Panel <span class="emoji">🛠️</span></h1>
                <a href="logout.php" class="header-link logout-btn"><strong>Logout</strong></a>
            </div>
        </header>

        <main class="dashboard-main">
            <section class="welcome-card">
                <h2>Welcome back, **<?php echo htmlspecialchars($_SESSION['username']); ?>**!</h2>
                <p>You have full administrative privileges to manage the system.</p>
            </section>
            
            <section class="action-grid">
                <a href="manage_users.php" class="action-card primary-action">
                    <span class="icon">👥</span>
                    <h3>Manage Users</h3>
                    <p>View, edit, or delete user accounts and update roles.</p>
                </a>
                <a href="admin_messages.php" class="action-card primary-action">
                    <span class="icon">💬</span>
                    <h3>View Messages</h3>
                    <p>See all contact form messages from users.</p>
                </a>

                <!-- <div class="action-card secondary-action coming-soon">
                    <span class="icon">⚙️</span>
                    <h3>System Settings</h3>
                    <p>Configure application parameters (Coming Soon).</p>
                </div> -->
            </section>
        </main>
    </div>
</body>
</html>