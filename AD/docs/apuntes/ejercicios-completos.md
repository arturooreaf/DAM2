# Ejercicios completos · AD PHP

Cada ejercicio entero, tal cual se escribe. Arriba de cada uno: **qué hace**.

---

## 1. Números con comas: 1,2,3,4,5,6

**Qué hace:** escribe los números del 1 al 6 separados por comas, sin coma al final.

```php
<?php
$coma = "";
for ($i = 1; $i <= 6; $i++)
{
    echo $coma . $i;
    $coma = ",";
}
?>
```

---

## 2. Mayor de 3 números

**Qué hace:** devuelve el mayor de 3 números. Si hay alguno repetido, devuelve -1.

```php
<?php
function mayorDe2($a, $b)
{
    if ($a > $b)
    {
        return $a;
    }
    else
    {
        return $b;
    }
}

function mayorDe3($a, $b, $c)
{
    if ($a === $b || $a === $c || $b === $c)
    {
        return -1;
    }
    return mayorDe2($c, mayorDe2($a, $b));
}

echo mayorDe3(1, 2, 3);   //3
echo "<br/>";
echo mayorDe3(1, 1, 2);   //-1
?>
```

---

## 3. Hipotenusa (por defecto y por referencia)

**Qué hace:** calcula la hipotenusa. La primera función tiene valores por defecto; la segunda devuelve el resultado por referencia (`&`).

```php
<?php
function hipotenusa($cateto1 = 3, $cateto2 = 4)
{
    return sqrt($cateto1 * $cateto1 + $cateto2 * $cateto2);
}

function calcularHipotenusa($lado1, $lado2, &$hipotenusa)
{
    $hipotenusa = sqrt($lado1 * $lado1 + $lado2 * $lado2);
}

echo hipotenusa();          //5
echo "<br/>";
calcularHipotenusa(6, 8, $h);
echo $h;                    //10
?>
```

---

## 4. Calculadora con referencia

**Qué hace:** hace la operación y deja el resultado en `$resultado` (por referencia). Controla la división entre 0.

```php
<?php
function calcular($num1, $num2, $operador, &$resultado)
{
    if ($operador === "+")
    {
        $resultado = $num1 + $num2;
    }
    else if ($operador === "-")
    {
        $resultado = $num1 - $num2;
    }
    else if ($operador === "*")
    {
        $resultado = $num1 * $num2;
    }
    else if ($operador === "/")
    {
        if ($num2 === 0)
        {
            $resultado = "No se puede dividir por 0";
        }
        else
        {
            $resultado = $num1 / $num2;
        }
    }
}

$resultado = 0;
calcular(1, 3, "+", $resultado);
echo $resultado . "<br/>";      //4
calcular(1, 0, "/", $resultado);
echo $resultado . "<br/>";      //No se puede dividir por 0
?>
```

---

## 5. Formulario simple (2 archivos)

**Qué hace:** escribes algo en un campo y la otra página lo enseña.

**formulario.php**
```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario</title>
</head>
<body>
    <form action="resultado.php" method="post">
        <input type="text" name="miInput1">
        <input type="submit" name="miBoton1" value="dame!">
    </form>
</body>
</html>
```

**resultado.php**
```php
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>
    <h2>Has escrito: <?php echo $_POST['miInput1']; ?></h2>
</body>
</html>
```

---

## 6. Calculadora con 4 botones (2 archivos)

**Qué hace:** escribes 2 números y pulsas un botón. Solo llega el botón pulsado, por eso se usa `?? ''`.

**calculadora.php**
```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calculadora</title>
</head>
<body>
    <form action="calculadora_resultado.php" method="post">
        <input type="text" name="num1">
        <input type="text" name="num2">
        <input type="submit" name="sumar" value="+">
        <input type="submit" name="restar" value="-">
        <input type="submit" name="multiplicar" value="x">
        <input type="submit" name="dividir" value="/">
    </form>
</body>
</html>
```

**calculadora_resultado.php**
```php
<?php
$num1 = $_POST['num1'];
$num2 = $_POST['num2'];
$sumar = $_POST['sumar'] ?? '';
$restar = $_POST['restar'] ?? '';
$multiplicar = $_POST['multiplicar'] ?? '';
$dividir = $_POST['dividir'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>
    <h2>Resultado:
    <?php
    if ($sumar !== '')
    {
        echo $num1 + $num2;
    }
    else if ($restar !== '')
    {
        echo $num1 - $num2;
    }
    else if ($multiplicar !== '')
    {
        echo $num1 * $num2;
    }
    else if ($dividir !== '')
    {
        if ($num2 === "0")
        {
            echo "No se puede dividir por 0";
        }
        else
        {
            echo $num1 / $num2;
        }
    }
    ?>
    </h2>
</body>
</html>
```

