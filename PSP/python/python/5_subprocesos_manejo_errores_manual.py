import subprocess
import sys


resultado = subprocess.run(
    [sys.executable, "-c", "print(6 / 0)"],
    capture_output=True,
    text=True,
    check=False
)

if resultado.returncode == 0:
    print("Ejecución exitosa. Contenido de stdout:")
    print(resultado.stdout.strip())
else:
    print("El proceso falló.")
    print(f"Código de salida: {resultado.returncode}")
    print(f"Contenido de stderr:\n{resultado.stderr.strip()}")

'''
    check=False                 Si ocurre un error, el programa NO se detendrá ni lanzará una excepción.

    resultado.returncode        Devuelve el éxito o fallo de la ejecución
                                    Devuelve 0 si va todo bien

'''