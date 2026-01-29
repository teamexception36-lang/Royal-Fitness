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
    <link rel="stylesheet" href="about.css">
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

        <!-- About Section -->
  <section class="about">
    <div class="about-container">
      <div class="about-text">
        <h1>Welcome to <span>Royal Fitness</span></h1>
        <p>
          At <strong>Royal Fitness</strong>, fitness is not just about building muscle—it’s about
          discipline, confidence, and living a healthy lifestyle.  
          Since 2020, we’ve helped hundreds of members achieve their goals through 
          strength training, cardio, and personalized nutrition.
        </p>
        <p>
          Our mission: <em>make fitness accessible, enjoyable, and result-driven for everyone</em>.
        </p>
        <div class="highlights">
          <div class="highlight">
            <h3>🏋️ Modern Equipment</h3>
            <p>Latest machines and tools for every workout style.</p>
          </div>
          <div class="highlight">
            <h3>👨‍🏫 Expert Trainers</h3>
            <p>Certified coaches guiding you at every step.</p>
          </div>
          <div class="highlight">
            <h3>💡 Personalized Plans</h3>
            <p>Workouts & diets designed just for you.</p>
          </div>
        </div>
      </div>
      <div class="about-image">
        <img src="https://images.pexels.com/photos/1552242/pexels-photo-1552242.jpeg" alt="Royal Fitness Gym">
      </div>
    </div>
  </section>

  
    </div>
    <script src="script.js"></script>
</body>
</html>
