<?php
// Proyecto2/index3.php (con la lista <ul> que pide el enunciado de index12.php)
function letraAleatoria()
{
    $todasLetras = "abcdefghijklmnñopqrstuvwxyz";
    $rr = rand(0, mb_strlen($todasLetras) - 1);
    return mb_substr($todasLetras, $rr, 1);
}

function palabraAletoria($tam)
{
    $palabro = "";
    for ($i = 0; $i < $tam; $i++)
    {
        $palabro .= letraAleatoria();
    }
    return $palabro;
}
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
    for ($i = 0; $i < $_POST['numeros']; $i++)
    {
        echo "<li>" . palabraAletoria($_POST['tam']) . "</li>";
    }
    ?>
    </ul>
</body>
</html>
