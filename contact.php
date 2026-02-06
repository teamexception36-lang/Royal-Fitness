<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Royal Fitness</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3.0 & FontAwesome Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- External Custom CSS -->
    <link rel="stylesheet" href="contact.css">
</head>

<body>
    <!-- Navbar -->
  <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top" 
     style="background: hsla(0, 8%, 88%, 0.44) !important; 
            backdrop-filter: blur(15px); 
            -webkit-backdrop-filter: blur(15px); 
            border-bottom: 1px solid rgba(212, 175, 55, 0.3); 
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);">
    
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="images/Royal_fit_logo.png" alt="Logo" width="40" height="40" onerror="this.style.display='none'">
            ROYAL FITNESS
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="membership.php">Membership</a></li>
                <li class="nav-item"><a class="nav-link active" href="contact.php">Contact</a></li>
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

    <div class="container">
        <!-- Header -->
        <header class="contact-header">
            <h6 class="text-gold text-uppercase ls-2">Connect with the Elite</h6>
            <h1>Get In <span>Touch</span></h1>
            <p class=" mx-auto" style="max-width: 600px;">Have questions about our training programs or memberships? Our team is ready to help you start your transformation.</p>
        </header>

        <!-- Main Contact Card -->
        <div class="contact-wrapper">
            <div class="row g-0">
                <!-- Info Section -->
                <div class="col-lg-5">
                    <div class="info-side">
                        <h3 class="mb-4 fw-bold">Contact Info</h3>
                        
                        <div class="info-item">
                            <div class="info-icon-box"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="info-content">
                                <h5>Location</h5>
                                <p>Sunrise Tower, Nardave Phatta, Kankavli 416602</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon-box"><i class="fas fa-phone-alt"></i></div>
                            <div class="info-content">
                                <h5>Call Us</h5>
                                <p>+91 8208508875</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon-box"><i class="fas fa-envelope"></i></div>
                            <div class="info-content">
                                <h5>Email Us</h5>
                                <p>contact@royalfitness.com</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon-box"><i class="fas fa-clock"></i></div>
                            <div class="info-content">
                                <h5>Working Hours</h5>
                                <p>Mon–Sat: 5:30 AM - 10:30 AM<br>Evening: 5:00 PM - 9:00 PM</p>
                            </div>
                        </div>

                        <!-- Added Social Media for Pro-Level Engagement -->
                        <div class="social-links mt-5">
                            <p class="small text-secondary text-uppercase mb-3">Follow our progress</p>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="col-lg-7">
                    <div class="form-side">
                        <h3 class="mb-4 fw-bold">Send us a Message</h3>
                        <form action="contact_process.php" method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label small">Full Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label small ">Email Address</label>
                                    <input type="email" name="email" class="form-control" placeholder="john@example.com" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small ">Phone Number</label>
                                <input type="tel" name="phone" class="form-control" placeholder="+91 00000 00000" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label small ">How can we help?</label>
                                <textarea name="message" class="form-control" rows="4" placeholder="I'm interested in the 12-month membership..." required></textarea>
                            </div>
                            <button type="submit" class="btn-royal-contact">Send Message <i class="fas fa-paper-plane ms-2"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Google Map -->
        <div class="map-container-pro">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1074.8325513865616!2d73.71275142605498!3d16.258043892905018!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc017072756d5e9%3A0xfd2362d51a03e0ea!2sRoyal%20Fitness%20Unisex!5e0!3m2!1sen!2sin!4v1757381434079!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>

    <footer>
        <div class="container text-center py-4">
            <p class="mb-0 text-muted">© 2025 Royal Fitness. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>