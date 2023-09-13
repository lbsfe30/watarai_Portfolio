<?php
session_start();
if (isset($_SESSION['customer'])) {
    session_destroy();
    header('Location:../login_system/login.php?logout=1');
    exit;
}

