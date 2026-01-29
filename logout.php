<?php
// Start the session
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Redirect to login page (you can change this to homepage if you want)
header("Location: home.php");
exit();
?>
