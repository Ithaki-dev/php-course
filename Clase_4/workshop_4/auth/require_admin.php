<?php
// filepath: /home/bob/Github/php-course/Clase_4/Workshop_4/auth/require_admin.php
session_start();

// Verificar si hay sesión activa
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}

// Verificar si es administrador
if ($_SESSION['role'] !== 'admin') {
    die('Acceso denegado. Se requieren permisos de administrador.');
}
?>