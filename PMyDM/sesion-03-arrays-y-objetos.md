# Sesión 3 · Arrays y objetos — Teoría + ejercicios resueltos

Resumen de la sesión 3 del bloque "JavaScript desde cero": la teoría y los ejercicios de `sesion3-practica.js` tal como quedan bien hechos, con comentarios. Al final están los errores que cometí al hacerlos y los ejercicios que tengo pendientes.

Datos que usan todos los ejercicios:

```js
const alumnos = [
  { nombre: "Ana",    edad: 20, nota: 8.5, ciudad: "Madrid" },
  { nombre: "Luis",   edad: 22, nota: 4.0, ciudad: "Sevilla" },
  { nombre: "Marta",  edad: 19, nota: 6.5, ciudad: "Madrid" },
  { nombre: "Pedro",  edad: 21, nota: 9.2, ciudad: "Valencia" },
  { nombre: "Lucía",  edad: 23, nota: 3.8, ciudad: "Sevilla" },
  { nombre: "Carlos", edad: 20, nota: 7.1, ciudad: "Madrid" },
];
```

`alumnos` es un **array**, una lista. Cada elemento de la lista es un **objeto**, la ficha de un alumno.

---

## 1. Arrays

Un **array** es una lista ordenada de valores entre corchetes `[]`.

- Las posiciones empiezan en **0**: `colores[0]` es el primero.
- `length` dice cuántos elementos hay.
- El último elemento está en `length - 1`.
- `push` añade un elemento al final **y modifica el array original**.

> **Trampa:** si escribes mal una propiedad (`lenght` en vez de `length`), JavaScript **no da error**: devuelve `undefined` y el programa sigue funcionando mal sin avisarte.

### Ej 1 — `colores`

```js
const colores = ["rojo", "azul", "verde", "morado"];

console.log(colores[0]);                  // "rojo"   → primero (posición 0)
console.log(colores[colores.length - 1]); // "morado" → último, sirva cual sea el tamaño
console.log(colores.length);              // 4

colores.push("marron");                   // añade al final (modifica el original)
console.log(colores.length);              // 5
```

> `colores[3]` también da "morado", pero solo mientras haya 4 elementos. Después del `push` daría "morado" aunque el último ya sea "marron". `length - 1` funciona siempre.

---

## 2. Objetos

Un **objeto** agrupa datos relacionados bajo un nombre. Cada dato es una **propiedad** con su etiqueta. El array ordena por **posición** y el objeto ordena por **nombre**.

Hay dos formas de acceder a una propiedad:

- **Punto:** `coche.modelo`. Es la forma normal, cuando conoces el nombre de la propiedad.
- **Corchetes:** `coche["modelo"]` o `coche[variable]`. Lo de dentro **se evalúa**: si va entre comillas es el nombre literal de la propiedad; si va sin comillas, JavaScript busca una variable con ese nombre.

> **Trampa:** `const` impide **reasignar** la variable (`coche = otraCosa`), pero **no impide modificar el contenido** del objeto. Puedes cambiar y añadir propiedades a un objeto `const`.

### Ej 2 — `coche`

```js
const coche = { marca: "BMW", modelo: "x33", ano: 2020 };

console.log(coche.modelo);  // "x33"
// coche[coche.modelo] → coche["x33"] → undefined (no existe esa propiedad)
// coche[modelo]       → ReferenceError: busca una VARIABLE llamada modelo

coche.ano = 2023;           // cambiar una propiedad
coche.color = "rojo";       // añadir una propiedad nueva: basta con asignarla
console.log(coche);         // { marca: 'BMW', modelo: 'x33', ano: 2023, color: 'rojo' }
```

---

## 3. `map` — transformar cada elemento

**Analogía:** una cadena de montaje. Cada pieza entra, se transforma y sale. Si entran 6, salen 6.

`map` ejecuta un **callback** (una función que tú le pasas) con cada elemento y guarda **lo que devuelve** en un array nuevo del mismo tamaño. No toca el original.

> **Trampa de las funciones flecha:**
> - `x => x * 2`: sin llaves, devuelve el resultado automáticamente.
> - `x => { x * 2 }`: con llaves, **necesita `return`**. Sin él, devuelve `undefined`.

### Ej 3 — nombres

```js
const nombres = alumnos.map(a => a.nombre);
console.log(nombres); // [ 'Ana', 'Luis', 'Marta', 'Pedro', 'Lucía', 'Carlos' ]
```

### Ej 4 — frases "Ana (20 años)"

