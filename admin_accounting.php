<?php
session_start();
include 'config.php';
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') { header("Location: login.php"); exit(); }

// Logic: Add Expense
if(isset($_POST['add_expense'])) {
    $cat = $_POST['category'];
    $amt = $_POST['amount'];
    $desc = $_POST['description'];
    mysqli_query($conn, "INSERT INTO expenses (category, amount, description) VALUES ('$cat', '$amt', '$desc')");
}

$income = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(amount) as total FROM payments"))['total'] ?? 0;
$expense = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(amount) as total FROM expenses"))['total'] ?? 0;
$transactions = mysqli_query($conn, "SELECT 'Income' as type, plan_name as ref, amount, payment_date as dt FROM payments UNION SELECT 'Expense' as type, category as ref, amount, expense_date as dt FROM expenses ORDER BY dt DESC LIMIT 10");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Accounting | Royal Fitness Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="admin_shared.css">
    <link rel="stylesheet" href="admin_accounting.css">
</head>
<body>
    <div class="admin-wrapper">
        <?php include 'admin_sidebar.php'; ?>
        <div class="main-content">
            <h1>Financial Ledger</h1>
            
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <div class="account-card income">
                        <span>Total Cash Inflow</span>
                        <h2>₹<?php echo number_format($income, 2); ?></h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="account-card expense">
                        <span>Total Cash Outflow</span>
                        <h2>₹<?php echo number_format($expense, 2); ?></h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="table-container">
                        <h4 class="mb-4 text-gold">Recent Transactions</h4>
                        <table class="table table-dark">
                            <thead><tr><th>Type</th><th>Reference</th><th>Amount</th><th>Date</th></tr></thead>
                            <tbody>
                                <?php while($t = mysqli_fetch_assoc($transactions)): ?>
                                <tr>
                                    <td><span class="badge <?php echo $t['type']=='Income'?'bg-success':'bg-danger'; ?>"><?php echo $t['type']; ?></span></td>
                                    <td><?php echo $t['ref']; ?></td>
                                    <td class="fw-bold">₹<?php echo number_format($t['amount'], 0); ?></td>
                                    <td><?php echo date('d M', strtotime($t['dt'])); ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="expense-form">
                        <h4 class="text-gold">Log Expense</h4>
                        <form method="POST">
                            <select name="category" class="form-control mb-3">
                                <option value="Rent">Rent</option>
                                <option value="Electricity">Electricity</option>
                                <option value="Salary">Trainer Salary</option>
                                <option value="Maintenance">Maintenance</option>
                            </select>
                            <input type="number" name="amount" placeholder="Amount (₹)" class="form-control mb-3" required>
                            <textarea name="description" placeholder="Description" class="form-control mb-3"></textarea>
                            <button name="add_expense" class="btn btn-warning w-100 fw-bold">Record Expense</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>