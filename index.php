<?php
session_start();

// Pro-level logic: Determine where the "Start Journey" button goes
$isLoggedIn = isset($_SESSION['username']);
$journeyLink = $isLoggedIn ? 'services.php' : 'register.php';
$journeyText = $isLoggedIn ? 'Explore Services' : 'Start Journey';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Royal Fitness | Push Your Limits</title>
    
    <!-- Google Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap 5.3.0 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- External Custom CSS -->
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <!-- Navbar (Glassmorphism White Transparent) -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top pro-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/Royal_fit_logo.png" alt="Logo" width="40" height="40" onerror="this.style.display='none'">
                ROYAL <span>FITNESS</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="membership.php">Membership</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    <li class="nav-item ms-lg-3">
                        <?php if($isLoggedIn): ?>
                            <a href="dashboard.php" class="btn btn-nav shadow-gold">👋 <?php echo htmlspecialchars($_SESSION['username']); ?></a>
                        <?php else: ?>
                            <a href="login.php" class="btn btn-nav shadow-gold">Login</a>
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
                <h6 class="text-gold ls-2 mb-3">ESTABLISHED 2020</h6>
                <h1>Push Beyond <span>Limits</span></h1>
                <p class="lead mb-4">
                    <?php echo $isLoggedIn ? "Welcome back to the elite, <strong>".$_SESSION['username']."</strong>." : "Join <strong>Royal Fitness</strong> today and unlock your true potential."; ?>
                    <br>Professional coaching, world-class equipment.
                </p>
                <div class="hero-buttons">
                    <a href="membership.php" class="btn-primary-custom">View Plans</a>
                    <a href="<?php echo $journeyLink; ?>" class="btn-secondary-custom"><?php echo $journeyText; ?></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Offers Section -->
    <section class="py-5 bg-darker">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h6 class="text-gold ls-2">EXCELLENCE</h6>
                <h2 class="section-title mt-0">What We <span>Offer</span></h2>
            </div>
            <div class="row g-4">
                <!-- Cardio -->
                <div class="col-md-6 col-lg-3">
                    <div class="offer-card">
                        <img src="https://images.pexels.com/photos/841130/pexels-photo-841130.jpeg" alt="Cardio">
                        <div class="offer-content">
                            <h2>Cardio</h2>
                            <p>Boost your stamina and heart health with our advanced treadmills.</p>
                        </div>
                    </div>
                </div>
                <!-- Training -->
                <div class="col-md-6 col-lg-3">
                    <div class="offer-card">
                        <img src="https://goat-fitness.com/wp-content/uploads/2022/01/shutterstock_1822207589.jpg" alt="Training">
                        <div class="offer-content">
                            <h2>Personal Training</h2>
                            <p>Certified trainers to guide you with personalized workout plans.</p>
                        </div>
                    </div>
                </div>
                <!-- Strength -->
                <div class="col-md-6 col-lg-3">
                    <div class="offer-card">
                        <img src="https://tse2.mm.bing.net/th/id/OIP.9qcVqc_apexd-1uekO0FjwHaEz?rs=1&pid=ImgDetMain" alt="Weight">
                        <div class="offer-content">
                            <h2>Build Strength</h2>
                            <p>World-class heavy machinery for maximum muscle growth.</p>
                        </div>
                    </div>
                </div>
                <!-- CrossFit -->
                <div class="col-md-6 col-lg-3">
                    <div class="offer-card">
                        <img src="https://i.pinimg.com/originals/cd/39/2c/cd392ca4aeb158972376c7b26f5860ec.jpg" alt="CrossFit">
                        <div class="offer-content">
                            <h2>CrossFit</h2>
                            <p>High-intensity workouts designed to build power and agility.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Royal Gallery (The Royal Arena) -->
    <section class="py-5 bg-black">
        <div class="container text-center py-4">
            <h6 class="text-gold ls-2">VISUAL TOUR</h6>
            <h2 class="section-title">THE <span>ROYAL</span> ARENA</h2>
            <div class="row g-3 mt-4">
                <div class="col-md-4"><div class="gallery-item"><img src="https://images.pexels.com/photos/1552242/pexels-photo-1552242.jpeg" alt="Gym"></div></div>
                <div class="col-md-4"><div class="gallery-item"><img src="https://images.pexels.com/photos/2261145/pexels-photo-2261145.jpeg" alt="Gym"></div></div>
                <div class="col-md-4"><div class="gallery-item"><img src="https://images.pexels.com/photos/3838389/pexels-photo-3838389.jpeg" alt="Gym"></div></div>
                <div class="col-md-8"><div class="gallery-item"><img src="https://images.pexels.com/photos/1954524/pexels-photo-1954524.jpeg" alt="Gym"></div></div>
                <div class="col-md-4"><div class="gallery-item"><img src="https://images.pexels.com/photos/4162485/pexels-photo-4162485.jpeg" alt="Gym"></div></div>
            </div>
        </div>
    </section>

    <!-- Wall of Fame (Top 4 Google Reviews) -->
    <section class="py-5 bg-darker">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h6 class="text-gold ls-2">TESTIMONIALS</h6>
                <h2 class="section-title">WALL OF <span>FAME</span></h2>
                <p class="text-muted">What our elite members say on Google</p>
            </div>
            <div class="row g-4">
                <!-- Review 1 -->
                <div class="col-md-6 col-lg-3">
                    <div class="review-card">
                        <div class="stars">★★★★★</div>
                        <p class="review-text">"The best gym atmosphere in Kankavli. The golden theme is very motivating."</p>
                        <div class="reviewer">
                            <img src="https://ui-avatars.com/api/?name=Rahul+S&background=d4af37&color=000" alt="Rahul">
                            <div><h6>Rahul Sawant</h6><span>Member</span></div>
                        </div>
                    </div>
                </div>
                <!-- Review 2 -->
                <div class="col-md-6 col-lg-3">
                    <div class="review-card">
                        <div class="stars">★★★★★</div>
                        <p class="review-text">"Premium equipment and very clean. Highly recommend the personal trainers."</p>
                        <div class="reviewer">
                            <img src="https://ui-avatars.com/api/?name=Anita+K&background=d4af37&color=000" alt="Anita">
                            <div><h6>Anita K.</h6><span>Athlete</span></div>
                        </div>
                    </div>
                </div>
                <!-- Review 3 -->
                <div class="col-md-6 col-lg-3">
                    <div class="review-card">
                        <div class="stars">★★★★★</div>
                        <p class="review-text">"Changed my lifestyle completely. The community here is just amazing."</p>
                        <div class="reviewer">
                            <img src="https://ui-avatars.com/api/?name=Sagar+P&background=d4af37&color=000" alt="Sagar">
                            <div><h6>Sagar Patil</h6><span>Member</span></div>
                        </div>
                    </div>
                </div>
                <!-- Review 4 -->
                <div class="col-md-6 col-lg-3">
                    <div class="review-card">
                        <div class="stars">★★★★★</div>
                        <p class="review-text">"The CrossFit zone is world-class. Worth every penny of the membership."</p>
                        <div class="reviewer">
                            <img src="https://ui-avatars.com/api/?name=John+D&background=d4af37&color=000" alt="John">
                            <div><h6>John Doe</h6><span>Member</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BMI CTA -->
    <div class="container py-5">
        <div class="bmi-banner">
            <h3 class="fw-bold">KNOW YOUR BODY BETTER</h3>
            <p>Calculate your Body Mass Index (BMI) right now and track your progress!</p>
            <a href="bmi.php" class="btn-bmi">Try BMI Calculator →</a>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="text-gold fw-bold">Royal Fitness</h5>
                    <p class="text-muted">Your trusted partner in strength, health, and total body transformation since 2020.</p>
                </div>
                <div class="col-md-4 mb-4 footer-links text-center">
                    <h6>Quick Links</h6>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="services.php">Services</a></li>
                        <li><a href="membership.php">Membership</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4 text-md-end">
                    <h6>Contact Us</h6>
                    <p class="text-muted">📍 Sunrise Tower, Kankavli<br>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>