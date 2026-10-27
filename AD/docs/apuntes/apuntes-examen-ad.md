# Apuntes AD · PHP para el examen

**Solo lo que hay en el GitHub del profe** (`DAM2_2627/AD`): `Proyecto1` (index a index12, resultado_11) y `Proyecto2` (index, index2, index3).

| Archivo del profe | Tema |
|---|---|
| `Proyecto1/index.php` | `echo`, variables, concatenar, comas en bucle, tipos, comillas, `define` |
| `Proyecto1/index2.php` | Funciones con `return`, mayor de 2 y de 3 |
| `Proyecto1/index3.php` | Parámetros por defecto, `sqrt`, **paso por referencia** |
| `Proyecto1/index4.php` | **Calculadora con referencia** |
| `Proyecto1/index5-6.php` | **Formulario** y `$_POST` |
| `Proyecto1/index7-8.php` | Formulario que **suma** 2 números |
| `Proyecto1/index9-10.php` | **Calculadora con varios botones**, `??` |
| `Proyecto1/index11` + `resultado_11.php` | **`switch`**, `strtolower`: estación y horóscopo |
| `Proyecto2/index.php` | **Pirámide** de asteriscos |
| `Proyecto2/index2-3.php` | **`<select>` con bucle** y **palabras aleatorias** |

---

## 1. Lo básico (`index.php`)

```php
<?php
echo "HOLA MUNDO <br/>";
echo 55;

$edad = 24;
$nombre = 45;
$apellido = "Fernández";

echo $edad . $nombre . $apellido;   // 2445Fernández
?>
```

| Cosa | Qué hace |
|---|---|
| `<?php ... ?>` | Abre y cierra PHP |
| `echo` | Escribe en la página |
| `$variable` | Las variables empiezan por `$` |
| `.` | **Concatena** (une textos) |
| `<br/>` | Salto de línea en la página |
| `//` y `/* */` | Comentarios |

### Las variables no tienen tipo fijo

```php
$edad = 24;
echo gettype($edad);   // integer
$edad = "ocho";
var_export($edad);     // 'ocho'
echo gettype($edad);   // string
```

| Función | Para qué |
|---|---|
| `gettype($x)` | Dice el **tipo** |
| `var_export($x)` | Muestra el **valor tal cual** (para depurar) |

### Comillas simples vs dobles (cae seguro)

```php
echo ' el valor de edad es $edad ';   // imprime: el valor de edad es $edad
echo " el valor de edad es $edad ";   // imprime: el valor de edad es ocho
```

**Dobles = cambia la variable por su valor. Simples = texto literal.**

### Constantes

```php
define('PI', 3.141592);
echo PI;   // sin $
```

---

## 2. Bucle `for`: imprimir `1,2,3,4,5,6` (`index.php`)

Sin la coma, sale `123456`. El reto es **que no sobre coma al final**. El profe hace 3 formas:

```php
$tamano = 6;

// A) coma DESPUÉS, si no es el último
for ($i = 1; $i <= $tamano; $i++)
{
    echo $i;
    if ($i < $tamano) {
        echo ',';
    }
}

// B) coma ANTES, si no es el primero
for ($i = 1; $i <= $tamano; $i++)
{
    if ($i > 1) echo ',';
    echo $i;
}

// C) separador que empieza vacío
$comma = "";
for ($i = 1; $i <= $tamano; $i++)
{
    echo $comma . $i;
    $comma = ",";
}
```

**Partes del `for`:** `for (inicio; condición; incremento)`. `$i++` suma 1.

---

## 3. Funciones (`index2.php`)

```php
function saludar($nombre, $saludo)
{
    return $saludo . $nombre;
}
echo saludar("Begoña", "Qué tal ");   // Qué tal Begoña
```

`return` **devuelve** el valor y **sale** de la función.

### Mayor de 2

```php
function NumeroMayor($num1, $num2)
{
    if ($num1 > $num2) return $num1;
    else return $num2;
}
echo NumeroMayor(119950, 2);   // 119950
```

### Mayor de 3: tres versiones del profe

