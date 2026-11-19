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
    <title>Habitacion 2</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;800&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="estilos.css">
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
    <script src="escape.js"></script>
</head>
<body>
    <h1>Habitacion 2</h1>
    <p>Estas en un laboratorio con probetas rotas.</p>

    <p>Pista C1: el tercer numero es el ultimo numero del año 2026</p>
    <p>Pista C2: el tercer numero es el numero de esta habitacion</p>
    <p>Pista C4: el tercer numero es 0</p>
    <p>Pista C5: el segundo numero es el ultimo de C2</p>
    <h2>Candado C2</h2>
    <form action="habitacion2.php" method="post">
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
    if ($clave == "512") {
        echo "<p>Correcto!! El candado se ha abierto</p>";
        echo "<a href='habitacion3.php'>Ir a la habitacion 3</a>";
    } else if ($clave != "") {
        echo "<p>Incorrecto, prueba otra vez</p>";
    }
    ?>
    <br>
    <a href="habitacion0.php">Volver a la habitacion 0</a>
</body>
</html>
