<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Tarea 1 - Suma de tres números</title>
	<style>body{font-family:Arial,Helvetica,sans-serif;margin:18px}pre{background:#f6f6f6;padding:10px;border-radius:6px}</style>
</head>
<body>
	<h1>Tarea 1: Suma de tres números (parámetros por URL)</h1>
	<p>Esta página recibe tres números por la URL y muestra su suma. Parámetros aceptados (cualquiera de estos nombres): <code>n1,n2,n3</code></p>

	<?php

	$n1 = $_GET['n1'];
	$n2 = $_GET['n2'];
	$n3 = $_GET['n3'];

	$errors = [];
	if ($n1 === null || $n2 === null || $n3 === null) {
		$errors[] = 'Faltan parámetros. Debes pasar tres números por la URL.';
	} else {
		// Validación: valores numéricos
		if (!is_numeric($n1)) $errors[] = "El valor de n1 ('$n1') no es numérico.";
		if (!is_numeric($n2)) $errors[] = "El valor de n2 ('$n2') no es numérico.";
		if (!is_numeric($n3)) $errors[] = "El valor de n3 ('$n3') no es numérico.";
	}

	if (!empty($errors)) {
		echo '<div style="border:1px solid #f2a; background:#fff2f5;padding:10px;border-radius:6px">';
		echo '<h3>Errores</h3><ul>';
		foreach ($errors as $e) echo '<li>' . htmlspecialchars($e) . '</li>';
		echo '</ul></div>';
	} else {

		$suma = $n1 + $n2 + $n3;

		echo '<div style="border:1px solid #2a9; background:#f4fff8;padding:10px;border-radius:6px">';
		echo '<h3>Resultado</h3>';
		echo '<p>Valores recibidos: <strong>' . htmlspecialchars($n1) . '</strong>, <strong>' . htmlspecialchars($n2) . '</strong>, <strong>' . htmlspecialchars($n3) . '</strong></p>';
		echo '<p>Operación: ' . number_format($n1) . ' + ' . number_format($n2) . ' + ' . number_format($n3) . ' = <strong>' . number_format($suma) . '</strong></p>';
		echo '</div>';
	}
	?>

</body>
</html>