```php
// Versión 1: usando && (Y)
function numeroMayor3_($num1, $num2, $num3)
{
    if ($num3 > $num2 && $num3 > $num1) return $num3;
    return NumeroMayor($num1, $num2);
}

// Versión 2: reutilizando NumeroMayor dos veces (la más corta)
function numeroMayor3__($num1, $num2, $num3)
{
    return NumeroMayor($num3, NumeroMayor($num1, $num2));
}

// Versión 3: si hay alguno repetido, devuelve -1. Usa || (O)
function numeroMayor3($num1, $num2, $num3)
{
    if ($num1 === $num2 || $num1 === $num3 || $num2 === $num3) {
        return -1;
    }
    return numeroMayor3_($num1, $num2, $num3);
}
```

| Operador | Significa |
|---|---|
| `&&` | **Y**: se cumplen los dos |
| `\|\|` | **O**: se cumple al menos uno |
| `===` | Igual en **valor y tipo** (el profe usa siempre este) |
| `>` `<` `>=` `<=` | Mayor, menor... |

**Truco:** prueba la función con todos los órdenes (1,2,3 / 1,3,2 / 3,1,2...), como hace el profe.

---

## 4. Parámetros por defecto y por referencia (`index3.php`)

### Por defecto

```php
function hipotenusa($cateto = 3, $cateto2 = 4)
{
    return sqrt($cateto * $cateto + $cateto2 * $cateto2);
}
echo hipotenusa();       // usa 3 y 4 -> 5
echo hipotenusa(6, 8);   // 10
```

`sqrt()` = raíz cuadrada.

### Por referencia `&` (importante)

```php
function calcularHipotenusa($lado1, $lado2, &$hipotenusa)
{
    $suma = ($lado1 * $lado1) + ($lado2 * $lado2);
    $hipotenusa = sqrt($suma);
}

calcularHipotenusa(5, 6, $hipo);
echo "la hipotenusa es: $hipo";   // 7.81...
```

| Sin `&` | Con `&` |
|---|---|
| La función recibe una **copia** | Recibe **la variable de fuera** |
| Si la cambias dentro, fuera no cambia | Si la cambias dentro, **fuera también** |
| Hay que usar `return` | No hace falta `return` |

**El ejemplo comentado del profe** (sin `&`):

```php
$n = 0;
$n = f($n);       // hay que recoger el return
function f($n)
{
    $n = $n + 1;  // cambia la copia
    return $n;
}
echo $n;          // 1
```

---

## 5. Calculadora con referencia (`index4.php`)

```php
function calcular($num1, $num2, $operador, &$resultado)
{
    if ($operador === "+")
        $resultado = $num1 + $num2;
    else if ($operador === "-")
        $resultado = $num1 - $num2;
    else if ($operador === "*")
        $resultado = $num1 * $num2;
    else if ($operador === "/")
    {
        if ($num2 === 0)
            $resultado = "No se puede dividir por 0";
        else
            $resultado = $num1 / $num2;
    }
}

$resultado = 0;
calcular(1, 3, "+", $resultado);
echo $resultado . "<br>";   // 4

calcular(1, 0, "/", $resultado);
echo $resultado . "<br>";   // No se puede dividir por 0
```

1. **`if / else if / else`** para elegir la operación.
2. **Controla la división entre 0.**
3. El resultado sale **por la referencia**, no por `return`.

---

## 6. Formularios y `$_POST` (`index5.php` + `index6.php`)

Siempre **2 páginas**: la del formulario y la que recibe.

### Página 1: formulario (`index5.php`)

```html
<form action="index6.php" method="post">
    <input type="text" name="miInput1">
    <input type="submit" name="miBoton1" value="dame!">
</form>
```

| Atributo | Para qué |
|---|---|
| `action` | **A qué página** se envía |
| `method="post"` | Los datos llegan en **`$_POST`** |
| `name` | **La clave** para leerlo en PHP |
| `value` (en el submit) | El texto del botón |

### Página 2: recibe (`index6.php`)

```php
<?php
    var_export($_POST);   // para VER qué llega
?>
<h2>En el input llega el valor <?php echo $_POST['miInput1'] ?></h2>
```

**`$_POST['miInput1']`**: lo de dentro de los corchetes es **el `name` del input**, igual, con las mismas mayúsculas.

**PHP dentro de HTML:** abres `<?php`, escribes, y cierras `?>` en mitad del HTML.

---

## 7. Sumar dos números (`index7.php` + `index8.php`)

```html
<form action="index8.php" method="post">
    <input type="text" name="miInput1">
    <input type="text" name="miInput2">
    <input type="submit" name="suma" value="+">
</form>
```

