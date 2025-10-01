<!DOCTYPE html>
<html lang="en">
<head>
    <title>Resultados</title>
</head>
<body>
    <h1>Resultado</h1>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $operator = $_POST['operator'];
        $result = null;

        // Validación básica
        $errors = [];
        if (!is_numeric($num1)) {
            $errors[] = "El valor de Número 1 ('$num1') no es numérico.";
        }
        if (!is_numeric($num2)) {
            $errors[] = "El valor de Número 2 ('$num2') no es numérico.";
        }
        if (empty($operator)) {
            $errors[] = "No se ha seleccionado ninguna operación.";
        }   
        if ($operator === '/' && $num2 == 0) {
            $errors[] = "No se puede dividir por cero.";
        }

        if (!empty($errors)) {
            echo '<div style="border:1px solid #f2a; background:#fff2f5;padding:10px;border-radius:6px">';
            echo '<h3>Errores</h3><ul>';
            foreach ($errors as $e) {
                echo '<li>' . htmlspecialchars($e) . '</li>';
            }
            echo '</ul></div>';
        } else {
            // Realizar la operación
            switch ($operator) {
                case '+':
                    $result = $num1 + $num2;
                    break;
                case '-':
                    $result = $num1 - $num2;
                    break;
                case '*':
                    $result = $num1 * $num2;
                    break;
                case '/':
                    $result = $num1 / $num2;
                    break;
                default:
                    echo "<p>Operación no válida.</p>";
                    exit;
            }

            // Mostrar el resultado
            echo "<p>El resultado de " . htmlspecialchars($num1) . " " . htmlspecialchars($operator) . " " . htmlspecialchars($num2) . " es: <strong>" . htmlspecialchars($result) . "</strong></p>";
        }
    } else {
        echo "<p>No se recibieron datos. Por favor, <a href='numeros.php'>complete el formulario</a> primero.</p>";
    }
    ?>  

</body>
</html>