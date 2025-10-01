<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Empleados - TU RAYO</title>
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
        // Configurar timezone para Colombia (ajusta según tu ubicación)
        date_default_timezone_set('America/Bogota');
        echo "Fecha: " . date('d/m/Y');
        ?>
    </div>

    <div class="container">
        <h1 class="company-title">🏢 EMPRESA TU RAYO</h1>
        <h2 style="text-align: center; color: #666;">Registro de Empleados</h2>
        
        <form action="process.php" method="POST">
            <div class="form-group">
                <label for="identificacion">Identificación <span class="required">*</span></label>
                <input type="number" id="identificacion" name="identificacion" 
                       placeholder="Ingrese el número de identificación" required>
            </div>

            <div class="form-group">
                <label for="nombre">Nombre <span class="required">*</span></label>
                <input type="text" id="nombre" name="nombre" 
                       placeholder="Ingrese el nombre" required>
            </div>

            <div class="form-group">
                <label for="primer_apellido">Primer Apellido <span class="required">*</span></label>
                <input type="text" id="primer_apellido" name="primer_apellido" 
                       placeholder="Ingrese el primer apellido" required>
            </div>

            <div class="form-group">
                <label for="segundo_apellido">Segundo Apellido <span class="required">*</span></label>
                <input type="text" id="segundo_apellido" name="segundo_apellido" 
                       placeholder="Ingrese el segundo apellido" required>
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

            <button type="submit" class="btn">Registrar Empleado</button>
        </form>
    </div>
</body>
</html>