```php
<h2>La respuesta es: <?php echo $_POST['miInput1'] + $_POST['miInput2'] ?></h2>
```

Aquí sí se usa **`+`** porque se suman números (para unir texto sería `.`).

---

## 8. Calculadora con varios botones (`index9.php` + `index10.php`)

Cada botón tiene **su propio `name`**. Al enviar, **solo llega el botón que has pulsado**.

```html
<form action="index10.php" method="post">
    <input type="text" name="miInput1">
    <input type="text" name="miInput2">
    <button type="submit" name="miBoton1" value="multiplicar">x</button>
    <button type="submit" name="miBoton2" value="dividir">/</button>
    <button type="submit" name="miBoton3" value="sumar">+</button>
    <button type="submit" name="miBoton4" value="restar">-</button>
</form>
```

```php
<h2>Resultado: <?php
if (($_POST['miBoton1'] ?? '') === 'multiplicar') {
    echo $_POST['miInput1'] * $_POST['miInput2'];
} else if (($_POST['miBoton2'] ?? '') === 'dividir') {
    echo $_POST['miInput1'] / $_POST['miInput2'];
} else if (($_POST['miBoton3'] ?? '') === 'sumar') {
    echo $_POST['miInput1'] + $_POST['miInput2'];
} else if (($_POST['miBoton4'] ?? '') === 'restar') {
    echo $_POST['miInput1'] - $_POST['miInput2'];
}
?></h2>
```

### `??` (importante)

`$_POST['miBoton2'] ?? ''` = **"si `miBoton2` no ha llegado, usa `''`"**.

Sin `??`, al pulsar "x" daría error *Undefined array key "miBoton2"*, porque los otros botones no llegan.

**Ojo:** en el `index9.php` del profe pone `type="sumbit"` (mal escrito). Lo correcto es **`submit`**.

---

## 9. `switch`: estación y horóscopo (`index11.php` + `resultado_11.php`)

```html
<form action="resultado_11.php" method="post">
    NOMBRE DEL MES: <input type="text" name="mes">
    <input type="submit" name="boton" value="DAME">
</form>
```

```php
<?php
$mes = strtolower($_POST["mes"]);   // "Mayo" -> "mayo"

function strMes($mes)
{
    return "El mes $mes corresponde a la estación ";
}

switch ($mes)
{
    case "abril":
    case "mayo":
    case "junio":
        echo strMes($mes) . "PRIMAVERA";
        if ($mes === "abril")
            echo " y el horóscopo es ARIES";
        else if ($mes === "mayo")
            echo " y el horóscopo es TAURO";
        else if ($mes === "junio")
            echo " y el horóscopo es GÉMINIS";
        break;

    case "enero":
    case "febrero":
    case "marzo":
        echo strMes($mes) . "INVIERNO";
        if ($mes === "enero")
            echo " y el horóscopo es CAPRICORNIO";
        else if ($mes === "febrero")
            echo " y el horóscopo es ACUARIO";
        else if ($mes === "marzo")
            echo " y el horóscopo es PISCIS";
        break;

    default:
        echo "No has escrito un mes";
}
?>
```

1. **Varios `case` seguidos** = el mismo código para todos.
2. **`break`** al final de cada grupo. Sin él, sigue ejecutando el siguiente.
3. **`default`** = si no coincide ninguno.
4. **`strtolower()`** pasa a minúsculas, así da igual si escriben "MAYO" o "Mayo".

**Ojo, fallos del profe:** enero-marzo pone **PRIMAVERA** (es **INVIERNO**). Y en `index11.php` hay una **coma** sobrante entre `action` y `method`. Aquí ya van corregidos.

**Para el examen:** puede pedirte completar los 12 meses (julio-septiembre verano, octubre-diciembre otoño).

---

## 10. Pirámide de asteriscos (`Proyecto2/index.php`)

```php
function imprimir($n, $c)
{
    for ($i = 0; $i < $n; $i++)
    {
        echo $c;
    }
}

$altura = 21;
$nAst = -1;
for ($i = 1; $i <= $altura; $i++)
{
    imprimir($altura - $i, "_");   // relleno: va bajando
    $nAst = $nAst + 2;             // asteriscos: 1, 3, 5, 7...
    imprimir($nAst, "*");
    echo "<br/>";
}
```

Con `$altura = 3` sale:

