<?php
// filepath: /home/bob/Github/php-course/Clase_4/Workshop_4/reset_admin.php
require_once 'config/database.php';

$username = 'admin';
$password = 'admin123';
$password_hash = password_hash($password, PASSWORD_DEFAULT);

try {
    // Actualizar o crear usuario admin
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE username = ?");
    $stmt->execute([$username]);
    
    if ($stmt->rowCount() > 0) {
        // Actualizar existente
        $stmt = $pdo->prepare("UPDATE usuarios SET password_hash = ?, active = 1 WHERE username = ?");
        $stmt->execute([$password_hash, $username]);
        echo "✅ Contraseña del admin actualizada correctamente<br>";
    } else {
        // Crear nuevo
        $stmt = $pdo->prepare("INSERT INTO usuarios (username, password_hash, nombre, apellido, email, role, active) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$username, $password_hash, 'Administrador', 'Sistema', 'admin@turayo.com', 'admin', 1]);
        echo "✅ Usuario admin creado correctamente<br>";
    }
    
    echo "<br>Credenciales:<br>";
    echo "Usuario: <strong>admin</strong><br>";
    echo "Contraseña: <strong>admin123</strong><br>";
    echo "<br><a href='auth/login.php'>Ir al Login</a>";
    
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>