# PHP: de cero a profesional

Guía de estudio y referencia · Arturo Orea · DAM2 — Acceso a Datos

---

## Cómo usar esta guía

Tiene dos partes y se usan de forma distinta:

- **Parte 1 — Ruta de estudio.** Se lee en orden, de arriba abajo. Dice qué aprender en cada nivel, por qué importa y qué ejercicio hacer. Los ejercicios **no traen solución**: el objetivo es que el código lo escribas tú.
- **Parte 2 — Referencia.** No se lee seguida. Se consulta cuando te atascas con algo concreto.

Todos los ejercicios construyen **el mismo proyecto**, que va creciendo nivel a nivel: un **catálogo de videojuegos** con su base de datos. Nada de ejemplos de juguete sueltos — al final del recorrido tienes una aplicación entera que puedes enseñar.

**Regla de oro:** no pases de nivel hasta que el ejercicio funcione y puedas explicar en voz alta por qué funciona. Ir rápido y no entender nada es la forma más eficiente de perder un curso.

---

# Parte 1 — Ruta de estudio

## Nivel 0 — El entorno ✅

Ya lo tienes montado. Está documentado en `entorno-php-AD.pdf`, en el Escritorio.

Lo único que hay que tener grabado a fuego:

- PHP se ejecuta **en el servidor**, antes de que el navegador vea nada
- Solo funciona a través de `http://localhost/...`, nunca con doble clic
- `php.ini` se lee **al arrancar** Apache

---

## Nivel 1 — Fundamentos del lenguaje

**Qué aprender**

- Variables y tipos: `string`, `int`, `float`, `bool`, `array`, `null`
- Tipado dinámico y conversión automática (*juggling*)
- Operadores, y la diferencia entre `==` y `===`
- Condicionales: `if`, `else`, `switch`, `match`
- Bucles: `while`, `for`, `foreach`
- Arrays indexados y asociativos
- Funciones: parámetros, valor de retorno, tipos declarados
- Interpolación de strings y concatenación

**Por qué importa**

PHP es *dinámicamente tipado*: una variable no declara su tipo y puede cambiarlo sobre la marcha. Es cómodo y es una fuente de bugs enorme. `"5" + 3` da `8`, pero `"5" == 5` es `true` y `"5" === 5` es `false`. Si no entiendes esto desde el principio, vas a perseguir errores fantasma durante meses.

**Ejercicio 1 — La lista en memoria**

En `catalogo/`, crea `juegos.php`. Define un array de arrays asociativos con 5 juegos: `titulo`, `plataforma`, `anio`, `nota` (0-10). Recórrelo con `foreach` y píntalo como una tabla HTML.

Requisitos:

- Los juegos con nota ≥ 8 salen en negrita
- Al final, una fila con la **nota media** redondeada a un decimal
- Usa sintaxis alternativa (`foreach: ... endforeach;`) porque va mezclado con HTML

**Antes de pasar al Nivel 2, contéstate:** ¿qué devuelve `"10" == "1e1"` y por qué? ¿Y `0 == "hola"` en PHP 8?

---

## Nivel 2 — La web: entrada del usuario

**Qué aprender**

- `$_GET` y `$_POST`: qué son y en qué se diferencian
- `$_SERVER['REQUEST_METHOD']` para distinguir "me han pedido la página" de "me han enviado el formulario"
- Validación y saneado: `filter_input`, `htmlspecialchars`
- `isset`, `empty`, `??` (operador de fusión de null)
- Redirecciones con `header('Location: ...')`
- Sesiones: `session_start`, `$_SESSION`
- Cookies

**Por qué importa**

Todo lo que llega del usuario es **hostil hasta que se demuestre lo contrario**. Un `$_POST['nombre']` puede contener `<script>`, comillas, o no existir. Aquí es donde empiezan el 90% de los agujeros de seguridad de una web.

**Ejercicio 2 — Formulario de alta**

Añade `alta.php`: un formulario que envía por POST a sí mismo (`action=""`) con los cuatro campos de un juego.

Requisitos:

- Si el método es `GET`, solo pinta el formulario
- Si es `POST`, valida: título no vacío, año entre 1970 y el actual, nota entre 0 y 10
- Si hay errores, vuelve a pintar el formulario **con los valores que escribió el usuario** y los mensajes de error al lado de cada campo
- Si todo es válido, guarda el juego en `$_SESSION` y redirige a `juegos.php`
- Escapa **siempre** con `htmlspecialchars` al imprimir cualquier cosa que venga del usuario

