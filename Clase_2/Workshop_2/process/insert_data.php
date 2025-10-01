<?php
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];

    $upper_nombre = strtoupper($nombre);
    $upper_apellido = strtoupper($apellido);
    $correo = strtolower($correo);

    // Validate input
    if (empty($upper_nombre) || empty($upper_apellido) || empty($correo) || empty($telefono)) {
        echo "Todos los campos son requeridos.";
        exit;
    }

    // Validate email format
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo "Formato de correo inválido.";
        exit;
    }

    try {
        // Check if email already exists
        $check_stmt = $conn->prepare("SELECT id FROM usuarios WHERE correo = ?");
        $check_stmt->execute([$correo]);
        
        if ($check_stmt->rowCount() > 0) {
            echo "Este correo ya está registrado.";
            echo "<br><a href='../index.php'>Volver</a>";
            exit;
        }

        // Insert new user
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, apellido, correo, telefono) VALUES (?, ?, ?, ?)");
        $stmt->execute([$upper_nombre, $upper_apellido, $correo, $telefono]);
        
        echo "Registro creado exitosamente";
        echo "<br><button onclick=\"window.location.href='../index.php'\">Volver al formulario</button>";
        echo "<br><button onclick=\"window.location.href='../view_users.php'\">Ver usuarios</button>";
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        echo "<br><a href='../index.php'>Volver</a>";
    }
}
?>