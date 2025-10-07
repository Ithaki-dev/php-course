<?php
// filepath: /home/bob/Github/php-course/Clase_3/Workshop_3/login.php
$username = isset($_GET['username']) ? $_GET['username'] : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TU RAYO</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 400px;
            margin: 100px auto;
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
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
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
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #3498db;
        }
        .btn {
            background-color: #27ae60;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            margin-top: 10px;
        }
        .btn:hover {
            background-color: #219a52;
        }
        .btn-secondary {
            background-color: #95a5a6;
            margin-top: 10px;
        }
        .btn-secondary:hover {
            background-color: #7f8c8d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="company-title">🏢 Workshop 3</h1>
        <h2 style="text-align: center; color: #666;">Iniciar Sesión</h2>
        
        <?php if (!empty($username)): ?>
            <div class="success-message">
                ✅ <strong>¡Registro exitoso!</strong><br>
                Su usuario ha sido creado correctamente.
            </div>
        <?php endif; ?>
        
        <form action="#" method="POST">
            <div class="form-group">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" 
                       value="<?php echo htmlspecialchars($username); ?>" 
                       placeholder="Ingrese su usuario" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" 
                       placeholder="Ingrese su contraseña" required>
            </div>

            <button type="submit" class="btn">Iniciar Sesión</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='form.php'">
                Registrar Nuevo Empleado
            </button>
        </form>
    </div>
</body>
</html>