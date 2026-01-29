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
    <link rel="stylesheet" href="contact.css">
    <link rel="icon" type="image/x-icon" href="images/Royal-Fitness-Logo-Design.ico">
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
        <!-- navbar End -->


  <!-- Contact Section -->
  <section class="contact">
    <h1>Contact Us</h1>
    <p class="subtitle">We’d love to hear from you! Get in touch with Royal Fitness today.</p>

    <div class="contact-container">
      
      <!-- Left Info -->
      <div class="contact-info">
        <h2>Get in Touch</h2>
        <p><strong>📍 Address:</strong> Royal Fitness, Sunrise Tower, Kankavli</p>
        <p><strong>📞 Phone:</strong> +91 8208508875</p>
        <p><strong>📧 Email:</strong> contact@royalfitness.com</p>
        <p><strong>🕒 Hours:</strong> Mon–Sat: 5:30 - 10.30am, 5am – 9pm <br>
        &nbsp; &nbsp; &nbsp; Sun: <span style="color:grey;">Sunday & National Holiday Closed</span></p>
      </div>

      <!-- Right Form -->
      <div class="contact-form">
        <h2>Send a Message</h2>
        <form action="contact_process.php" method="POST">
          <input type="text" name="name" placeholder="Your Name" required>
          <input type="email" name="email" placeholder="Your Email" required>
          <input type="tel" name="phone" placeholder="Your Phone" required>
          <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
          <button type="submit" class="btn-submit">Send Message</button>
          
        </form>
      </div>
    </div>

    <!-- Google Map -->
    <div class="map">
     <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1074.8325513865616!2d73.71275142605498!3d16.258043892905018!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc017072756d5e9%3A0xfd2362d51a03e0ea!2sRoyal%20Fitness%20Unisex!5e0!3m2!1sen!2sin!4v1757381434079!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
       
      </iframe>
    </div>
  </section>
<script src="script.js"></script>
</body>
</html>
