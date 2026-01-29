<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BMI Calculator | Royal Fitness</title>
  <link rel="stylesheet" href="bmi.css" />
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
        <!-- navbar End -->

  <section class="bmi-section">
    <div class="bmi-container">
      <h1>Calculate Your BMI</h1>
      <p>Check your Body Mass Index and get personalized fitness suggestions.</p>

      <div class="bmi-form">
        <label>Height (cm):</label>
        <input type="number" id="height" placeholder="Enter your height" />

        <label>Weight (kg):</label>
        <input type="number" id="weight" placeholder="Enter your weight" />

        <button onclick="calculateBMI()">Calculate</button>
      </div>

      <div id="result"></div>
      <div id="suggestions"></div>
    </div>
  </section>

  <script src="bmi.js"></script>
</body>
</html>
