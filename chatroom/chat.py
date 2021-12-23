from datetime import datetime

class chatroom():
    def __init__(self):
        self._chat = []

    def push(self, name, msg):
        now = datetime.now()
        self._chat.append((now, name, msg))

    def get(self):
        for msg in self._chat:
            yield {'time':int(msg[0].strftime('%s'))*1000, 'name':msg[1], 'msg':msg[2]}
