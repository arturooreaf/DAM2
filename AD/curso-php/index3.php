<?php


function hipotenusa($cateto1, $cateto2){


return sqrt($cateto1*$cateto1 + $cateto2* $cateto2);



}
echo hipotenusa(3, 4);
echo "<br>";



$n = 0;
$n = f($n);

function f(&$n){
    $n = $n+1;
    echo "n dentro de la funcion es $n";
}
f($n);
echo " n es $n";


echo "<br>";

function hipotenusa1(&$h, $cateto1, $cateto2){
  

$h = sqrt($cateto1*$cateto1 + $cateto2* $cateto2);

echo "la hipotenusa dentro es: $h";
}

 hipotenusa1($hipo, 1,5);
echo "la hipotenusa es:  $hipo";


//Practica 

function calcular($a, $b, $operador, &$resultado){
   
if ($operador ==="+" ){

         $resultado = $a + $b;
    }  else if ($operador === "-" ){
$resultado = $a-$b;
    } else if ($operador ===  "*"){
        $resultado = $a*$b;

    }else if ($operador ===" /"){
        $resultado = $a/$b;
    }
    
}
calcular (3,4, "-", $res);
    echo "el resultado es  $res";
    echo "<br>";
    calcular (3,4, "+", $res);
    echo "el resultado es  $res";
    echo "<br>";
    calcular (3,4, "*", $res);
    echo "el resultado es  $res";
    echo "<br>";
    calcular (3,4, "/", $res);
    echo "el resultado es  $res";
   


?>