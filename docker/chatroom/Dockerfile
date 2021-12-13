FROM python:3.10-slim-bullseye

RUN apt-get update
RUN apt-get upgrade -y
RUN pip install --no-cache-dir --upgrade pip

WORKDIR /

ADD ./requirements.txt /requirements.txt
RUN pip install --no-cache-dir --upgrade -r /requirements.txt

EXPOSE 3001
CMD ["python", "-m", "chatroom"]
