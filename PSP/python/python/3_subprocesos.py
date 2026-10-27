import subprocess   #   Permite crear y controlar otros miniprogramas
import sys          #   sirve para saber qué versión o entorno de Python estás usando

p = subprocess.Popen([ 
    sys.executable, "-c", 
   "import time; time.sleep(5)"])

print("PID hijo: ", p.pid)
print("¿Ha terminado?: ", p.poll())
codigo = p.wait()  
print("Código: ", codigo)


'''
    p = subprocess.Popen([...])

        Lanza y ejecuta un nuevo proceso de forma no bloqueante (es decir, tu programa principal sigue leyendo las 
        siguientes líneas inmediatamente).

        Por tanto, se da el PARALELISMO, ya que hay dos procesos trabajando al mismo tiempo

        Devuelve un objeto de la clase Popen:   es un mando a distancia para interactuar con ese proceso


    sys.executable, "-c", "import time; time.sleep(2)"

        sys.executable      Usa el mismo ejecutable de Python se esté usando en este mismo momento (en este caso, el del entorno virtual .venv)
                            Guarda la ruta absoluta y exacta del intérprete de Python que está ejecutando tu código en este preciso instante.

        -c le dice          Indica que lo que viene a continuación es código 


    p.poll()  
    
        Pregunta el estado actual del proceso. No detiene tu programa principal.
            Si el proceso sigue trabajando, devuelve None. 
            Si ya ha terminado, devuelve su código de salida (un número entero, donde 0 significa éxito y cualquier otro número significa error)

            
    p.wait()
    
        Pausa y bloquea el hilo de tu programa principal (estado bloqueado) hasta que el proceso hijo (llamado p) termine su tarea   
        Esto evita que el hijo se convierta en un proceso zombi.
        Devuelve un número entero, igual que poll() cuando termina
'''