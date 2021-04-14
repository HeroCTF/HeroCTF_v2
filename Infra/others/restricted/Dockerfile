FROM ubuntu:latest

# install openssh
RUN apt update && apt install -y openssh-server
RUN ssh-keygen -A && mkdir -p /run/sshd

# remove banner
RUN chmod -x /etc/update-motd.d/*
RUN rm /etc/legal

# configure ssh
RUN sed -i "s/\#PrintLastLog yes/PrintLastLog no/g" /etc/ssh/sshd_config
RUN echo "Match User pwn" >> /etc/ssh/sshd_config
RUN echo "	ForceCommand source /opt/shell.sh" >> /etc/ssh/sshd_config

# create & configure user
RUN useradd -s /bin/bash pwn
RUN mkdir -p /home/pwn/bin
RUN echo "set disable-completion on" > /home/pwn/.inputrc
RUN ln -s /bin/echo /home/pwn/bin/echo
RUN ln -s /bin/rbash /home/pwn/bin/rbash
RUN ln -s /bin/groups /home/pwn/bin/groups
RUN echo 'pwn:pwn' | chpasswd
ADD shell.sh /opt/shell.sh

ADD flag.txt /home/pwn/f04af61b3f332afa0ceec786a42cd365.txt

CMD ["/usr/sbin/sshd", "-D"]
EXPOSE 22
