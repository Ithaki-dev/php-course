<?php
// filepath: /home/bob/Github/php-course/Clase_3/Workshop_3/form.php
require_once 'config/database.php';

// Obtener provincias de la base de datos
try {
    $stmt = $conn->query("SELECT id, nombre FROM provincia ORDER BY nombre");
    $provincias = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error al cargar provincias: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Empleados </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .header {
            text-align: right;
            margin-bottom: 20px;
            font-weight: bold;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .company-title {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
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
        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus {
            outline: none;
            border-color: #3498db;
        }
        .btn {
            background-color: #3498db;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #2980b9;
        }
        .required {
            color: red;
        }
    </style>
</head>
<body>
    <!-- Fecha en la parte superior derecha -->
    <div class="header">
        <?php
        date_default_timezone_set('America/Costa_Rica');
        echo "Fecha: " . date('d/m/Y');
        ?>
    </div>

    <div class="container">
        <h1 style="text-align: center; color: #666;">Registro de Empleados - Workshop 3</h2>
        
        <form action="process.php" method="POST">
            <div class="form-group">
                <label for="identificacion">Identificación <span class="required">*</span></label>
                <input type="text" id="identificacion" name="identificacion" 
                       placeholder="Ingrese el número de identificación" required>
            </div>

            <div class="form-group">
                <label for="nombre">Nombre <span class="required">*</span></label>
                <input type="text" id="nombre" name="nombre" 
                       placeholder="Ingrese el nombre completo" required>
            </div>

            <div class="form-group">
                <label for="apellidos">Apellidos <span class="required">*</span></label>
                <input type="text" id="apellidos" name="apellidos" 
                       placeholder="Ingrese los apellidos" required>
            </div>

            <div class="form-group">
                <label for="departamento">Departamento <span class="required">*</span></label>
                <select id="departamento" name="departamento" required>
                    <option value="">Seleccione un departamento</option>
                    <option value="Financiero">Financiero</option>
                    <option value="Gerencia">Gerencia</option>
                    <option value="Ventas">Ventas</option>
                    <option value="TI">TI (Tecnología de la Información)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="provincia">Provincia <span class="required">*</span></label>
                <select id="provincia" name="provincia" required>
                    <option value="">Seleccione una provincia</option>
                    <?php foreach ($provincias as $provincia): ?>
                        <option value="<?php echo $provincia['id']; ?>">
                            <?php echo htmlspecialchars($provincia['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn">Registrar Empleado</button>
        </form>
    </div>
</body>
</html>