<?php
function imprimir($n,$c){

    for ($i=0; $i < $n; $i++) { 
        echo $c;
    }
}
        $altura = 3;
        $nAst = -1;


for ($i=1; $i<=$altura; $i++)
     { 
    imprimir($altura-$i, "_");
    $nAst = +2;
    imprimir($nAst, "*");
    echo "<br/>";
    }



?>