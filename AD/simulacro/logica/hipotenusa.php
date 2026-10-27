<?php
// Proyecto1/index3.php: parámetros por defecto y paso por referencia
function hipotenusa($cateto = 3, $cateto2 = 4)
{
    return sqrt($cateto * $cateto + $cateto2 * $cateto2);
}
echo hipotenusa();          //5
echo "<br/>";
echo hipotenusa(6, 8);      //10
echo "<br/>";

function calcularHipotenusa($lado1, $lado2, &$hipotenusa)
{
    $suma = ($lado1 * $lado1) + ($lado2 * $lado2);
    $hipotenusa = sqrt($suma);
}
calcularHipotenusa(5, 6, $hipo);
echo "la hipotenusa es: $hipo";
echo "<br/>";

// sin &: la función trabaja con una copia, hay que recoger el return
function f($n)
{
    $n = $n + 1;
    return $n;
}
$n = 0;
$n = f($n);
echo "n es $n";             //1
?>