```js
// Todo en UNA expresión a la derecha de la flecha; los textos se unen con +
const frases = alumnos.map(a => a.nombre + " (" + a.edad + " años)");
console.log(frases); // [ 'Ana (20 años)', 'Luis (22 años)', ... ]
```

> - **Una coma dentro de `map(...)` separa argumentos.** `map(a => a.nombre, a.edad)` deja `a.edad` **fuera** del callback, y ahí `a` no existe (`ReferenceError`).
> - **`=` asigna, no une textos.** Para concatenar se usa `+`.
> - **`+` no añade espacios.** Tienes que ponerlos tú dentro de las comillas.
> - **Nombres:** un array se nombra en plural (`frases`) y un solo elemento en singular.

---

## 4. `filter` — quedarse con los que cumplen

**Analogía:** el portero de una discoteca. Mira a cada uno y solo deja pasar a quien cumple la regla.

El callback devuelve `true` o `false`. Los elementos que dan `true` entran en un **array nuevo**, que puede ser más corto que el original.

### Ej 5 — aprobados

```js
const aprobados = alumnos.filter(a => a.nota >= 5);
console.log(aprobados.length); // 4 → Ana, Marta, Pedro, Carlos
```

### Ej 6 — alumnos de Madrid

```js
const alumnosMadrid = alumnos.filter(a => a.ciudad === "Madrid");
console.log(alumnosMadrid); // Ana, Marta, Carlos
```

> - **Usa `===` y nunca `=`.** Con `=` asignarías "Madrid" a todos los alumnos y pasarían todos el filtro.
> - **La comparación de textos distingue mayúsculas:** `"madrid" === "Madrid"` es `false`.
> - **Imprime la variable correcta.** Si copias y pegas, revisa el `console.log`: yo imprimí `aprobados` en vez de `alumnosMadrid` y salía Pedro, que es de Valencia.

---

## 5. `find` — el primero que cumple

**Analogía:** buscar a alguien en la lista de invitados. Cuando lo encuentras, dejas de buscar.

`find` devuelve **un elemento** (el objeto tal cual, no un array) o `undefined` si no hay ninguno que cumpla.

| | Devuelve |
|---|---|
| `filter` | un **array**, aunque esté vacío |
| `find` | **un elemento**, o `undefined` |

### Ej 7 — Pedro y Zoe

```js
const alumnoPedro = alumnos.find(a => a.nombre === "Pedro"); // singular: es UN alumno
console.log(alumnoPedro.nota); // 9.2

const alumnoZoe = alumnos.find(a => a.nombre === "Zoe");
console.log(alumnoZoe);        // undefined
// alumnoZoe.nota → TypeError: no se puede leer una propiedad de undefined
```

> **Trampa de producción:** después de un `find`, piensa siempre qué pasa si no encuentra nada.
>
> **Al renombrar una variable,** cámbiala en todos los sitios donde aparece. En VS Code: ponte encima del nombre y pulsa **F2**.

---

## 6. `reduce` — acumular en un único valor

**Analogía:** una hucha. Empieza con una cantidad (el valor inicial), vas metiendo cada moneda y al final tienes **un solo total**.

```js
array.reduce((acc, elemento) => nuevoAcc, valorInicial)
```

- `acc`: lo que llevas acumulado.
- `elemento`: el elemento actual. **En `alumnos`, es un objeto alumno entero.**
- Lo que devuelve la flecha pasa a ser el `acc` de la vuelta siguiente.
- `valorInicial`: con qué empieza `acc`.

Equivale a este `for`:

```js
let acc = 0;
for (let i = 0; i < alumnos.length; i++) {
  acc = acc + alumnos[i].nota;
}
```

**¿Por qué el `0` del final?** Es el valor con el que empieza `acc`.

- Sin él, `reduce` usa el **primer elemento** (el objeto Ana) como punto de partida, y la suma se convierte en texto: `"[object Object]4"...`.
- Con un array vacío y sin valor inicial, lanza un `TypeError`.
- **Regla:** pon siempre el valor inicial. Usa `0` para sumar, `""` para construir texto y `{}` para contar.

### Ej 8 — nota media

```js
const sumaNotas = alumnos.reduce((acc, alumno) => acc + alumno.nota, 0);
//                                                     ↑ objeto.propiedad: el número
const notaMedia = sumaNotas / alumnos.length;

console.log(sumaNotas);            // 39.1
console.log(notaMedia);            // 6.516666666666667
console.log(notaMedia.toFixed(2)); // "6.52" ← toFixed devuelve TEXTO: úsalo solo para mostrar
```

