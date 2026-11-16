<?php
$n1 = $_POST['n1'] ?? '';
$n2 = $_POST['n2'] ?? '';
$n3 = $_POST['n3'] ?? '';
$clave = $n1 . $n2 . $n3;
$intentos = $_POST['intentos'] ?? 0;

if ($clave != "") {
    $intentos = $intentos + 1;
}

// si fallas 3 veces vuelves a la habitacion 0
if ($intentos >= 3 && $clave != "723") {
    header("Location: habitacion0.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Habitacion 5</title>
</head>
<body>
    <h1>Habitacion 5</h1>
    <p>Estas en la sala de control. La salida esta detras de una puerta blindada.</p>

    <p>Pista C5: el tercer numero es el numero de intentos que tienes</p>

    <h2>Candado C5</h2>
    <p>Solo tienes 3 intentos, si fallas vuelves al principio.</p>

    <?php
    if ($clave == "723") {
        echo "<p>Correcto!! La puerta se ha abierto</p>";
        echo "<a href='habitacion6.php'>Ir a la habitacion 6</a>";
    } else {
        if ($clave != "") {
            echo "<p>Incorrecto</p>";
        }
        echo "<p>Te quedan " . (3 - $intentos) . " intentos</p>";
    ?>
    <form action="habitacion5.php" method="post">
        <select name="n1">
            <?php for ($i = 0; $i <= 9; $i++) { echo "<option>$i</option>"; } ?>
        </select>
        <select name="n2">
            <?php for ($i = 0; $i <= 9; $i++) { echo "<option>$i</option>"; } ?>
        </select>
        <select name="n3">
            <?php for ($i = 0; $i <= 9; $i++) { echo "<option>$i</option>"; } ?>
        </select>
        <input type="hidden" name="intentos" value="<?php echo $intentos; ?>">
        <input type="submit" value="Probar">
    </form>
    <?php
    }
    ?>
</body>
</html>
