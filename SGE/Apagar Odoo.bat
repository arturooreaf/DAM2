@echo off
title Apagar Odoo
set VBOX="C:\Program Files\Oracle\VirtualBox\VBoxManage.exe"

%VBOX% showvminfo odoo-server --machinereadable | find "VMState=""running""" >nul
if errorlevel 1 (
    echo.
    echo  La maquina virtual ya estaba apagada.
    timeout /t 4 >nul
    exit /b
)

echo.
echo  Apagando Odoo de forma segura (como pulsar el boton de apagado)...
%VBOX% controlvm odoo-server acpipowerbutton >nul

:esperar
timeout /t 3 /nobreak >nul
%VBOX% showvminfo odoo-server --machinereadable | find "VMState=""poweroff""" >nul
if errorlevel 1 goto esperar

echo  Apagada. Ya puedes cerrar esta ventana.
timeout /t 4 >nul
