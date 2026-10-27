<?php

function contarLetra($texto, $letra){
    $contador = 0;
$texto = strtolower($texto);
$letra = strtolower($letra);
    for ($i=0; $i < mb_strlen($texto); $i++) { 
        $actual = mb_substr($texto, $i,1);
if($actual === $letra){
    $contador = $contador+1;
}
    }
    return $contador;
}

echo contarLetra("Cancion", "c");
echo "<br/>";
function invertir ($texto){
    $invertido = "";
    for ($i=mb_strlen($texto); $i >= 0 ; $i--) { 
      $invertido .= mb_substr($texto, $i, 1);
    }
    return $invertido;
}
echo invertir("cancion");



function quitarEspacios($texto)
{
    $actual = "";                                  // la caja vacía
    for ($i = 0; $i < mb_strlen($texto); $i++)
    {
        $letra = mb_substr($texto, $i, 1);     // 1. coger la letra de esta vuelta
        if ($letra !== " ")                     // 2. ¿NO es un espacio?
        {
            $actual .= $letra;                 // 3. añadirla a la caja
        }
    }
    return $actual;                                 // 4. devolver la caja
}
    

echo quitarespacios("Anita lava la tinta");
echo "<br/>";

function esPalindromo($texto, &$invertido)
{
    $limpio = strtolower(quitarEspacios($texto));   // sin espacios y en minúsculas
    $invertido = invertir($limpio);                  // se guarda por referencia
    if ($limpio === $invertido)
    {
        return true;
    }
    return false;
}

if (esPalindromo("Anita lava la tina", $alReves))
{
    echo "Anita lava la tina: SÍ es palíndromo (al revés: $alReves)<br/>";
}
else
{
    echo "Anita lava la tina: NO es palíndromo (al revés: $alReves)<br/>";
}

if (esPalindromo("hola", $alReves))
{
    echo "hola: SÍ es palíndromo (al revés: $alReves)<br/>";
}
else
{
    echo "hola: NO es palíndromo (al revés: $alReves)<br/>";
}
?>