---

## 7. Estación y horóscopo con switch (2 archivos)

**Qué hace:** escribes un mes y te dice la estación y el horóscopo. Da igual mayúsculas o minúsculas.

**meses.php**
```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Meses</title>
</head>
<body>
    <form action="meses_resultado.php" method="post">
        Mes: <input type="text" name="mes">
        <input type="submit" name="boton" value="DAME">
    </form>
</body>
</html>
```

**meses_resultado.php**
```php
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>
    <?php
    $mes = strtolower($_POST['mes']);

    switch ($mes)
    {
        case "enero":
        case "febrero":
        case "marzo":
            echo "INVIERNO";
            if ($mes === "enero") echo " y CAPRICORNIO";
            else if ($mes === "febrero") echo " y ACUARIO";
            else echo " y PISCIS";
            break;
        case "abril":
        case "mayo":
        case "junio":
            echo "PRIMAVERA";
            if ($mes === "abril") echo " y ARIES";
            else if ($mes === "mayo") echo " y TAURO";
            else echo " y GÉMINIS";
            break;
        case "julio":
        case "agosto":
        case "septiembre":
            echo "VERANO";
            if ($mes === "julio") echo " y CÁNCER";
            else if ($mes === "agosto") echo " y LEO";
            else echo " y VIRGO";
            break;
        case "octubre":
        case "noviembre":
        case "diciembre":
            echo "OTOÑO";
            if ($mes === "octubre") echo " y LIBRA";
            else if ($mes === "noviembre") echo " y ESCORPIO";
            else echo " y SAGITARIO";
            break;
        default:
            echo "No has escrito un mes";
    }
    ?>
</body>
</html>
```

---

## 8. Pirámide normal

**Qué hace:** dibuja una pirámide de asteriscos de la altura que quieras.

```php
<?php
function imprimir($n, $c)
{
    for ($i = 0; $i < $n; $i++)
    {
        echo $c;
    }
}

$altura = 5;
$nAst = -1;
for ($i = 1; $i <= $altura; $i++)
{
    imprimir($altura - $i, "_");
    $nAst = $nAst + 2;
    imprimir($nAst, "*");
    echo "<br/>";
}
?>
```

Sale:
```
____*
___***
__*****
_*******
*********
```

---

## 9. Pirámide invertida

**Qué hace:** la misma pirámide, al revés. Solo cambia el `for` (va hacia atrás) y los asteriscos se calculan con `2 * $i - 1`.

```php
<?php
function imprimir($n, $c)
{
    for ($i = 0; $i < $n; $i++)
    {
        echo $c;
    }
}

$altura = 5;
for ($i = $altura; $i >= 1; $i--)
{
    imprimir($altura - $i, "_");
    imprimir(2 * $i - 1, "*");
    echo "<br/>";
}
?>
```

Sale:
```
*********
_*******
__*****
___***
____*
```

---

## 10. Pirámide con formulario y botones (2 archivos)

**Qué hace:** eliges la altura en un desplegable y pulsas "Normal" o "Invertida".

**piramide.php**
```php
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pirámide</title>
</head>
<body>
    <form action="piramide_resultado.php" method="post">
        Altura:
        <select name="altura">
            <?php
            for ($i = 1; $i <= 12; $i++)
            {
                echo '<option value="' . $i . '">' . $i . '</option>';
            }
            ?>
        </select>
        <input type="submit" name="normal" value="Normal">
        <input type="submit" name="invertida" value="Invertida">
    </form>
</body>
</html>
```

**piramide_resultado.php**
```php
<?php
function imprimir($n, $c)
{
    for ($i = 0; $i < $n; $i++)
    {
        echo $c;
    }
}

$altura = $_POST['altura'];
$normal = $_POST['normal'] ?? '';
$invertida = $_POST['invertida'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>
    <?php
    if ($normal !== '')
    {
        for ($i = 1; $i <= $altura; $i++)
        {
            imprimir($altura - $i, "_");
            imprimir(2 * $i - 1, "*");
            echo "<br/>";
        }
    }
    else if ($invertida !== '')
    {
        for ($i = $altura; $i >= 1; $i--)
        {
            imprimir($altura - $i, "_");
            imprimir(2 * $i - 1, "*");
            echo "<br/>";
        }
    }
    ?>
</body>
</html>
```

