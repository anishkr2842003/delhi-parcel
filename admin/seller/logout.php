<?php
session_start();

// Unset a specific session variable
if (isset($_SESSION['delivery_boy_email'])) {
    unset($_SESSION['delivery_boy_email']);
}

// Redirect to the index page
header('Location: index.php');
exit();
