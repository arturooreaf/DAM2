<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palabras aleatorias</title>
</head>
<body>
    <!-- Proyecto2/index2.php -->
    <form action="palabras_aleatorias_resultado.php" method="post">
        <div>
            <label style="color: brown;">Número de palabras</label>
            <select name="numeros">
                <?php
                    for ($i = 1; $i <= 100; $i++)
                    {
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    }
                ?>
            </select>
        </div>
        <div>
            <label style="color: red;">Tamaño palabras</label>
            <select name="tam">
                <?php
                    for ($i = 3; $i <= 6; $i++)
                    {
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    }
                ?>
            </select>
        </div>
        <div style="background-color: yellow;">
            <input type="submit" name="boton1" value="Ejecuta!!!">
        </div>
    </form>
</body>
</html>
