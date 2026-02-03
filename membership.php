<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Plans | Royal Fitness</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="membership.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/Royal_fit_logo.png" alt="Logo" width="40" height="40" onerror="this.style.display='none'">
                ROYAL FITNESS
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                    <li class="nav-item"><a class="nav-link active" href="membership.php">Membership</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    <li class="nav-item ms-lg-3">
                        <?php if(isset($_SESSION['username'])): ?>
                            <a href="dashboard.php" class="btn btn-nav">👋 <?php echo htmlspecialchars($_SESSION['username']); ?></a>
                        <?php else: ?>
                            <a href="login.php" class="btn btn-nav">Login</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <header class="membership-hero">
        <h1 class="display-3 fw-bold">JOIN THE <span style="color:var(--primary-gold)">ELITE</span></h1>
    </header>

    <div class="container">
        <h1 class="section-title">Standard Memberships</h1>
        <p class="section-subtitle">Flexible plans for every commitment level</p>

        <div class="row g-4 justify-content-center">
            <!-- 1 Month -->
            <div class="col-md-6 col-lg-3">
                <div class="plan-card">
                    <h2>1 Month</h2>
                    <p class="price">₹1100 <span>/mo</span></p>
                    <ul class="plan-features">
                        <li>All Gym Equipment</li>
                        <li>Locker Facility</li>
                        <li>General Coaching</li>
                    </ul>
                    <a href="payment.php?plan=Monthly&price=1100" class="btn-royal">Select Plan</a>

                </div>
            </div>

            <!-- 3 Month -->
            <div class="col-md-6 col-lg-3">
                <div class="plan-card">
                    <h2>3 Months</h2>
                    <p class="price">₹2500 <span>/total</span></p>
                    <ul class="plan-features">
                        <li>Save ₹800</li>
                        <li>Diet Consultation</li>
                        <li>Full Access</li>
                    </ul>
                    <a href="payment.php?plan=Monthly&price=2500" class="btn-royal">Select Plan</a>
                </div>
            </div>

            <!-- 6 Month -->
            <div class="col-md-6 col-lg-3">
                <div class="plan-card">
                    <h2>6 Months</h2>
                    <p class="price">₹4500 <span>/total</span></p>
                    <ul class="plan-features">
                        <li>Save ₹2100</li>
                        <li>Free Workout Plan</li>
                        <li>Full Access</li>
                    </ul>
                    <a href="payment.php?plan=Monthly&price=2100" class="btn-royal">Select Plan</a>
                </div>
            </div>

            <!-- 12 Month -->
            <div class="col-md-6 col-lg-3">
                <div class="plan-card popular">
                    <span class="popular-badge">BEST VALUE</span>
                    <h2>12 Months</h2>
                    <p class="price">₹8500 <span>/total</span></p>
                    <ul class="plan-features">
                        <li>Save ₹4700</li>
                        <li>2 Free PT Sessions</li>
                        <li>Premium Support</li>
                    </ul>
                    <a href="payment.php?plan=Elite-Yearly&price=8500" class="btn-royal">Select Plan</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Specialty Plans -->
    <section class="specialty-section">
        <div class="container">
            <h2 class="section-title mt-0" style="color:white">Specialty Plans</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-md-5">
                    <div class="plan-card">
                        <h2>Student Plan</h2>
                        <p class="price">₹2200 <span>/3 Months</span></p>
                        <p class="text-muted small mb-4">Valid ID Card Required</p>
                        <a href="register.php" class="btn-royal">Claim Offer</a>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="plan-card">
                        <h2>Personal Training</h2>
                        <p class="price">₹3000 <span>/Month</span></p>
                        <p class="note text-muted mb-4">18 Dedicated Sessions</p>
                        <a href="register.php" class="btn-royal">Book Trainer</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Free Trial -->
    <section class="free-trial-banner">
        <div class="container">
            <h2 class="mb-4">Not sure yet?</h2>
            <a href="register.php" class="btn-royal btn-free-trial">TRY US FOR FREE!</a>
            <p class="mt-3 text-muted">Get a 1-day guest pass and experience Royal Fitness.</p>
        </div>
    </section>

    <!-- Services & Address -->
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-6">
                <h3 class="mb-4" style="color:var(--primary-gold)">Included Services</h3>
                <div class="service-badge-container">
                    <div class="s-badge">Modern Equipment</div>
                    <div class="s-badge">Cardio Zone</div>
                    <div class="s-badge">Strength Training</div>
                    <div class="s-badge">Air-Conditioned</div>
                    <div class="s-badge">Diet & Nutrition</div>
                    <div class="s-badge">Certified Trainers</div>
                    <div class="s-badge">Lockers</div>
                    <div class="s-badge">Steam Room</div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="address-box">
                    <h3>📍 Visit Us</h3>
                    <p class="lead">3rd Floor, Sunrise Tower, Nardave Phatta,<br> 
                    Mumbai-Goa Highway, Kankavli 416602</p>
                    <p>Open: Mon-Sat (6:00 AM - 10:00 PM)</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>