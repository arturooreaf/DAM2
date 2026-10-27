# Chuleta AD PHP · 1 folio, 2 caras

## CARA A

**1. Formulario (archivo 1)**
```php
<form action="res.php" method="post">
  <select name="num">
    <?php for ($i = 1; $i <= 50; $i++)
    { echo '<option value="' . $i . '">' . $i . '</option>'; } ?>
  </select>
  <input type="text" name="texto">
  <input type="submit" name="b1" value="Uno">
  <input type="submit" name="b2" value="Dos">
</form>
```

**2. Recibe (archivo 2)**
```php
<?php
$num = $_POST['num'];  $texto = $_POST['texto'];
$b1 = $_POST['b1'] ?? '';  $b2 = $_POST['b2'] ?? '';   // botones con ??
if ($texto === "") { echo "Rellena"; }
else if ($b1 !== '') { ... }
else if ($b2 !== '') { ... }
?>
```
Depurar: `var_export($_POST);` · Todo llega como texto: `"0" === 0` es falso

**3. Construir texto: caja + for + .= + return**
```php
function invertir($texto)
{
    $res = "";
    for ($i = mb_strlen($texto) - 1; $i >= 0; $i--)
    { $res .= mb_substr($texto, $i, 1); }
    return $res;
}
```
Delante: `for ($i = 0; $i < mb_strlen($texto); $i++)`
Filtrar: `$l = mb_substr($texto, $i, 1); if ($l !== " ") { $res .= $l; }`
Contar: `$c = 0;` … `if ($l === $buscada) { $c++; }` … `return $c;`

**4. Función con &**
```php
function calcular($n1, $n2, $op, &$res)
{
    if ($op === "+") $res = $n1 + $n2;
    else if ($op === "/")
    {
        if ($n2 === 0 || $n2 === "0") $res = "No se puede dividir por 0";
        else $res = $n1 / $n2;
    }
}
$r = 0;  calcular(6, 3, "/", $r);  echo $r;   // 2
```
Sin `&` = copia (hay que hacer `return`) · Por defecto: `function f($a = 3, $b = 4)`

**5. Letra / palabra aleatoria**
```php
function letra()
{
    $l = "abcdefghijklmnñopqrstuvwxyz";          // DENTRO
    return mb_substr($l, rand(0, mb_strlen($l) - 1), 1);
}
function palabra($tam)
{
    $p = "";
    for ($i = 0; $i < $tam; $i++) { $p .= letra(); }
    return $p;
}
```
Lista: `echo "<ul>";` → en el for `echo "<li>$p</li>";` → `echo "</ul>";`

---

## CARA B

**6. Pirámide**
```php
function imprimir($n, $c) { for ($i = 0; $i < $n; $i++) { echo $c; } }
$nAst = -1;
for ($i = 1; $i <= $altura; $i++)
{
    imprimir($altura - $i, "_");
    $nAst = $nAst + 2;               // 1, 3, 5... (= 2*$i - 1)
    imprimir($nAst, "*");
    echo "<br/>";
}
```
Invertida: `for ($i = $altura; $i >= 1; $i--)` con `imprimir(2 * $i - 1, "*")`

**7. switch agrupado**
```php
$mes = strtolower($_POST['mes']);
switch ($mes)
{
    case "enero": case "febrero": case "marzo":
        echo "INVIERNO";
        if ($mes === "enero") echo " CAPRICORNIO";
        break;
    default: echo "No es un mes";
}
```
Ene-mar invierno · abr-jun primavera · jul-sep verano · oct-dic otoño

**8. Mayor de 3**
```php
function mayor($a, $b) { if ($a > $b) return $a; else return $b; }
function mayor3($a, $b, $c)
{
    if ($a === $b || $a === $c || $b === $c) return -1;
    return mayor($c, mayor($a, $b));
}
```
`&&` = Y · `||` = O · Medio: `$a + $b + $c - $mayor - $menor`

**9. $$ (diccionario)**
```php
for ($i = 1; $i <= 3; $i++)
{
    $es = "espanol" . $i;  $$es = $_POST[$es];    // crea $espanol1...
    echo $$es . "<br/>";
}
```

**10. Básico**
`"Hola $x"` sustituye · `'Hola $x'` literal · `.` une · `define('PI', 3.14);` · `gettype($x)`
Comas: `$coma = "";` → en el for `echo $coma . $i; $coma = ",";`

**11. ERRORES (recuadro)**
1. `.=` añade, `=` machaca
2. Caja vacía ANTES del for · `return` DESPUÉS
3. No machacar el parámetro · funciones no ven variables de fuera
4. Posiciones 0 a long-1: `- 1` y `<`
5. Siempre `===`, `$` y `;`
6. Botones `?? ''` · `action` con `.php` · sin comas entre atributos
7. `name` del HTML = `$_POST['...']`
