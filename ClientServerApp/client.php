<?php
require_once "config.php";
$server = stream_socket_client("{$proto}://{$server_ip}:{$port}", $ErrNo, $ErrStr);
fwrite($server, "how\n");
fwrite($server, "ITstep\n");
$response_server = stream_get_line($server, 1000, "\n");

echo $response_server . "\n";