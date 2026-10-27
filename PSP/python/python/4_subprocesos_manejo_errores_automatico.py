import subprocess
import sys


try:
    resultado = subprocess.run(
        [sys.executable, "-c", "print(6 / 1)"],
        capture_output=True,
        text=True,
        check=True
    )

    print(resultado.stdout.strip())
    print(resultado.returncode)


except subprocess.CalledProcessError as e:
    print("Excepción capturada automáticamente:")
    print(f"Código de salida: {e.returncode}")
    print(f"Contenido de stderr:\n{e.stderr.strip()}")


'''
    subprocess.run()    
    
        Es una función bloqueante. 
        
            Lanza el proceso hijo y pausa automáticamente al proceso padre hasta que el hijo termine su ejecución por completo.

        capture_output=True:    atrapa tanto el stdout como el stderr.

        text=True:              convierte los datos capturados (que por defecto son bytes) en texto normal (strings).

        check=True              si el proceso hijo falla (devuelve un código distinto a 0) se detiene la ejecución y lanza un error 
                                automáticamente de tipo CalledProcessError.

                                
    Si el proceso hubiera funcionado bien:
    
        stdout          guarda el resultado obtenido

        returncode      guarda el código de error (0 si va todo bien)

        strip()         limpia los saltos de línea o espacios en blanco sobrantes al principio y al final.


    Si el proceso falla:

        e.returncode        contiene el número del error que devolvió el sistema operativo (ej. 1 para error general)
        e.stderr            contiene el texto exacto del error que escupió el proceso (en este caso, el ZeroDivisionError).
'''