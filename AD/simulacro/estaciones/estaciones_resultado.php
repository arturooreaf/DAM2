<?php
function strMes($mes)
{
    return "El mes $mes corresponde a la estación ";
}

$mes = strtolower($_POST['mes']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
</head>
<body>
    <h1>ESTACIÓN Y HORÓSCOPO</h1>
    <?php
    switch ($mes)
    {
        case "enero":
        case "febrero":
        case "marzo":
            echo strMes($mes) . "INVIERNO";
            if ($mes === "enero")
                echo " y el horóscopo es CAPRICORNIO";
            else if ($mes === "febrero")
                echo " y el horóscopo es ACUARIO";
            else if ($mes === "marzo")
                echo " y el horóscopo es PISCIS";
            break;

        case "abril":
        case "mayo":
        case "junio":
            echo strMes($mes) . "PRIMAVERA";
            if ($mes === "abril")
                echo " y el horóscopo es ARIES";
            else if ($mes === "mayo")
                echo " y el horóscopo es TAURO";
            else if ($mes === "junio")
                echo " y el horóscopo es GÉMINIS";
            break;

        case "julio":
        case "agosto":
        case "septiembre":
            echo strMes($mes) . "VERANO";
            if ($mes === "julio")
                echo " y el horóscopo es CÁNCER";
            else if ($mes === "agosto")
                echo " y el horóscopo es LEO";
            else if ($mes === "septiembre")
                echo " y el horóscopo es VIRGO";
            break;

        case "octubre":
        case "noviembre":
        case "diciembre":
            echo strMes($mes) . "OTOÑO";
            if ($mes === "octubre")
                echo " y el horóscopo es LIBRA";
            else if ($mes === "noviembre")
                echo " y el horóscopo es ESCORPIO";
            else if ($mes === "diciembre")
                echo " y el horóscopo es SAGITARIO";
            break;

        default:
            echo "No has escrito un mes";
    }
    ?>
</body>
</html>
