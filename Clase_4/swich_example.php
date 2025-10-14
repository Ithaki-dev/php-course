<?php
$dia = "Lunes";

switch ($dia) {
    case "Lunes":
        echo "Hoy es lunes, inicio de semana.";
        break;
    case "Martes":
        echo "Hoy es martes, segundo día de la semana.";
        break;
    case "Miércoles":
        echo "Hoy es miércoles, mitad de semana.";
        break;
    case "Jueves":
        echo "Hoy es jueves, casi fin de semana.";
        break;
    case "Viernes":
        echo "Hoy es viernes, último día laboral.";
        break;
    case "Sábado":
    case "Domingo":
        echo "Es fin de semana, ¡a descansar!";
        break;
    default:
        echo "Día no válido.";
        break;
}   

?>