<?php
header('Content-Type: application/json');

$str_to_send = "GET";

$port_number = 3001;
$ip_address = "chatroom";

$sock = socket_create(AF_INET, SOCK_STREAM, 0) or die("Unable to create connection with socket\n");
$server = socket_connect($sock, $ip_address, $port_number) or die("Unable to create connection with server\n");

socket_write($sock, $str_to_send, strlen($str_to_send)) or die("Unable to send data to the server\n");

$server_recv = socket_read($sock, 1024) or die("Unable to read response from the server\n");

echo $server_recv;

socket_close($sock);
?>
