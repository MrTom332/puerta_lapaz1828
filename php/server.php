<?php
    $dir = __DIR__ ."/";

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

            $json = json_decode(file_get_contents("$dir../config.json"), true);
            if ($json["mode"] == "target")
                $sound = $json["target_sound"];
            else if ($json["mode"] == "random")
                $sound = GetRandomSound();

            // Ejecuta el comando de Linux
            exec("mpg321 $dir../sonidos/$sound");

            // Cierra la conexión
            socket_close($client_socket);
        }
        socket_close($server_socket);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "\n";
    }

    function GetRandomSound()
    {
        global $dir;
        global $json;

        $soundsDir = "$dir../sonidos";
        
        $files = array();
        if ($handle = opendir($soundsDir)) {
            while (($file = readdir($handle)) !== false) {
                if ($file == "." || $file == "..") {
                    continue;
                }

                // Asegurarse de que el elemento es un archivo y no un directorio
                if (is_file($soundsDir . '/' . $file)) {
                    $files[] = $file;
                }
            }
            closedir($handle);
        } else {
            echo "[GetRandomSound] No se pudo abrir el directorio. Ejecutando target_sound";
            return $json[$json["target_sound"]];
        }

        if (count($files) > 0) {
            $randomIndex = array_rand($files);
            $randomFile = $files[$randomIndex];
            echo "[GetRandomSound] Archivo aleatorio: $randomFile";
            return $randomFile;
        } else {
            echo "[GetRandomSound] No se encontraron archivos en el directorio. Ejecutando target_sound";
            return $json[$json["target_sound"]];
        }
    }
?>

