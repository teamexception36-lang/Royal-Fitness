<?php
session_start();
include 'config.php';

// Security: Admin Only
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// ADVANCED SQL: LEFT JOIN to identify leads vs members
$sql = "SELECT m.*, u.active_plan, u.id as user_id 
        FROM messages m 
        LEFT JOIN users u ON m.email = u.email 
        ORDER BY m.created_at DESC";

$result = mysqli_query($conn, $sql);

// Business Insights Logic
$total_inquiries = mysqli_num_rows($result);
$member_inquiries = mysqli_num_rows(mysqli_query($conn, "SELECT m.id FROM messages m JOIN users u ON m.email = u.email"));
$new_leads = $total_inquiries - $member_inquiries;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inquiry Command Center | Royal Fitness</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="admin_shared.css">
    <link rel="stylesheet" href="admin_messages.css">
</head>
<body>

    <div class="admin-wrapper">
        <!-- Persistent Sidebar -->
        <?php include 'admin_sidebar.php'; ?>

        <div class="main-content">
            <div class="header-flex mb-5">
                <div>
                    <h1>Inquiry <span class="text-gold">Intelligence</span></h1>
                    <p class="text-muted">Manage communication and convert leads into members</p>
                </div>
                
                <!-- Insight Pills -->
                <div class="d-flex gap-3">
                    <div class="mini-insight">
                        <span class="label">New Leads</span>
                        <span class="val text-success"><?php echo $new_leads; ?></span>
                    </div>
                    <div class="mini-insight">
                        <span class="label">Member Support</span>
                        <span class="val text-gold"><?php echo $member_inquiries; ?></span>
                    </div>
                </div>
            </div>

            <div class="table-responsive inquiry-card-wrap">
                <table class="table table-dark table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Sender</th>
                            <th>Inquiry Details</th>
                            <th>Status</th>
                            <th>Time</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($total_inquiries > 0): ?>
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td>
                                    <div class="sender-box">
                                        <div class="name"><?php echo $row['name']; ?></div>
                                        <div class="sub"><?php echo $row['email']; ?></div>
                                        <div class="sub"><?php echo $row['phone']; ?></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="msg-text">
                                        <?php echo nl2br(htmlspecialchars($row['message'])); ?>
                                    </div>
                                </td>
                                <td>
                                    <?php if($row['user_id']): ?>
                                        <span class="badge-pro member">
                                            <i class="fas fa-crown"></i> Member (<?php echo $row['active_plan']; ?>)
                                        </span>
                                    <?php else: ?>
                                        <span class="badge-pro lead">
                                            <i class="fas fa-bolt"></i> New Lead
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="small text-muted">
                                    <?php echo date('d M', strtotime($row['created_at'])); ?><br>
                                    <?php echo date('h:i A', strtotime($row['created_at'])); ?>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- Instant Email -->
                                        <a href="mailto:<?php echo $row['email']; ?>" class="action-btn email" title="Reply via Email">
                                            <i class="fas fa-envelope"></i>
                                        </a>
                                        <!-- Instant WhatsApp -->
                                        <a href="https://wa.me/<?php echo $row['phone']; ?>" target="_blank" class="action-btn whatsapp" title="Reply via WhatsApp">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        <!-- Delete Record -->
                                        <a href="delete_msg.php?id=<?php echo $row['id']; ?>" class="action-btn delete" onclick="return confirm('Archive this inquiry?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="text-center py-5 text-muted">No inquiries found in the database.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>