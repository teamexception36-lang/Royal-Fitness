<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Royal Fitness</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3.0 -->
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
            line-height: 1.6;
        }

        /* Navbar (Matches Home) */
        .navbar {
            background: rgba(255, 255, 255, 0.9) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(212, 175, 55, 0.3);
        }
        .navbar-brand { font-weight: 700; color: var(--primary-gold) !important; }
        .nav-link { color: black !important; margin: 0 10px; }
        .btn-nav { background: var(--primary-gold); color: black !important; font-weight: 600; border-radius: 20px; padding: 5px 20px; }

        /* About Hero Section */
        .about-hero {
            padding: 100px 0 60px;
            background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), 
                        url('https://images.pexels.com/photos/1552242/pexels-photo-1552242.jpeg');
            background-size: cover;
            background-position: center;
            text-align: center;
        }
        .about-hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            text-transform: uppercase;
        }
        .about-hero h1 span { color: var(--primary-gold); }

        /* Main Content */
        .content-section { padding: 80px 0; }
        
        .about-text-box {
            padding-right: 30px;
        }
        .about-text-box h2 {
            color: var(--primary-gold);
            font-weight: 700;
            margin-bottom: 20px;
        }
        .about-image img {
            width: 100%;
            border-radius: 20px;
            border: 2px solid var(--primary-gold);
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.2);
        }

        /* Stats/Highlights Cards */
        .highlight-card {
            background: var(--card-bg);
            border: 1px solid #333;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            transition: var(--transition);
            height: 100%;
        }
        .highlight-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary-gold);
        }
        .highlight-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            display: block;
        }
        .highlight-card h3 {
            color: var(--primary-gold);
            font-size: 1.2rem;
            font-weight: 600;
        }

        /* CTA Section */
        .cta-section {
            background: var(--primary-gold);
            color: black;
            padding: 50px 0;
            text-align: center;
            border-radius: 0;
            margin-top: 50px;
        }
        .btn-dark-custom {
            background: black;
            color: white;
            padding: 12px 35px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            margin-top: 20px;
        }

        footer {
            background: #000;
            padding: 40px 0;
            text-align: center;
            border-top: 1px solid #333;
            color: #888;
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
                    <li class="nav-item"><a class="nav-link active" href="about.php">About</a></li>
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
    <header class="about-hero">
        <div class="container">
            <h1>Our <span>Story</span></h1>
            <p class="lead">Building a legacy of strength and discipline since 2020.</p>
        </div>
    </header>

    <!-- About Content -->
    <section class="content-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 about-text-box">
                    <h2>Welcome to Royal Fitness</h2>
                    <p>At <strong>Royal Fitness</strong>, we believe that fitness is a lifestyle, not a chore. We don't just provide equipment; we provide a community and a path to self-improvement.</p>
                    <p>Whether you are a beginner taking your first step or an athlete pushing for a new personal best, our world-class facility and expert coaches are here to ensure you succeed.</p>
                    <p class="fst-italic text-muted">"Our mission is to make high-end fitness coaching accessible, enjoyable, and result-driven for everyone in Kankavli."</p>
                </div>
                <div class="col-lg-6 about-image mt-4 mt-lg-0">
                    <img src="https://images.pexels.com/photos/1552242/pexels-photo-1552242.jpeg" alt="Royal Fitness Gym">
                </div>
            </div>

            <!-- Highlight Cards -->
            <div class="row mt-5 g-4">
                <div class="col-md-4">
                    <div class="highlight-card">
                        <span class="highlight-icon">🏋️‍♂️</span>
                        <h3>Modern Equipment</h3>
                        <p>Access to top-tier brands and the latest strength and cardio technology.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="highlight-card">
                        <span class="highlight-icon">🏆</span>
                        <h3>Expert Trainers</h3>
                        <p>Our certified coaches bring years of experience to help you train safely and effectively.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="highlight-card">
                        <span class="highlight-icon">🥗</span>
                        <h3>Custom Nutrition</h3>
                        <p>We provide personalized diet charts tailored to your body type and fitness goals.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta-section">
        <div class="container">
            <h2 class="fw-bold">Ready to start your transformation?</h2>
            <p>Join the Royal Fitness family today and get your first consultation for free.</p>
            <a href="register.php" class="btn-dark-custom">Join Now</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>© 2025 Royal Fitness | Designed for Excellence</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>