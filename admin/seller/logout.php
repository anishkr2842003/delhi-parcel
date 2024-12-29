<?php
session_start();

// Unset a specific session variable
if (isset($_SESSION['seller_email'])) {
    unset($_SESSION['seller_email']);
}

// Redirect to the index page
header('Location: index.php');
exit();
