<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <h1>ESTACIÓN Y HORÓSCOPO</h1>

    <?php 

        $mes = strtolower($_POST["mes"]);
        function strMes($mes)
        {
            return "El mes $mes corresponde a la estación ";
        }

        switch($mes)
        {
            case "abril":
            case "mayo":
            case "junio":
                echo strMes($mes) . "PRIMAVERA";
                if($mes === "abril")
                    echo " y el horóscopo es ARIES";
                else if($mes === "mayo")
                    echo " y el horóscopo es TAURO";
                else if($mes === "junio")
                    echo " y el horóscopo es GÉMENIS";
                break;

            case "enero":
            case "febrero":
            case "marzo":
                echo strMes($mes) . "PRIMAVERA";
                if($mes === "enero")
                    echo " y el horóscopo es CAPRICORNIO";
                else if($mes === "febrero")
                    echo " y el horóscopo es ACUARIO";
                else if($mes === "marzo")
                    echo " y el horóscopo es PISCIS";
                break;
            default:
                echo "No has escrito un mes";
        }
    ?>
</body>
</html>