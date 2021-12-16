def send(chat, string):
    chat.push("Temp", string)

def get(chat, string):
    chatlog = []
    for i in chat.get():
        chatlog.append(i)
    return tuple(chatlog)

commands = {
    "SEND":send,
    "GET":get
}
