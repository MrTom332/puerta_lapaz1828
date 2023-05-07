#Ver si tenes tarjeta bluetooth
sudo hciconfig

#Con bluetooth
bluetoothctl

#Ver status
systemctl status bluetooth.service

#Verificar log bluetooth
sudo journalctl -u bluetooth.service

#########################################################################
bluetoothctl
scan on
pair B4:B7:42:26:A4:2A
connect B4:B7:42:26:A4:2A

bluetoothctl
[bluetooth]# power on
[bluetooth]# agent on
[bluetooth]# scan on
[bluetooth]# connect B4:B7:42:26:A4:2A
[bluetooth]# trust B4:B7:42:26:A4:2A
[bluetooth]# quit
