FROM alpine:latest

RUN apk add --no-cache openssh-server
RUN ssh-keygen -A

RUN adduser -H --disabled-password postman
RUN mkdir -p /home/postman
RUN echo 'postman:645033151114248195776092794707902464' | chpasswd

ADD README.txt /etc/motd
ADD flag.txt /home/postman/flag.txt
ADD authorized_keys /home/postman/.ssh/authorized_keys

CMD /usr/sbin/sshd -D
EXPOSE 22
