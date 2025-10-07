<?php
// filepath: /home/bob/Github/php-course/Clase_3/Workshop_3/process.php
require_once 'config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y limpiar datos del formulario
    $identificacion = trim($_POST['identificacion']);
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $departamento = $_POST['departamento'];
    $provincia_id = $_POST['provincia'];
    
    // Validaciones básicas
    if (empty($identificacion) || empty($nombre) || empty($apellidos) || empty($departamento) || empty($provincia_id)) {
        die("Error: Todos los campos son obligatorios.");
    }
    
    try {
        // Verificar si la identificación ya existe
        $check_stmt = $conn->prepare("SELECT id FROM usuarios WHERE identificacion = ?");
        $check_stmt->execute([$identificacion]);
        
        if ($check_stmt->rowCount() > 0) {
            die("Error: Ya existe un empleado con esa identificación.");
        }
        
        // Insertar nuevo usuario
        $stmt = $conn->prepare("INSERT INTO usuarios (identificacion, nombre, apellidos, departamento, provincia_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$identificacion, $nombre, $apellidos, $departamento, $provincia_id]);
        
        // Crear nombre de usuario para el login
        $username = strtolower($nombre) . "." . strtolower(explode(' ', $apellidos)[0]);
        $username = str_replace(' ', '', $username); // Remover espacios
        
        // Redireccionar al login con el username
        header("Location: login.php?username=" . urlencode($username));
        exit();
        
    } catch (PDOException $e) {
        die("Error en la base de datos: " . $e->getMessage());
    }
} else {
    header("Location: form.php");
    exit();
}
?>