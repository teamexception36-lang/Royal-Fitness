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
    
    <style>
        :root {
            --primary-gold: #d4af37;
            --dark-bg: #121212;
            --card-bg: #1e1e1e;
            --transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--dark-bg);
            color: #ffffff;
            line-height: 1.6;
        }

        /* Navbar (Consistent with Home/About) */
        .navbar {
            background: rgba(0, 0, 0, 0.9) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(212, 175, 55, 0.3);
        }
        .navbar-brand { font-weight: 700; color: var(--primary-gold) !important; }
        .nav-link { color: white !important; margin: 0 10px; transition: var(--transition); }
        .nav-link:hover { color: var(--primary-gold) !important; }
        .btn-nav { background: var(--primary-gold); color: black !important; font-weight: 600; border-radius: 20px; padding: 5px 20px; }

        /* Services Header */
        .services-header {
            padding: 100px 0 50px;
            text-align: center;
            background: linear-gradient(to bottom, #000, var(--dark-bg));
        }
        .services-header h1 {
            font-size: 3rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .services-header h1 span { color: var(--primary-gold); }
        .services-header p { color: #888; max-width: 600px; margin: 0 auto; }

        /* Service Cards */
        .service-card {
            background: var(--card-bg);
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid #333;
            transition: var(--transition);
            height: 100%;
            position: relative;
        }

        .service-card:hover {
            transform: translateY(-15px);
            border-color: var(--primary-gold);
            box-shadow: 0 20px 40px rgba(0,0,0,0.6);
        }

        .service-img-container {
            position: relative;
            height: 250px;
            overflow: hidden;
        }

        .service-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .service-card:hover .service-img-container img {
            transform: scale(1.1);
        }

        /* Overlay icon or label */
        .service-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: var(--primary-gold);
            color: black;
            padding: 5px 15px;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 700;
            z-index: 2;
        }

        .service-content {
            padding: 30px;
            text-align: center;
        }

        .service-content h3 {
            color: var(--primary-gold);
            font-weight: 700;
            margin-bottom: 15px;
            font-size: 1.5rem;
        }

        .service-content p {
            color: #bbb;
            font-size: 0.95rem;
            margin-bottom: 20px;
        }

        .btn-outline-gold {
            border: 1px solid var(--primary-gold);
            color: var(--primary-gold);
            padding: 8px 25px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .btn-outline-gold:hover {
            background: var(--primary-gold);
            color: black;
        }

        /* Footer */
        footer {
            background: #000;
            padding: 60px 0 30px;
            margin-top: 80px;
            border-top: 1px solid #333;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="home.php">ROYAL FITNESS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link active" href="services.php">Services</a></li>
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