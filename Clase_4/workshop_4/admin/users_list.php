<?php
// filepath: /home/bob/Github/php-course/Clase_4/Workshop_4/admin/users_list.php
require_once '../auth/require_admin.php';
require_once '../config/database.php';

// Obtener todos los usuarios
$stmt = $pdo->query("SELECT * FROM usuarios ORDER BY created_at DESC");
$usuarios = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios - Workshop 4</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar h1 {
            font-size: 24px;
        }
        .navbar-user {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .navbar a:hover {
            background: rgba(255,255,255,0.2);
        }
        .container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 20px;
        }
        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-success {
            background: #27ae60;
            color: white;
        }
        .btn-warning {
            background: #f39c12;
            color: white;
            padding: 6px 12px;
            font-size: 12px;
        }
        .btn-danger {
            background: #e74c3c;
            color: white;
            padding: 6px 12px;
            font-size: 12px;
        }
        .btn-secondary {
            background: #95a5a6;
            color: white;
            padding: 6px 12px;
            font-size: 12px;
        }
        .table-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #34495e;
            color: white;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f8f9fa;
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        .status-active {
            background: #d4edda;
            color: #155724;
        }
        .status-inactive {
            background: #f8d7da;
            color: #721c24;
        }
        .role-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        .role-admin {
            background: #fff3cd;
            color: #856404;
        }
        .role-user {
            background: #d1ecf1;
            color: #0c5460;
        }
        .actions {
            display: flex;
            gap: 5px;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .user-inactive {
            opacity: 0.6;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>👥 Gestión de Usuarios</h1>
        <div class="navbar-user">
            <a href="dashboard.php">🏠 Dashboard</a>
            <span>👤 <?php echo htmlspecialchars($_SESSION['nombre']); ?></span>
            <a href="../auth/logout.php">🚪 Salir</a>
        </div>
    </nav>

    <div class="container">
        <div class="header-actions">
            <h2>Listado de Usuarios</h2>
            <a href="user_form.php" class="btn btn-success">➕ Agregar Usuario</a>
        </div>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">
                <?php 
                switch($_GET['success']) {
                    case 'created': echo "✅ Usuario creado exitosamente"; break;
                    case 'updated': echo "✅ Usuario actualizado exitosamente"; break;
                    case 'deleted': echo "✅ Usuario eliminado exitosamente"; break;
                    case 'enabled': echo "✅ Usuario habilitado exitosamente"; break;
                    case 'disabled': echo "✅ Usuario deshabilitado exitosamente"; break;
                }
                ?>
            </div>
        <?php endif; ?>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Fecha Creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr class="<?php echo $usuario['active'] == 0 ? 'user-inactive' : ''; ?>">
                            <td><?php echo $usuario['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($usuario['username']); ?></strong></td>
                            <td><?php echo htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellido']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                            <td>
                                <span class="role-badge role-<?php echo $usuario['role']; ?>">
                                    <?php echo strtoupper($usuario['role']); ?>
                                </span>
                            </td>
                            <td>
                                <span class="status-badge <?php echo $usuario['active'] ? 'status-active' : 'status-inactive'; ?>">
                                    <?php echo $usuario['active'] ? 'Activo' : 'Inactivo'; ?>
                                </span>
                            </td>
                            <td><?php echo date('d/m/Y', strtotime($usuario['created_at'])); ?></td>
                            <td class="actions">
                                <a href="user_form.php?id=<?php echo $usuario['id']; ?>" 
                                   class="btn btn-warning" title="Editar">✏️</a>
                                
                                <?php if ($usuario['active'] == 1): ?>
                                    <a href="user_toggle.php?id=<?php echo $usuario['id']; ?>&action=disable" 
                                       class="btn btn-secondary" title="Deshabilitar"
                                       onclick="return confirm('¿Deshabilitar este usuario?')">🔒</a>
                                <?php else: ?>
                                    <a href="user_toggle.php?id=<?php echo $usuario['id']; ?>&action=enable" 
                                       class="btn btn-success" title="Habilitar"
                                       onclick="return confirm('¿Habilitar este usuario?')">🔓</a>
                                <?php endif; ?>
                                
                                <a href="user_delete.php?id=<?php echo $usuario['id']; ?>" 
                                   class="btn btn-danger" title="Eliminar"
                                   onclick="return confirm('¿Está seguro de eliminar este usuario? Esta acción no se puede deshacer.')">🗑️</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px; text-align: center; color: #666;">
            Total de usuarios: <?php echo count($usuarios); ?>
        </div>
    </div>
</body>
</html>