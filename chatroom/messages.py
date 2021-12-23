import json

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
    return json.dumps((code, msg)).encode("utf-8")
