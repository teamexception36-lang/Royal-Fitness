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
  <title>Membership - Royal Fitness</title>
  <link rel="stylesheet" href="membership.css">
</head>
<body>
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
            <!-- Hero Image Before Plans -->
            <section class="membership-hero">
            <img src="https://images.pexels.com/photos/1954524/pexels-photo-1954524.jpeg" 
                alt="Royal Fitness Membership" />
            </section>

  <!-- Membership Section -->
  <section class="membership">
    <h1 class="section-title">Membership Plans</h1>
    <p class="section-subtitle">Choose the plan that fits your fitness journey</p>

    <div class="plans-grid">
          <!-- Regular Memberships -->
          <div class="plan-card">
            <h2>1 Month</h2>
            <p class="price">₹1100</p>
          </div>

          <div class="plan-card">
            <h2>3 Months</h2>
            <p class="price">₹2500</p>
          </div>

          <div class="plan-card">
            <h2>6 Months</h2>
            <p class="price">₹4500</p>
          </div>

          <div class="plan-card">
            <h2>12 Months</h2>
            <p class="price">₹8500</p>
          </div>
      </div>
      <!-- 2nd row -->
      <div class="plans-grid2">
        <!-- Student Membership -->
            <div class="plan-card highlight">
              <h2>Student (3 Months)</h2>
              <p class="price">₹2200</p>
            </div>

            <!-- Personal Training -->
            <div class="plan-card highlight">
              <h2>Personal Training</h2>
              <p class="price">₹3000</p>
              <p class="note">18 Sessions / Valid for 1 Month</p>
            </div>
       </div>
       <h2 class="tryfree"><a href="signup2.html" >Try us for FREE! </a></h2>
  </section>

  <!-- Services Section -->
  <section class="services">
    <h1 class="section-title">Our Services</h1>
    <ul class="services-list">
      <li>Modern Equipment</li>
      <li>Cardio</li>
      <li>Strength</li>
      <li>Weight Loss & Gain</li>
      <li>Air-Conditioned</li>
      <li>Diet & Nutrition</li>
      <li>Certified Trainer</li>
      <li>Lockers</li>
    </ul>
  </section>

  <!-- Address Section -->
  <section class="address">
    <h2>📍 Visit Us</h2>
    <p>3rd Floor, Sunrise Tower, Nardave Phatta,<br> Mum-Goa Highway, Kankavli 416602</p>
  </section>
<script src="script.js"></script>
</body>
</html>
