<?php
function dibujarFruta($numero)
{
    switch ($numero)
    {
        case 1:
            return '<img src="imagenes/cereza.png" width="80">';
        case 2:
            return '<img src="imagenes/diamante.jpg" width="80">';
        case 3:
            return '<img src="imagenes/limon.png" width="80">';
        case 4:
            return '<img src="imagenes/sandia.png" width="80">';
        case 5:
            return '<img src="imagenes/herradura.jpg" width="80">';
    }
}

function calcularPremio($c1, $c2, $c3, $c4)
{

    if ($c1 === $c2 && $c1 === $c3 && $c1 === $c4)
    {
        return 100;
    }

    if ($c1 === $c2 || $c1 === $c3 || $c1 === $c4 ||
        $c2 === $c3 || $c2 === $c4 ||
        $c3 === $c4)
    {
        return 20;
    }
    return 0;
}

$bote = $_POST['bote'] ?? 1000;
$jugar = $_POST['luchar'] ?? '';
$haJugado = false;
$mensaje = "";

if ($jugar !== '')
{
    if ($bote < 15)
    {
        $mensaje = "No te queda bote para jugar";
    }
    else
    {
        $bote = $bote - 15;

        $c1 = rand(1, 5);
        $c2 = rand(1, 5);
        $c3 = rand(1, 5);
        $c4 = rand(1, 5);

        $premio = calcularPremio($c1, $c2, $c3, $c4);
        $bote = $bote + $premio;
        $haJugado = true;

        if ($premio === 100)
        {
            $mensaje = "¡TODAS IGUALES! Ganas 100";
        }
        else if ($premio === 20)
        {
            $mensaje = "¡Pareja! Ganas 20";
        }
        else
        {
            $mensaje = "Nada esta vez";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tragaperras</title>
</head>
<body>
    <h1>TRAGAPERRAS</h1>

    <form action="tragaperras.php" method="post">
        <div style="width: 500px; border: 2px solid black; padding: 10px;">

            <div style="text-align: right;">
                Bote: <?php echo $bote; ?>
            </div>

            <div style="text-align: center; margin: 20px 0;">
                <?php
                if ($haJugado)
                {
                    echo dibujarFruta($c1);
                    echo dibujarFruta($c2);
                    echo dibujarFruta($c3);
                    echo dibujarFruta($c4);
                }
                else
                {
                   
                    for ($i = 1; $i <= 4; $i++)
                    {
                        echo dibujarFruta($i);
                    }
                }
                ?>
                <p><?php echo $mensaje; ?></p>
            </div>

            <div style="display: flex; justify-content: space-between;">
                <div>
                    <?php echo '<input type="hidden" name="bote" value="' . $bote . '">'; ?>
                    <button type="submit" name="luchar" value="luchar">PLAY</button>
                </div>
                <div style="text-align: right;">
                    Todos iguales: 100<br/> 
                    1 pareja: 20<br/>
                    Jugar cuesta: 15
                </div>
            </div>

        </div>
    </form>
</body>
</html>
