  /***La función calcular($n1, $n2, $op, &$resultado) con +, -, * y /.
Si se divide entre 0: “No se puede dividir por 0”.
Pruébala con 4 llamadas y saca cada resultado con echo y <br/>.
La función invertir($texto) con mb_strlen y mb_substr, y pruébala con “canción”. */

<?php  
function calcular ($n1, $n2, $op, &$resultado)
{

if($op === "+") {
    $resultado = $n1 + $n2;
}else if($op === "-"){
 $resultado = $n1 - $n2;
}else if($op === "*"){
 $resultado = $n1 * $n2;
}else if($op === "/"){
if($n2 === 0){
    $resultado = "no se puede dividir entre 0";
} else {
     $resultado = $n1 / $n2;
}

}
}
$resultado = 0;
echo "<br/><br/>";
calcular(1,3,"+", $resultado);
echo $resultado;
echo "<br/><br/>";
calcular(1,0,"/", $resultado);
echo $resultado;
echo "<br/><br/>";
calcular(5,3,"-", $resultado);
echo $resultado;
echo "<br/><br/>";
calcular(5,3,"*", $resultado);
echo $resultado;


    function invertir($texto){
    $invertido = "";
    for ($i =mb_strlen($texto); $i >= 0; $i--){
        $invertido.= mb_substr($texto, $i, 1);
    }
    return $invertido;
}


echo invertir("cancion")









?>