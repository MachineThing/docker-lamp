import socket
from . import messages as msg
from . import sigterm
from . import commands

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
            response = command.decode("utf-8").split(":")
            r_com = response[0].strip().upper()
            r_str = response[1].strip()
            print("{}: {}".format(r_com, r_str))

            output = None
            for key in commands.commands:
                if key == r_com:
                    output = commands.commands[key](r_str)
                    break
            if output != None:
                conn.send(output.encode("utf-8"))
            else:
                print("Failed to execute command {}: {}".format(r_com, r_str))
                conn.send("Failed to execute command {}: {}".format(r_com, r_str).encode("utf-8"))

def quit_routine():
    sock.shutdown(1)
    print(msg.goodbye)

sigterm.sigterm(routine, quit_routine)
