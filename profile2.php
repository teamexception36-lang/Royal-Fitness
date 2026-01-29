<?php
session_start();

// Redirect to login if not logged in
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";     // your MySQL username
$password = "";         // your MySQL password
$dbname = "login_system";  // your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get username from session
$user = $_SESSION['username'];

// Fetch user details
$sql = "SELECT username, email FROM users WHERE username='$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
    $email = $row['email'];
} else {
    $username = "Unknown";
    $email = "Not Found";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile | Gym Royal Fitness</title>
    <style>
        :root {
            --primary-color: #4CAF50; /* A fresh green */
            --secondary-color: #388E3C; /* Darker green for accents */
            --text-color: #333;
            --card-bg: #ffffff;
            --body-bg-start: #f0f2f5;
            --body-bg-end: #e3e6e8;
            --shadow-color: rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(to right, var(--body-bg-start), var(--body-bg-end));
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .profile-box {
            background: var(--card-bg);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 15px var(--shadow-color);
            text-align: center;
            width: 350px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .profile-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px var(--shadow-color);
        }

        h2 {
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            margin: 10px 0;
            color: var(--text-color);
        }

        strong {
            color: var(--secondary-color);
        }

        .logout-btn {
            margin-top: 25px;
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: background 0.3s ease;
        }

        .logout-btn:hover {
            background: var(--secondary-color);
        }
    </style>
</head>
<body>
    <div class="profile-box">
        <h2>Your Profile</h2>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        <form action="logout.php" method="post">
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</body>
</html>
