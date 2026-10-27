# Apuntes para copiar a mano · AD PHP

**Todo lo del GitHub del profe (AD), archivo por archivo**, más el diccionario de clase y unos extras al final.
Sus fallos están corregidos (marcados con **[corregido]**).

---

## 1. Proyecto1/index.php · Lo básico

```php
<?php
echo "HOLA MUNDO <br/>";
echo 55;
$edad = 24;
$apellido = "Fernández";
echo $edad . $apellido;          // . une textos
echo gettype($edad);             // integer
$edad = "ocho";                  // cambia de tipo sin problema
var_export($edad);               // 'ocho'
echo gettype($edad);             // string
echo ' edad es $edad ';          // simples: literal → edad es $edad
echo " edad es $edad ";          // dobles: sustituye → edad es ocho
define('PI', 3.141592);          // constante: echo PI; (sin $)
?>
```

**1,2,3,4,5,6 sin coma al final (3 formas):**

```php
$tamano = 6;
for ($i = 1; $i <= $tamano; $i++)        // A) coma después si no es el último
{
    echo $i;
    if ($i < $tamano) { echo ','; }
}
for ($i = 1; $i <= $tamano; $i++)        // B) coma antes si no es el primero
{
    if ($i > 1) echo ',';
    echo $i;
}
$comma = "";                              // C) separador que empieza vacío
for ($i = 1; $i <= $tamano; $i++)
{
    echo $comma . $i;
    $comma = ",";
}
```

---

## 2. Proyecto1/index2.php · Funciones con return

```php
function saludar($nombre, $saludo)
{
    return $saludo . $nombre;
}
echo saludar("Begoña", "Qué tal ");      // Qué tal Begoña

function NumeroMayor($num1, $num2)
{
    if ($num1 > $num2) return $num1;
    else return $num2;
}

function numeroMayor3_($num1, $num2, $num3)      // versión con &&
{
    if ($num3 > $num2 && $num3 > $num1) return $num3;
    return NumeroMayor($num1, $num2);
}

function numeroMayor3__($num1, $num2, $num3)     // versión corta: función dentro de función
{
    return NumeroMayor($num3, NumeroMayor($num1, $num2));
}

function numeroMayor3($num1, $num2, $num3)       // si hay repetidos → -1
{
    if ($num1 === $num2 || $num1 === $num3 || $num2 === $num3)
    {
        return -1;
    }
    return numeroMayor3_($num1, $num2, $num3);
}
echo numeroMayor3(1,2,3);    //3
echo numeroMayor3(1,1,2);    //-1
```

- `&&` = Y (los dos) · `||` = O (al menos uno) · `===` = igual en valor y tipo
- Probar con todos los órdenes: (1,2,3) (1,3,2) (3,1,2) (3,2,1)...

---

## 3. Proyecto1/index3.php · Por defecto y por referencia

```php
function hipotenusa($cateto = 3, $cateto2 = 4)          // valores por defecto
{
    return sqrt($cateto * $cateto + $cateto2 * $cateto2);
}
echo hipotenusa();        // 5 (usa 3 y 4)

function calcularHipotenusa($lado1, $lado2, &$hipotenusa)   // & = por referencia
{
    $suma = ($lado1 * $lado1) + ($lado2 * $lado2);
    $hipotenusa = sqrt($suma);
}
calcularHipotenusa(5, 6, $hipo);
echo "la hipotenusa es: $hipo";
```

**Sin & (copia): hay que recoger el return**

```php
$n = 0;
$n = f($n);
function f($n)
{
    $n = $n + 1;          // cambia la COPIA
    return $n;
}
echo $n;                  // 1
```

| Sin `&` | Con `&` |
|---|---|
| Copia: lo de fuera no cambia | La variable de fuera SÍ cambia |
| Hay que usar `return` | No hace falta `return` |

---

