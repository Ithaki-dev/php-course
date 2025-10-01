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

    <div class="container">
        <h1 class="company-title">CALCULADORA</h1>
        <h2 style="text-align: center; color: #666;">Ingrese los números</h2>
        
        <form action="process.php" method="POST">
            <div class="form-group">
                <label for="num1">Número 1: <span class="required">*</span></label>
                <input type="number" id="num1" name="num1" required>
            </div>

            <div class="form-group">
                <label for="num2">Número 2: <span class="required">*</span></label>
                <input type="number" id="num2" name="num2" required>
            </div>

            <div class="form-group">
                <select id="operator" name="operator" required>
                    <option value="">Seleccione una operación</option>
                    <option value="+">Suma (+)</option>
                    <option value="-">Resta (-)</option>
                    <option value="*">Multiplicación (*)</option>
                    <option value="/">División (/)</option>
                </select>
            <button type="submit" class="btn">Calcular</button>
        </form>
    </div>
</body>
</html>