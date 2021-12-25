from math import floor

class chatroom():
    def __init__(self):
        self.avail_id = 0
        self._chat = []

    def push(self, name, msg):
        self._chat.append((self.avail_id, name, msg))
        self.avail_id += 1

    def get(self):
        for msg in self._chat:
            yield {'id':msg[0], 'name':msg[1], 'msg':msg[2]}
