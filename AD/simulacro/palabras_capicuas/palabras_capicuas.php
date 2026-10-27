<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de palabras</title>
</head>
<body>
    <form action="palabras_capicuas_resultado.php" method="post">
        Cantidad:
        <select name="cantidad">
            <?php
                for ($i = 1; $i <= 50; $i++)
                {
                    echo '<option value="' . $i . '">' . $i . '</option>';
                }
            ?>
        </select>

        Tamaño:
        <select name="tamano">
            <?php
                for ($i = 2; $i <= 6; $i++)
                {
                    echo '<option value="' . $i . '">' . $i . '</option>';
                }
            ?>
        </select>

        <input type="submit" name="normales" value="Normales">
        <input type="submit" name="capicuas" value="Capicúas">
    </form>
</body>
</html>
