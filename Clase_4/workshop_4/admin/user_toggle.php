<?php
// filepath: /home/bob/Github/php-course/Clase_4/Workshop_4/admin/user_toggle.php
require_once '../auth/require_admin.php';
require_once '../config/database.php';

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];
    
    // Validar acción
    if (!in_array($action, ['enable', 'disable'])) {
        header("Location: users_list.php");
        exit();
    }
    
    $active = ($action == 'enable') ? 1 : 0;
    
    try {
        // Verificar que el usuario existe
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        $usuario = $stmt->fetch();
        
        if (!$usuario) {
            header("Location: users_list.php");
            exit();
        }
        
        // No permitir deshabilitar al propio administrador
        if ($id == $_SESSION['user_id'] && $active == 0) {
            die("Error: No puedes deshabilitarte a ti mismo.");
        }
        
        // Actualizar estado
        $stmt = $pdo->prepare("UPDATE usuarios SET active = ? WHERE id = ?");
        $stmt->execute([$active, $id]);
        
        $success = ($action == 'enable') ? 'enabled' : 'disabled';
        header("Location: users_list.php?success=" . $success);
        exit();
        
    } catch (PDOException $e) {
        die("Error al cambiar estado del usuario: " . $e->getMessage());
    }
} else {
    header("Location: users_list.php");
    exit();
}
?>