```
__*
_***
*****
```

| Fila `$i` | `_` (`$altura - $i`) | `*` (`$nAst`) |
|---|---|---|
| 1 | 2 | 1 |
| 2 | 1 | 3 |
| 3 | 0 | 5 |

**Error típico:** `$nAst = +2;` (vale siempre 2). Lo correcto: **`$nAst = $nAst + 2;`** o **`$nAst += 2;`**.

---

## 11. `<select>` generado con un bucle (`Proyecto2/index2.php`)

```php
<form action="index3.php" method="post">
    <label>Número de palabras</label>
    <select name="numeros">
        <?php
            for ($i = 1; $i <= 100; $i++)
            {
                echo '<option value="' . $i . '">' . $i . '</option>';
            }
        ?>
    </select>

    <label>Tamaño palabras</label>
    <select name="tam">
        <?php
            for ($i = 3; $i <= 6; $i++)
            {
                echo '<option value="' . $i . '">' . $i . '</option>';
            }
        ?>
    </select>

    <input type="submit" name="boton1" value="Ejecuta!!!">
</form>
```

1. El **`name` va en el `<select>`**, no en cada `<option>`.
2. Lo que llega en `$_POST['numeros']` es el **`value`** de la opción elegida.
3. **Comillas:** simples por fuera para poder meter las `"` del HTML dentro.

---

## 12. Palabras aleatorias (`Proyecto2/index3.php`)

```php
<?php
function letraAleatoria()
{
    $todasLetras = "abcdefghijklmnñopqrstuvwxyz";
    $rr = rand(0, mb_strlen($todasLetras) - 1);
    return mb_substr($todasLetras, $rr, 1);
}

function palabraAletoria($tam)
{
    $palabro = "";
    for ($i = 0; $i < $tam; $i++)
    {
        $palabro .= letraAleatoria();
    }
    return $palabro;
}
?>

<body>
    <?php
    for ($i = 0; $i < $_POST['numeros']; $i++)
    {
        echo palabraAletoria($_POST['tam']);
        echo "<br/>";
    }
    ?>
</body>
```

| Función | Qué hace |
|---|---|
| `rand(min, max)` | Número aleatorio entre min y max (**los dos incluidos**) |
| `mb_strlen($texto)` | Cuántas letras tiene |
| `mb_substr($texto, pos, n)` | Saca `n` letras desde la posición `pos` |
| `.=` | **Añade al final**: `$a .= "x"` es `$a = $a . "x"` |

1. **Posiciones desde 0**: por eso `rand(0, longitud - 1)`.
2. **¿Por qué `mb_`?** Por la **ñ**: ocupa 2 bytes y con `strlen`/`substr` normales sale un símbolo raro.
3. **Empieza la palabra vacía** (`""`) y vas añadiendo letras con `.=`.

### El enunciado de clase (`index12.php` y `Proyecto2/index.php`)

> Un desplegable con números de 1 a 100 y otro de 3 a 6 (tamaño de las palabras). Al enviarlo, otra página genera una **lista no ordenada HTML** con tantas palabras aleatorias como el número elegido.

El profe las saca con `<br/>`. Pide **lista no ordenada**. Pistas (hazlo tú):

1. Escribe `<ul>` **antes** del bucle.
2. Dentro del bucle, cada palabra entre **`<li>`** y **`</li>`**.
3. Escribe `</ul>` **después** del bucle.

---

## 13. Errores típicos

| Error | Correcto |
|---|---|
| `echo $a + $b` para unir texto | `echo $a . $b` |
| Falta `;` | Todas las sentencias acaban en `;` |
| `$_POST['MiInput1']` con otra mayúscula | Igual que el `name` del HTML |
| `$_POST['boton']` de un botón no pulsado | `$_POST['boton'] ?? ''` |
| `type="sumbit"` | `type="submit"` |
| `<form action="x.php", method="post">` | **Sin coma** entre atributos |
| `case` sin `break` | `break` al final de cada grupo |
| Función con `&` sin `&` | Sin `&` no cambia la variable de fuera |
| `$nAst = +2;` | `$nAst = $nAst + 2;` |
| `if ($x = 5)` | `if ($x === 5)` (un `=` asigna) |
| `strlen` con ñ | `mb_strlen` |
| `rand(0, mb_strlen($s))` | `rand(0, mb_strlen($s) - 1)` |
| Abrir el `.php` con doble clic | `http://localhost/AD/...` con **Apache encendido** |

