# JavaScript desde cero — Sesiones 1, 2 y 3

Apuntes del Bloque 1 del curso de React Native. Siguen el temario de las tres sesiones del profesor, con una analogía, un ejemplo comentado y la trampa típica de cada concepto.

**Índice**

- [Sesión 1 — Fundamentos del lenguaje](#sesión-1--fundamentos-del-lenguaje)
- [Sesión 2 — Funciones y bucles](#sesión-2--funciones-y-bucles)
- [Sesión 3 — Arrays y objetos](#sesión-3--arrays-y-objetos)
- [Chuleta rápida](#chuleta-rápida)

---

# Sesión 1 — Fundamentos del lenguaje

## 0. Montar el entorno

No hay que instalar nada raro: VS Code y Node.js.

**Node.js** es el programa que ejecuta JavaScript fuera del navegador, directamente en tu ordenador.

El ciclo de trabajo es siempre el mismo: **editar → guardar → ejecutar**.

1. Abre en VS Code una carpeta para los ejercicios.
2. Crea dentro `sesion-01.js`.
3. Abre la terminal integrada (Ctrl + `, la tecla del acento grave).
4. Escribe algo y ejecútalo:

```js
console.log("Funciona");
```

```
node sesion-01.js
```

> **Consejo:** no borres el código de cada apartado al pasar al siguiente. Ve añadiendo debajo. Al final de la sesión tienes el fichero entero como material de repaso.

**Alternativa sin terminal:** la consola del navegador (F12 → pestaña *Console*). Pega ahí el código y pulsa Enter. Va bien para probar una línea suelta; para varias, mejor el fichero.

## 1. Variables: `let` y `const`

Una **variable** es un nombre al que asocias un valor para reutilizarlo.

La analogía: una caja con etiqueta. La etiqueta es el nombre, el contenido es el valor.

```js
const nombre = "Arturo";   // caja PRECINTADA: una vez llena, no se toca
let edad = 27;             // caja que PUEDO vaciar y rellenar

edad = 28;                 // ✓ correcto
edad++;                    // ✓ también: ahora 29

nombre = "Pedro";          // ✗ TypeError: Assignment to constant variable
```

**La regla de clase:** empieza siempre por `const`. Cambia a `let` solo cuando el programa te obligue porque necesitas reasignar. Así el código te avisa de cambios que no pretendías.

**Trampa:** `const` impide **reasignar la caja**, no modificar lo que hay dentro.

```js
const lista = [1, 2, 3];
lista.push(4);        // ✓ permitido: la caja sigue siendo la misma lista
console.log(lista);   // [1, 2, 3, 4]

lista = [9, 9];       // ✗ error: estás cambiando la caja entera
```

### Por qué `var` está prohibida

La verás en tutoriales viejos. Su problema es que **se escapa de los bloques**:

```js
if (true) {
  var a = 1;
  let b = 2;
}

console.log(a);   // 1              ← var sale del bloque. No debería existir aquí.
console.log(b);   // ReferenceError ← let se queda dentro, como es lógico
```

Ese escape provoca errores difíciles de encontrar. No hay ningún motivo para usar `var` en código nuevo.

## 2. Tipos de datos primitivos

Los tres que usarás constantemente:

| Tipo | Qué guarda | Ejemplo |
|---|---|---|
| `number` | Números, con o sin decimales | `42`, `3.14`, `-7` |
| `string` | Texto | `"hola"`, `'adiós'` |
| `boolean` | Verdadero o falso | `true`, `false` |

Y dos que representan "nada":

```js
let a;            // declarada sin valor → undefined ("nadie puso nada aquí")
let b = null;     // yo decido que está vacía       ("aquí no hay nada, a propósito")
```

### `typeof`

Comprueba de qué tipo es algo:

```js
typeof 42          // "number"
typeof "hola"      // "string"
typeof true        // "boolean"
typeof undefined   // "undefined"
```

A diferencia de Java o PHP con tipado estricto, aquí **no declaras el tipo**: lo decide el valor, y una misma variable puede cambiar de tipo sobre la marcha. Es cómodo y es una fuente constante de bugs — por eso existe TypeScript, que llega en la sesión 5.

### Concatenar texto

```js
const nombre = "Arturo";
const edad = 27;

console.log("Hola " + nombre);        // "Hola Arturo"
console.log("Edad: " + edad);         // "Edad: 27"  ← el número se convierte solo
```

Esa conversión automática muerde:

```js
console.log(2 + 3);       // 5     ← dos números: suma
console.log("2" + 3);     // "23"  ← hay texto: concatena
console.log("2" - 3);     // -1    ← el - no concatena, así que convierte a número
```

**Forma moderna, mejor que concatenar.** Con comillas invertidas (`` ` ``) metes variables dentro del texto:

```js
console.log(`Me llamo ${nombre} y tengo ${edad} años`);
```

Dentro de `${}` cabe cualquier expresión: `${edad + 1}`, `${nombre.toUpperCase()}`.

## 3. Operadores

### Aritméticos

```js
10 + 3    // 13
10 - 3    // 7
10 * 3    // 30
10 / 3    // 3.3333333333333335
10 % 3    // 1     ← RESTO de la división
10 ** 3   // 1000  ← potencia
```

El **módulo** (`%`) es el que más vas a usar sin esperarlo. Devuelve lo que sobra de una división:

```js
8 % 2    // 0  → 8 es par
7 % 2    // 1  → 7 es impar
15 % 5   // 0  → 15 es múltiplo de 5
```

Guárdalo: `n % 2 === 0` significa "n es par". En la sesión 2 es la base de FizzBuzz.

### Comparación: `===` frente a `==`

Esto es lo más importante de la sesión.

- `==` compara **después de convertir los tipos**
- `===` compara **valor y tipo**, sin convertir nada

```js
5 == "5"     // true   ← convierte el texto "5" a número y luego compara
5 === "5"    // false  ← number no es string. Fin.

0 == false   // true   ← convierte false a 0
0 === false  // false

null == undefined   // true
null === undefined  // false
```

**Norma de clase: usa siempre `===` y `!==`.** Sin excepciones. El `==` genera bugs que no ves hasta que algo falla en producción, porque la conversión automática hace cosas que nadie espera.

### Valores "falsy"

En un `if`, JavaScript no exige un booleano: convierte lo que le des. Estos seis cuentan como falso:

```js
false, 0, "", null, undefined, NaN
```

Todo lo demás es verdadero. Ojo con estos dos:

```js
if ([])  { }   // ✓ ENTRA: un array vacío es verdadero
if ("0") { }   // ✓ ENTRA: es un texto de un carácter, no el número 0
```

## 4. Condicionales: `if` / `else if` / `else`

```js
const temperatura = 22;

if (temperatura < 0) {
  console.log("Helada");
} else if (temperatura < 15) {
  console.log("Frío");
} else if (temperatura < 25) {
  console.log("Templado");
} else {
  console.log("Calor");
}
// "Templado"
```

**Las condiciones se evalúan en orden y para en la primera que se cumple.** Con `temperatura = -5` entra en la primera y ni mira las demás.

Por eso **el orden importa**. Si pusieras `temperatura < 25` arriba del todo, un -5 también la cumpliría y saldría "Templado". La regla: de lo más restrictivo a lo más general.

Cambia el valor de `temperatura` y ejecuta varias veces hasta ver las cuatro ramas.

## 5. Práctica — elige una

### Opción A: clasificador de edad

1. Declara `const edad = 25;`
2. Encadena condiciones: menor de edad (<18), adulto (18-64), mayor (65+).
3. Prueba los **valores límite**: 0, 17, 18, 40, 64, 65, 90. Ahí es donde salen los fallos de `<` frente a `<=`.
4. Reto: afina con bebé (<3), niño (<12) y adolescente (<18).

### Opción B: calculadora de IMC

1. Declara `peso` en kg y `altura` en metros.
2. Calcula el IMC: `peso / (altura ** 2)`.
3. Clasifícalo según la OMS: bajo peso (<18.5), normal (18.5-24.9), sobrepeso (25-29.9), obesidad (≥30).
4. Redondea a un decimal con `toFixed(1)`:

```js
const imc = 24.567;
console.log(imc.toFixed(1));   // "24.6"  ← ojo: devuelve TEXTO, no número
```

5. Reto: pide los datos con `prompt()` en el navegador. Devuelve texto siempre, así que conviértelo:

```js
const peso = Number(prompt("¿Peso en kg?"));   // sin Number() tendrías "70", no 70
```

---

# Sesión 2 — Funciones y bucles

> Puedes trabajar en la consola del navegador (F12) o con `node`. Si usas la consola, escribe el código en un fichero y **pégalo entero**: línea a línea es un infierno en cuanto hay llaves de por medio.

## 1. Funciones

Una **función** es un bloque de código con nombre que recibe datos, hace algo y devuelve un resultado. Sirve para no repetir el mismo código en diez sitios.

La analogía: una máquina. Metes cosas por la boca de entrada (los parámetros), la máquina trabaja, y sale algo por el otro lado (el `return`). La máquina no va a buscar los ingredientes por su cuenta: tú se los das.

```js
function saludar(nombre) {      // los paréntesis = la boca de entrada
  return `Hola, ${nombre}`;     // return = lo que sale
}

const mensaje = saludar("Arturo");
console.log(mensaje);           // "Hola, Arturo"
```

Fíjate en la correspondencia: **un** nombre al declarar, **un** valor al llamar. Con dos parámetros, dos valores, y en el mismo orden.

### Las dos sintaxis

```js
// Function declaration (la clásica)
function saludar(nombre) {
  return `Hola, ${nombre}`;
}

// Arrow function
const saludar2 = (nombre) => {
  return `Hola, ${nombre}`;
};

// Arrow function abreviada: una sola expresión, sin llaves ni return
const saludar3 = (nombre) => `Hola, ${nombre}`;
```

Las tres hacen lo mismo. **¿Cuál uso?** Son dos sintaxis para la misma idea. Aprende a leer las dos y usa la que te resulte clara.

Dicho eso, **la arrow function es la que vas a ver en todo el código de React Native**, porque encaja en una línea dentro de otra cosa:

```js
<Button onPress={() => setContador(contador + 1)} />
```

Y en la sesión 3, dentro de `map` y `filter`.

### `return` no es `console.log`

```js
function sinRetorno(n) {
  console.log(n * 2);     // imprime, pero no devuelve nada
}

const x = sinRetorno(5);  // imprime 10
console.log(x);           // undefined
```

Imprimir enseña algo por pantalla. `return` **entrega un valor** a quien llamó a la función, para que haga algo con él. Una función sin `return` devuelve `undefined`.

Regla práctica: la función **calcula y devuelve**; quien la llama decide si imprimir, guardar o seguir operando.

### Parámetros por defecto

```js
function saludar(nombre = "invitado") {
  return `Hola, ${nombre}`;
}

saludar("Arturo");   // "Hola, Arturo"
saludar();           // "Hola, invitado"   ← sin argumento, usa el valor por defecto
```

## 2. Bucles

### `for` — cuando sabes cuántas vueltas

```js
for (let i = 1; i <= 5; i++) {
  console.log(i);   // 1, 2, 3, 4, 5
}
```

Tres partes separadas por `;`:

| Parte | Cuándo se ejecuta |
|---|---|
| `let i = 1` — inicio | Una sola vez, al empezar |
| `i <= 5` — condición | Antes de cada vuelta; si es falsa, el bucle termina |
| `i++` — avance | Al final de cada vuelta |

> ### ⚠️ El error número uno de principiante
>
> ```js
> for (let i = 1; i <= 5; i) { }   // ✗ BUCLE INFINITO
> ```
>
> `i` a secas solo **lee** el valor, no lo cambia. `i` vale 1 para siempre, la condición siempre se cumple, y el programa no para nunca.
>
> **Cómo se manifiesta:** en el navegador, la pestaña se congela. En un servidor, una petición que nunca responde y una página que "tarda mucho en cargar".
>
> **Cómo salir:** en el navegador, cierra la pestaña. En `node`, Ctrl + C en la terminal.

### `while` — cuando no sabes cuántas vueltas

```js
let saldo = 100;
let meses = 0;

while (saldo > 0) {     // "mientras quede saldo"
  saldo -= 30;
  meses++;
}

console.log(meses);     // 4   (100 → 70 → 40 → 10 → -20)
```

Fíjate en que acaba en -20, no en 0: la condición se comprueba **antes** de cada vuelta, y con saldo 10 todavía entra una vez más.

**Dentro del cuerpo tiene que haber algo que pueda volver falsa la condición.** Si `saldo` no bajara, bucle infinito igual que antes.

La regla para elegir: si puedes contar las vueltas de antemano, `for`. Si dependen de algo que pasa dentro, `while`.

### `break` y `continue`

```js
for (let i = 0; i < 10; i++) {
  if (i === 3) continue;   // salta ESTA vuelta, sigue con la siguiente
  if (i === 6) break;      // sale del bucle del todo
  console.log(i);          // 0, 1, 2, 4, 5
}
```

### Ejercicio en clase

1. Imprime los números del 1 al 10.
2. Ahora júntalos en una sola línea separados por comas, **sin coma suelta al principio ni al final**:

```
1, 2, 3, 4, 5, 6, 7, 8, 9, 10
```

Ese detalle de la coma es el ejercicio de verdad. Dos caminos: acumular en un array y usar `join(", ")` al final, o ir construyendo un texto y decidir en cada vuelta si toca poner separador. Prueba primero el segundo, que es el que enseña.

## 3. Scope (ámbito)

El **ámbito** es la zona del programa donde una variable existe.

La analogía: una función es una habitación. Desde dentro ves lo que hay en el salón, pero desde el salón no ves lo que hay dentro de la habitación.

```js
function calcularDoble(n) {
  const resultado = n * 2;
  return resultado;
}

console.log(calcularDoble(5));   // 10
console.log(resultado);          // ✗ ReferenceError: resultado is not defined
```

`resultado` nace dentro de la función y **muere en cuanto termina**.

Al revés sí funciona: una función puede leer variables declaradas fuera, antes:

```js
const IVA = 0.21;

function precioFinal(base) {
  return base * (1 + IVA);   // ✓ ve el IVA de fuera
}

precioFinal(100);   // 121
```

**Pero no te apoyes en eso.** Una función que depende de variables externas se rompe en cuanto la mueves de sitio, y no puedes entender qué hace leyendo solo su interior. Pásale por parámetro todo lo que necesite.

> **Diferencia con PHP, que te va a morder:** en PHP una función **no** ve las variables globales de fuera (hay que declararlas con `global`). En JavaScript **sí** las ve. Lo que no cambia es el consejo: parámetros, no variables sueltas.

Que cada función tenga su espacio privado es justo lo que evita que dos partes del programa se pisen una variable llamada `i` o `total`.

`let` y `const` también se limitan al bloque `{ }` donde se declaran:

```js
for (let i = 0; i < 3; i++) {
  // i solo existe aquí dentro
}
console.log(i);   // ✗ ReferenceError
```

## 4. Práctica: FizzBuzz

El ejercicio clásico, en cinco pasos.

**Paso 1 — el esqueleto.** Un `for` del 1 al 100 que imprima cada número. Compruébalo antes de seguir.

**Paso 2 — detectar múltiplos.** Con el módulo:

```js
15 % 3   // 0  → múltiplo de 3
15 % 5   // 0  → múltiplo de 5
7  % 3   // 1  → no lo es
```

**Paso 3 — las condiciones.** Las reglas: múltiplo de 3 → `Fizz`; de 5 → `Buzz`; de ambos → `FizzBuzz`; si no → el número.

El operador `&&` significa **"y"**: la condición completa solo es verdadera si lo son las dos partes.

```js
if (i % 3 === 0 && i % 5 === 0) { ... }   // múltiplo de 3 Y de 5
```

**La clave está en el orden:** el caso "múltiplo de ambos" va **primero**. Si lo pones después, el 15 entra en la rama del 3 y nunca llega a FizzBuzz. Es el mismo principio de la sesión 1: de lo más restrictivo a lo más general.

**Paso 4 — verificar.** Los quince primeros tienen que salir así:

```
1, 2, Fizz, 4, Buzz, Fizz, 7, 8, Fizz, Buzz, 11, Fizz, 13, 14, FizzBuzz
```

Si no cuadran, mira el orden de los `if` antes que nada.

**Paso 5 — convertirlo en función.** Empaquétalo en `fizzBuzz(limite)` para poder llamarlo con 100, con 15 o con lo que quieras.

## 5. Reto extra: tablas de multiplicar

1. `tablaDe(numero)` que imprima la tabla del 1 al 10 con un `for` dentro.
2. Pide el número con `prompt()` (acuérdate de `Number()`).
3. Añade un segundo parámetro para el límite, con 10 por defecto: `tablaDe(7)` llega hasta 10, `tablaDe(7, 20)` hasta 20.

---

# Sesión 3 — Arrays y objetos

Hasta ahora manejabas datos sueltos: una edad, un nombre, un precio. Esta sesión va de **modelar colecciones**: listas de productos, de mensajes, de usuarios, de tareas. Es la base de todo lo que pintarás en pantalla en React Native.

## 1. Arrays

Un **array** es una lista ordenada de valores. Cada posición tiene un índice, y **el primero es el 0**.

```js
const notas = [7, 4, 9, 6];

notas[0]                  // 7   ← primer elemento
notas[3]                  // 6   ← último
notas.length              // 4   ← cuántos hay
notas[notas.length - 1]   // 6   ← el último sin saber el tamaño
```

**Trampa:** `notas[4]` no da error, devuelve `undefined`. JavaScript no te avisa de que te has salido de la lista.

Métodos básicos:

```js
const a = [1, 2, 3];

a.push(4);       // añade al final       → [1, 2, 3, 4]
a.pop();         // quita el último      → [1, 2, 3]
a.unshift(0);    // añade al principio   → [0, 1, 2, 3]
a.shift();       // quita el primero     → [1, 2, 3]
a.includes(2);   // ¿está el 2?          → true
```

## 2. Los cuatro métodos que lo cambian todo

`map`, `filter`, `find` y `reduce` sustituyen a casi todos los `for` que escribirías.

### `map` — transformar cada elemento

La analogía: una cinta transportadora con una máquina encima. Entran 4 cosas, salen 4 cosas, cada una transformada.

```js
const numeros = [1, 2, 3, 4];
const dobles = numeros.map(n => n * 2);

console.log(dobles);    // [2, 4, 6, 8]
console.log(numeros);   // [1, 2, 3, 4]  ← el original intacto
```

**`map` siempre devuelve un array del mismo tamaño.** Si el tuyo sale más corto, el método que querías era otro.

### `filter` — quedarte con algunos

La analogía: un colador. Entran 6, salen los que pasan la prueba.

```js
const numeros = [1, 2, 3, 4, 5, 6];
const pares = numeros.filter(n => n % 2 === 0);

console.log(pares);   // [2, 4, 6]
```

La función que le pasas tiene que devolver `true` o `false`: `true` lo deja pasar, `false` lo descarta.

### `find` — encontrar el primero

```js
const numeros = [1, 5, 8, 12, 3];

numeros.find(n => n > 4);     // 5          ← UN valor, no un array. Se para en el primero.
numeros.find(n => n > 100);   // undefined  ← si no encuentra nada
```

**Diferencia con `filter`:** `filter` devuelve **un array** con todas las coincidencias (vacío si no hay ninguna); `find` devuelve **el elemento** (o `undefined`). Confundirlos es clásico: si haces `.find(...)` y luego `.length`, obtienes `undefined` o la longitud de un texto.

### `reduce` — convertir toda la lista en un solo valor

El más difícil de los cuatro. La analogía: una bola de nieve rodando cuesta abajo. Empieza con un tamaño inicial y cada elemento que encuentra la hace crecer.

```js
const numeros = [1, 2, 3, 4];

const suma = numeros.reduce((acumulado, actual) => acumulado + actual, 0);
//                           ↑ la bola     ↑ el elemento        ↑ tamaño inicial
console.log(suma);   // 10
```

Paso a paso:

| Vuelta | `acumulado` | `actual` | Devuelve |
|---|---|---|---|
| inicio | — | — | 0 |
| 1 | 0 | 1 | 1 |
| 2 | 1 | 2 | 3 |
| 3 | 3 | 3 | 6 |
| 4 | 6 | 4 | 10 |

Ese `0` del final es el **valor inicial** y en la práctica es obligatorio: sin él, `reduce` usa el primer elemento como punto de partida, lo que da resultados raros con arrays de objetos y revienta con arrays vacíos.

### Inmutabilidad

Ninguno de los cuatro modifica el array original: devuelven algo nuevo.

Esto no es un detalle: **es la razón por la que estos métodos son los que se usan en React y React Native**. Esas librerías deciden si repintar la pantalla comparando si el dato es *otro objeto*, no si su contenido cambió. Si modificas un array en su sitio, React no se entera y la pantalla no se actualiza. Si creas uno nuevo con `map` o `filter`, sí.

Lo tendrás delante en la sesión 8.

## 3. Objetos

Un **objeto** agrupa datos relacionados bajo nombres en vez de números.

La analogía: un array es una fila de taquillas numeradas (0, 1, 2...). Un objeto es un armario con cajones etiquetados: "nombre", "nota", "email". Usas el nombre del cajón, no su posición.

```js
const alumno = {
  nombre: "Arturo",        // clave: valor
  nota: 8,
  edad: 27,
  asignaturas: ["AD", "DI", "PMyDM"],   // un valor puede ser otro array
};
```

### Punto y corchetes

```js
alumno.nombre          // "Arturo"       ← notación de punto, la habitual
alumno["nombre"]       // "Arturo"       ← notación de corchetes, mismo resultado

alumno.nota = 9;       // modificar
alumno.email = "a@b.c" // añadir una propiedad nueva
delete alumno.edad;    // eliminar

alumno.telefono        // undefined      ← propiedad inexistente: no da error
```

¿Cuándo corchetes? **Cuando el nombre de la propiedad está en una variable:**

```js
const campo = "nombre";

alumno.campo      // undefined  ← busca una propiedad LITERALMENTE llamada "campo"
alumno[campo]     // "Arturo"   ← usa el VALOR de la variable
```

### Array de objetos

La estructura que más vas a manejar. Combina índice y propiedad:

```js
const alumnos = [
  { nombre: "Ana",    nota: 8, edad: 20 },
  { nombre: "Luis",   nota: 4, edad: 22 },
  { nombre: "Marta",  nota: 9, edad: 21 },
];

alumnos[0]             // { nombre: "Ana", nota: 8, edad: 20 }
alumnos[0].nombre      // "Ana"       ← primero la posición, luego la propiedad
alumnos[2].nota        // 9
```

Y aquí encajan los cuatro métodos:

```js
alumnos.map(a => a.nombre);         // ["Ana", "Luis", "Marta"]
alumnos.filter(a => a.nota >= 5);   // [{Ana...}, {Marta...}]
```

### Objetos anidados y `?.`

```js
const curso = {
  nombre: "DAM2",
  profesor: { nombre: "Luis", email: "luis@centro.es" },
};

curso.profesor.nombre        // "Luis"
curso.tutor.nombre           // ✗ TypeError: Cannot read properties of undefined
curso.tutor?.nombre          // undefined  ← el ?. corta y devuelve undefined
```

El `?.` (**encadenamiento opcional**) evita que el programa reviente cuando una propiedad intermedia no existe. Lo usarás sin parar con datos que vengan de una API (sesión 16).

## 4. Destructuring

**Destructuring** es sacar valores de un objeto o array y meterlos en variables sueltas de una vez.

```js
const alumno = { nombre: "Ana", nota: 8, edad: 20 };

// Sin destructuring:
const nombre = alumno.nombre;
const nota = alumno.nota;

// Con destructuring:
const { nombre, nota } = alumno;   // crea las dos variables de golpe
```

**Los nombres tienen que coincidir con las claves.** `const { nombe } = alumno` (con la errata) te da `undefined`, sin aviso ninguno.

Renombrar y valores por defecto:

```js
const { nombre: n, telefono = "sin datos" } = alumno;
// n         → "Ana"
// telefono  → "sin datos"   (no existía en el objeto)
```

En arrays va **por posición**, no por nombre:

```js
const [primero, segundo] = [10, 20, 30];
// primero → 10, segundo → 20
```

### En los parámetros de una función

Aquí es donde más lo verás:

```js
function ficha({ nombre, nota }) {      // desempaqueta en la propia firma
  return `${nombre} — ${nota}`;
}

ficha(alumno);   // "Ana — 8"
```

Cuando llegues a React (sesión 7), **cada componente recibe sus props exactamente así**.

## 5. Spread y rest

Mismo símbolo, `...`, dos usos opuestos.

### Spread — desparramar

Saca el contenido de un array u objeto y lo esparce:

```js
const a = [1, 2];
const b = [3, 4];
const juntos = [...a, ...b];           // [1, 2, 3, 4]

const base = { nombre: "Ana", nota: 8 };
const subido = { ...base, nota: 10 };  // { nombre: "Ana", nota: 10 }
//                        ↑ lo que va DESPUÉS pisa lo anterior
```

Ese patrón —copiar un objeto cambiando un campo— es el que usarás para actualizar estado en React.

**Su utilidad principal: no modificar el original.**

```js
const original = { nota: 8 };

const malo = original;         // ✗ NO es una copia: dos nombres, un solo objeto
malo.nota = 10;
console.log(original.nota);    // 10  ← has modificado el original sin querer

const bueno = { ...original }; // ✓ copia de verdad
bueno.nota = 10;
console.log(original.nota);    // 8   ← intacto
```

> Es una copia **superficial**: copia el primer nivel. Si el objeto contiene otros objetos o arrays dentro, esos siguen compartidos entre la copia y el original.

### Rest — recoger

En los parámetros de una función, `...` hace lo contrario: agrupa en un array todo lo que sobre.

```js
function sumar(...numeros) {           // recoge TODOS los argumentos
  return numeros.reduce((s, n) => s + n, 0);
}

sumar(1, 2, 3);      // 6
sumar(1, 2, 3, 4);   // 10
```

También al desestructurar:

```js
const { nombre, ...resto } = { nombre: "Ana", nota: 8, edad: 20 };
// nombre → "Ana"
// resto  → { nota: 8, edad: 20 }
```

**Cómo distinguirlos:** a la derecha del `=` es spread (reparte); en los parámetros o a la izquierda es rest (recoge).

## 6. Práctica

Parte de este array:

```js
const alumnos = [
  { nombre: "Ana",    nota: 8, edad: 20 },
  { nombre: "Luis",   nota: 4, edad: 22 },
  { nombre: "Marta",  nota: 9, edad: 21 },
  { nombre: "Carlos", nota: 5, edad: 23 },
  { nombre: "Elena",  nota: 3, edad: 20 },
];
```

1. **`obtenerAprobados(lista)`** — devuelve los alumnos con nota ≥ 5. Usa `filter`.
2. **`calcularMedia(lista)`** — devuelve la nota media. Usa `reduce` y `.length`.
   *Pista:* dentro del `reduce`, cada elemento es un objeto completo. No sumas `alumno`, sumas `alumno.nota`.
3. **`obtenerNombres(lista)`** — devuelve solo los nombres. Usa `map`.
4. **Encadenar.** Calcula la media de los aprobados de dos formas, y comprueba que dan lo mismo:
   - Llamadas anidadas: `calcularMedia(obtenerAprobados(alumnos))`
   - Métodos encadenados: `alumnos.filter(...).reduce(...)`

## 7. Reto extra

1. **`alumnoConMejorNota(lista)`** — devuelve el objeto del alumno con la nota más alta.
   *Pista:* no es `find`, porque no sabes de antemano cuál es la nota máxima. Es `reduce`: la bola de nieve va guardando "el mejor hasta ahora" y en cada vuelta lo compara con el actual.
2. **`subirNota(alumno, puntos)`** — devuelve una **copia** del alumno con la nota incrementada, sin tocar el original. Usa destructuring en los parámetros y spread para la copia. Compruébalo imprimiendo el original después.

---

# Chuleta rápida

| Quiero... | Uso |
|---|---|
| Saber si un número es par / múltiplo | `n % 2 === 0` |
| Comparar sin sorpresas | `===` y `!==`, nunca `==` |
| Repetir un número conocido de veces | `for` |
| Repetir hasta que pase algo | `while` |
| Transformar todos los elementos | `map` |
| Quedarme con algunos | `filter` |
| Encontrar uno | `find` |
| Obtener un único valor del conjunto | `reduce` |
| Copiar un objeto cambiando un campo | `{ ...obj, campo: nuevo }` |
| Sacar propiedades a variables | `const { a, b } = obj` |
| Evitar error si algo puede no existir | `obj?.prop` |

## Los seis fallos que vas a cometer

1. Usar `==` en vez de `===`.
2. Olvidar el `i++` del `for` → bucle infinito, pestaña congelada.
3. Poner los `if` en mal orden: el caso general antes que el específico, y el específico no se alcanza nunca.
4. Confundir `console.log` con `return`: la función imprime pero devuelve `undefined`.
5. Asignar un objeto creyendo que lo copias (`const b = a`) y modificar el original sin querer.
6. Confundir `find` (devuelve un elemento) con `filter` (devuelve un array).

---

# Chuleta de examen: casos rebuscados

Preguntas con trampa y ejercicios combinados, del estilo de lo que se pide cuando quieren separar al que ha entendido del que ha copiado. **Intenta responder antes de mirar.**

## A. "¿Qué imprime esto?"

### A1. Suma de decimales

```js
console.log(0.1 + 0.2 === 0.3);
```

<details><summary>Respuesta</summary>

`false`. `0.1 + 0.2` da `0.30000000000000004`. Los decimales se guardan en binario y algunos no tienen representación exacta, igual que 1/3 en decimal.

**Nunca compares decimales con `===`.** Compara la diferencia: `Math.abs(a - b) < 0.0001`.
</details>

### A2. `typeof null`

```js
console.log(typeof null);
console.log(typeof []);
```

<details><summary>Respuesta</summary>

`"object"` las dos veces. Lo de `null` es un bug histórico de JavaScript que nunca se arregló por compatibilidad. Y los arrays son objetos por dentro, así que `typeof` no sirve para detectarlos: para eso está `Array.isArray([])`.
</details>

### A3. Ordenar números

```js
const numeros = [10, 9, 1, 100];
console.log(numeros.sort());
```

<details><summary>Respuesta</summary>

`[1, 10, 100, 9]`.

**`sort()` convierte todo a texto y ordena alfabéticamente.** Como texto, "9" va después de "100" porque compara carácter a carácter y "9" > "1".

Para números hay que pasarle una función de comparación:

```js
numeros.sort((a, b) => a - b);   // ascendente: [1, 9, 10, 100]
numeros.sort((a, b) => b - a);   // descendente
```

**Y encima `sort` modifica el array original**, al contrario que `map` y `filter`. Si no quieres tocarlo: `[...numeros].sort((a, b) => a - b)`.

Esta es la trampa que más cae.
</details>

### A4. Copiar un array

```js
const a = [1, 2, 3];
const b = a;
b.push(4);
console.log(a.length);
```

<details><summary>Respuesta</summary>

`4`. `const b = a` no copia nada: los dos nombres apuntan al mismo array en memoria. Para copiar de verdad: `const b = [...a]`.
</details>

### A5. Conversiones

```js
console.log("5" + 3);
console.log("5" - 3);
console.log(5 + true);
console.log([] + {});
```

<details><summary>Respuesta</summary>

`"53"`, `2`, `6`, `"[object Object]"`.

El `+` concatena si hay algún texto; el `-` no tiene versión de texto, así que convierte a número. `true` vale 1. Y lo último es JavaScript haciendo el ridículo: convierte ambos a texto.
</details>

### A6. `reduce` sin valor inicial

```js
console.log([].reduce((a, b) => a + b));
```

<details><summary>Respuesta</summary>

`TypeError: Reduce of empty array with no initial value`. Con `, 0` al final devolvería `0` tranquilamente. Por eso el valor inicial no es opcional en la práctica.
</details>

### A7. El bucle y el índice

```js
const letras = ["a", "b", "c"];
const resultado = letras.map((letra, i) => `${i}: ${letra}`);
console.log(resultado);
```

<details><summary>Respuesta</summary>

`["0: a", "1: b", "2: c"]`.

**`map`, `filter` y `find` reciben un segundo parámetro con el índice.** Casi nadie lo sabe y aparece en los exámenes: `(elemento, indice) => ...`.
</details>

### A8. `find` sobre vacío

```js
const alumnos = [{ nombre: "Ana", nota: 8 }];
console.log(alumnos.find(a => a.nota > 9).nombre);
```

<details><summary>Respuesta</summary>

`TypeError: Cannot read properties of undefined`. `find` no encuentra nada, devuelve `undefined`, y le pides `.nombre` a `undefined`.

La defensa: `alumnos.find(...)?.nombre` → `undefined` sin reventar.
</details>

## B. Ejercicios combinados

Los clásicos que piden encadenar varias cosas. Sobre este array:

```js
const alumnos = [
  { nombre: "Ana",    nota: 8, curso: "DAM2" },
  { nombre: "Luis",   nota: 4, curso: "DAM1" },
  { nombre: "Marta",  nota: 9, curso: "DAM2" },
  { nombre: "Carlos", nota: 5, curso: "DAM1" },
  { nombre: "Elena",  nota: 3, curso: "DAM2" },
];
```

### B1. Agrupar por una propiedad

Devuelve `{ DAM1: [...], DAM2: [...] }`.

<details><summary>Pista y solución</summary>

Es `reduce` con un **objeto** como acumulador, no un número:

```js
const porCurso = alumnos.reduce((acc, alumno) => {
  if (!acc[alumno.curso]) acc[alumno.curso] = [];   // si no existe el grupo, créalo
  acc[alumno.curso].push(alumno);
  return acc;                                        // ← devolver el acumulador SIEMPRE
}, {});                                              // ← inicial: objeto vacío
```

**El fallo típico:** olvidar el `return acc`. En la vuelta siguiente el acumulador es `undefined` y revienta.
</details>

### B2. Contar frecuencias

Cuántos alumnos hay por curso: `{ DAM1: 2, DAM2: 3 }`.

<details><summary>Pista</summary>

Igual que B1 pero sumando en vez de acumulando en array: `acc[clave] = (acc[clave] || 0) + 1`. El `|| 0` cubre la primera vez, cuando todavía es `undefined`.
</details>

### B3. Eliminar duplicados

```js
const cursos = alumnos.map(a => a.curso);   // ["DAM2","DAM1","DAM2","DAM1","DAM2"]
```

Déjalo en `["DAM2", "DAM1"]`.

<details><summary>Dos formas</summary>

```js
[...new Set(cursos)]                             // la corta
cursos.filter((c, i) => cursos.indexOf(c) === i) // la de examen: me quedo con la
                                                 // primera aparición de cada uno
```
</details>

### B4. Aplanar

```js
const grupos = [[1, 2], [3, 4], [5]];   // → [1, 2, 3, 4, 5]
```

<details><summary>Solución</summary>

`grupos.flat()`, o con reduce: `grupos.reduce((a, b) => [...a, ...b], [])`.
</details>

### B5. El mejor sin usar `sort`

Devuelve el alumno con la nota más alta.

<details><summary>Pista</summary>

`reduce` donde el acumulador es "el mejor hasta ahora":

```js
alumnos.reduce((mejor, actual) => actual.nota > mejor.nota ? actual : mejor);
```

El `? :` es el **operador ternario**: `condición ? siVerdadero : siFalso`. Un `if/else` en una línea que además devuelve valor.
</details>

### B6. Ordenar sin destrozar el original

Devuelve los alumnos ordenados por nota descendente, dejando `alumnos` intacto.

<details><summary>Solución</summary>

```js
const ordenados = [...alumnos].sort((a, b) => b.nota - a.nota);
```

Sin el `[...]`, `sort` te reordena el array original. Compruébalo imprimiendo los dos.
</details>

## C. Código que parece correcto y no lo es

### C1.

```js
function sumar(a, b) {
  const total = a + b;
}
console.log(sumar(2, 3));
```

<details><summary>El fallo</summary>

Falta `return total`. Imprime `undefined`. Calcula bien y no entrega nada.
</details>

### C2.

```js
const numeros = [1, 2, 3];
numeros.map(n => n * 2);
console.log(numeros);
```

<details><summary>El fallo</summary>

`[1, 2, 3]`. `map` devuelve un array nuevo y aquí nadie lo recoge. Falta `const dobles = numeros.map(...)`.
</details>

### C3.

```js
for (let i = 0; i < 5; i++);
  console.log(i);
```

<details><summary>El fallo</summary>

El `;` justo después del `for` cierra el bucle: da cinco vueltas sin hacer nada. El `console.log` queda fuera, se ejecuta una vez, y falla con `ReferenceError` porque `i` ya no existe.
</details>

### C4.

```js
const nota = 10;
if (nota > 5) {
  console.log("Aprobado");
} else if (nota > 9) {
  console.log("Sobresaliente");
}
```

<details><summary>El fallo</summary>

Imprime `"Aprobado"`. El orden está invertido: el caso general atrapa al específico y la segunda rama es inalcanzable. Lo específico primero.
</details>

### C5.

```js
const alumno = { nombre: "Ana" };
const copia = { ...alumno };
copia.nombre = "Luis";
console.log(alumno.nombre);
```

<details><summary>Respuesta</summary>

`"Ana"`. Aquí **sí** está bien: el spread copia de verdad. Si fuera `const copia = alumno` saldría `"Luis"`.

Ojo con el matiz: si `alumno` tuviera dentro otro objeto (`direccion: { ciudad: "Madrid" }`), el spread copia solo el primer nivel y `copia.direccion` seguiría siendo el mismo objeto que `alumno.direccion`.
</details>

## D. Lo que sueltan a última hora

Cosas que no están en las tres sesiones pero que suelen caer:

```js
// Texto
"hola".toUpperCase()        // "HOLA"
"  hola  ".trim()           // "hola"
"a,b,c".split(",")          // ["a", "b", "c"]
["a","b"].join("-")         // "a-b"
"hola".includes("ol")       // true
"hola".length               // 4

// Arrays
[1,2,3].reverse()           // [3,2,1]   ← MODIFICA el original
[1,2,3].slice(0, 2)         // [1,2]     ← NO modifica: devuelve un trozo
[1,2,3].indexOf(2)          // 1
[1,2,3].some(n => n > 2)    // true   ¿alguno cumple?
[1,2,3].every(n => n > 0)   // true   ¿todos cumplen?

// Números
Math.max(1, 5, 3)           // 5
Math.max(...[1, 5, 3])      // 5    ← spread para pasarle un array
Math.round(4.6)             // 5
Math.floor(4.9)             // 4
Math.random()               // decimal entre 0 y 1 (nunca llega a 1)
Number("42")                // 42
parseInt("42px")            // 42   ← parseInt tolera basura detrás
Number("42px")              // NaN  ← Number no
```

**Entero aleatorio entre 1 y n** (sale en los ejercicios de juegos):

```js
Math.floor(Math.random() * n) + 1
```

**Los que modifican el original**, para memorizar: `push`, `pop`, `shift`, `unshift`, `sort`, `reverse`, `splice`.
**Los que no**: `map`, `filter`, `find`, `reduce`, `slice`, `concat`, `join`.

Esa distinción es media práctica.
