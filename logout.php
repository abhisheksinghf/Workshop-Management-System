<?php

session_start();

if (isset($_SESSION['LoginAdmin'])) {
    session_destroy();
    header('Location: login.php');
    exit();
} else {
    header('Location: login.php');
    exit();
}
?>
