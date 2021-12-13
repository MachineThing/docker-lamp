import socket

print("Initializng chatroom.")

host = '0.0.0.0'
port = 3001

sock = socket.socket()
sock.bind((host, port))

print("Socket created!")
print("Listening...")

while True:
    try:
        sock.listen()
        conn, addr = sock.accept()
        with conn:
            print("Connected by {}".format(addr))
            conn.send('Pong!\n'.encode())
            conn.close()
            break
    except KeyboardInterrupt:
        break

print("Quitting...")
sock.shutdown(1)
print("Bye!")
