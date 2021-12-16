def send(chat, name, string):
    chat.push(name, string)

def get(chat, name, string):
    chatlog = []
    for i in chat.get():
        chatlog.append(i)
    return tuple(chatlog)

commands = {
    "SEND":send,
    "GET":get
}
