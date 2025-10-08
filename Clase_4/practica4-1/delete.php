<?php
// filepath: /home/bob/Github/php-course/Clase_5/CRUD_Tecnologia/delete.php
require_once 'config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        // Verificar que el dispositivo existe
        $stmt = $pdo->prepare("SELECT * FROM dispositivos WHERE id = ?");
        $stmt->execute([$id]);
        $dispositivo = $stmt->fetch();
        
        if (!$dispositivo) {
            header("Location: index.php");
            exit();
        }
        
        // Eliminar el dispositivo
        $stmt = $pdo->prepare("DELETE FROM dispositivos WHERE id = ?");
        $stmt->execute([$id]);
        
        header("Location: index.php?success=deleted");
        exit();
        
    } catch (PDOException $e) {
        die("Error al eliminar dispositivo: " . $e->getMessage());
    }
} else {
    header("Location: index.php");
    exit();
}
?>