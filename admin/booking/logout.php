<?php
session_start();

// Unset a specific session variable
if (isset($_SESSION['booking_email'])) {
    unset($_SESSION['booking_email']);
}

// Redirect to the index page
header('Location: index.php');
exit();
