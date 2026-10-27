import multiprocessing as mp   
import os                       

def trabajo(nombre):
    print(nombre, "PID:", os.getpid())

def main():
    
    ctx = mp.get_context("spawn")
    
    p = ctx.Process(target=trabajo, args=("A",))
    
    p.start()
    
    p.join()
    
    print("Salida:", p.exitcode)


if __name__ == "__main__":
    main()

'''
    ctx = mp.get_context("spawn")
    
      Define el contexto 'spawn', es decir, inicia un intérprete de Python limpio

   if __name__ == "__main__":
      main()

         Bloque obligatorio de protección al usar multiprocessing (especialmente con 'spawn')
         Evita que los procesos hijos vuelvan a ejecutar el script completo creando un bucle infinito
'''