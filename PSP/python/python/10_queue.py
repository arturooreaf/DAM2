import multiprocessing as mp

def calcula(cola, numero):

    resultado = numero * numero
    
    # Deposita una tupla con el número original y su cuadrado en la cola compartida.
    cola.put((numero, resultado))

def main():

    ctx = mp.get_context("spawn")
    
    cola = ctx.Queue()

    numeros = list(range(6))
 
    hijos = [ctx.Process(target=calcula, args=(cola, n)) for n in numeros]

    for p in hijos:
        p.start()

    recibidos = [cola.get(timeout=10) for _ in hijos]

    for p in hijos:
        p.join()

    #   El orden puede no ser del 0 al 5, ya que los procesos más rápidos entregan antes.
    print("Resultados recibidos:", recibidos)
    

    cola.close()
    cola.join_thread()


if __name__ == "__main__":
    main()

'''
    cola = ctx.Queue()

        Se crea una cola
        Mecanismo de comunicación que permite que varios procesos depositen mensajes y que otro proceso los recoja

        
    numeros = list(range(6))

        Se crea una lista de números del 0 al 5, ambos incluidos

        
    hijos = [ctx.Process(target=calcula, args=(cola, n)) for n in numeros]

        Creamos 6 procesos en total y los guardamos en una lista. 
        A cada proceso le damos la MISMA cola y un número DIFERENTE.


    recibidos = [cola.get(timeout=10) for _ in hijos]

        Recogemos los resultados y los guardamos en una lista.

        Pedimos tantos resultados como procesos habia en hijos. 

        El timeout de 10 segundos es una red de seguridad por si un proceso falla y nunca responde.

        Usamos _ porque no queremos acceder a ninguna variable de hijos.

        
    cola.close()
     
        Ya no se aceptan más mensajes en la Queue
        

    cola.join_thread()

        Cuando un proceso deposita un resultado usando cola.put(), se crea un "mini-trabajador" en segundo plano 
        (llamado thread o hilo) que se encarga de recoger esos datos y empujarlos físicamente por la tubería

        Espera a que el mensajero interno (thread) termine de apagar sus propias tubería
'''