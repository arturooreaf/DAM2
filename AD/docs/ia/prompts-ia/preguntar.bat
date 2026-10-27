@echo off
if "%1"=="" (
  echo Uso: preguntar 1   ^(del 1 al 6^)
  exit /b
)
ollama run quetevotetxapote < "%~dp0ej%1.txt"
