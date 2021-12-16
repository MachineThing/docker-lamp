import socket
from . import messages as msg
from . import sigterm
from . import commands

print(msg.info["chat_init"])

# Socket stuff

host = '0.0.0.0'
port = 3001

sock = socket.socket()
sock.bind((host, port))

print(msg.info["sock_init"])

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
            if len(response) != 2:
                print("Bad command: {}".format(response))
                conn.send(msg.gen_response(301))
            else:
                r_com = response[0].strip().upper()
                r_str = response[1].strip()
                print("{}: {}".format(r_com, r_str))

                output = None
                for key in commands.commands:
                    if key == r_com:
                        output = commands.commands[key](r_str)
                        break
                if output != None:
                    conn.send(msg.gen_response(100))
                else:
                    print("Failed to execute command {}: {}".format(r_com, r_str))
                    conn.send(msg.gen_response(300))

def quit_routine():
    sock.shutdown(1)
    print(msg.info["goodbye"])

sigterm.sigterm(routine, quit_routine)
