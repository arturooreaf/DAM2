import multiprocessing as mp

def modifica(datos):
    datos.append(99)
    print("Hijo:", datos)


def main():
    datos = [1, 2]
    ctx = mp.get_context("spawn")
    
    p = ctx.Process(target=modifica, args=(datos,))

    p.start()
    p.join()

    print("Padre:", datos)

if __name__ == "__main__":
    main()

'''
    Hijo: [1, 2, 99]
    Padre: [1, 2]

    Los procesos no comparten sus variables ni datos.
    
    Pasar una lista como argumento a un proceso no significa que ambos procesos estén trabajando sobre la
    misma lista de memoria.
'''
