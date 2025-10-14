<?php
// filepath: /home/bob/Github/php-course/Clase_4/Workshop_4/admin/user_process.php
require_once '../auth/require_admin.php';
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];
    $active = $_POST['active'];
    
    // Validaciones básicas
    if (empty($username) || empty($nombre) || empty($apellido) || empty($email)) {
        die("Error: Todos los campos son obligatorios.");
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Email inválido.");
    }
    
    try {
        if ($id) {
            // Actualizar usuario existente
            if (!empty($password)) {
                // Si se proporciona nueva contraseña, actualizarla
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("UPDATE usuarios SET username = ?, password_hash = ?, nombre = ?, apellido = ?, email = ?, role = ?, active = ? WHERE id = ?");
                $stmt->execute([$username, $password_hash, $nombre, $apellido, $email, $role, $active, $id]);
            } else {
                // No cambiar la contraseña
                $stmt = $pdo->prepare("UPDATE usuarios SET username = ?, nombre = ?, apellido = ?, email = ?, role = ?, active = ? WHERE id = ?");
                $stmt->execute([$username, $nombre, $apellido, $email, $role, $active, $id]);
            }
            $success = 'updated';
        } else {
            // Crear nuevo usuario
            if (empty($password)) {
                die("Error: La contraseña es obligatoria para nuevos usuarios.");
            }
            
            // Verificar si el username ya existe
            $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->rowCount() > 0) {
                die("Error: El nombre de usuario ya existe.");
            }
            
            // Verificar si el email ya existe
            $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->rowCount() > 0) {
                die("Error: El email ya está registrado.");
            }
            
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO usuarios (username, password_hash, nombre, apellido, email, role, active) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$username, $password_hash, $nombre, $apellido, $email, $role, $active]);
            $success = 'created';
        }
        
        header("Location: users_list.php?success=" . $success);
        exit();
        
    } catch (PDOException $e) {
        die("Error en la base de datos: " . $e->getMessage());
    }
} else {
    header("Location: users_list.php");
    exit();
}
?>