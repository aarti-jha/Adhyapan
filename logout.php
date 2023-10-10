<?php
// Start the session (if not already started)
session_start();

// Destroy all session data
session_destroy();

// Redirect the user to the login page or any other desired page
header("Location: afterjoinus.html"); // Replace "login.php" with the URL of your desired page

// Ensure that no code below this point is executed
exit;
?>
