FROM ubuntu:latest

RUN apt-get update && apt upgrade -y
RUN apt-get install -y socat
RUN groupadd ctf

RUN mkdir /pwn
COPY ./chall /pwn/chall
COPY ./entry.sh /pwn/
COPY ./flag.txt /pwn/flag.txt

RUN useradd -G ctf --home=/pwn pwnuser
RUN useradd -G ctf --home=/pwn pwnflag

RUN chown pwnflag:pwnflag /pwn/chall
RUN chown pwnflag:pwnflag /pwn

RUN chmod 4755 /pwn/chall
RUN chmod 4755 /pwn/entry.sh

EXPOSE 7000
ENTRYPOINT ["/pwn/entry.sh"]