> - **`acc + alumno`** suma el objeto entero. JavaScript lo convierte en el texto `"[object Object]"` y **concatena**, sin dar error.
> - **`acc + nota`** da `ReferenceError`: `nota` sola no existe como variable, es una propiedad de `alumno`.
> - **Correcto:** `acc + alumno.nota`, el objeto, un punto y la propiedad.
> - **`+` con números suma; si un lado es texto u objeto, concatena.**

---

## 7. Encadenar `filter` + `map`

**Analogía:** una cadena de montaje con dos puestos. El primero descarta y el segundo transforma.

Como `filter` devuelve un array, puedes escribir `.map()` justo detrás. **El orden importa:** si haces `map` primero, ya solo tienes textos y no puedes filtrar por otras propiedades.

### Ej 9 — nombres de Sevilla

```js
const nombresSevilla = alumnos
  .filter(a => a.ciudad === "Sevilla") // → objetos de Luis y Lucía
  .map(a => a.nombre);                 // → solo sus nombres

console.log(nombresSevilla); // [ 'Luis', 'Lucía' ]
```

> Nombra las variables por lo que **contienen** (`nombresSevilla`), no por lo que **haces** (`encadenar`).

---

## 8. Destructuring

**Destructuring** saca propiedades de un objeto y las guarda en variables sueltas, en una sola línea.

**Analogía:** abrir una caja de mudanza y sacar solo lo que necesitas.

```js
const { nombre, nota } = objeto;
// equivale a:
// const nombre = objeto.nombre;
// const nota   = objeto.nota;
```

Los nombres entre llaves deben coincidir **exactamente** con los de las propiedades. Si no coinciden, la variable vale `undefined` sin dar error.

También se puede usar en los **parámetros de una función**: la función recibe el objeto entero y saca solo lo que necesita.

### Ej 10 — primer alumno y `resumen`

```js
// Parte 1: del PRIMER alumno (alumnos[0]), no del array entero
const { nombre, nota } = alumnos[0];
console.log(nombre, nota); // Ana 8.5
// const { nombre, nota } = alumnos → undefined undefined (el array no tiene esas propiedades)

// Parte 2: destructuring en los parámetros
function resumen({ nombre, ciudad }) {
  return nombre + " vive en " + ciudad; // DEVUELVE el texto, no lo imprime
}
console.log(resumen(alumnos[0])); // "Ana vive en Madrid" → se le pasa UN alumno
```

> - **`resumen`** (sin paréntesis) es la función en sí: imprimirla da `[Function: resumen]`. **`resumen()`** la ejecuta.
> - **`resumen(alumnos)`** pasa el array, no un alumno, y sale `undefined vive en undefined`.
> - **Redeclarar** una variable con `const` en el mismo ámbito da `SyntaxError: Identifier ... has already been declared`. Un `SyntaxError` impide que se ejecute **el fichero entero**, no solo esa línea.
> - **El `nombre` del parámetro es otra variable**, distinta del `nombre` de fuera, porque la función tiene su propio ámbito. Funciona, pero se presta a confusión.

---

## 9. Spread (`...`) — copiar y ampliar sin tocar el original

**Spread** vuelca el contenido de un array u objeto dentro de otro nuevo.

**Analogía:** fotocopiar un documento y escribir encima de la copia. El original sigue en el cajón.

- `[...array, nuevo]`: un array nuevo con todo lo de `array` y después `nuevo`.
- `{ ...objeto, prop: valor }`: un objeto nuevo con todo lo de `objeto` y `prop` cambiada. Si una propiedad aparece dos veces, **gana la última**.

¿Por qué importa? En React no se modifican los datos en su sitio, sino que se crean copias.

### Ej 11 — alumno nuevo y copia de Ana

```js
// Corchetes por fuera: el resultado es un ARRAY
const alumnosConNuevo = [
  ...alumnos,                                                // los 6 alumnos
  { nombre: "Arturo", edad: 27, nota: 10, ciudad: "Madrid" } // el nuevo, en SU propio objeto
];
console.log(alumnosConNuevo.length); // 7
console.log(alumnos.length);         // 6 → original intacto

// Llaves por fuera: el resultado es un OBJETO
const anaCopia = { ...alumnos[0], nota: 10 }; // primero copiar, después pisar
console.log(anaCopia);        // { nombre: 'Ana', edad: 20, nota: 10, ciudad: 'Madrid' }
console.log(alumnos[0].nota); // 8.5 → la Ana original sigue igual
```

