#!/bin/bash

#sleep 5
sudo hciconfig hci0 up

# Establecer conexión Bluetooth
bluetoothctl connect B4:B7:42:26:A4:2A &> /dev/null

# Esperar a que la conexión se complete
sleep 5

# Continuar ejecutando un loop para mantener la conexión
while true; do
  # Enviar un comando de prueba para verificar la conexión
  bluetoothctl info B4:B7:42:26:A4:2A | grep -q "Connected: yes"
  if [ $? -eq 0 ]; then
    echo "Conexión Bluetooth establecida"
  else
    echo "Error: se perdió la conexión Bluetooth"
    break
  fi
  # Esperar 10 segundos antes de volver a verificar la conexión
  sleep 10
done

