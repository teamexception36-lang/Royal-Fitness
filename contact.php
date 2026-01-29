<?php
// 1. CRITICAL CORRECTION: session_start() must be the very first line of output.
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Royal Fitness</title>
    
    <!-- Google Fonts & Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-gold: #d4af37;
            --dark-bg: #121212;
            --card-bg: #1e1e1e;
            --input-focus: rgba(212, 175, 55, 0.2);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--dark-bg);
            color: #ffffff;
            overflow-x: hidden;
        }

        /* Navbar (Consistent) */
        .navbar {
            background: rgba(0, 0, 0, 0.9) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(212, 175, 55, 0.3);
        }
        .navbar-brand { font-weight: 700; color: var(--primary-gold) !important; }
        .nav-link { color: white !important; margin: 0 10px; }
        .btn-nav { background: var(--primary-gold); color: black !important; font-weight: 600; border-radius: 20px; padding: 5px 20px; }

        /* Contact Header */
        .contact-header {
            padding: 80px 0 40px;
            text-align: center;
        }
        .contact-header h1 {
            font-size: 3rem;
            font-weight: 800;
            text-transform: uppercase;
            color: white;
        }
        .contact-header h1 span { color: var(--primary-gold); }

        /* Info & Form Container */
        .contact-wrapper {
            background: var(--card-bg);
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
            border: 1px solid #333;
        }

        /* Left Info Side */
        .info-side {
            background: linear-gradient(135deg, #1a1a1a 0%, #000000 100%);
            padding: 50px;
            height: 100%;
        }
        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 30px;
        }
        .info-icon {
            font-size: 1.5rem;
            color: var(--primary-gold);
            margin-right: 20px;
            margin-top: 5px;
        }
        .info-content h5 {
            color: var(--primary-gold);
            font-weight: 600;
            margin-bottom: 5px;
        }
        .info-content p { color: #ccc; font-size: 0.95rem; }

        /* Right Form Side */
        .form-side {
            padding: 50px;
        }
        .form-control {
            background: #252525;
            border: 1px solid #444;
            color: white;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .form-control:focus {
            background: #2a2a2a;
            border-color: var(--primary-gold);
            box-shadow: 0 0 10px var(--input-focus);
            color: white;
        }
        .btn-submit {
            background: var(--primary-gold);
            color: black;
            font-weight: 700;
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none;
            transition: var(--transition);
        }
        .btn-submit:hover {
            background: white;
            transform: translateY(-3px);
        }

        /* Map Section */
        .map-container {
            margin-top: 60px;
            border-radius: 20px;
            overflow: hidden;
            border: 2px solid #333;
            filter: grayscale(100%);
            transition: var(--transition);
        }
        .map-container:hover {
            filter: grayscale(0%);
            border-color: var(--primary-gold);
        }

        footer {
            padding: 40px 0;
            text-align: center;
            color: #666;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="home.php">ROYAL FITNESS</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="membership.php">Membership</a></li>
                    <li class="nav-item"><a class="nav-link active" href="contact.php">Contact</a></li>
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

    <div class="container">
        <!-- Header -->
        <header class="contact-header">
            <h1>Get In <span>Touch</span></h1>
            <p class="text-muted">Have a question? We are here to help you start your journey.</p>
        </header>

        <!-- Main Contact Card -->
        <div class="contact-wrapper">
            <div class="row g-0">
                <!-- Info Section -->
                <div class="col-lg-5">
                    <div class="info-side">
                        <h3 class="mb-5 fw-bold">Contact Information</h3>
                        
                        <div class="info-item">
                            <span class="info-icon">📍</span>
                            <div class="info-content">
                                <h5>Location</h5>
                                <p>Sunrise Tower, Nardave Phatta, Mumbai-Goa Highway, Kankavli 416602</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <span class="info-icon">📞</span>
                            <div class="info-content">
                                <h5>Call Us</h5>
                                <p>+91 8208508875</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <span class="info-icon">📧</span>
                            <div class="info-content">
                                <h5>Email Us</h5>
                                <p>contact@royalfitness.com</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <span class="info-icon">🕒</span>
                            <div class="info-content">
                                <h5>Working Hours</h5>
                                <p>Mon–Sat: 5:30 AM - 10:30 AM<br>Evening: 5:00 PM - 9:00 PM<br>
                                <span class="text-danger small">Sunday & National Holidays Closed</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="col-lg-7">
                    <div class="form-side">
                        <h3 class="mb-4 fw-bold">Send us a Message</h3>
                        <form action="contact_process.php" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                                </div>
                            </div>
                            <input type="tel" name="phone" class="form-control" placeholder="Phone Number" required>
                            <textarea name="message" class="form-control" rows="5" placeholder="How can we help you?" required></textarea>
                            <button type="submit" class="btn-submit">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Google Map -->
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1074.8325513865616!2d73.71275142605498!3d16.258043892905018!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc017072756d5e9%3A0xfd2362d51a03e0ea!2sRoyal%20Fitness%20Unisex!5e0!3m2!1sen!2sin!4v1757381434079!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>© 2025 Royal Fitness. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>