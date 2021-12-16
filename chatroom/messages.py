import json

info = {
    "chat_init"     :'Initializng chatroom',
    "sock_init"     :'Socket created',
    "goodbye"       :'Bye!'
}

response = {
    # Successes     (1xx)
    100             :'Command successfully executed',
    # Server Errors (2xx)

    # Client Errors (3xx)
    300             :'Command doesn\'t exist',
    301             :'Command is malformed'
}

def gen_response(code):
    return json.dumps((code, response[code])).encode("utf-8")
