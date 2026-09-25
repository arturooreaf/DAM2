<?php

function saludar ($nombre, $saludo){

    return $saludo .  $nombre;

}

echo saludar(" Bego", " Que tal");
echo "<br>";
function calcularNumeroMayor ($numero1, $numero2){
    if($numero1 > $numero2)  return $numero1;
  
   else return $numero2;
}
echo calcularNumeroMayor(60, 50);

echo "<br>";

//dados tres numeros suelte el mayor
function llamadaNumeroMayor3 ($num1, $num2, $num3){
    if($num1>$num2 && $num1 > $num3) return $num1; 
    else if ($num2> $num1 && $num2 > $num3) return $num2;
    else return  $num3;
}

echo "test1:  ";
echo llamadaNumeroMayor3(1, 2, 3); //test 1  //3
echo "<br>";

echo "test2:  ";
echo llamadaNumeroMayor3(3, 2,1); //test2  //3
echo "<br>";


echo "test3:  ";
echo llamadaNumeroMayor3(3, 1, 2);  //test2 //3
echo "<br>";

echo "test4:  ";
echo llamadaNumeroMayor3(3, 2, 1); //test 1  //3
echo "<br>";

echo "test5:  ";
echo llamadaNumeroMayor3(1, 1,2); //test2  //2
echo "<br>";


echo "test6:  ";
echo llamadaNumeroMayor3(2, 1, 1);  //test2  //2
echo "<br>";

echo "test7:  ";
echo llamadaNumeroMayor3(1, 1, 1);  //test2 //1
echo "<br>";




?>