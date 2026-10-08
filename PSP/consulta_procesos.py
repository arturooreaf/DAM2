import psutil

actual = psutil.Process()
print("PID", actual.pid)
print("Ejecutable:", actual.exe)
print("Carpeta de trabajos: ", actual.cwd)
print("Estado: ", actual.status)