from time import time
from math import floor

get_time = lambda : floor(time()*1000)

class chatroom():
    def __init__(self):
        self._chat = []

    def push(self, name, msg):
        self._chat.append((get_time(), name, msg))

    def get(self):
        for msg in self._chat:
            yield {'time':get_time(), 'name':msg[1], 'msg':msg[2]}
