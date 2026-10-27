<?php
// Proyecto2/index.php: pirámide de asteriscos
function imprimir($n, $c)
{
    for ($i = 0; $i < $n; $i++)
    {
        echo $c;
    }
}

$altura = 21;
$nAst = -1;
for ($i = 1; $i <= $altura; $i++)
{
    imprimir($altura - $i, "_");
    $nAst = $nAst + 2;
    imprimir($nAst, "*");
    echo "<br/>";
}
?>
