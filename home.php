<?php
// 1. CRITICAL CORRECTION: session_start() must be the very first line of output.
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Royal Fitness</title>
    <link rel="stylesheet" href="home.css">
    
    <link rel="icon" href="C:\xampp\htdocs\gym_web\images\Royal-Fitness-Logo-Design.ico">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid">
        
        <nav>
                <div class="logo">
                    <img src="images/Royal_fit_logo.png" alt="" class="logo-img">
                    <a href="home.php">Royal Fitness</a>
                </div>

                <div class="menu-items">
                  <a href="home.php">Home</a>
                  <a href="about.php">About us</a>
                  <a href="services.php">Services</a>
                  <a href="membership.php">Membership</a>
                  <a href="contact.php">Contact</a>
        
                    <?php if(isset($_SESSION['username'])): ?>
                    <a href="profile2.php" class="btn btn-nav">👋Hello, <?php echo $_SESSION['username']; ?></a>
                    <!-- <a href="logout.php">Logout</a> -->
                    <?php else: ?>
                    <a href="login.php" class="btn btn-nav">Login</a>
                    <!-- <a href="register.php">Register</a> -->
                    <?php endif; ?>
                </div>          
        </nav>

        <section class="hero-section" id="hero-section">
            <div class="hero-text">
                <h1>Push Beyond Limits, Unlock Your Potential</h1>
                <p>
                    “Join <strong>Royal Fitness</strong> today and start your journey to a stronger, healthier you!” 💪
                    your journey to strength and health begins here.
                </p>
                <div class="hero-buttons">
                    <a href="membership.php" class="btn-primary">View Plans</a>
                    <a href="register.php" class="btn-secondary">Join Us</a>
                </div>
            </div>
            <div class="hero-image">
                <img src="https://images.pexels.com/photos/1954524/pexels-photo-1954524.jpeg" alt="Royal Fitness Gym">
            </div>
        </section>
        
        <section class="offer-section">
            <h1 class="section-title">What We Offer</h1>
        </section>
        
        <section class="grid-section">
            <div class="grid-item image">
                <img src="https://images.pexels.com/photos/841130/pexels-photo-841130.jpeg" alt="Cardio Equipment">
            </div>
            <div class="grid-item content">
                <h2>Cardio</h2>
                <p>Our gym features advanced cardio equipment to boost your stamina, burn calories, and keep your heart healthy.<br>Improves endurance & heart health.</p>
            </div>

            <div class="grid-item content">
                <h2>Personal Training</h2>
                <p>Get guidance from certified trainers who design personalized plans to match your fitness goals.</p>
            </div>
            <div class="grid-item image">
                <img src="https://goat-fitness.com/wp-content/uploads/2022/01/shutterstock_1822207589.jpg" alt="Personal Training Session">
            </div>

            <div class="grid-item image">
                <img src="https://tse2.mm.bing.net/th/id/OIP.9qcVqc_apexd-1uekO0FjwHaEz?cb=thfvnext&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Weight Lifting">
            </div>
            <div class="grid-item content">
                <h2>Build Strength</h2>
                <p>Our gym is equipped with world-class strength training machines to help you push your limits safely and effectively.</p>
            </div>

            <div class="grid-item content">
                <h2>CrossFit</h2>
                <p>Our gym offers high-intensity CrossFit workouts designed to build endurance, strength, and agility while keeping your training dynamic and challenging.</p>
            </div>
            <div class="grid-item image">
                <img src="https://i.pinimg.com/originals/cd/39/2c/cd392ca4aeb158972376c7b26f5860ec.jpg" alt="CrossFit Workout">
            </div>
        </section>

        <section class="bmi-section">
            <a href="bmi.php" class="btn btn-bmi">Try! BMI calculator</a>
        </section>
   
        
        <footer>
            <div class="footer-container">
                <div class="footer-about">
                    <h5>Royal Fitness</h5>
                    <p>Your trusted partner in strength, health, and transformation.</p>
                </div>

                <div class="footer-links">
                    <h6>Quick Links</h6>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="services.php">Services</a></li>
                        <li><a href="membership.html">Membership</a></li> <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-contact">
                    <h6>Contact</h6>
                    <p>📍 Royal Fitness, Sunrise Tower, Kankavli</p>
                    <p>📞 +91 8208508875</p>
                    <p>📧 contact@royalfitness.com</p>
                </div>
            </div>

            <div class="footer-bottom">
                <p>© 2025 Royal Fitness. All Rights Reserved.</p>
            </div>
        </footer>

    </div>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>