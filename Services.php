<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services | Royal Fitness</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3.0 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- External Custom CSS -->
    <link rel="stylesheet" href="services.css">
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

    <!-- Header Section -->
    <header class="services-header">
        <div class="container">
            <h1>Our <span>Services</span></h1>
            <p>We provide world-class facilities and professional coaching to ensure you reach your peak performance.</p>
        </div>
    </header>

    <!-- Services Grid -->
    <section class="container mb-5">
        <div class="row g-4">
            
            <!-- Service 1: Cardio -->
            <div class="col-md-6 col-lg-3">
                <div class="service-card">
                    <span class="service-badge">Stamina</span>
                    <div class="service-img-container">
                        <img src="https://images.pexels.com/photos/1954524/pexels-photo-1954524.jpeg" alt="Cardio Training">
                    </div>
                    <div class="service-content">
                        <h3>Cardio Training</h3>
                        <p>High-end treadmills, rowers, and bikes to incinerate fat and boost heart health.</p>
                        <a href="membership.php" class="btn-outline-gold">View Plans</a>
                    </div>
                </div>
            </div>

            <!-- Service 2: Strength -->
            <div class="col-md-6 col-lg-3">
                <div class="service-card">
                    <span class="service-badge">Power</span>
                    <div class="service-img-container">
                        <img src="https://images.pexels.com/photos/1552242/pexels-photo-1552242.jpeg" alt="Strength Training">
                    </div>
                    <div class="service-content">
                        <h3>Strength Training</h3>
                        <p>Olympic barbells, heavy dumbbells, and specialized machines for muscle growth.</p>
                        <a href="membership.php" class="btn-outline-gold">View Plans</a>
                    </div>
                </div>
            </div>

            <!-- Service 3: CrossFit -->
            <div class="col-md-6 col-lg-3">
                <div class="service-card">
                    <span class="service-badge">Intensity</span>
                    <div class="service-img-container">
                        <img src="https://images.pexels.com/photos/841130/pexels-photo-841130.jpeg" alt="CrossFit">
                    </div>
                    <div class="service-content">
                        <h3>CrossFit</h3>
                        <p>Functional movements performed at high intensity to build a versatile body.</p>
                        <a href="membership.php" class="btn-outline-gold">View Plans</a>
                    </div>
                </div>
            </div>

            <!-- Service 4: Nutrition -->
            <div class="col-md-6 col-lg-3">
                <div class="service-card">
                    <span class="service-badge">Health</span>
                    <div class="service-img-container">
                        <img src="https://tse1.mm.bing.net/th/id/OIP.-_gVacCqnnZqHyZoGUif0gHaE8?rs=1&pid=ImgDetMain" alt="Nutrition Guidance">
                    </div>
                    <div class="service-content">
                        <h3>Nutrition Plans</h3>
                        <p>Customized diet charts and supplement guidance from our in-house experts.</p>
                        <a href="membership.php" class="btn-outline-gold">View Plans</a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <h5 style="color:var(--primary-gold)">Royal Fitness</h5>
            <p class="text-muted small">Elevating Fitness Standards Since 2020</p>
            <div class="py-3">
                <a href="contact.php" class="text-white text-decoration-none mx-2">Contact</a> | 
                <a href="about.php" class="text-white text-decoration-none mx-2">About</a>
            </div>
            <p class="text-muted mt-3" style="font-size: 0.8rem;">© 2025 Royal Fitness. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>