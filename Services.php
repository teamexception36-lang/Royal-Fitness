<?php
// 1. CRITICAL CORRECTION: session_start() must be the very first line of output.
session_start();

// Include the header file after starting the session
// include 'header.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Royal Fitness</title>
    <link rel="stylesheet" href="services.css">
    <link rel="icon" href="Royal-Fitness-Logo-Design.ico">
    <!-- bootstrap -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>

<!-- body -->
<body>
    <div class="container-fluid">
        <!-- navbar   -->
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
                    <a href="profile2.php" class="btn btn-nav">Hello, <?php echo $_SESSION['username']; ?></a>
                    <!-- <a href="logout.php">Logout</a> -->
                    <?php else: ?>
                    <a href="login.php" class="btn btn-nav">Login</a>
                    <!-- <a href="register.php">Register</a> -->
                    <?php endif; ?>
                </div>          
        </nav>
            <!-- Services Section -->
<section class="services">
  <h1 class="section-title">Our Services</h1>
  <p class="section-subtitle">We provide everything you need to achieve your fitness goals.</p>

  <div class="services-grid">
    <!-- Service 1 -->
    <div class="service-card">
      <img src="https://images.pexels.com/photos/1954524/pexels-photo-1954524.jpeg" alt="Cardio Training">
      <h3>Cardio Training</h3>
      <p>Boost stamina and burn calories with our world-class cardio machines.</p>
    </div>

    <!-- Service 2 -->
    <div class="service-card">
      <img src="https://images.pexels.com/photos/1552242/pexels-photo-1552242.jpeg" alt="Strength Training">
      <h3>Strength Training</h3>
      <p>Build muscle and power with professional equipment and free weights.</p>
    </div>

    <!-- Service 3 -->


    <div class="service-card">
      <img src="https://images.pexels.com/photos/841130/pexels-photo-841130.jpeg" alt="CrossFit">
      <h3>CrossFit</h3>
      <p>High-intensity functional workouts for strength, agility, and endurance.</p>
    </div>

    <!-- Service 4 -->
    <div class="service-card">
      <img src="https://tse1.mm.bing.net/th/id/OIP.-_gVacCqnnZqHyZoGUif0gHaE8?cb=thfvnext&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Nutrition Guidance">
      <h3>Nutrition Guidance</h3>
      <p>Personalized diet plans and supplement advice to support your fitness journey.</p>
    </div>

  </div>
</section>

    </div>
    <script src="script.js"></script>
</body>
</html>
