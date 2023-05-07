#!/bin/bash
nohup bash /home/mrtom/codigos_pruebas/puerta_lapaz1828/connect_alexa.sh > /dev/null 2>&1 &
php /home/mrtom/codigos_pruebas/puerta_lapaz1828/server.php & 2> /dev/null

