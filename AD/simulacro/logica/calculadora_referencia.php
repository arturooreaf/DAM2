<?php
// Proyecto1/index4.php: calculadora con el resultado por referencia
function calcular($num1, $num2, $operador, &$resultado)
{
    if ($operador === "+")
        $resultado = $num1 + $num2;
    else if ($operador === "-")
        $resultado = $num1 - $num2;
    else if ($operador === "*")
        $resultado = $num1 * $num2;
    else if ($operador === "/")
    {
        if ($num2 === 0)
            $resultado = "No se puede dividir por 0";
        else
            $resultado = $num1 / $num2;
    }
}

$resultado = 0;
calcular(1, 3, "+", $resultado);
echo $resultado . "<br>";

calcular(1, 3, "-", $resultado);
echo $resultado . "<br>";

calcular(1, 3, "*", $resultado);
echo $resultado . "<br>";

calcular(1, 3, "/", $resultado);
echo $resultado . "<br>";

calcular(1, 0, "/", $resultado);
echo $resultado . "<br>";
?>
