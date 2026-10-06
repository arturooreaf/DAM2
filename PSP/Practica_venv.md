# PSP · Práctica: entornos virtuales de Python (`venv`)

**Alumno:** Arturo Orea · 2º DAM · 6 de octubre de 2026
**Probado en:** Windows 11 con **Python 3.13.15**
**Fuente oficial:** [docs.python.org/3/library/venv.html](https://docs.python.org/3/library/venv.html)

> **Cómo estudiar esto:** lee primero la **frase clave** de cada pregunta. Si te la sabes explicar, pasa a la siguiente. El resto es para entenderla.

---

## 1. ¿Qué problema resuelve un entorno virtual?

> **Que cada proyecto tenga sus propias librerías, sin pisarse con las de otros proyectos.**

**El problema, sin venv:** todas las librerías van al **mismo Python del sistema**, compartido por todos los proyectos.

| Problema | Ejemplo |
|---|---|
| **Choque de versiones** | El proyecto A necesita `Django 4` y el B `Django 5`. Solo cabe una → uno se rompe |
| **Ensuciar el sistema** | Se acumulan librerías de todos los proyectos en el Python del sistema |
| **No se puede reproducir** | No sabes qué librerías (y qué versión) usa cada proyecto |

**La solución, con venv:** cada proyecto tiene **su propia "caja" de librerías**. Y para que otro lo reproduzca:

```bash
pip freeze > requirements.txt      # apunta lo que usa el proyecto
pip install -r requirements.txt    # otra persona lo instala igual
```

---

## 2. ¿Qué crea realmente `python -m venv .venv`?

> **Una carpeta `.venv` con un Python "propio" (que reutiliza el del sistema) y su zona privada de librerías.**

- `python -m venv` → ejecuta el módulo `venv`, que **ya viene con Python**.
- `.venv` → el **nombre de la carpeta** que se crea.

**Lo que creó en mi PC (real):**

```
.venv\
├── pyvenv.cfg          ← configuración: qué Python usa de base
├── .gitignore          ← (nuevo en Python 3.13) hace que Git ignore la carpeta
├── Include\
├── Lib\
│   └── site-packages\  ← aquí irán las librerías (al principio solo pip)
└── Scripts\
    ├── python.exe      ← el Python del entorno
    ├── pip.exe         ← el pip del entorno
    ├── Activate.ps1    ← activar en PowerShell
    ├── activate.bat    ← activar en cmd
    └── deactivate.bat
```

**Contenido real de `pyvenv.cfg`:**

```
home = C:\Users\aorea\AppData\Local\Programs\Python\Python313
include-system-site-packages = false
version = 3.13.15
```

- `home` → el **Python del sistema** que usa como base. **No se instala otro Python.**
- `include-system-site-packages = false` → **no ve** las librerías del sistema: está aislado.

Recién creado ocupa **~11 MB**. Es solo una carpeta: **se puede borrar y volver a crear** sin miedo.

---

## 3. ¿Dónde se guardan las librerías que instalamos dentro de él?

> **En `.venv\Lib\site-packages\`, dentro de la propia carpeta del entorno.**

| Sistema | Ruta |
|---|---|
| **Windows** | `.venv\Lib\site-packages\` |
| **Linux / Mac** | `.venv/lib/python3.13/site-packages/` |

- Recién creado, en mi PC solo había: `pip` y `pip-26.2.1.dist-info`.
- Si hago `pip install requests` → aparece `.venv\Lib\site-packages\requests\`.
- El **Python del sistema no se entera**: sin el venv, `import requests` daría error.

Para verlas: `pip list`

---

## 4. ¿Qué ocurre realmente cuando lo "activamos"?

> **Solo cambia variables de ESA terminal para que `python` y `pip` sean los del venv. No instala nada.**

El script `Activate.ps1` hace **3 cosas**:

1. **Pone `.venv\Scripts` el primero del `PATH`** → al escribir `python`, Windows encuentra antes el del venv.
2. **Crea la variable `VIRTUAL_ENV`** → con la ruta del entorno.
3. **Cambia el prompt** → aparece `(.venv)` delante.

**Prueba real en mi PC:**

| | `python` apunta a… | `VIRTUAL_ENV` | Prompt |
|---|---|---|---|
| **Antes** | `...\Python313\python.exe` (sistema) | vacía | `PS C:\...>` |
| **Activado** | `...\.venv\Scripts\python.exe` | `...\.venv` | `(.venv) PS C:\...>` |
| **Tras `deactivate`** | `...\Python313\python.exe` (sistema) | vacía | `PS C:\...>` |

**Cómo se activa:**

| Terminal | Comando |
|---|---|
| PowerShell | `.venv\Scripts\Activate.ps1` |
| cmd | `.venv\Scripts\activate.bat` |
| Linux / Mac | `source .venv/bin/activate` |

Solo dura **en esa terminal**. Terminal nueva → **hay que activarlo otra vez**. Para salir: `deactivate`.

---

## 5. ¿Es obligatorio activarlo para utilizarlo?

> **No. Activar es solo una comodidad: puedes llamar directamente al `python` del venv.**

| Sin activar | Lo mismo, activado |
|---|---|
| `.venv\Scripts\python main.py` | `python main.py` |
| `.venv\Scripts\pip install requests` | `pip install requests` |

**Por qué funciona:** ese `python.exe` lee su `pyvenv.cfg` y ya sabe que sus librerías están en `.venv\Lib\site-packages`.

**Prueba real en mi PC**, sin activar nada:

```
.venv\Scripts\python -c "import sys; print(sys.prefix)"
→ ...\venvlab\.venv            ← usa el venv
→ base: ...\Python313          ← apoyado en el Python del sistema
```

**Lo hacen así:** VS Code y PyCharm (apuntan al `python.exe` del venv) y los servidores. Ejemplo de SGE: el servicio de Odoo arranca con `/opt/odoo/venv/bin/python ...` **sin activar nada**.

> La documentación oficial lo dice: *"You don't specifically need to activate a virtual environment"*.

---

## 6. ¿Qué diferencia hay entre un venv y una máquina virtual como VirtualBox?

> **Un venv aísla solo las LIBRERÍAS de Python. Una máquina virtual aísla un ORDENADOR ENTERO con su propio sistema operativo.**

| | venv | Máquina virtual (VirtualBox) |
|---|---|---|
| **Qué aísla** | Librerías de un proyecto Python | Todo: sistema operativo, disco, red, RAM |
| **Sistema operativo** | El mismo del PC (Windows) | El suyo propio (ej.: Ubuntu dentro de Windows) |
| **Qué es por dentro** | Una carpeta `.venv` | Un disco virtual `.vdi` + hardware simulado |
| **Tamaño** | ~11 MB al crearlo | Varios GB (la de Odoo: disco de 25 GB) |
| **Recursos** | Ninguno extra | Reserva RAM y CPU (la de Odoo: 4 GB y 2 CPU) |
| **Arranque** | Instantáneo | Tarda (como encender un PC) |
| **Para qué** | Separar dependencias entre proyectos | Otro sistema, servidores, aislar todo |

**Se pueden combinar:** en SGE, **dentro de la VM** de Ubuntu se creó **un venv** (`/opt/odoo/venv`) para las librerías de Odoo.

---

## Chuleta de repaso

```bash
python -m venv .venv               # crear
.venv\Scripts\Activate.ps1         # activar (PowerShell)
pip install requests               # instalar (va a .venv\Lib\site-packages)
pip list                           # ver lo instalado
pip freeze > requirements.txt      # guardar la lista
deactivate                         # desactivar
```

| Palabra | Significa |
|---|---|
| `venv` | Módulo de Python para crear entornos virtuales |
| `.venv` | La carpeta del entorno (nombre habitual) |
| `site-packages` | Donde se guardan las librerías |
| `pyvenv.cfg` | Configuración: qué Python usa de base |
| `PATH` | Lista de carpetas donde Windows busca los programas |
| `VIRTUAL_ENV` | Variable que dice qué venv está activo |

---

## Mini-test (tápate las respuestas)

1. Si borro la carpeta `.venv`, ¿se rompe mi Python del sistema? → **No. Solo se pierde el entorno; se vuelve a crear con `python -m venv .venv`.**
2. ¿Activar el venv instala algo? → **No, solo cambia el `PATH`, `VIRTUAL_ENV` y el prompt de esa terminal.**
3. Abro una terminal nueva y `python` no ve mis librerías. ¿Por qué? → **Porque la activación solo dura en la terminal donde se hizo.**
4. ¿Hay que subir `.venv` a GitHub? → **No. Se sube `requirements.txt`. Desde Python 3.13, `.venv` trae su propio `.gitignore`.**
5. ¿Un venv tiene su propio sistema operativo? → **No, eso es una máquina virtual.**
