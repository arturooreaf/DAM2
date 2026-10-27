from concurrent.futures import ProcessPoolExecutor
import multiprocessing as mp

def cuadrado(n):
    return n, n * n

def main():
 
    ctx = mp.get_context("spawn")

    with ProcessPoolExecutor(
       
    max_workers=2, 
    mp_context=ctx

    ) as pool:

        resultados = list(pool.map(cuadrado, range(6)))
        print(resultados)


if __name__ == "__main__":
 main()


'''
    with    gestión y limpieza automática de recursos

            Al llegar a la última línea del bloque with, el programa principal se bloquea y espera hasta que todas
            las tareas hayan finalizado 

    ProcessPoolExecutor

        Es una herramienta que crea y administra un conjunto (pool) de procesos trabajadores (workers) reutilizables.
        El executor se encarga de repartir N trabajos entre esos trabajadores a medida que van quedando libres.
        Usa Pipe o Queue por debajo, por eso nos ahorra escribir código

        max_workers         Número máximo de procesos que se van a crear para realizar las tareas (como mínimo 1)
                            Se crean y se quedan en reposo

        mp_context = ctx    Se crearán los workers con el contexto definido anteriormente 

        
    resultados = list(pool.map(cuadrado, range(6)))

        Toma la función cuadrado y la aplica individualmente a cada elemento del iterable que es range(6) 
        Los procesos empiezan a ejecutarse en paralelo
        Entrega los resultados en el mismo orden exacto en que se pasaron los datos en el iterable de entrada
'''