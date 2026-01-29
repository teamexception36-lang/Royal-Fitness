<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Plans | Royal Fitness</title>
    
    <!-- Google Fonts & Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-gold: #d4af37;
            --dark-bg: #121212;
            --card-bg: #1e1e1e;
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--dark-bg);
            color: #ffffff;
        }

        /* Navbar (Consistency) */
        .navbar {
            background: rgba(255, 255, 255, 0.9) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(212, 175, 55, 0.3);
        }
        .navbar-brand { font-weight: 700; color: var(--primary-gold) !important; }
        .nav-link { color: black !important; margin: 0 10px; }
        .btn-nav { background: var(--primary-gold); color: black !important; font-weight: 600; border-radius: 20px; padding: 5px 20px; }

        /* Membership Hero */
        .membership-hero {
            height: 40vh;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                        url('https://images.pexels.com/photos/1954524/pexels-photo-1954524.jpeg');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        /* Section Titles */
        .section-title {
            text-align: center;
            margin: 60px 0 10px;
            font-weight: 700;
            text-transform: uppercase;
        }
        .section-subtitle {
            text-align: center;
            color: #888;
            margin-bottom: 50px;
        }

        /* Plan Cards */
        .plan-card {
            background: var(--card-bg);
            border: 1px solid #333;
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            transition: var(--transition);
            height: 100%;
            position: relative;
        }
        .plan-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary-gold);
            box-shadow: 0 15px 30px rgba(212, 175, 55, 0.1);
        }
        .plan-card.popular {
            border: 2px solid var(--primary-gold);
            transform: scale(1.05);
        }
        .popular-badge {
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--primary-gold);
            color: black;
            padding: 5px 20px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
        }

        .plan-card h2 { color: var(--primary-gold); font-weight: 700; margin-bottom: 20px; }
        .price { font-size: 2.5rem; font-weight: 800; margin-bottom: 20px; }
        .price span { font-size: 1rem; color: #888; }

        .plan-features {
            list-style: none;
            padding: 0;
            margin: 25px 0;
            text-align: left;
            color: #bbb;
        }
        .plan-features li { margin-bottom: 10px; }
        .plan-features li::before { content: "✓ "; color: var(--primary-gold); font-weight: bold; }

        .btn-plan {
            display: block;
            background: transparent;
            border: 2px solid var(--primary-gold);
            color: var(--primary-gold);
            padding: 12px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 700;
            transition: var(--transition);
        }
        .btn-plan:hover { background: var(--primary-gold); color: black; }
        .popular .btn-plan { background: var(--primary-gold); color: black; }

        /* Specialty Plans */
        .specialty-section { background: #000; padding: 60px 0; margin-top: 60px; }

        /* Services Badges */
        .service-badge-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
        }
        .s-badge {
            background: #252525;
            padding: 10px 25px;
            border-radius: 50px;
            border: 1px solid #333;
            font-size: 0.9rem;
            transition: var(--transition);
        }
        .s-badge:hover { border-color: var(--primary-gold); color: var(--primary-gold); }

        /* Free Trial Button */
        .free-trial-banner {
            text-align: center;
            padding: 80px 0;
        }
        .btn-free {
            background: var(--primary-gold);
            color: black;
            padding: 15px 50px;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: 800;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 0 20px rgba(212, 175, 55, 0.4);
            transition: var(--transition);
        }
        .btn-free:hover { transform: scale(1.1); color: black; box-shadow: 0 0 30px rgba(212, 175, 55, 0.6); }

        .address-box {
            background: #1e1e1e;
            padding: 40px;
            border-radius: 20px;
            border-left: 5px solid var(--primary-gold);
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="home.php">ROYAL FITNESS</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                    <li class="nav-item"><a class="nav-link active" href="membership.php">Membership</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    <li class="nav-item ms-lg-3">
                        <?php if(isset($_SESSION['username'])): ?>
                            <a href="profile2.php" class="btn btn-nav">👋 <?php echo $_SESSION['username']; ?></a>
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
                    <a href="register.php" class="btn-plan">Select Plan</a>
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
                    <a href="register.php" class="btn-plan">Select Plan</a>
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
                    <a href="register.php" class="btn-plan">Select Plan</a>
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
                    <a href="register.php" class="btn-plan">Select Plan</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Specialty Plans -->
    <section class="specialty-section">
        <div class="container">
            <h2 class="section-title mt-0">Specialty Plans</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-md-5">
                    <div class="plan-card">
                        <h2>Student Plan</h2>
                        <p class="price">₹2200 <span>/3 Months</span></p>
                        <p class="text-muted small">Valid ID Card Required</p>
                        <a href="register.php" class="btn-plan">Claim Offer</a>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="plan-card">
                        <h2>Personal Training</h2>
                        <p class="price">₹3000 <span>/Month</span></p>
                        <p class="note">18 Dedicated Sessions</p>
                        <a href="register.php" class="btn-plan">Book Trainer</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Free Trial -->
    <section class="free-trial-banner">
        <div class="container">
            <h2 class="mb-4">Not sure yet?</h2>
            <a href="register.php" class="btn-free">TRY US FOR FREE!</a>
            <p class="mt-3 text-muted">Get a 1-day guest pass and experience Royal Fitness.</p>
        </div>
    </section>

    <!-- Services & Address -->
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-6">
                <h3 class="mb-4 text-gold" style="color:var(--primary-gold)">Included Services</h3>
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