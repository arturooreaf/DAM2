<?php
//var_export($_POST); 


function letraAleatoria()
{
    $todasLetras = "abcdefghijklmnñopqrstuvwxyz";
    $rr = rand(0,mb_strlen($todasLetras )-1);
    return mb_substr($todasLetras,$rr,1);
}

function palabraAletoria($tam)
{
    $palabro = "";
    for ($i=0; $i < $tam; $i++)
    {
        $palabro.=letraAleatoria();
    }
    return $palabro;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0; charset=UTF-8">
    <title>Document</title>
</head>
<body>
    <?php
    for ($i=0; $i < $_POST['numeros']; $i++)
    {
        echo palabraAletoria($_POST['tam']);
        echo "<br/>";
    }
    ?>
</body>
</html>