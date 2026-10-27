<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Figuras</title>
</head>
<body>
    <form action="figuras_resultado.php" method="post">
        Altura:
        <select name="altura">
            <?php
                for ($i = 1; $i <= 12; $i++)
                {
                    echo '<option value="' . $i . '">' . $i . '</option>';
                }
            ?>
        </select>

        Carácter: <input type="text" name="caracter">

        <input type="submit" name="piramide" value="Pirámide">
        <input type="submit" name="escalera" value="Escalera">
        <input type="submit" name="invertida" value="Pirámide invertida">
    </form>
</body>
</html>