> - **`{...alumnos, nombre: ...}`** con llaves crea un **objeto** con propiedades `0`, `1`, `2`... y no un array. No tiene `length`.
> - **Las propiedades del alumno nuevo** deben ir dentro de **su propio** `{ }`.
> - **`push` está prohibido aquí** porque modifica el original.
> - **En `{ nota: 10, ...alumnos[0] }`**, la copia pisaría tu cambio y la nota volvería a ser 8.5.

---

## 10. Rest (`...`) — agrupar argumentos

**Rest** usa la misma sintaxis `...` que spread, pero hace lo contrario: en lugar de **expandir**, **agrupa**. En los parámetros de una función, recoge todos los argumentos que lleguen en **un array**.

**Analogía:** un saco en la puerta. Da igual cuántas cosas te entreguen: todas van al mismo saco.

| | Dónde aparece | Qué hace |
|---|---|---|
| **Spread** | al **crear** arrays u objetos, o al **llamar** a una función | expande: saca los elementos |
| **Rest** | en los **parámetros** de una función | agrupa: mete los argumentos en un array |

### Ej 12 — `media(...numeros)`

```js
function media(...numeros) {
  // numeros es un ARRAY con todo lo que llegue: media(4, 6, 8) → [4, 6, 8]
  const suma = numeros.reduce((acc, n) => acc + n, 0); // aquí n YA es un número
  return suma / numeros.length;
}

console.log(media(4, 6, 8)); // 6
console.log(media(10));      // 10
console.log(media());        // NaN → 0 / 0
```

> - **Rest debe ser el último parámetro:** `function f(a, ...resto)` es válido; `function f(...resto, a)` da `SyntaxError`.
> - **Sin argumentos** la función devuelve `NaN` (`0 / 0`). En un programa real, comprueba ese caso.

---

## Ejercicios pendientes (para hacer yo)

### P1 — Spread (con lo que hay en el fichero)

1. Crea `coloresAmpliados` con todos los `colores` más `"negro"`, **sin `push`**.
2. Crea `cocheNuevo`, una copia de `coche` con `color` cambiado a `"azul"`.
3. Imprime `coche.color` para comprobar que el original sigue siendo `"rojo"`.

### P2 — Rest

Crea la función `maximo(...numeros)`, que devuelva el número **más alto** de los que reciba, usando `reduce`.

- `maximo(4, 9, 2)` → `9`
- `maximo(7)` → `7`
- Pista: el acumulado no tiene que ser una suma; puede ser "el mayor que he visto hasta ahora".
- Pregunta para pensar: ¿qué valor inicial tiene sentido aquí? ¿Sirve `0` si todos los números son negativos?

### Ej 13 (reto del fichero)

Con `reduce`, crea un objeto que cuente cuántos alumnos hay por ciudad:
`{ Madrid: 3, Sevilla: 2, Valencia: 1 }`

- Pista: el valor inicial es `{}`, y se usa la **notación de corchetes** con una variable (`acc[alumno.ciudad]`).

---

## Errores que cometí y debo vigilar

| Error | Qué pasa | Cómo evitarlo |
|---|---|---|
| Escribir mal una propiedad (`lenght`) | `undefined` sin aviso | Comprobar la salida contra lo esperado |
| `objeto[variableInexistente]` | `ReferenceError` | Usar punto, o comillas dentro de los corchetes |
| Coma dentro de `map(...)` | Parte del código queda fuera del callback | Todo en una sola expresión, unido con `+` |
| Imprimir la variable equivocada | Salida "razonable" pero falsa | Revisar el `console.log` después de copiar y pegar |
| Renombrar solo en un sitio | `ReferenceError` | F2 en VS Code |
| Sumar el objeto entero en `reduce` | `"0[object Object]..."` | `acc + alumno.nota` |
| Pasar el array en lugar de un elemento | `undefined` | `alumnos[0]` para el primero |
| Olvidar los paréntesis al llamar | `[Function: ...]` | `funcion()` para ejecutarla |
| Redeclarar con `const` | `SyntaxError`: no se ejecuta nada | Un nombre por variable en cada ámbito |
| `{}` en lugar de `[]` con spread | Objeto en vez de array | Corchetes si quieres una lista |
| No guardar el fichero | `node` ejecuta la versión vieja | `Cmd + S` antes de ejecutar |
