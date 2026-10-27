<?php
// Devuelve el número (1..$max) si el texto es válido, o 0 si no lo es
function validarNumero($texto, $max)
{
    $numero = 0;
    for ($i = 1; $i < $max; $i++)
    {
        if ($texto === "" . $i)
        {
            $numero = $i;
        }
    }
    return $numero;
}

function ganaApuesta($apuesta, $jugador, $chofi)
{
    if ($apuesta === "menor" && $jugador < $chofi)
    {
        return true;
    }
    if ($apuesta === "mayor" && $jugador > $chofi)
    {
        return true;
    }
    if ($apuesta === "iguales" && $jugador === $chofi)
    {
        return true;
    }
    return false;
}

$jugador = validarNumero($_POST['numero'] ?? '', 3);
$apuesta = $_POST['apuesta'] ?? '';
$chofi = rand(1, 3);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batalla 1</title>
</head>
<body>
    <div>
        <?php
        if ($jugador === 0)
        {
            echo "<h2>Solo se admiten 1, 2 o 3</h2>";
            echo '<form action="chofi.php" method="post"><button type="submit">← Volver atrás</button></form>';
        }
        else
        {
            echo "<h2>CHOFI SACA</h2>";
            echo "<div>$chofi</div>";

            if (ganaApuesta($apuesta, $jugador, $chofi))
            {
                echo "<h2>¡PERFECTO! CONTINÚAS</h2>";
                echo '<form action="chofo.php" method="post"><button type="submit">Continuar →</button></form>';
                echo '<form action="chofi.php" method="post"><button type="submit" disabled>← Volver atrás</button></form>';
            }
            else
            {
                echo "<h2>MUERTO</h2>";
                echo '<form action="chofo.php" method="post"><button type="submit">Continuar →</button></form>';
                echo '<form action="chofo.php" method="post"><button type="submit">← Volver atrás</button></form>';
            }
        }
        ?>
    </div>
</body>
</html>
