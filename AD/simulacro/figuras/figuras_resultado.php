<?php
function imprimir($n, $c, &$total)
{
    for ($i = 0; $i < $n; $i++)
    {
        echo $c;
        $total++;
    }
}

$altura = $_POST['altura'];
$caracter = $_POST['caracter'];
$piramide = $_POST['piramide'] ?? '';
$escalera = $_POST['escalera'] ?? '';
$invertida = $_POST['invertida'] ?? '';

$total = 0;      // caracteres dibujados
$relleno = 0;    // los "_" van a otro contador para no contarlos
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
</head>
<body>
    <?php
    if ($caracter === "" || mb_strlen($caracter) > 1)
    {
        echo "Escribe un solo carácter";
    }
    else
    {
        if ($piramide !== '')
        {
            for ($i = 1; $i <= $altura; $i++)
            {
                imprimir($altura - $i, "_", $relleno);
                imprimir(2 * $i - 1, $caracter, $total);
                echo "<br/>";
            }
        }
        else if ($escalera !== '')
        {
            for ($i = 1; $i <= $altura; $i++)
            {
                imprimir($i, $caracter, $total);
                echo "<br/>";
            }
        }
        else if ($invertida !== '')
        {
            for ($i = $altura; $i >= 1; $i--)
            {
                imprimir($altura - $i, "_", $relleno);
                imprimir(2 * $i - 1, $caracter, $total);
                echo "<br/>";
            }
        }

        echo "<p>Caracteres dibujados: $total</p>";

        switch ($altura)
        {
            case 1:
            case 2:
            case 3:
                echo "Figura pequeña";
                break;
            case 4:
            case 5:
            case 6:
            case 7:
            case 8:
                echo "Figura mediana";
                break;
            default:
                echo "Figura grande";
        }
    }
    ?>
</body>
</html>
