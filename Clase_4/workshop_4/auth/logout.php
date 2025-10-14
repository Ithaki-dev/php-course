<?php
// filepath: /home/bob/Github/php-course/Clase_4/Workshop_4/auth/logout.php
session_start();
session_destroy();
header('Location: login.php');
exit();
?>