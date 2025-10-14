<?php
// filepath: /home/bob/Github/php-course/Clase_4/Workshop_4/admin/user_delete.php
require_once '../auth/require_admin.php';
require_once '../config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        // Verificar que el usuario existe
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        $usuario = $stmt->fetch();
        
        if (!$usuario) {
            header("Location: users_list.php");
            exit();
        }
        
        // No permitir eliminar al propio administrador
        if ($id == $_SESSION['user_id']) {
            die("Error: No puedes eliminarte a ti mismo.");
        }
        
        // Eliminar el usuario
        $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        
        header("Location: users_list.php?success=deleted");
        exit();
        
    } catch (PDOException $e) {
        die("Error al eliminar usuario: " . $e->getMessage());
    }
} else {
    header("Location: users_list.php");
    exit();
}
?>