**Comprueba que lo entiendes:** ¿por qué se redirige después de un POST correcto en vez de pintar la página directamente? (Busca "patrón POST/Redirect/GET".)

---

## Nivel 3 — Base de datos con PDO

Este es el nivel que da nombre al módulo. El resto del curso vive aquí.

**Qué aprender**

- SQL básico: `CREATE TABLE`, `INSERT`, `SELECT`, `UPDATE`, `DELETE`, `WHERE`, `ORDER BY`
- phpMyAdmin (`http://localhost/phpmyadmin`) para mirar y trastear
- **PDO**: conexión, DSN, opciones
- **Consultas preparadas** y por qué son obligatorias
- `fetch`, `fetchAll`, modos de fetch
- Manejo de errores: `PDO::ERRMODE_EXCEPTION` y `try/catch`
- Transacciones

**Por qué importa**

Concatenar variables dentro de una consulta SQL es **inyección SQL**, la vulnerabilidad más clásica y más destructiva que existe. Las consultas preparadas no son "la forma elegante": son la única forma aceptable. Un profesor te baja la nota; en producción, te vacían la base de datos.

```php
// MAL — inyección SQL
$sql = "SELECT * FROM juegos WHERE titulo = '$titulo'";

// BIEN — consulta preparada
$stmt = $pdo->prepare('SELECT * FROM juegos WHERE titulo = ?');
$stmt->execute([$titulo]);
```

**Ejercicio 3 — CRUD completo**

Crea la base de datos `catalogo` en phpMyAdmin con una tabla `juegos` (`id` autoincremental, `titulo`, `plataforma`, `anio`, `nota`).

Requisitos:

- `db.php` con la conexión PDO, incluido desde los demás archivos con `require_once`
- **C**rear: `alta.php` inserta de verdad en la tabla
- **R**ead: `juegos.php` lee de la tabla, con un `ORDER BY` configurable por `$_GET`
- **U**pdate: `editar.php?id=X` carga el juego y permite modificarlo
- **D**elete: borrado con confirmación (nunca un `GET` que borre directamente)
- Todas las consultas preparadas. Ninguna excepción.

**Trampa habitual:** si te sale "página en blanco", el error está ahí pero no se muestra. Revisa `display_errors` y mira `C:\xampp\php\logs\php_error_log`.

---

## Nivel 4 — Estructurar el código

**Qué aprender**

- `require`, `include`, `require_once` y por qué casi siempre quieres `require_once`
- Separar en capas: configuración / acceso a datos / lógica / presentación
- Plantillas: un `header.php` y un `footer.php` reutilizados
- Programación orientada a objetos: clases, propiedades, métodos, `__construct`, visibilidad (`public`, `private`, `protected`)
- Herencia e interfaces
- Espacios de nombres (`namespace`) y carga automática (*autoload*)
- Patrón repositorio: una clase que sabe hablar con la tabla y nadie más

**Por qué importa**

Un proyecto de 5 archivos con SQL suelto entre el HTML funciona. Uno de 50 se vuelve imposible de tocar sin romper algo. Separar capas no es estética: es lo que permite cambiar la base de datos sin reescribir las vistas, y probar la lógica sin un navegador delante.

**Ejercicio 4 — Refactorizar sin cambiar el comportamiento**

Coge el CRUD del Nivel 3 y reorganízalo. No añades ni una funcionalidad nueva: al terminar tiene que hacer exactamente lo mismo.

Requisitos:

- Clase `Juego` con sus propiedades tipadas
- Clase `JuegoRepositorio` con los métodos `todos()`, `porId(int $id)`, `guardar(Juego $j)`, `borrar(int $id)`. **Es el único sitio del proyecto donde aparece SQL.**
- Las vistas solo pintan: ni una consulta dentro del HTML
- `header.php` / `footer.php` compartidos
- Un commit por cada paso de la refactorización, no uno gigante al final

---

## Nivel 5 — Nivel profesional

**Qué aprender**

