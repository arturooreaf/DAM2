import multiprocessing
import time


def mi_tarea():
    print("El proceso hijo está trabajando...")
    time.sleep(2)


if __name__ == "__main__":
    print("Soy el proceso Padre. Arrancando...")
    
    hijo = multiprocessing.Process(target=mi_tarea)
    hijo.start()
    hijo.join()

    print("Fin del programa.")

'''
Librería multiprocessing

    La librería multiprocessing sí separa   la creación     hijo = multiprocessing.Process(target=mi_tarea
                                            la ejecución    hijo.start()

    .join() es el equivalente exacto de .wait() en la librería subprocess.


EXPLICANDO EL if __name__ == "__main__":

    Cuando se crea un proceso hijo (en Windows), este vuelve a leer el archivo desde el principio,
    pero no recibe el nombre "__main__".

    Esto evita el bucle de creación infinito de procesos
''' 