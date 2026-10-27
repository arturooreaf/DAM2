import psutil as ps     #   Nos permite interactuar con el sistema operativo para gestionar procesos y recursos del sistema

proceso_actual = ps.Process()

print(f"PID del proceso: {proceso_actual.pid}")

print(f"Directorio de trabajo: {proceso_actual.cwd()}")     #   C:\DAM2_2627\PSP\python

print(f"Estado del proceso: {proceso_actual.status()}")     #   running

print(f"Ejecutable de Python: {proceso_actual.exe()}")      #   C:\Program Files\Python314\python.exe


'''
    DOCUMENTACIÓN
    
    ps.Process()            Crea un objeto que sirve como mando a distancia para obtener datos o métodos de un proceso 
                            Al no pasar por parámetro ningún PID asume que el proceso es el que se ejecuta en el propio script de python


                            
    proceso_actual.cwd()    Ruta del directorio de trabajo actual
                            No depende de si el venv está activado o no


                                       
    proceso_actual.exe()    Ruta del intérprete python que ha ejecutado el proceso

                            Tiene una relación directacon venv:
                             
                                Si no tienes el venv activado, apuntará a la instalación global de tu sistema 
                                (por ejemplo, C:\Program Files\Python314\python.exe). 
                                
                                Si tienes el venv activado, apuntará al intérprete aislado dentro de la carpeta de tu entorno virtual 
                                (por ejemplo, C:\Ruta\A\Tu\Proyecto\venv\Scripts\python.exe).
'''