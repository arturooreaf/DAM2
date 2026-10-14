import multiprocessing as mp


#   Este ejercicio es para analizar la memoria virtual de cada proceso
def modifica(datos):
    datos.append(99)
    print("Hijo", datos)

def main():
    datos = [1, 2]
    ctx = mp.get_context("spawn")
    p = mp.Process(target=modifica, args=("datos",))
    p.start()
    p.join()
    print(datos)