<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Primer script PHP</title>
</head>
<body>
  <h1>
    <?php
      echo "Hola mundo desde PHP";
      $edad = 24;
      $nombre = 45;
      $apellido = "fernandez";

      echo $edad . $nombre . $apellido ;

echo "</br>";



for($i = 1;  $i< 7; $i++){ 


      if($i>=6) {  
        echo  " ". $i . " " ;
      }
       else {
                echo " ".  $i . ","; 
      }
}

echo "</br>";

$tamano  = 7;
for($i = 1 ; $i<= $tamano; $i++){
  echo $i;
  if($i< $tamano){
    echo ", ";
  }
}


echo "</br>";

$comma = "";
for($i=1; $i<=$tamano; $i++)
  {
     echo $comma. $i;
    $comma = ",";
  }
   

echo "</br>";

$edad = "ocho";
$edad = "nueve";

var_export($edad);
echo "</br>";
echo gettype($edad);
 
echo "</br>";

echo 'el valor de edad es $edad ';
echo "el valor de la edad es $edad";


define('PI',3,141592)
    ?>
  </h1>
</body>
</html>
