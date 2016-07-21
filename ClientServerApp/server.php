<?php
require_once "config.php";
$server = stream_socket_server("{$proto}://{$server_ip}:{$port}", $ErrNo, $ErrStr);
while($client = stream_socket_accept($server ,-1)){
    echo "New client session\n";
    $response_client = stream_get_line($client, 1000, "\n");
    switch ($response_client) {
        case "hello";
            fwrite($client, "hello client\n");
            break;
        case "how";
            $user = stream_get_line($client, 1000, "\n");
            fwrite($client, "User {$user} is ok\n");
            break;
    }
//    echo "Client says $response_client";
//    fwrite($client, "Hello client\n");
}