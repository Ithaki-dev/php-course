<?php
// filepath: /home/bob/Github/php-course/Clase_5/CRUD_Tecnologia/index.php
require_once 'config/database.php';

// Obtener todos los dispositivos
try {
    $stmt = $pdo->query("SELECT * FROM dispositivos ORDER BY fecha_creacion DESC");
    $dispositivos = $stmt->fetchAll();
} catch (PDOException $e) {
    $error = "Error al cargar dispositivos: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Gestión de Tecnología</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #eee;
        }
        h1 {
            color: #2c3e50;
            font-size: 28px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
            transition: all 0.3s;
        }
        .btn-primary {
            background-color: #3498db;
            color: white;
        }
        .btn-primary:hover {
            background-color: #2980b9;
        }
        .btn-warning {
            background-color: #f39c12;
            color: white;
            padding: 8px 12px;
            font-size: 12px;
        }
        .btn-warning:hover {
            background-color: #e67e22;
        }
        .btn-danger {
            background-color: #e74c3c;
            color: white;
            padding: 8px 12px;
            font-size: 12px;
        }
        .btn-danger:hover {
            background-color: #c0392b;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #34495e;
            color: white;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f8f9fa;
        }
        .actions {
            display: flex;
            gap: 5px;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .empty-state {
            text-align: center;
            padding: 50px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🖥️ Gestión de Dispositivos Tecnológicos</h1>
            <a href="form.php" class="btn btn-primary">+ Agregar Dispositivo</a>
        </div>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">
                <?php 
                switch($_GET['success']) {
                    case 'created': echo "✅ Dispositivo creado exitosamente"; break;
                    case 'updated': echo "✅ Dispositivo actualizado exitosamente"; break;
                    case 'deleted': echo "✅ Dispositivo eliminado exitosamente"; break;
                }
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-error">❌ <?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (empty($dispositivos)): ?>
            <div class="empty-state">
                <h3>No hay dispositivos registrados</h3>
                <p>Comienza agregando tu primer dispositivo tecnológico</p>
                <a href="form.php" class="btn btn-primary">+ Agregar Primer Dispositivo</a>
            </div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Tipo</th>
                        <th>Fecha Ingreso</th>
                        <th>Departamento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dispositivos as $dispositivo): ?>
                        <tr>
                            <td><?php echo $dispositivo['id']; ?></td>
                            <td><?php echo htmlspecialchars($dispositivo['marca']); ?></td>
                            <td><?php echo htmlspecialchars($dispositivo['modelo']); ?></td>
                            <td><?php echo htmlspecialchars($dispositivo['tipo']); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($dispositivo['fecha_ingreso'])); ?></td>
                            <td><?php echo htmlspecialchars($dispositivo['departamento']); ?></td>
                            <td class="actions">
                                <a href="form.php?id=<?php echo $dispositivo['id']; ?>" class="btn btn-warning">
                                    ✏️ Editar
                                </a>
                                <a href="delete.php?id=<?php echo $dispositivo['id']; ?>" 
                                   class="btn btn-danger"
                                   onclick="return confirm('¿Está seguro de eliminar este dispositivo?')">
                                    🗑️ Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div style="margin-top: 20px; text-align: center; color: #666;">
                Total de dispositivos: <?php echo count($dispositivos); ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>