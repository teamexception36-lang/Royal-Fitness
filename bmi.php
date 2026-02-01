<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI Calculator | Royal Fitness</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="membership.css"> <!-- Reusing your existing global styles -->
    <style>
        .bmi-card {
            background: var(--card-bg);
            border: 1px solid #333;
            border-radius: 20px;
            padding: 40px;
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
        }
        .bmi-input {
            background: #252525;
            border: 1px solid #444;
            color: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            width: 100%;
        }
        #result-box {
            margin-top: 30px;
            padding: 20px;
            border-radius: 10px;
            display: none;
        }
        .underweight { background: #17a2b8; color: white; }
        .normal { background: #28a745; color: white; }
        .overweight { background: #ffc107; color: black; }
        .obese { background: #dc3545; color: white; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="home.php">
                <img src="images/Royal_fit_logo.png" alt="Logo" width="40" height="40">
                ROYAL FITNESS
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="membership.php">Membership</a></li>
                    <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
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
        <div class="bmi-card">
            <h1 class="mb-4 text-gold" style="color:var(--primary-gold)">BMI CALCULATOR</h1>
            <p class="text-muted mb-4">Track your health progress and save results to your dashboard.</p>
            
            <input type="number" id="height" class="bmi-input" placeholder="Enter Height (cm)">
            <input type="number" id="weight" class="bmi-input" placeholder="Enter Weight (kg)">
            
            <button onclick="calculateBMI()" class="btn-royal">Calculate & Save</button>

            <div id="result-box">
                <h3 id="bmi-value"></h3>
                <p id="bmi-status"></p>
            </div>
        </div>
    </div>

    <script>
        function calculateBMI() {
            let height = document.getElementById('height').value;
            let weight = document.getElementById('weight').value;

            if (height > 0 && weight > 0) {
                let bmi = (weight / ((height / 100) ** 2)).toFixed(1);
                let status = "";
                let cssClass = "";

                if (bmi < 18.5) { status = "Underweight"; cssClass = "underweight"; }
                else if (bmi < 25) { status = "Normal Weight"; cssClass = "normal"; }
                else if (bmi < 30) { status = "Overweight"; cssClass = "overweight"; }
                else { status = "Obese"; cssClass = "obese"; }

                let resultBox = document.getElementById('result-box');
                resultBox.style.display = "block";
                resultBox.className = cssClass;
                document.getElementById('bmi-value').innerText = "Your BMI: " + bmi;
                document.getElementById('bmi-status').innerText = status;

                // Send data to PHP to save in database
                saveBMI(bmi, height, weight);
            }
        }

        function saveBMI(bmi, h, w) 
        {
            // This creates the data format PHP expects
            let formData = new URLSearchParams();
            formData.append('bmi', bmi);
           formData.append('height', h);
           formData.append('weight', w);

          fetch('save_bmi.php',
           {
               method: 'POST',
               headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
               body: formData.toString()
            })
          .then(response => response.text())
            .then(data => {
             console.log(data); // This will show "Success" or "Error" in your browser console (F12)
             if(data.includes("Success")) 
              {
                alert("BMI Saved Successfully!");
              }
         })
     .catch(error => console.error('Error:', error));
}
    </script>
</body>
</html>