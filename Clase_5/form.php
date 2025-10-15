
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Subida de archivos - Práctica</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; line-height: 1.6; margin: 20px; }
        h1 { color: #123; }
        form { border: 1px solid #ddd; padding: 12px; border-radius: 6px; max-width: 400px; }
        input[type="file"] { margin-bottom: 10px; }
        button { padding: 8px 16px; border: none; border-radius: 4px; background-color: #28a745; color: white; cursor: pointer; }
        button:hover { background-color: #218838; }
    </style>
</head>
<body>
    <h1>Subida de archivos</h1>
    <p>Usa el siguiente formulario para subir un archivo al servidor. El archivo se guardará en la carpeta <code>uploads/</code> dentro del directorio actual.</p>
<form action ="upload.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="archivo">
    <button type="submit">Subir archivo</button>
</form>
    <p>Una vez subido, podrás ver el archivo en la carpeta <code>uploads/</code>.</p>
</body>
</html>