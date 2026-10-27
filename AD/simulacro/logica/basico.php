<?php
// Proyecto1/index.php: echo, variables, tipos, comillas y constantes
echo "HOLA MUNDO <br/>";
echo 55;
echo "<br/>";

$edad = 24;
$nombre = 45;
$apellido = "Fernández";
echo $edad . $nombre . $apellido;
echo "<br/>";

echo gettype($edad);
echo "<br/>";
$edad = "ocho";
var_export($edad);
echo "<br/>";
echo gettype($edad);
echo "<br/>";

echo ' el valor de edad es $edad ';
echo "<br/>";
echo " el valor de edad es $edad ";
echo "<br/>";

define('PI', 3.141592);
echo PI;
?>
