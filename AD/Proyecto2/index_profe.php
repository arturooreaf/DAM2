<?php
function imprimir($n,$c)
{
    for ($i=0; $i < $n; $i++)
    {
        echo $c;
    }
}
$altura = 21;
$nAst = -1;
for ($i=1; $i <= $altura; $i++)
{
    imprimir($altura-$i,"_");
    $nAst=$nAst+2;
    imprimir($nAst,"*");
    echo "<br/>";

 /*   Un menú desplegable con varios números de 1 a 100 y otro con numeros entre 3-6 (para el tamaño de las palabras)

Al enviarlo, otra página genera una lista no ordenada HTML con palabras aleatorias tantas como el número elegido.
*/

}

?>