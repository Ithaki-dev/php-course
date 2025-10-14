<?php
// filepath: /home/bob/Github/php-course/Clase_4/Workshop_4/admin/dashboard.php
require_once '../auth/require_admin.php';
require_once '../config/database.php';

// Estadísticas
$stmt = $pdo->query("SELECT COUNT(*) as total FROM usuarios");
$total_users = $stmt->fetch()['total'];

$stmt = $pdo->query("SELECT COUNT(*) as total FROM usuarios WHERE active = 1");
$active_users = $stmt->fetch()['total'];

$stmt = $pdo->query("SELECT COUNT(*) as total FROM usuarios WHERE active = 0");
$inactive_users = $stmt->fetch()['total'];

$stmt = $pdo->query("SELECT COUNT(*) as total FROM usuarios WHERE role = 'admin'");
$admin_users = $stmt->fetch()['total'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Workshop 4</title>
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
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .stat-card h3 {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .stat-card .number {
            font-size: 36px;
            font-weight: bold;
            color: #667eea;
        }
        .actions-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .actions-card h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        .btn {
            padding: 15px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: transform 0.2s;
        }
        .btn:hover {
            transform: translateY(-2px);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-success {
            background: #27ae60;
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>🏢 Sistema de Gestión - Workshop 4</h1>
        <div class="navbar-user">
            <span>👤 <?php echo htmlspecialchars($_SESSION['nombre']); ?> (<?php echo $_SESSION['role']; ?>)</span>
            <a href="../auth/logout.php">🚪 Cerrar Sesión</a>
        </div>
    </nav>

    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <h3>TOTAL DE USUARIOS</h3>
                <div class="number"><?php echo $total_users; ?></div>
            </div>
            <div class="stat-card">
                <h3>USUARIOS ACTIVOS</h3>
                <div class="number" style="color: #27ae60;"><?php echo $active_users; ?></div>
            </div>
            <div class="stat-card">
                <h3>USUARIOS INACTIVOS</h3>
                <div class="number" style="color: #e74c3c;"><?php echo $inactive_users; ?></div>
            </div>
            <div class="stat-card">
                <h3>ADMINISTRADORES</h3>
                <div class="number" style="color: #f39c12;"><?php echo $admin_users; ?></div>
            </div>
        </div>

        <div class="actions-card">
            <h2>Acciones Rápidas</h2>
            <div class="action-buttons">
                <a href="users_list.php" class="btn btn-primary">📋 Ver Todos los Usuarios</a>
                <a href="user_form.php" class="btn btn-success">➕ Agregar Nuevo Usuario</a>
            </div>
        </div>
    </div>
</body>
</html>