<?php
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['LoginAdmin'])) {
    header("Location: ../login.php");
    exit();
}

// You can add more session-related functions or configurations here
?>
