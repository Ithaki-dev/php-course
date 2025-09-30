<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Workshop 2 - Registro de Usuarios</title>
    <style>
        body { font-family: Arial; margin: 50px; }
        .form-group { margin: 15px 0; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input { width: 300px; padding: 8px; border: 1px solid #ddd; }
        button { padding: 10px 20px; background: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
    <h1>Registro de Usuarios</h1>
    <h2>Workshop 2</h2>
    
    <form action="process/insert_data.php" method="POST">
        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="nombre" required>
        </div>
        
        <div class="form-group">
            <label>Apellido:</label>
            <input type="text" name="apellido" required>
        </div>
        
        <div class="form-group">
            <label>Correo Electrónico:</label>
            <input type="email" name="correo" required>
        </div>
        
        <div class="form-group">
            <label>Teléfono:</label>
            <input type="tel" name="telefono" required>
        </div>
        
        <button type="submit">Registrar Usuario</button>
    </form>
    
    <br><br>
    <a href="view_users.php">Ver Todos los Usuarios</a>
</body>
</html>