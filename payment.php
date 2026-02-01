<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$plan = $_GET['plan'] ?? 'Basic';
$price = $_GET['price'] ?? '0';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Secure Payment | Royal Fitness</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style1.css">
    <style>
        body { background: #000; color: #fff; }
        .payment-card {
            background: #1e1e1e;
            border: 1px solid #d4af37;
            border-radius: 20px;
            padding: 40px;
            max-width: 500px;
            margin: 50px auto;
            text-align: center;
        }
        .qr-placeholder {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
            margin: 20px 0;
        }
        .qr-placeholder img { width: 200px; height: 200px; }
        .price-tag { font-size: 2rem; color: #d4af37; font-weight: 800; }
    </style>
</head>
<body>
    <div class="container">
        <div class="payment-card">
            <h2 class="fw-bold">Complete Payment</h2>
            <p class="text-muted">Plan: <span class="text-white"><?php echo $plan; ?></span></p>
            <div class="price-tag">₹<?php echo $price; ?></div>

            <div class="qr-placeholder">
                <!-- Replace with any QR image URL or your own -->
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=RoyalFitnessPayment" alt="Payment QR">
            </div>

            <p class="small text-muted">Scan QR with any UPI App (GPay, PhonePe, Paytm)</p>

            <form action="process_payment.php" method="POST" class="mt-4">
                <input type="hidden" name="plan_name" value="<?php echo $plan; ?>">
                
                <div class="mb-3 text-start">
                    <label class="form-label small">Enter Transaction ID / Ref No.</label>
                    <input type="text" name="txn_id" class="form-control bg-dark text-white border-secondary" placeholder="e.g. 1234567890" required>
                </div>

                <button type="submit" class="btn-royal w-100">Verify & Activate Plan</button>
            </form>
            
            <a href="membership.php" class="d-block mt-3 text-muted small text-decoration-none">← Cancel and go back</a>
        </div>
    </div>
</body>
</html>