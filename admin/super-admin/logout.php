<?php
session_start();

// Unset a specific session variable
if (isset($_SESSION['admin_email'])) {
    unset($_SESSION['admin_email']);
}

// Redirect to the index page
header('Location: index.php');
exit();
