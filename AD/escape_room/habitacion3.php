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
    <title>Habitacion 3</title>
</head>
<body>
    <h1>Habitacion 3</h1>
    <p>Estas en un sotano oscuro.</p>

    <p>Pista C3: los tres numeros suman 18</p>
    <h2>Candado C3</h2>
    <form action="habitacion3.php" method="post">
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
    if ($clave == "666") {
        echo "<p>Correcto!! El candado se ha abierto</p>";
        echo "<a href='habitacion5.php'>Ir a la habitacion 5</a>";
    } else if ($clave != "") {
        echo "<p>Incorrecto, prueba otra vez</p>";
    }
    ?>
    <br>
    <a href="habitacion2.php">Volver a la habitacion 2</a>
</body>
</html>
