<?php
header('Content-Type: application/json');

$port_number = 3001;
$ip_address = "chatroom";

$sock = socket_create(AF_INET, SOCK_STREAM, 0) or die("Unable to create connection with socket\n");
$server = socket_connect($sock, $ip_address, $port_number) or die("Unable to create connection with server\n");

if ($_POST) {
  socket_write($sock, "SEND: ".$_POST["nick"].":".$_POST["msg"], strlen("SEND: ".$_POST["nick"].":".$_POST["msg"])) or die("Unable to send SEND command to the server\n");
} else {
  socket_write($sock, "GET: GET", strlen("GET: GET")) or die("Unable to send GET command to the server\n");
}
$server_recv = socket_read($sock, 1024) or die("Unable to read response from the server\n");
echo $server_recv;

socket_close($sock);
?>
