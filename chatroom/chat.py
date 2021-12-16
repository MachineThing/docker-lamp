from datetime import datetime

class chatroom():
    def __init__(self):
        self._chat = []

    def push(self, name, msg):
        now = datetime.now()
        self._chat.append((now, name, msg))

    def get(self):
        for msg in self._chat:
            start = datetime(1970, 1, 1)
            seconds = msg[0] - start
            yield {'time':seconds, 'name':msg[1], 'msg':msg[2]}
