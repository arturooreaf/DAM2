<?php
// Proyecto1/index2.php: funciones con return, mayor de 2 y de 3
function saludar($nombre, $saludo)
{
    return $saludo . $nombre;
}
echo saludar("Begoña", "Qué tal ");
echo "<br/>";

function NumeroMayor($num1, $num2)
{
    if ($num1 > $num2) return $num1;
    else return $num2;
}
echo NumeroMayor(119950, 2);    //119950
echo "<br/>";

function numeroMayor3_($num1, $num2, $num3)
{
    if ($num3 > $num2 && $num3 > $num1) return $num3;
    return NumeroMayor($num1, $num2);
}

function numeroMayor3__($num1, $num2, $num3)
{
    return NumeroMayor($num3, NumeroMayor($num1, $num2));
}

// si alguno es igual, devuelve -1
function numeroMayor3($num1, $num2, $num3)
{
    if ($num1 === $num2 || $num1 === $num3 || $num2 === $num3)
    {
        return -1;
    }
    return numeroMayor3_($num1, $num2, $num3);
}

echo numeroMayor3(1, 2, 3);     //3
echo numeroMayor3(1, 3, 2);     //3
echo numeroMayor3(3, 1, 2);     //3
echo numeroMayor3(1, 1, 2);     //-1
echo "<br/>";
echo numeroMayor3__(1, 2, 3);   //3
echo numeroMayor3__(3, 2, 1);   //3
?>