## 4. Proyecto1/index4.php · Calculadora con referencia

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
echo $resultado . "<br>";       // 4
calcular(1, 0, "/", $resultado);
echo $resultado . "<br>";       // No se puede dividir por 0
```

- **Ojo:** si `$num2` viene de `$_POST` es texto → comprobar `$num2 === "0"`

---

## 5. Proyecto1/index5.php + index6.php · Formulario simple

**index5.php (formulario):**

```html
<form action="index6.php" method="post">
    <input type="text" name="miInput1">
    <input type="submit" name="miBoton1" value="dame!">
</form>
```

**index6.php (recibe):**

```php
<?php
    var_export($_POST);          // ver qué llega
?>
<h2>En el input llega el valor <?php echo $_POST['miInput1'] ?></h2>
```

- `action` = a qué archivo va · `method="post"` → llega en `$_POST`
- `$_POST['miInput1']` = el `name` del input (mismas mayúsculas)
- PHP dentro de HTML: `<?php ... ?>` en mitad del HTML

---

## 6. Proyecto1/index7.php + index8.php · Sumar dos números

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

---

## 7. Proyecto1/index9.php + index10.php · Varios botones con ??

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

**[corregido]** el profe pone `type="sumbit"` → es `submit`

```php
<?php
if (($_POST['miBoton1'] ?? '') === 'multiplicar')
{
    echo $_POST['miInput1'] * $_POST['miInput2'];
}
else if (($_POST['miBoton2'] ?? '') === 'dividir')
{
    echo $_POST['miInput1'] / $_POST['miInput2'];
}
else if (($_POST['miBoton3'] ?? '') === 'sumar')
{
    echo $_POST['miInput1'] + $_POST['miInput2'];
}
else if (($_POST['miBoton4'] ?? '') === 'restar')
{
    echo $_POST['miInput1'] - $_POST['miInput2'];
}
?>
```

- **Solo llega el botón pulsado.** `?? ''` = "si no ha llegado, vale ''" → sin Warning

---

## 8. Proyecto1/index11.php + resultado_11.php · switch: estación y horóscopo

```html
<form action="resultado_11.php" method="post">
    NOMBRE DEL MES: <input type="text" name="mes">
    <input type="submit" name="boton" value="DAME">
</form>
```

**[corregido]** el profe pone una coma entre `action` y `method` → sin coma

```php
<?php
$mes = strtolower($_POST["mes"]);       // "MAYO" → "mayo"
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
        if ($mes === "abril") echo " y el horóscopo es ARIES";
        else if ($mes === "mayo") echo " y el horóscopo es TAURO";
        else if ($mes === "junio") echo " y el horóscopo es GÉMINIS";
        break;
    case "enero":
    case "febrero":
    case "marzo":
        echo strMes($mes) . "INVIERNO";          // [corregido] el profe pone PRIMAVERA
        if ($mes === "enero") echo " y el horóscopo es CAPRICORNIO";
        else if ($mes === "febrero") echo " y el horóscopo es ACUARIO";
        else if ($mes === "marzo") echo " y el horóscopo es PISCIS";
        break;
    default:
        echo "No has escrito un mes";
}
?>
```

- Varios `case` seguidos = mismo código · `break` al final de cada grupo · `default` = ninguno
- Por si lo pide completo: julio-agosto-septiembre **VERANO** (Cáncer, Leo, Virgo) · octubre-noviembre-diciembre **OTOÑO** (Libra, Escorpio, Sagitario)

---

## 9. Proyecto2/index.php · Pirámide de asteriscos

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
    imprimir($altura - $i, "_");     // relleno: va bajando
    $nAst = $nAst + 2;               // asteriscos: 1, 3, 5, 7...
    imprimir($nAst, "*");
    echo "<br/>";
}
```

| Fila `$i` | `_` = altura - i | `$nAst` |
|---|---|---|
| 1 | altura - 1 | -1 + 2 = 1 |
| 2 | altura - 2 | 1 + 2 = 3 |
| 3 | altura - 3 | 3 + 2 = 5 |