---

## 14. Cómo hacer un ejercicio de formulario (pasos)

1. **Página 1:** el `<form>` con `action` (a dónde va), `method="post"` y un `name` en cada campo.
2. **Página 2:** pon arriba **`var_export($_POST);`** y comprueba qué llega.
3. Lee los datos con **`$_POST['name']`** (con `?? ''` si puede no llegar, como los botones).
4. Haz la lógica en **funciones** (como `letraAleatoria` o `strMes`).
5. **Prueba** con datos fáciles y compara con lo que calculas a mano.
6. **Quita el `var_export`** antes de entregar.

---

## 15. Chuleta final

| Necesito... | Uso |
|---|---|
| Escribir en la página | `echo` |
| Unir textos | `.` |
| Añadir al final | `.=` |
| Ver el tipo | `gettype($x)` |
| Ver qué llega del form | `var_export($_POST);` |
| Leer un campo | `$_POST['name']` |
| Valor si no llega | `$_POST['x'] ?? ''` |
| Constante | `define('PI', 3.14);` |
| Raíz cuadrada | `sqrt($n)` |
| Modificar variable de fuera | Parámetro con `&` |
| Valor por defecto | `function f($a = 3)` |
| Comparar bien | `===` |
| Y / O | `&&` / `\|\|` |
| A minúsculas | `strtolower($s)` |
| Aleatorio | `rand(0, 10)` |
| Longitud con ñ | `mb_strlen($s)` |
| Una letra | `mb_substr($s, $pos, 1)` |
| Muchos casos de una variable | `switch` + `case` + `break` |
| Variable con nombre en otra variable | `$$nombre` |

---

## 16. Lo último de clase: diccionario con POST y `$$`

**Esto NO está en el GitHub del profe** (último commit de AD: 16/10, "formularios varios"). Está montado a partir de lo que te ha dicho tu compañero: **un diccionario con `post`, un `for` y `$$`**. Cuando el profe lo suba, compáralo con esto.

### Qué es `$$` (variable variable)

`$$nombre` = **"la variable que se llama como lo que hay dentro de `$nombre`"**.

```php
$nombre = "edad";
$$nombre = 24;     // es lo mismo que: $edad = 24;
echo $edad;        // 24
```

| Escribes | PHP entiende |
|---|---|
| `$nombre` | `"edad"` (un texto) |
| `$$nombre` | `$edad` (la variable que se llama así) |

### Para qué sirve con un `for`

Si los campos se llaman `espanol1`, `espanol2`, `espanol3`..., puedes **montar el nombre** con el `for` (`"espanol" . $i`) en vez de escribirlos uno a uno.

### Página 1: el formulario

```html
<form action="diccionario.php" method="post">
    Español 1: <input type="text" name="espanol1"> Inglés 1: <input type="text" name="ingles1"><br/>
    Español 2: <input type="text" name="espanol2"> Inglés 2: <input type="text" name="ingles2"><br/>
    Español 3: <input type="text" name="espanol3"> Inglés 3: <input type="text" name="ingles3"><br/>
    <input type="submit" name="boton" value="Traducir">
</form>
```

Los inputs también se pueden generar con un `for`, como el `<select>` del apartado 11.

### Página 2: recibe con `for` y `$$`

```php
<?php
for ($i = 1; $i <= 3; $i++)
{
    $es = "espanol" . $i;          // "espanol1", "espanol2"...
    $en = "ingles" . $i;           // "ingles1", "ingles2"...

    $$es = $_POST[$es];            // crea $espanol1 = lo que llegó
    $$en = $_POST[$en];            // crea $ingles1 = lo que llegó

    echo $$es . " = " . $$en . "<br/>";
}

echo $espanol2;   // también se pueden usar después por su nombre
?>
```

Con `perro/dog`, `gato/cat` y `casa/house` sale:

```
perro = dog
gato = cat
casa = house
```

1. **`$es`** guarda **el nombre** (texto): `"espanol1"`.
2. **`$_POST[$es]`** lee el campo con ese `name`.
3. **`$$es`** crea la variable **`$espanol1`** con ese valor.

**Ojo:** dentro de comillas dobles, `"$$es"` no funciona bien. Concatena con `.` como en el ejemplo.
