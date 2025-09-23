<?php
// time.php - muestra la fecha y hora actuales usando PHP
// Encabezados recomendados
header('Content-Type: text/html; charset=utf-8');

// Ajuste de zona horaria (ajusta según tu ubicación)
date_default_timezone_set('America/Argentina/Buenos_Aires');

$now = new DateTime();
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Hora actual (PHP)</title>
  <style>
    body { font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; padding: 2rem; }
    .box { background:#f6f6f8;border:1px solid #e1e1e6;padding:1rem;border-radius:6px;display:inline-block; }
  </style>
</head>
<body>
  <h1>Hora actual (PHP)</h1>
  <div class="box">
    <strong>Fecha y hora del servidor:</strong>
    <div><?php echo $now->format('d/m/Y H:i:s'); ?></div>
    <small>Zona horaria: <?php echo $now->getTimezone()->getName(); ?></small>
  </div>
</body>
</html>
