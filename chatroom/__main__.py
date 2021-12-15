import socket
from . import messages as msg
from . import sigterm

print(msg.chat_init)

# Socket stuff

host = '0.0.0.0'
port = 3001

sock = socket.socket()
sock.bind((host, port))

print(msg.sock_init)

# Routine

def routine():
    sock.listen()
    conn, addr = sock.accept()
    data = []
    while True:
        command = conn.recv(1024)
        if not command:
            break
        else:
            print(command)

def quit_routine():
    sock.shutdown(1)
    print(msg.goodbye)

sigterm.sigterm(routine, quit_routine)
