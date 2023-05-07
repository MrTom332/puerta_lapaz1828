<?php
        // Crea un socket del servidor en el puerto 9875
        $server_socket = socket_create(AF_INET, SOCK_STREAM, 0);
        try {
            if (!socket_bind($server_socket, '0.0.0.0', 9875)) {
                throw new Exception('No se pudo unir el socket al puerto');
            }
            socket_listen($server_socket);
            echo "Server open in 9875\n";
            while (true)
            {
                    // Espera a que se conecte un cliente
	            $client_socket = socket_accept($server_socket);

                    // Ejecuta el comando de Linux
                    exec("mpg321 /home/mrtom/codigos_pruebas/puerta_lapaz1828/sonido.mp3 2> /dev/null");

                    // Cierra la conexión
                    socket_close($client_socket);
            }
            socket_close($server_socket);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
?>

