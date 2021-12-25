from xml.dom import minidom

info = {
    "chat_init"     :'Initializng chatroom',
    "ready"         :'Ready',
    "goodbye"       :'Bye'
}

response = [
    "good"
    "command_failed"
    "bad_command"
    "malformed"
]

def gen_response(code, msg=None):
    root = minidom.Document()
    response = root.createElement('response')
    response.setAttribute('code', code)
    root.appendChild(response)
    if msg != None:
        for i in msg:
            chatMsg = root.createElement('chat')
            chatMsg.setAttribute("id", str(i["id"]))
            chatMsg.setAttribute("name", str(i["name"]))
            chatMsg.setAttribute("msg", str(i["msg"]))
            response.appendChild(chatMsg)
    return root.toprettyxml(indent ="\t").encode("utf-8")
