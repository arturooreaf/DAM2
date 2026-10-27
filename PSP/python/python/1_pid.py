# Importamos el módulo 'os' que nos permite interactuar con el sistema operativo y acceder a los identificadores de los procesos.
import os

# Importamos el módulo 'time' para poder pausar la ejecución del programa.
import time

def mostrar_informacion_proceso():

   
    pid = os.getpid()
    
    ppid = os.getppid()

    print(f"▶ PID (ID del proceso actual): {pid}")
    print(f"▶ PPID (ID del proceso padre): {ppid}")
    
    segundos_espera = 30
    
    print(f"\nEl programa está en pausa durante {segundos_espera} segundos.")
    print("Es el momento de abrir tu monitor del sistema para localizarlo...")
    
    time.sleep(segundos_espera)
    
    print("\nTiempo de espera finalizado. Programa terminado.")


mostrar_informacion_proceso()

"""
    Esta función obtiene y muestra los identificadores del proceso actual y de su proceso padre, y luego pausa la ejecución para permitir su búsqueda.

        os.getpid()     devuelve el Process ID (PID) del proceso que está ejecutando este script.

        os.getppid()    devuelve el Parent Process ID (PPID), es decir, el ID del programa o terminal desde donde se lanzó este proceso de Python.
"""