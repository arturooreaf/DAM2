<?php
$n1 = $_POST['n1'] ?? '';
$n2 = $_POST['n2'] ?? '';
$n3 = $_POST['n3'] ?? '';
$clave = $n1 . $n2 . $n3;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Habitacion 1</title>
</head>
<body>
    <h1>Habitacion 1</h1>
    <p>Estas en una biblioteca vieja. Hay un candado en la pared.</p>

    <p>Pista C1: el segundo numero es 2 + 2</p>
    <p>Pista C2: el segundo numero es 9 - 8</p>
    <p>Pista C4: el primer numero es el de la habitacion donde esta el candado C3</p>
    <p>Pista C5: el primer numero es el mismo que el primero de C1</p>
    <h2>Candado C1</h2>
    <form action="habitacion1.php" method="post">
        <select name="n1">
            <?php for ($i = 0; $i <= 9; $i++) { echo "<option>$i</option>"; } ?>
        </select>
        <select name="n2">
            <?php for ($i = 0; $i <= 9; $i++) { echo "<option>$i</option>"; } ?>
        </select>
        <select name="n3">
            <?php for ($i = 0; $i <= 9; $i++) { echo "<option>$i</option>"; } ?>
        </select>
        <input type="submit" value="Probar">
    </form>

    <?php
    if ($clave == "746") {
        echo "<p>Correcto!! El candado se ha abierto</p>";
        echo "<a href='habitacion4.php'>Ir a la habitacion 4</a>";
    } else if ($clave != "") {
        echo "<p>Incorrecto, prueba otra vez</p>";
    }
    ?>
    <br>
    <a href="habitacion0.php">Volver a la habitacion 0</a>
</body>
</html>
