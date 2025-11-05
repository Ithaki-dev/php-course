<?php
require_once 'config/database.php';

// PASO 1: Obtener datos de la base de datos
try {
    $stmt = $pdo->query("SELECT * FROM ventas ORDER BY fecha");
    $ventas_bd = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error al consultar la base de datos: " . $e->getMessage());
}

// PASO 2: Crear arreglo con cálculos adicionales
$ventas_procesadas = [];
$total_ventas = 0;
$total_impuestos = 0;

foreach ($ventas_bd as $venta) {
    // Calcular monto por unidad
    $monto_por_unidad = $venta['monto_total_venta'] / $venta['cantidad_elementos'];
    
    // Calcular impuesto (13% si es gravado, 0% si no)
    $impuesto = 0;
    if ($venta['es_gravado'] == 1) {
        $impuesto = $venta['monto_total_venta'] * 0.13;
    }
    
    // Crear registro procesado con todos los datos
    $registro = [
        'id' => $venta['id'],
        'fecha' => $venta['fecha'],
        'cantidad_elementos' => $venta['cantidad_elementos'],
        'monto_por_unidad' => $monto_por_unidad,
        'monto_total_venta' => $venta['monto_total_venta'],
        'es_gravado' => $venta['es_gravado'],
        'impuesto' => $impuesto
    ];
    
    // Agregar al arreglo procesado
    $ventas_procesadas[] = $registro;
    
    // Acumular totales
    $total_ventas += $venta['monto_total_venta'];
    $total_impuestos += $impuesto;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 5-1 - Sistema de Ventas</title>
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
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }
        .info-box {
            background: #e3f2fd;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #2196F3;
        }
        .info-box p {
            margin: 5px 0;
            color: #1976D2;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #34495e;
            color: white;
            font-weight: bold;
            text-align: center;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        tr:hover {
            background-color: #e9ecef;
        }
        td {
            text-align: right;
        }
        td:first-child,
        td:nth-child(2) {
            text-align: center;
        }
        .gravado-si {
            background-color: #d4edda;
            color: #155724;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
        }
        .gravado-no {
            background-color: #fff3cd;
            color: #856404;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
        }
        .total-row {
            background-color: #2c3e50 !important;
            color: white;
            font-weight: bold;
            font-size: 16px;
        }
        .total-row td {
            border-top: 3px solid #34495e;
        }
        .currency {
            font-family: 'Courier New', monospace;
        }
        .section-title {
            background-color: #3498db;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin: 20px 0 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📊 Práctica 5-1: Sistema de Visualización de Ventas con Impuestos</h1>
        
        <div class="info-box">
            <p><strong>Total de registros:</strong> <?php echo count($ventas_procesadas); ?></p>
            <p><strong>Impuesto aplicado:</strong> 13% sobre productos gravados</p>
            <p><strong>Nota:</strong> Los productos NO gravados están exentos de impuesto</p>
        </div>

        <h2 class="section-title">Tabla de Ventas Procesadas</h2>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Cantidad<br>Elementos</th>
                    <th>Monto por<br>Unidad</th>
                    <th>Monto Total<br>Venta</th>
                    <th>Gravado</th>
                    <th>Impuesto<br>(13%)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ventas_procesadas as $venta): ?>
                    <tr>
                        <td><?php echo $venta['id']; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($venta['fecha'])); ?></td>
                        <td><?php echo number_format($venta['cantidad_elementos'], 0); ?></td>
                        <td class="currency">
                            ₡<?php echo number_format($venta['monto_por_unidad'], 2); ?>
                        </td>
                        <td class="currency">
                            ₡<?php echo number_format($venta['monto_total_venta'], 2); ?>
                        </td>
                        <td style="text-align: center;">
                            <?php if ($venta['es_gravado'] == 1): ?>
                                <span class="gravado-si">SÍ</span>
                            <?php else: ?>
                                <span class="gravado-no">NO</span>
                            <?php endif; ?>
                        </td>
                        <td class="currency">
                            ₡<?php echo number_format($venta['impuesto'], 2); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                
                <!-- FILA DE TOTALES -->
                <tr class="total-row">
                    <td colspan="4">TOTALES</td>
                    <td class="currency">
                        ₡<?php echo number_format($total_ventas, 2); ?>
                    </td>
                    <td>-</td>
                    <td class="currency">
                        ₡<?php echo number_format($total_impuestos, 2); ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <div style="margin-top: 30px; padding: 20px; background-color: #f8f9fa; border-radius: 5px;">
            <h3 style="color: #2c3e50; margin-bottom: 15px;">📈 Resumen de Operaciones</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px;">
                <div style="background: white; padding: 15px; border-radius: 5px; border-left: 4px solid #3498db;">
                    <strong>Total Ventas:</strong><br>
                    <span class="currency" style="font-size: 20px; color: #3498db;">
                        ₡<?php echo number_format($total_ventas, 2); ?>
                    </span>
                </div>
                <div style="background: white; padding: 15px; border-radius: 5px; border-left: 4px solid #e74c3c;">
                    <strong>Total Impuestos:</strong><br>
                    <span class="currency" style="font-size: 20px; color: #e74c3c;">
                        ₡<?php echo number_format($total_impuestos, 2); ?>
                    </span>
                </div>
                <div style="background: white; padding: 15px; border-radius: 5px; border-left: 4px solid #27ae60;">
                    <strong>Total Neto (sin impuesto):</strong><br>
                    <span class="currency" style="font-size: 20px; color: #27ae60;">
                        ₡<?php echo number_format($total_ventas - $total_impuestos, 2); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>