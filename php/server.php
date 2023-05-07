<?php
    $dir = __DIR__ ."/";

    $json = json_decode(file_get_contents("$dir../config.json"), true);
    print_r($json);
    exit;

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
            exec("mpg321 $dir../sonidos/$sound");

            // Cierra la conexión
            socket_close($client_socket);
        }
        socket_close($server_socket);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "\n";
    }
?>