---

## 11. Invertir un texto

**Qué hace:** devuelve el texto al revés. Funciona con ñ y tildes.

```php
<?php
function invertir($texto)
{
    $invertido = "";
    for ($i = mb_strlen($texto) - 1; $i >= 0; $i--)
    {
        $invertido .= mb_substr($texto, $i, 1);
    }
    return $invertido;
}

echo invertir("canción");   //nóicnac
?>
```

---

## 12. Contar una letra

**Qué hace:** cuenta cuántas veces sale una letra en un texto, sin importar mayúsculas.

```php
<?php
function contarLetra($texto, $letra)
{
    $contador = 0;
    $texto = strtolower($texto);
    $letra = strtolower($letra);
    for ($i = 0; $i < mb_strlen($texto); $i++)
    {
        $actual = mb_substr($texto, $i, 1);
        if ($actual === $letra)
        {
            $contador++;
        }
    }
    return $contador;
}

echo contarLetra("Anita lava la tina", "a");   //6
?>
```

---

## 13. Quitar espacios

**Qué hace:** devuelve el texto sin espacios.

```php
<?php
function quitarEspacios($texto)
{
    $resultado = "";
    for ($i = 0; $i < mb_strlen($texto); $i++)
    {
        $letra = mb_substr($texto, $i, 1);
        if ($letra !== " ")
        {
            $resultado .= $letra;
        }
    }
    return $resultado;
}

echo quitarEspacios("Anita lava la tina");   //Anitalavalatina
?>
```

---

## 14. Palabras aleatorias en lista (2 archivos)

**Qué hace:** eliges cuántas palabras y de qué tamaño, y salen en una lista `<ul>`.

**palabras.php**
```php
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Palabras</title>
</head>
<body>
    <form action="palabras_resultado.php" method="post">
        Número de palabras:
        <select name="numeros">
            <?php
            for ($i = 1; $i <= 100; $i++)
            {
                echo '<option value="' . $i . '">' . $i . '</option>';
            }
            ?>
        </select>
        Tamaño:
        <select name="tam">
            <?php
            for ($i = 3; $i <= 6; $i++)
            {
                echo '<option value="' . $i . '">' . $i . '</option>';
            }
            ?>
        </select>
        <input type="submit" name="boton" value="Ejecuta!!!">
    </form>
</body>
</html>
```

**palabras_resultado.php**
```php
<?php
function letraAleatoria()
{
    $letras = "abcdefghijklmnñopqrstuvwxyz";
    $posicion = rand(0, mb_strlen($letras) - 1);
    return mb_substr($letras, $posicion, 1);
}

function palabraAleatoria($tam)
{
    $palabra = "";
    for ($i = 0; $i < $tam; $i++)
    {
        $palabra .= letraAleatoria();
    }
    return $palabra;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>
    <ul>
    <?php
    for ($i = 0; $i < $_POST['numeros']; $i++)
    {
        echo "<li>" . palabraAleatoria($_POST['tam']) . "</li>";
    }
    ?>
    </ul>
</body>
</html>
```

---

## 15. Diccionario con $$ (2 archivos)

**Qué hace:** escribes 3 palabras en español y su traducción, y la otra página las enseña. Las variables se crean con `$$`.

**diccionario.php**
```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Diccionario</title>
</head>
<body>
    <form action="diccionario_resultado.php" method="post">
        Español 1: <input type="text" name="espanol1"> Inglés 1: <input type="text" name="ingles1"><br/>
        Español 2: <input type="text" name="espanol2"> Inglés 2: <input type="text" name="ingles2"><br/>
        Español 3: <input type="text" name="espanol3"> Inglés 3: <input type="text" name="ingles3"><br/>
        <input type="submit" name="boton" value="Traducir">
    </form>
</body>
</html>
```

**diccionario_resultado.php**
```php
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>
    <?php
    for ($i = 1; $i <= 3; $i++)
    {
        $es = "espanol" . $i;
        $en = "ingles" . $i;
        $$es = $_POST[$es];
        $$en = $_POST[$en];
        echo $$es . " = " . $$en . "<br/>";
    }
    ?>
</body>
</html>
```
