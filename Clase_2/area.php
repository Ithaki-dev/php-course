<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Cálculo de áreas - Práctica</title>
	<style>
		body{font-family: Arial,Helvetica,sans-serif;line-height:1.6;margin:20px}
		.card{border:1px solid #ddd;padding:12px;border-radius:6px;margin-bottom:12px}
		h1,h2{color:#123}
		pre{background:#f6f6f6;padding:8px;border-radius:4px}
	</style>
</head>
<body>
	<h1>Cálculo de áreas (valores estáticos)</h1>
	<p>Esta página calcula las áreas de varias figuras usando valores estáticos y muestra los pasos del cálculo.</p>

	<?php
	// Valores estáticos (puedes cambiarlos aquí)
	$lado_cuadrado = 5;           // para cuadrado
	$base_rect = 8; $altura_rect = 3; // para rectángulo
	$base_tri = 6; $altura_tri = 4;   // para triángulo
	$radio = 2.5;                 // para círculo
	$diag1_rombo = 10; $diag2_rombo = 6; // para rombo

	// 1) Cuadrado: A = lado^2
	$area_cuadrado = $lado_cuadrado * $lado_cuadrado;

	// 2) Rectángulo: A = base * altura
	$area_rectangulo = $base_rect * $altura_rect;

	// 3) Triángulo: A = (base * altura) / 2
	$area_triangulo = ($base_tri * $altura_tri) / 2;

	// 4) Círculo: A = pi * r^2
	$pi = pi();
	$area_circulo = $pi * $radio * $radio;

	// 5) Rombo (usando diagonales): A = (d1 * d2) / 2
	$area_rombo = ($diag1_rombo * $diag2_rombo) / 2;

	// Helper para formatear números
	function f($n){
		return number_format((float)$n, 4, ',', '.');
	}
	?>

	<div class="card">
		<h2>1) Cuadrado</h2>
		<p>Valor estático: lado = <strong><?php echo $lado_cuadrado; ?></strong></p>
		<pre>
Fórmula: A = lado^2
Sustituyendo: A = <?php echo $lado_cuadrado; ?>^2
Cálculo: A = <?php echo $lado_cuadrado; ?> * <?php echo $lado_cuadrado; ?> = <?php echo f($area_cuadrado); ?>
		</pre>
	</div>

	<div class="card">
		<h2>2) Rectángulo</h2>
		<p>Valores estáticos: base = <strong><?php echo $base_rect; ?></strong>, altura = <strong><?php echo $altura_rect; ?></strong></p>
		<pre>
Fórmula: A = base * altura
Sustituyendo: A = <?php echo $base_rect; ?> * <?php echo $altura_rect; ?>
Cálculo: A = <?php echo f($area_rectangulo); ?>
		</pre>
	</div>

	<div class="card">
		<h2>3) Triángulo</h2>
		<p>Valores estáticos: base = <strong><?php echo $base_tri; ?></strong>, altura = <strong><?php echo $altura_tri; ?></strong></p>
		<pre>
Fórmula: A = (base * altura) / 2
Sustituyendo: A = (<?php echo $base_tri; ?> * <?php echo $altura_tri; ?>) / 2
Cálculo: A = <?php echo f($area_triangulo); ?>
		</pre>
	</div>

	<div class="card">
		<h2>4) Círculo</h2>
		<p>Valor estático: radio = <strong><?php echo $radio; ?></strong></p>
		<pre>
Fórmula: A = π * r^2
Usando π = <?php echo f($pi); ?>
Sustituyendo: A = <?php echo f($pi); ?> * <?php echo $radio; ?>^2
Cálculo: A = <?php echo f($area_circulo); ?>
		</pre>
	</div>

	<div class="card">
		<h2>5) Rombo</h2>
		<p>Valores estáticos (diagonales): d1 = <strong><?php echo $diag1_rombo; ?></strong>, d2 = <strong><?php echo $diag2_rombo; ?></strong></p>
		<pre>
Fórmula: A = (d1 * d2) / 2
Sustituyendo: A = (<?php echo $diag1_rombo; ?> * <?php echo $diag2_rombo; ?>) / 2
Cálculo: A = <?php echo f($area_rombo); ?>
		</pre>
	</div>

	<p>Nota: los valores son estáticos en el código fuente. Cambia las variables al inicio del archivo para probar con otros valores.</p>

</body>
</html>

