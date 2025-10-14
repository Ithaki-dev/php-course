<?php
// filepath: /home/bob/Github/php-course/Clase_4/Workshop_4/index.php
session_start();

// Si ya está logueado, redirigir al dashboard
if (isset($_SESSION['user_id'])) {
    header('Location: admin/dashboard.php');
    exit();
}

// Si no, redirigir al login
header('Location: auth/login.php');
exit();
?>