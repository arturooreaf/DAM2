import subprocess 
import sys 
p = subprocess.Popen([
    sys.executable, "-c", "import time; time.sleep(2)"
])
print ("PID hijo:" , p.pid)
print ("Ha terminado?", p.poll())
codigo = p.wait()
print("Codigo", codigo)