- **Composer**: gestor de dependencias de PHP (el `npm` de este mundo), y `vendor/autoload.php`
- **Excepciones**: lanzar, capturar, crear las tuyas, y por qué no se capturan para ignorarlas
- Logs en vez de `echo` para depurar
- **Seguridad**: `password_hash` / `password_verify` (nunca guardes contraseñas en claro ni con `md5`), tokens CSRF, `.env` fuera del repositorio
- Variables de entorno y configuración por entorno (desarrollo / producción)
- **PSR-12** y un formateador automático
- **PHPUnit**: tests unitarios
- Un framework: **Laravel** o **Symfony**
- APIs REST: devolver JSON, códigos de estado HTTP, `Content-Type`

**Por qué importa**

Es la diferencia entre "me funciona en mi portátil" y "esto se puede desplegar y mantener entre varias personas".

**Ejercicio 5 — Producción**

Sobre el proyecto del Nivel 4:

- Login con usuarios en base de datos y `password_hash`
- Credenciales de la base de datos fuera del código, en un `.env` **añadido a `.gitignore`**
- Un `.env.example` con los nombres de las variables y valores falsos, ese sí versionado
- Excepciones propias (`JuegoNoEncontrado`) en vez de devolver `null` y esperar que alguien lo compruebe
- Un endpoint `api/juegos.php` que devuelva la lista en JSON con el `Content-Type` correcto
- Tests con PHPUnit de la lógica de validación

**Aviso serio:** si alguna vez subes un `.env` con credenciales reales a GitHub, borrarlo en un commit posterior **no lo elimina** — sigue en el historial. Hay que rotar las credenciales. Revisa siempre qué estás subiendo antes de hacer commit.

---

## Orden de aprendizaje recomendado

| Nivel | Enfoque | Señal de que puedes pasar al siguiente |
|---|---|---|
| 1 | Lenguaje | Escribes un bucle con arrays sin consultar nada |
| 2 | Formularios | Entiendes por qué se escapa la salida y se valida la entrada |
| 3 | PDO + SQL | Un CRUD entero con consultas preparadas |
| 4 | Arquitectura | No queda SQL fuera del repositorio |
| 5 | Producción | Sabes por qué el `.env` no va al repositorio |

---

# Parte 2 — Referencia con ejemplos

## Sintaxis básica

```php
<?php
// Comentario de una línea
# También válido, menos habitual
/* Comentario
   de varias líneas */

// Las variables empiezan por $ y distinguen mayúsculas
$nombre = "Arturo";
$Nombre = "otra variable distinta";

echo $nombre;              // imprime
echo "Hola, $nombre";      // interpola: comillas DOBLES
echo 'Hola, $nombre';      // NO interpola: comillas simples -> literal
echo "Hola, " . $nombre;   // concatena con punto, no con +

// La etiqueta de cierre ?> se OMITE en archivos que solo tienen PHP.
// Evita espacios en blanco accidentales que rompen headers y redirecciones.
```

## Tipos y conversión

```php
$entero  = 42;
$decimal = 3.14;
$texto   = "hola";
$logico  = true;
$nada    = null;

var_dump($entero);          // int(42)  -> la herramienta para depurar tipos
echo gettype($decimal);     // double

// Conversión automática: cómoda y peligrosa
var_dump("5" + 3);          // int(8)
var_dump("5" . 3);          // string("53")
var_dump("abc" == 0);       // false en PHP 8 (era true en PHP 7)

// == compara valores tras convertir; === compara valor Y tipo
var_dump(0 == "0");         // true
var_dump(0 === "0");        // false  <- usa SIEMPRE este salvo que sepas por qué no
```

## Strings

```php
$t = "  The Witcher 3  ";

strlen($t);                  // longitud en bytes
mb_strlen($t);               // longitud en caracteres (acentos, ñ): usa las mb_ con UTF-8
trim($t);                    // quita espacios de los extremos
strtoupper($t);              // mayúsculas
str_replace("3", "III", $t); // sustituye
str_contains($t, "Witcher"); // true/false  (PHP 8+)
explode(" ", trim($t));      // string -> array
implode(", ", ["a", "b"]);   // array -> string

// Formatear con plantilla
printf("%s tiene nota %.1f\n", "Hollow Knight", 9.25);  // -> nota 9.3
```

## Arrays