- `$nAst` empieza en -1 porque se suma ANTES de pintar · también vale `2 * $i - 1`
- Error típico: `$nAst = +2;` (vale siempre 2)

---

## 10. Proyecto2/index2.php · Desplegables generados con for

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

- El `name` va en el `<select>` · llega el `value` de la opción elegida
- Comillas simples por fuera, dobles (del HTML) por dentro, `. $i .` en medio

---

## 11. Proyecto2/index3.php · Palabras aleatorias

```php
<?php
function letraAleatoria()
{
    $todasLetras = "abcdefghijklmnñopqrstuvwxyz";       // DENTRO de la función
    $rr = rand(0, mb_strlen($todasLetras) - 1);         // posiciones de 0 a long-1
    return mb_substr($todasLetras, $rr, 1);
}
function palabraAletoria($tam)
{
    $palabro = "";                                      // caja vacía
    for ($i = 0; $i < $tam; $i++)
    {
        $palabro .= letraAleatoria();                   // .= añade
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
| `rand(min, max)` | Aleatorio, los dos incluidos |
| `mb_strlen($t)` | Longitud (bien con ñ) |
| `mb_substr($t, pos, n)` | n letras desde pos |

**El enunciado (index12.php) pide lista no ordenada** → `echo "<ul>";` antes del for, `echo "<li>" . $palabra . "</li>";` dentro, `echo "</ul>";` después.

---

## 12. Clase (no está en el GitHub) · Diccionario con POST, for y $$

```php
$nombre = "edad";
$$nombre = 24;                   // es lo mismo que $edad = 24

for ($i = 1; $i <= 3; $i++)
{
    $es = "espanol" . $i;        // "espanol1", "espanol2"...
    $en = "ingles" . $i;
    $$es = $_POST[$es];          // crea $espanol1 con lo que llegó
    $$en = $_POST[$en];
    echo $$es . " = " . $$en . "<br/>";
}
```

- Formulario: inputs con `name="espanol1"`, `name="ingles1"`, `name="espanol2"`...

---

## 13. Extras (no están en el GitHub, pero salen de lo mismo)

**Construir un texto: caja + for + .= + return**

```php
function invertir($texto)
{
    $resultado = "";
    for ($i = mb_strlen($texto) - 1; $i >= 0; $i--)
    {
        $resultado .= mb_substr($texto, $i, 1);
    }
    return $resultado;
}
```

- Filtrar: `$letra = mb_substr($texto, $i, 1); if ($letra !== " ") { $resultado .= $letra; }`
- Contar: `$contador = 0;` ... `if ($letra === $buscada) { $contador++; }` ... `return $contador;`

**Pirámide invertida:** el mismo cuerpo, con el for al revés: `for ($i = $altura; $i >= 1; $i--)` y `imprimir(2 * $i - 1, "*")`

**Botón pulsado (forma segura):** `$boton = $_POST['boton'] ?? '';` → `if ($boton !== '') { ... }`

**Campo vacío:** `if ($_POST['texto'] === "") { echo "Rellena el campo"; }`

---

## RECUADRO · Errores que NO puedo cometer

1. `.=` añade · `=` machaca.
2. La caja (`$resultado = "";`) va ANTES del for. Si no: Warning.
3. `return` DESPUÉS del for, nunca dentro.
4. No machacar el parámetro (`$texto = "";` borra lo que me pasan).
5. Una variable para lo que recibo y otra para lo que construyo.
6. Las funciones NO ven las variables de fuera.
7. Posiciones de 0 a longitud-1 → `mb_strlen($t) - 1` y `<` (no `<=`).
8. Siempre `===`. Siempre `$`. Siempre `;`.
9. Botones con `?? ''`. El `action` con `.php`. Sin comas entre atributos.
10. Comentarios `/* */` solo DENTRO de `<?php ?>`.
11. Lo de `$_POST` es texto: `"0" === 0` es falso.
12. `name` del HTML = clave de `$_POST['...']`, con las mismas mayúsculas.
