import multiprocessing as mp


def calcula(envio, numero):
    envio.send((numero, numero * numero))
    envio.close()
    

#   Pipe, bidireccional aunque se puede hacer solo en un sentido
#   Es un canal de comunicacion para transmitir datos (pipe=tuberia)

def main():
    ctx = mp.get_context("spawn")
    recepcion, envio = ctx.Pipe(duplex=False)
    p = ctx.Process(target=calcula, args=(envio,7))
    p.start()

    envio.close()

    numero, resultado = recepcion.recv()
    recepcion.close()

    p.join()

    print("Numero", numero)
    print("Cuadrado", resultado)
    print("Codigo de salida", p.exitcode)


if __name__ == "__main__":
    main()