```php
// Indexado
$plataformas = ["PC", "PS5", "Switch"];
echo $plataformas[0];                    // PC
$plataformas[] = "Xbox";                 // añade al final

// Asociativo: la estructura más usada en PHP
$juego = [
    'titulo'     => 'Hollow Knight',
    'plataforma' => 'PC',
    'nota'       => 9.5,
];
echo $juego['titulo'];

// Recorrer
foreach ($plataformas as $p) { echo $p; }
foreach ($juego as $clave => $valor) { echo "$clave: $valor\n"; }

// Funciones útiles
count($plataformas);                         // cuántos elementos
in_array("PC", $plataformas);                // ¿está?
array_keys($juego);                          // ['titulo','plataforma','nota']
array_map(fn($p) => strtolower($p), $plataformas);
array_filter($juegos, fn($j) => $j['nota'] >= 8);
usort($juegos, fn($a, $b) => $b['nota'] <=> $a['nota']);  // <=> es la "nave espacial"
```

## Control de flujo

```php
if ($nota >= 9)      { $txt = "imprescindible"; }
elseif ($nota >= 7)  { $txt = "recomendable"; }
else                 { $txt = "pasable"; }

// match (PHP 8): compara con === y devuelve un valor
$etiqueta = match(true) {
    $nota >= 9 => "imprescindible",
    $nota >= 7 => "recomendable",
    default    => "pasable",
};

// Bucles
for ($i = 1; $i <= 3; $i++)    { echo $i; }
while ($fila = $stmt->fetch())  { echo $fila['titulo']; }
foreach ($juegos as $j)         { echo $j['titulo']; }
```

## Islas de PHP dentro de HTML

```php
<ul>
  <?php foreach ($juegos as $j): ?>
    <li><?= htmlspecialchars($j['titulo']) ?></li>
  <?php endforeach; ?>
</ul>
```

- `<?= ?>` es atajo de `<?php echo ?>`
- La sintaxis con `:` y `endforeach;` se lee mejor entre etiquetas HTML que las llaves
- **Nunca** pongas `<?php` dentro de un comentario HTML `<!-- -->`: PHP no conoce esos comentarios, lo encuentra igual e intenta ejecutarlo

## Funciones

```php
// Tipos declarados en parámetros y retorno: hazlo siempre
function media(array $notas): float
{
    if (count($notas) === 0) {
        return 0.0;
    }
    return array_sum($notas) / count($notas);
}

// Parámetro con valor por defecto
function saludar(string $nombre, string $saludo = "Hola"): string
{
    return "$saludo, $nombre";
}

// Argumentos con nombre (PHP 8)
saludar(nombre: "Arturo", saludo: "Buenas");

// Función flecha: hereda las variables de fuera automáticamente
$conIva = fn(float $p): float => $p * 1.21;
```

## Superglobales

| Variable | Contiene |
|---|---|
| `$_GET` | Datos de la URL (`?id=3`) |
| `$_POST` | Datos de un formulario enviado por POST |
| `$_REQUEST` | Mezcla de los anteriores. **Evítala**, oculta de dónde vienen los datos |
| `$_SESSION` | Datos del usuario entre páginas (requiere `session_start()`) |
| `$_COOKIE` | Cookies del navegador |
| `$_FILES` | Ficheros subidos |
| `$_SERVER` | Información de la petición y del servidor |

```php
// Nunca accedas directamente: puede no existir
$id = $_GET['id'] ?? null;                       // ?? -> si no existe, null

// Validando el tipo
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id === false || $id === null) {
    http_response_code(400);
    exit('Id no válido');
}
```

## Formularios

```php
<!-- alta.php -->
<form action="" method="post">
  <input type="text"   name="titulo" value="<?= htmlspecialchars($titulo ?? '') ?>">
  <input type="number" name="anio"   value="<?= htmlspecialchars($anio ?? '') ?>">
  <button type="submit">Guardar</button>
</form>
```

```php
<?php
// Distinguir "me piden la página" de "me envían el formulario"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $errores = [];

    if ($titulo === '') {
        $errores[] = 'El título es obligatorio';
    }

    if (!$errores) {
        // ... guardar ...
        header('Location: juegos.php');  // redirige tras POST correcto
        exit;                            // SIEMPRE exit después de header()
    }
}
```

**Dos reglas que no se negocian:**

1. **Valida la entrada.** Todo lo que llega del usuario puede ser cualquier cosa.
2. **Escapa la salida.** `htmlspecialchars()` al imprimir cualquier dato del usuario. Sin eso tienes XSS: alguien guarda `<script>` como título y se ejecuta en el navegador de quien mire la lista.

