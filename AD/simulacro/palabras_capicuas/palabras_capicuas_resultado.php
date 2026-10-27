<?php
function letraAleatoria()
{
    $letras = "abcdefghijklmnñopqrstuvwxyz";
    $posicion = rand(0, mb_strlen($letras) - 1);
    return mb_substr($letras, $posicion, 1);
}

function palabraAleatoria($tam, &$enies)
{
    $palabra = "";
    for ($i = 0; $i < $tam; $i++)
    {
        $letra = letraAleatoria();
        if ($letra === "ñ")
        {
            $enies++;
        }
        $palabra .= $letra;
    }
    return $palabra;
}

function invertir($texto)
{
    $invertido = "";
    for ($i = mb_strlen($texto) - 1; $i >= 0; $i--)
    {
        $invertido .= mb_substr($texto, $i, 1);
    }
    return $invertido;
}

function empiezaPorVocal($palabra)
{
    $primera = mb_substr($palabra, 0, 1);
    if ($primera === "a" || $primera === "e" || $primera === "i" || $primera === "o" || $primera === "u")
    {
        return true;
    }
    return false;
}

$cantidad = $_POST['cantidad'];
$tamano = $_POST['tamano'];
$capicuas = $_POST['capicuas'] ?? '';
$enies = 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
</head>
<body>
    <ul>
        <?php
            for ($i = 0; $i < $cantidad; $i++)
            {
                $eniesPalabra = 0;
                $palabra = palabraAleatoria($tamano, $eniesPalabra);

                if ($capicuas !== '')
                {
                    $palabra = $palabra . invertir($palabra);
                    $eniesPalabra = $eniesPalabra * 2;
                }
                $enies = $enies + $eniesPalabra;

                if (empiezaPorVocal($palabra))
                {
                    echo "<li><b>$palabra</b></li>";
                }
                else
                {
                    echo "<li>$palabra</li>";
                }
            }
        ?>
    </ul>
    <p>Han salido <?php echo $enies; ?> ñ en total.</p>
</body>
</html>
