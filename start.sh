#!/bin/bash
nohup bash ./sh/connect_alexa.sh > /dev/null 2>&1 &
php ./php/server.php sonido=sonido.mp3 & 2> /dev/null