## Sesiones

```php
<?php
session_start();                  // la PRIMERA línea, antes de cualquier salida

$_SESSION['usuario_id'] = 7;
$usuario = $_SESSION['usuario_id'] ?? null;

// Cerrar sesión
session_unset();
session_destroy();
```

## Base de datos con PDO

```php
<?php
// db.php
$dsn = 'mysql:host=localhost;dbname=catalogo;charset=utf8mb4';

$opciones = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,  // errores como excepciones
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,        // filas como array asociativo
    PDO::ATTR_EMULATE_PREPARES   => false,                   // preparadas de verdad
];

try {
    $pdo = new PDO($dsn, 'root', '', $opciones);
} catch (PDOException $e) {
    // En producción: registrar en log, no enseñar el mensaje al usuario
    exit('Error de conexión');
}
```

```php
// SELECT con parámetros posicionales
$stmt = $pdo->prepare('SELECT * FROM juegos WHERE nota >= ? ORDER BY nota DESC');
$stmt->execute([8]);
$juegos = $stmt->fetchAll();

// SELECT con parámetros con nombre (más legible cuando hay varios)
$stmt = $pdo->prepare('SELECT * FROM juegos WHERE plataforma = :plat AND anio > :anio');
$stmt->execute(['plat' => 'PC', 'anio' => 2015]);

// Una sola fila
$stmt = $pdo->prepare('SELECT * FROM juegos WHERE id = ?');
$stmt->execute([$id]);
$juego = $stmt->fetch();          // false si no hay resultados

// INSERT
$stmt = $pdo->prepare('INSERT INTO juegos (titulo, plataforma, anio, nota) VALUES (?,?,?,?)');
$stmt->execute([$titulo, $plataforma, $anio, $nota]);
$nuevoId = $pdo->lastInsertId();

// UPDATE / DELETE: rowCount() dice cuántas filas se tocaron
$stmt = $pdo->prepare('DELETE FROM juegos WHERE id = ?');
$stmt->execute([$id]);
echo $stmt->rowCount();
```

**Los marcadores `?` y `:nombre` solo valen para VALORES.** No puedes parametrizar un nombre de tabla o de columna. Si el usuario elige el orden, valídalo contra una lista blanca:

```php
$permitidos = ['titulo', 'anio', 'nota'];
$orden = in_array($_GET['orden'] ?? '', $permitidos, true) ? $_GET['orden'] : 'titulo';
$juegos = $pdo->query("SELECT * FROM juegos ORDER BY $orden")->fetchAll();
```

## Transacciones

```php
$pdo->beginTransaction();
try {
    $pdo->prepare('UPDATE cuentas SET saldo = saldo - ? WHERE id = ?')->execute([100, 1]);
    $pdo->prepare('UPDATE cuentas SET saldo = saldo + ? WHERE id = ?')->execute([100, 2]);
    $pdo->commit();          // las dos o ninguna
} catch (Throwable $e) {
    $pdo->rollBack();
    throw $e;
}
```

## Programación orientada a objetos

```php
<?php
declare(strict_types=1);   // tipos estrictos: primera línea del archivo

class Juego
{
    public function __construct(
        public readonly ?int $id,        // promoción de propiedades (PHP 8)
        public string $titulo,
        public string $plataforma,
        public int $anio,
        public float $nota,
    ) {}

    public function esImprescindible(): bool
    {
        return $this->nota >= 9;
    }
}

$j = new Juego(null, 'Hollow Knight', 'PC', 2017, 9.5);
echo $j->titulo;                  // -> para acceder, no punto
var_dump($j->esImprescindible());
```

```php
// Repositorio: el ÚNICO sitio donde hay SQL
class JuegoRepositorio
{
    public function __construct(private PDO $pdo) {}

    public function porId(int $id): ?Juego
    {
        $stmt = $this->pdo->prepare('SELECT * FROM juegos WHERE id = ?');
        $stmt->execute([$id]);
        $fila = $stmt->fetch();

        return $fila ? $this->hidratar($fila) : null;
    }

    private function hidratar(array $f): Juego
    {
        return new Juego((int)$f['id'], $f['titulo'], $f['plataforma'],
                         (int)$f['anio'], (float)$f['nota']);
    }
}
```

## Errores y excepciones

