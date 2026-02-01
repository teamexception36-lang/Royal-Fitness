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
    
    <!-- External Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="home.php">
                <img src="images/Royal_fit_logo.png" alt="Logo" width="40" height="40" onerror="this.style.display='none'">
                ROYAL FITNESS</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="membership.php">Membership</a></li>
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