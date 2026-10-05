<?php
    var_export($_POST);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <div style=" margin: 10px; padding: 10px; background-color: aqua; border: 1px solid black;">
        <h2 style="text-align: center;">Resultado:  <?php

        if(($_POST['miBoton1'] ?? '') === 'multiplicar')
        {
            echo $_POST['miInput1'] * $_POST['miInput2'];
        }else if(($_POST['miBoton2'] ?? '') === 'dividir'){
            echo $_POST['miInput1'] / $_POST['miInput2'];
        }else if (($_POST['miBoton3'] ?? '') === 'sumar'){
            echo $_POST['miInput1'] + $_POST['miInput2'];
        }else if (($_POST['miBoton4'] ?? '') === 'restar'){
            echo $_POST['miInput1'] - $_POST['miInput2'];
        }
        ?> </h2>
        </div>
</body>
</html>
