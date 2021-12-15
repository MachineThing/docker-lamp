# Processes Docker SIGTERM signal

import signal

active = True

def deactivate():
    global active
    active = False

def sigterm(routine, quit_routine):
    # "routine" is the function to execute until SIGTERM is raised
    # "quit_routine" is the function to execute after SIGTERM is raised
    signal.signal(signal.SIGTERM, deactivate)

    while active:
        routine()
    quit_routine()
