<?php
// filepath: /home/bob/Github/php-course/Clase_5/CRUD_Tecnologia/process.php
require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $marca = trim($_POST['marca']);
    $modelo = trim($_POST['modelo']);
    $tipo = $_POST['tipo'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $departamento = $_POST['departamento'];
    
    // Validaciones
    if (empty($marca) || empty($modelo) || empty($tipo) || empty($fecha_ingreso) || empty($departamento)) {
        die("Error: Todos los campos son obligatorios.");
    }
    
    try {
        if ($id) {
            // Actualizar dispositivo existente
            $stmt = $pdo->prepare("UPDATE dispositivos SET marca = ?, modelo = ?, tipo = ?, fecha_ingreso = ?, departamento = ? WHERE id = ?");
            $stmt->execute([$marca, $modelo, $tipo, $fecha_ingreso, $departamento, $id]);
            $success = 'updated';
        } else {
            // Crear nuevo dispositivo
            $stmt = $pdo->prepare("INSERT INTO dispositivos (marca, modelo, tipo, fecha_ingreso, departamento) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$marca, $modelo, $tipo, $fecha_ingreso, $departamento]);
            $success = 'created';
        }
        
        header("Location: index.php?success=" . $success);
        exit();
        
    } catch (PDOException $e) {
        die("Error en la base de datos: " . $e->getMessage());
    }
} else {
    header("Location: index.php");
    exit();
}
?>