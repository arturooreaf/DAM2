<?php

function validarNumero($texto, $max)
{
    $numero = 0;
    for ($i = 1; $i <= $max; $i++)
    {
        if ($texto === "" . $i)
        {
            $numero = $i;
        }
    }
    return $numero;
}

function distancia($a, $b)
{
    $d = $a - $b;
    return $d;
}

function aciertaApuesta($apuesta, $jugador, $chofo)
{
    $d = distancia($jugador, $chofo);
    if ($apuesta === "dif1" && $d === 1)
    {
        return true;
    }
    if ($apuesta === "dif2" && $d === 2)
    {
        return true;
    }
    if ($apuesta === "iguales" && $d === 0)
    {
        return true;
    }
    return false;
}

$jugador = validarNumero($_POST['numero'] ?? '', 10);
$apuesta1 = $_POST['apuesta1'] ?? '';
$apuesta2 = $_POST['apuesta2'];
$chofo = rand(1, 10);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batalla final</title>

</head>
<body>
    <div>
        <?php
        if ($jugador === 0)
        {
            echo "<h2>Escribe un número del 1 al 10</h2>";
            echo '<form action="chofo.php" method="post"><button type="submit">← Volver atrás</button></form>';
        }
        else
        {
            echo "<h2>CHOFO SACA</h2>";
            echo "<div>$chofo</div>";

            if (aciertaApuesta($apuesta1, $jugador, $chofo) || aciertaApuesta($apuesta2, $jugador, $chofo))
            {
                echo "<h1>¡EDB!</h1>";
                echo "<p>¡Enhorabuena De la Buena!</p>";
            }
            else
            {
                echo "<h1>OHHHH!!</h1>";
                echo "<p>Has perdido</p>";
            }
        }
        ?>
    </div>
</body>
</html>
