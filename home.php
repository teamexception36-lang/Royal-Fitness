<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Royal Fitness | Push Your Limits</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3.0 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-gold: #d4af37;
            --dark-bg: #121212;
            --light-gray: #f4f4f4;
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--dark-bg);
            color: white;
            overflow-x: hidden;
        }

        /* Navbar Customization */
        .navbar {
            background: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 215, 0, 0.2);
            padding: 15px 0;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary-gold) !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-link {
            color: black !important;
            font-weight: 500;
            margin: 0 10px;
            transition: var(--transition);
        }

        .nav-link:hover {
            color: var(--primary-gold) !important;
        }

        .btn-nav {
            background: var(--primary-gold);
            color: black !important;
            font-weight: 600;
            border-radius: 25px;
            padding: 8px 20px;
        }

        /* Hero Section */
        .hero-section {
            height: 90vh;
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), 
                        url('https://images.pexels.com/photos/1954524/pexels-photo-1954524.jpeg');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .hero-text h1 {
            font-size: 4rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 20px;
        }

        .hero-text span {
            color: var(--primary-gold);
        }

        .btn-primary-custom {
            background: var(--primary-gold);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            color: black;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px;
            display: inline-block;
            transition: var(--transition);
        }

        .btn-secondary-custom {
            border: 2px solid white;
            padding: 12px 30px;
            font-weight: 600;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px;
            display: inline-block;
            transition: var(--transition);
        }

        .btn-primary-custom:hover, .btn-secondary-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
            color: black;
            background: white;
        }

        /* Offer Section Cards */
        .section-title {
            text-align: center;
            padding: 60px 0 40px;
            font-weight: 700;
            font-size: 2.5rem;
        }

        .offer-card {
            background: #1e1e1e;
            border: 1px solid #333;
            border-radius: 15px;
            overflow: hidden;
            transition: var(--transition);
            margin-bottom: 30px;
            height: 100%;
        }

        .offer-card:hover {
            border-color: var(--primary-gold);
            transform: translateY(-10px);
        }

        .offer-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .offer-content {
            padding: 25px;
        }

        .offer-content h2 {
            color: var(--primary-gold);
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        /* BMI Banner */
        .bmi-banner {
            background: var(--primary-gold);
            padding: 40px;
            text-align: center;
            border-radius: 20px;
            margin: 60px 0;
        }

        .bmi-banner h3 {
            color: black;
            font-weight: 700;
        }

        .btn-bmi {
            background: black;
            color: white;
            padding: 10px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 15px;
            display: inline-block;
        }

        /* Footer */
        footer {
            background: #000;
            padding: 60px 0 20px;
            border-top: 2px solid var(--primary-gold);
        }

        .footer-links ul {
            list-style: none;
            padding: 0;
        }

        .footer-links a {
            color: #bbb;
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: var(--primary-gold);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="home.php">
                <img src="images/Royal_fit_logo.png" alt="Logo" width="40" height="40" onerror="this.style.display='none'">
                ROYAL FITNESS
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="membership.php">Membership</a></li>
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

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-text">
                <h1>Push Beyond <span>Limits</span></h1>
                <p class="lead mb-4">Join <strong>Royal Fitness</strong> today and unlock your true potential.<br>Professional coaching, world-class equipment.</p>
                <div class="hero-buttons">
                    <a href="membership.php" class="btn-primary-custom">View Plans</a>
                    <a href="register.php" class="btn-secondary-custom">Start Journey</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Offers Section -->
    <div class="container py-5">
        <h1 class="section-title">What We Offer</h1>
        <div class="row">
            <!-- Cardio -->
            <div class="col-md-6 col-lg-3">
                <div class="offer-card">
                    <img src="https://images.pexels.com/photos/841130/pexels-photo-841130.jpeg" alt="Cardio">
                    <div class="offer-content">
                        <h2>Cardio</h2>
                        <p>Boost your stamina and heart health with our advanced treadmills and cycles.</p>
                    </div>
                </div>
            </div>
            <!-- Training -->
            <div class="col-md-6 col-lg-3">
                <div class="offer-card">
                    <img src="https://goat-fitness.com/wp-content/uploads/2022/01/shutterstock_1822207589.jpg" alt="Training">
                    <div class="offer-content">
                        <h2>Personal Training</h2>
                        <p>Certified trainers to guide you with personalized workout and diet plans.</p>
                    </div>
                </div>
            </div>
            <!-- Strength -->
            <div class="col-md-6 col-lg-3">
                <div class="offer-card">
                    <img src="https://tse2.mm.bing.net/th/id/OIP.9qcVqc_apexd-1uekO0FjwHaEz?rs=1&pid=ImgDetMain" alt="Weight">
                    <div class="offer-content">
                        <h2>Build Strength</h2>
                        <p>World-class heavy machinery and free weights for maximum muscle growth.</p>
                    </div>
                </div>
            </div>
            <!-- CrossFit -->
            <div class="col-md-6 col-lg-3">
                <div class="offer-card">
                    <img src="https://i.pinimg.com/originals/cd/39/2c/cd392ca4aeb158972376c7b26f5860ec.jpg" alt="CrossFit">
                    <div class="offer-content">
                        <h2>CrossFit</h2>
                        <p>High-intensity workouts designed to build power, agility, and endurance.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- BMI CTA -->
        <div class="bmi-banner">
            <h3>Know Your Body Better</h3>
            <p>Calculate your Body Mass Index (BMI) right now and track your progress!</p>
            <a href="bmi.php" class="btn-bmi">Try BMI Calculator →</a>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="text-gold" style="color:var(--primary-gold)">Royal Fitness</h5>
                    <p>Your trusted partner in strength, health, and total body transformation since 2025.</p>
                </div>
                <div class="col-md-4 mb-4 footer-links text-center">
                    <h6>Quick Links</h6>
                    <ul>
                        <li><a href="home.php">Home</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="services.php">Services</a></li>
                        <li><a href="membership.php">Membership</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4 text-md-end">
                    <h6>Contact Us</h6>
                    <p>📍 Sunrise Tower, Kankavli<br>
                    📞 +91 8208508875<br>
                    📧 contact@royalfitness.com</p>
                </div>
            </div>
            <hr style="background: #333">
            <div class="text-center pb-3">
                <p class="small text-muted mb-0">© 2025 Royal Fitness. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>