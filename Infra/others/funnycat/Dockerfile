FROM alpine:latest

RUN apk add --no-cache openssh
RUN ssh-keygen -A

RUN adduser -H --disabled-password funnycat
RUN mkdir -p /home/funnycat
RUN echo 'funnycat:funnycat' | chpasswd

ADD flag.txt /home/funnycat/-
ADD README.txt /etc/motd

EXPOSE 22
CMD ["/usr/sbin/sshd", "-D"]
