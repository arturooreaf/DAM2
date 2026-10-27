<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chofi</title>
</head>
<body>
    <div>
        <h1>CHOFI</h1>
        <p>¿Te atreves a retarme?</p>

        <form action="batalla1.php" method="post">
            <div>
                <label>Tu número (1-3)<br/>
                    <input type="text" name="numero" placeholder="1, 2 o 3">
                </label>
                <button type="submit" name="luchar" value="luchar">¡A luchar!</button>
            </div>

            <div>
                <label>Tu apuesta<br/>
                    <select name="apuesta">
                        <option value="menor">Jugador menor</option>
                        <option value="Mayor">Jugador mayor</option>
                        <option value="iguales">Iguales</option>
                    </select>
                </label>
            </div>
        </form>
    </div>
</body>
</html>
