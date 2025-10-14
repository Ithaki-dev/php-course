<?php
// filepath: /home/bob/Github/php-course/Clase_4/Workshop_4/admin/user_form.php
require_once '../auth/require_admin.php';
require_once '../config/database.php';

$usuario = null;
$isEdit = false;

if (isset($_GET['id'])) {
    $isEdit = true;
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $usuario = $stmt->fetch();
    
    if (!$usuario) {
        header("Location: users_list.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $isEdit ? 'Editar' : 'Agregar'; ?> Usuario - Workshop 4</title>
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
            max-width: 600px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #667eea;
        }
        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            margin: 5px;
        }
        .btn-success {
            background: #27ae60;
            color: white;
        }
        .btn-secondary {
            background: #95a5a6;
            color: white;
        }
        .form-actions {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        .required {
            color: #e74c3c;
        }
        .help-text {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1><?php echo $isEdit ? '✏️ Editar' : '➕ Agregar'; ?> Usuario</h1>
        <a href="users_list.php">← Volver al Listado</a>
    </nav>

    <div class="container">
        <form action="user_process.php" method="POST">
            <?php if ($isEdit): ?>
                <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
            <?php endif; ?>

            <div class="form-group">
                <label for="username">Nombre de Usuario <span class="required">*</span></label>
                <input type="text" id="username" name="username" 
                       value="<?php echo $usuario ? htmlspecialchars($usuario['username']) : ''; ?>"
                       placeholder="Ej: juan.perez" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña <?php echo $isEdit ? '' : '<span class="required">*</span>'; ?></label>
                <input type="password" id="password" name="password" 
                       placeholder="<?php echo $isEdit ? 'Dejar en blanco para mantener la actual' : 'Contraseña segura'; ?>"
                       <?php echo $isEdit ? '' : 'required'; ?>>
                <?php if ($isEdit): ?>
                    <div class="help-text">Dejar en blanco si no desea cambiar la contraseña</div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="nombre">Nombre <span class="required">*</span></label>
                <input type="text" id="nombre" name="nombre" 
                       value="<?php echo $usuario ? htmlspecialchars($usuario['nombre']) : ''; ?>"
                       placeholder="Nombre del usuario" required>
            </div>

            <div class="form-group">
                <label for="apellido">Apellido <span class="required">*</span></label>
                <input type="text" id="apellido" name="apellido" 
                       value="<?php echo $usuario ? htmlspecialchars($usuario['apellido']) : ''; ?>"
                       placeholder="Apellido del usuario" required>
            </div>

            <div class="form-group">
                <label for="email">Email <span class="required">*</span></label>
                <input type="email" id="email" name="email" 
                       value="<?php echo $usuario ? htmlspecialchars($usuario['email']) : ''; ?>"
                       placeholder="correo@ejemplo.com" required>
            </div>

            <div class="form-group">
                <label for="role">Rol <span class="required">*</span></label>
                <select id="role" name="role" required>
                    <option value="user" <?php echo ($usuario && $usuario['role'] == 'user') ? 'selected' : ''; ?>>Usuario</option>
                    <option value="admin" <?php echo ($usuario && $usuario['role'] == 'admin') ? 'selected' : ''; ?>>Administrador</option>
                </select>
            </div>

            <div class="form-group">
                <label for="active">Estado <span class="required">*</span></label>
                <select id="active" name="active" required>
                    <option value="1" <?php echo (!$usuario || $usuario['active'] == 1) ? 'selected' : ''; ?>>Activo</option>
                    <option value="0" <?php echo ($usuario && $usuario['active'] == 0) ? 'selected' : ''; ?>>Inactivo</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success">
                    <?php echo $isEdit ? '💾 Actualizar' : '➕ Crear'; ?> Usuario
                </button>
                <a href="users_list.php" class="btn btn-secondary">❌ Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>