<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chofo</title>
</head>
<body>
    <div>
        <h1>CHOFO</h1>
        <p>Tienes dos apuestas para ganarme</p>

        <form action="batallafinal.php" method="post">
            <div>
                <label>Tu número (1-10)<br/>
                    <input type="text" name="numero" placeholder="1 ... 10">
                </label>
                <button type="submit" name="luchar" value="luchar">¡A luchar!</button>
            </div>

            <div>
                <label>Apuesta 1<br/>
                    <select name="apuesta1">
                        <option value="dif1">Jugador a diferencia de 1</option>
                        <option value="dif2">Jugador a diferencia de 2</option>
                        <option value="iguales">Iguales</option>
                    </select>
                </label>
                <br/>
                <label>Apuesta 2<br/>
                    <select name="apuesta_2">
                        <option value="dif1">Jugador a diferencia de 1</option>
                        <option value="dif2">Jugador a diferencia de 2</option>
                        <option value="iguales">Iguales</option>
                    </select>
                </label>
            </div>
        </form>
    </div>
</body>
</html>
