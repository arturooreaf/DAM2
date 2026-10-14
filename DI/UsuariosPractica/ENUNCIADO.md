# 🧑‍💻 Ejercicio: Gestión de usuarios (Admin / Guest)

> **Objetivo:** programa de consola en Java donde un usuario **inicia sesión** y, según sea **Admin** o **Guest**, puede hacer cosas distintas.
>
> Practica: **herencia**, **clases abstractas**, **`@Override`**, **`ArrayList`**, bucles `while(true)` con menús y `Scanner`.

---

## 📦 Clases que tienes que crear

Todas dentro del mismo paquete (`intento1`, `intento2`…).

| Clase | Tipo | Para qué sirve |
|---|---|---|
| `User` | **abstracta** | La clase «padre» de todos los usuarios |
| `Admin` | hereda de `User` | Usuario administrador |
| `Guest` | hereda de `User` | Usuario invitado |
| `Utils` | normal | Leer datos por teclado |
| `Main` | normal | El programa principal (menú de inicio) |

---

## 1️⃣ `Utils`

- Un `Scanner` **estático** (uno solo para todo el programa).
- `readString(String message)` → muestra el mensaje y **devuelve un `String`**.
- `readInteger(String message)` → muestra el mensaje y **devuelve un `int`**.

> 💡 Los dos métodos son `static`: se llaman como `Utils.readString("USUARIO: ")`.

---

## 2️⃣ `User` (abstracta)

**Atributos** (privados y que no cambien → `private final`):
- `username`
- `password`

**Métodos:**
- **Constructor** con `username` y `password`.
- `getUsername()` → devuelve el nombre.
  - ⚠️ **NO** hay `getPassword()`: la contraseña nunca sale de la clase.
- `verify(String username, String password)` → devuelve `true` si **los dos** coinciden con los del usuario. Así se comprueba el login **sin sacar la contraseña fuera**.
- `actionByUserType(ArrayList<User> users)` → **abstracto** (sin cuerpo). Cada hijo hace el suyo.

---

## 3️⃣ `Guest` (hereda de `User`)

Al iniciar sesión muestra:

```
---------------
Bienvenido, fulano
```

Y repite este menú **hasta que elija cerrar sesión**:

```
1. Ver usuarios
2. Cerrar sesión
```

| Opción | Qué hace |
|---|---|
| **1** | Lista **los demás** usuarios (todos menos él mismo), uno por línea: `- juan`. Si no hay otros: `Todavía no hay usuarios...` |
| **2** | Sale del menú (vuelve al inicio del programa) |
| Otra | `Opción incorrecta` |

---

## 4️⃣ `Admin` (hereda de `User`)

Igual que `Guest`, pero con **una opción más**:

```
1. Ver usuarios
2. Crear usuario
3. Cerrar sesión
```

| Opción | Qué hace |
|---|---|
| **1** | Igual que en `Guest` |
| **2** | Pide `NUEVO NOMBRE:` y `CONTRASEÑA:`. Si **ya existe** un usuario con ese nombre → `El usuario ya existe...`. Si no → crea un **`Guest`** nuevo, lo añade a la lista y muestra `Usuario creado correctamente...` |
| **3** | Cierra sesión |
| Otra | `Opción incorrecta` |

> 💡 Para saber si el nombre ya existe, recorre la lista con un `for` y usa una variable `boolean` («trigger») que se pone a `true` si lo encuentras.

---

## 5️⃣ `Main`

1. Una lista **estática** `ArrayList<User> users` con estos usuarios de inicio:

   | Tipo | Usuario | Contraseña |
   |---|---|---|
   | `Admin` | `juan` | `hola` |
   | `Guest` | `fulano` | `hola` |
   | `Guest` | `mengano` | `hola` |

2. Menú que se repite **siempre** (`while(true)`):

   ```
   1. Iniciar sesión
   2. Salir
   ```

3. **Opción 1:** pide `USUARIO:` y `CONTRASEÑA:`. Recorre la lista y, con `verify(...)`, busca quién es:
   - Si lo encuentra → llama a **`actionByUserType(users)`** de ese usuario (el polimorfismo decide si es el menú de Admin o de Guest).
   - Si no lo encuentra → `Credenciales incorrectas`.
4. **Opción 2:** termina el programa.

---

## ▶️ Ejemplo de ejecución

```
1. Iniciar sesión
2. Salir
OPCIÓN: 1

USUARIO: juan
CONTRASEÑA: hola

---------------
Bienvenido, juan
1. Ver usuarios
2. Crear usuario
3. Cerrar sesión
OPCIÓN: 2
NUEVO NOMBRE: pepe
CONTRASEÑA: 1234
Usuario creado correctamente...

1. Ver usuarios
2. Crear usuario
3. Cerrar sesión
OPCIÓN: 1

- fulano
- mengano
- pepe

1. Ver usuarios
2. Crear usuario
3. Cerrar sesión
OPCIÓN: 3

1. Iniciar sesión
2. Salir
OPCIÓN: 1

USUARIO: pepe
CONTRASEÑA: mal
Credenciales incorrectas

1. Iniciar sesión
2. Salir
OPCIÓN: 2
```

---

## ✅ Checklist (márcalo al terminar)

- [ ] `User` es **abstracta** y `actionByUserType` es **abstracto**
- [ ] Los atributos son **`private final`** y **no** hay `getPassword()`
- [ ] `Admin` y `Guest` usan **`extends User`** y **`@Override`**
- [ ] El login usa **`verify(...)`**, no compara contraseñas desde fuera
- [ ] «Ver usuarios» **no se muestra a sí mismo**
- [ ] El Admin **no deja crear** un nombre repetido
- [ ] Un usuario creado por el Admin **puede iniciar sesión** después
- [ ] Opción incorrecta → mensaje, y el programa **no se cierra**

---

## 🧠 Pistas si te atascas

- **Clase abstracta:** `public abstract class User { ... }`, y el método sin cuerpo: `public abstract void actionByUserType(ArrayList<User> users);`
- **Llamar al constructor del padre:** en `Admin` y `Guest` → `super(username, password);`
- **Comparar Strings:** con `.equals(...)`, **nunca** con `==`
- **«Todos menos yo»:** compara `user.getUsername()` con `this.getUsername()`
- **Salir de un `while(true)`:** `break;`

> 📁 El modelo resuelto está en `DI/Usuarios`. **Intenta no mirarlo** hasta terminar cada intento.