```php
class JuegoNoEncontrado extends RuntimeException {}

function obtener(int $id, JuegoRepositorio $repo): Juego
{
    $j = $repo->porId($id);
    if ($j === null) {
        throw new JuegoNoEncontrado("No existe el juego $id");
    }
    return $j;
}

try {
    $juego = obtener(99, $repo);
} catch (JuegoNoEncontrado $e) {
    http_response_code(404);
    echo 'Juego no encontrado';
} catch (Throwable $e) {           // Throwable captura errores Y excepciones
    error_log($e->getMessage());   // al log, no a la pantalla
    http_response_code(500);
}
```

**Nunca** captures una excepción para dejar el bloque vacío. Si no sabes qué hacer con ella, no la captures: que suba.

## Contraseñas

```php
// Al registrar
$hash = password_hash($passwordEnClaro, PASSWORD_DEFAULT);
// guarda $hash en la base de datos (VARCHAR(255))

// Al iniciar sesión
if (password_verify($passwordEnClaro, $hashGuardado)) {
    session_regenerate_id(true);   // evita fijación de sesión
    $_SESSION['usuario_id'] = $usuario['id'];
}
```

Nunca `md5`, nunca `sha1`, nunca texto plano. `password_hash` ya añade la sal por ti.

## Fechas

```php
date_default_timezone_get();                       // Europe/Madrid (está en php.ini)

$hoy = new DateTimeImmutable();
echo $hoy->format('d/m/Y H:i');

$lanzamiento = new DateTimeImmutable('2017-02-24');
$dias = $hoy->diff($lanzamiento)->days;

$mesQueViene = $hoy->modify('+1 month');           // Immutable: devuelve uno nuevo
```

Usa `DateTimeImmutable` en vez de `DateTime`: el segundo se modifica a sí mismo y produce bugs difíciles de ver.

## JSON

```php
$json = json_encode($juegos, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
$datos = json_decode($json, true);    // true -> array asociativo

// Respuesta de una API
header('Content-Type: application/json; charset=utf-8');
echo json_encode(['ok' => true, 'datos' => $juegos]);
exit;
```

## Ficheros

```php
file_get_contents('datos.txt');
file_put_contents('log.txt', "linea\n", FILE_APPEND);
file_exists('datos.txt');

// CSV
$f = fopen('juegos.csv', 'r');
while (($fila = fgetcsv($f)) !== false) {
    print_r($fila);
}
fclose($f);
```

---

## Errores típicos y qué significan

| Mensaje | Causa habitual |
|---|---|
| Página completamente en blanco | Error fatal con `display_errors` apagado. Mira `C:\xampp\php\logs\php_error_log` |
| `Parse error: syntax error, unexpected ...` | Falta un `;`, una llave o una comilla. El número de línea suele apuntar a la SIGUIENTE |
| `Undefined variable $x` | Se usa antes de asignarla, o hay una errata en el nombre |
| `Undefined array key "x"` | La clave no existe. Usa `?? null` |
| `Headers already sent by ...` | Se imprimió algo antes de `header()` o `session_start()`. Suele ser un espacio antes de `<?php` o después de `?>` |
| `Call to a member function ... on null` | Un objeto que esperabas es `null`. Típico de un `fetch()` sin resultados |
| `SQLSTATE[42S02] Base table ... doesn't exist` | Nombre de tabla mal escrito, o base de datos equivocada en el DSN |
| `SQLSTATE[HY093] Invalid parameter number` | El número de `?` no coincide con el de valores de `execute()` |
| Se ve el código PHP en el navegador | No pasaste por `http://localhost`, o el archivo no está bajo `htdocs` |

---

## Recursos

- **Manual oficial**: <https://www.php.net/manual/es/> — la documentación de PHP es de las mejores que existen. Búscala antes que cualquier tutorial.
- **PHP The Right Way**: <https://phptherightway.com/> — prácticas actuales, en contra de los tutoriales viejos que siguen saliendo en Google.
- **PSR-12**: el estándar de estilo que siguen casi todos los proyectos serios.

**Aviso sobre tutoriales antiguos:** hay muchísimo material de PHP 5 circulando. Si ves `mysql_query()`, `ereg()`, `magic_quotes` o `$HTTP_POST_VARS`, cierra la pestaña: está obsoleto desde hace más de una década y algunas de esas funciones ya ni existen.
