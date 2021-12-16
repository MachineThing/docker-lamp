def send(chat, string):
    chat.push("Temp", string)
    return string

def get(chat, string):
    chatlog = []
    for i in chat:
        chatlog.append(i)
    return tuple(chatlog)

commands = {
    "SEND":send,
    "GET":get
}
