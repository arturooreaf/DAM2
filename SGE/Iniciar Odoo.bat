@echo off
title Iniciar Odoo
set VBOX="C:\Program Files\Oracle\VirtualBox\VBoxManage.exe"

echo.
echo  ==============================
echo     INICIANDO ODOO... espera
echo  ==============================
echo.

%VBOX% showvminfo odoo-server --machinereadable | find "VMState=""running""" >nul
if errorlevel 1 (
    echo  [1/3] Encendiendo la maquina virtual...
    %VBOX% startvm odoo-server --type headless >nul
) else (
    echo  [1/3] La maquina virtual ya estaba encendida.
)

echo  [2/3] Esperando a que Odoo arranque (1-3 minutos)...
:esperar
powershell -NoProfile -Command "try { (Invoke-WebRequest http://localhost:8069/web/login -UseBasicParsing -TimeoutSec 5).StatusCode } catch { exit 1 }" >nul 2>&1
if errorlevel 1 (
    timeout /t 5 /nobreak >nul
    goto esperar
)

echo  [3/3] Odoo listo. Abriendo el navegador...
start "" http://localhost:8069/web/login
echo.
echo  Ya puedes cerrar esta ventana.
timeout /t 5 >nul
