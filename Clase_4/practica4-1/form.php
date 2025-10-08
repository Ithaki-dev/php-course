<?php
// filepath: /home/bob/Github/php-course/Clase_5/CRUD_Tecnologia/form.php
require_once 'config/database.php';

$dispositivo = null;
$isEdit = false;

// Si es edición, cargar datos existentes
if (isset($_GET['id'])) {
    $isEdit = true;
    try {
        $stmt = $pdo->prepare("SELECT * FROM dispositivos WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $dispositivo = $stmt->fetch();
        
        if (!$dispositivo) {
            header("Location: index.php");
            exit();
        }
    } catch (PDOException $e) {
        $error = "Error al cargar dispositivo: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $isEdit ? 'Editar' : 'Agregar'; ?> Dispositivo</title>
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
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #eee;
        }
        h1 {
            color: #2c3e50;
            font-size: 24px;
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
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #3498db;
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
            transition: all 0.3s;
        }
        .btn-success {
            background-color: #27ae60;
            color: white;
        }
        .btn-success:hover {
            background-color: #219a52;
        }
        .btn-secondary {
            background-color: #95a5a6;
            color: white;
        }
        .btn-secondary:hover {
            background-color: #7f8c8d;
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
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><?php echo $isEdit ? '✏️ Editar' : '➕ Agregar'; ?> Dispositivo Tecnológico</h1>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert-error">❌ <?php echo $error; ?></div>
        <?php endif; ?>

        <form action="process.php" method="POST">
            <?php if ($isEdit): ?>
                <input type="hidden" name="id" value="<?php echo $dispositivo['id']; ?>">
            <?php endif; ?>

            <div class="form-group">
                <label for="marca">Marca <span class="required">*</span></label>
                <input type="text" id="marca" name="marca" 
                       value="<?php echo $dispositivo ? htmlspecialchars($dispositivo['marca']) : ''; ?>"
                       placeholder="Ej: Dell, Apple, HP, Lenovo..." required>
            </div>

            <div class="form-group">
                <label for="modelo">Modelo <span class="required">*</span></label>
                <input type="text" id="modelo" name="modelo" 
                       value="<?php echo $dispositivo ? htmlspecialchars($dispositivo['modelo']) : ''; ?>"
                       placeholder="Ej: Latitude 5520, iPhone 15, LaserJet Pro..." required>
            </div>

            <div class="form-group">
                <label for="tipo">Tipo de Dispositivo <span class="required">*</span></label>
                <select id="tipo" name="tipo" required>
                    <option value="">Seleccione el tipo</option>
                    <option value="Laptop" <?php echo ($dispositivo && $dispositivo['tipo'] == 'Laptop') ? 'selected' : ''; ?>>Laptop</option>
                    <option value="Desktop" <?php echo ($dispositivo && $dispositivo['tipo'] == 'Desktop') ? 'selected' : ''; ?>>Computadora de Escritorio</option>
                    <option value="Teléfono" <?php echo ($dispositivo && $dispositivo['tipo'] == 'Teléfono') ? 'selected' : ''; ?>>Teléfono/Móvil</option>
                    <option value="Tablet" <?php echo ($dispositivo && $dispositivo['tipo'] == 'Tablet') ? 'selected' : ''; ?>>Tablet</option>
                    <option value="Impresora" <?php echo ($dispositivo && $dispositivo['tipo'] == 'Impresora') ? 'selected' : ''; ?>>Impresora</option>
                    <option value="Monitor" <?php echo ($dispositivo && $dispositivo['tipo'] == 'Monitor') ? 'selected' : ''; ?>>Monitor</option>
                    <option value="Router" <?php echo ($dispositivo && $dispositivo['tipo'] == 'Router') ? 'selected' : ''; ?>>Router/Networking</option>
                    <option value="Software" <?php echo ($dispositivo && $dispositivo['tipo'] == 'Software') ? 'selected' : ''; ?>>Software/Licencia</option>
                </select>
            </div>

            <div class="form-group">
                <label for="fecha_ingreso">Fecha de Ingreso <span class="required">*</span></label>
                <input type="date" id="fecha_ingreso" name="fecha_ingreso" 
                       value="<?php echo $dispositivo ? $dispositivo['fecha_ingreso'] : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="departamento">Departamento <span class="required">*</span></label>
                <select id="departamento" name="departamento" required>
                    <option value="">Seleccione el departamento</option>
                    <option value="TI" <?php echo ($dispositivo && $dispositivo['departamento'] == 'TI') ? 'selected' : ''; ?>>Tecnología de la Información</option>
                    <option value="Gerencia" <?php echo ($dispositivo && $dispositivo['departamento'] == 'Gerencia') ? 'selected' : ''; ?>>Gerencia</option>
                    <option value="Ventas" <?php echo ($dispositivo && $dispositivo['departamento'] == 'Ventas') ? 'selected' : ''; ?>>Ventas</option>
                    <option value="Contabilidad" <?php echo ($dispositivo && $dispositivo['departamento'] == 'Contabilidad') ? 'selected' : ''; ?>>Contabilidad</option>
                    <option value="Administrativo" <?php echo ($dispositivo && $dispositivo['departamento'] == 'Administrativo') ? 'selected' : ''; ?>>Administrativo</option>
                    <option value="RRHH" <?php echo ($dispositivo && $dispositivo['departamento'] == 'RRHH') ? 'selected' : ''; ?>>Recursos Humanos</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success">
                    <?php echo $isEdit ? '💾 Actualizar' : '➕ Crear'; ?> Dispositivo
                </button>
                <a href="index.php" class="btn btn-secondary">❌ Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>