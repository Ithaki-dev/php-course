<?php
// Incluir la conexión a la base de datos
include 'config/database.php'; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios Registrados</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 50px; 
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        table { 
            border-collapse: collapse; 
            width: 100%; 
            margin: 20px 0;
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 12px; 
            text-align: left; 
        }
        th { 
            background-color: #007bff; 
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) { 
            background-color: #f9f9f9; 
        }
        tr:hover { 
            background-color: #f5f5f5; 
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin: 10px 0;
        }
        .btn:hover {
            background: #0056b3;
        }
        .alert {
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Usuarios Registrados</h1>
        <p>Lista de todos los usuarios en el sistema</p>
        
        <?php
        try {
            // Verificar que la conexión existe
            if (!isset($conn)) {
                throw new Exception("No hay conexión a la base de datos");
            }
            
            // Consultar todos los usuarios
            $stmt = $conn->prepare("SELECT * FROM usuarios ORDER BY fecha_registro DESC");
            $stmt->execute();
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (count($usuarios) > 0) {
                echo '<div class="alert alert-success">Se encontraron ' . count($usuarios) . ' usuario(s) registrado(s)</div>';
                
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Nombre</th>";
                echo "<th>Apellido</th>";
                echo "<th>Correo</th>";
                echo "<th>Teléfono</th>";
                echo "<th>Fecha Registro</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                
                foreach ($usuarios as $usuario) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($usuario['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($usuario['nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($usuario['apellido']) . "</td>";
                    echo "<td>" . htmlspecialchars($usuario['correo']) . "</td>";
                    echo "<td>" . htmlspecialchars($usuario['telefono']) . "</td>";
                    echo "<td>" . htmlspecialchars($usuario['fecha_registro']) . "</td>";
                    echo "</tr>";
                }
                
                echo "</tbody>";
                echo "</table>";
                
            } else {
                echo '<div class="alert alert-info">No hay usuarios registrados aún.</div>';
                echo '<p>¡Sé el primero en registrarte!</p>';
            }
            
        } catch (PDOException $e) {
            echo '<div class="alert alert-error">';
            echo '<strong>Error de base de datos:</strong> ' . htmlspecialchars($e->getMessage());
            echo '</div>';
            
        } catch (Exception $e) {
            echo '<div class="alert alert-error">';
            echo '<strong>Error:</strong> ' . htmlspecialchars($e->getMessage());
            echo '</div>';
        }
        ?>
        
        <div style="margin-top: 30px;">
            <a href="index.php" class="btn">← Volver al Formulario</a>
        </div>
    </div>
</body>
</html>