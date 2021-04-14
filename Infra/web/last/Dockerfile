FROM n01n02h/ssti_vuln
RUN apt update && apt upgrade -y
RUN apt install python3 -y 
RUN apt install python3-pip -y
RUN apt install sudo -y
RUN apt install man -y

RUN useradd stupid --uid 1002 --home /home/stupid/ --create-home --shell /bin/bash
RUN echo "stupid:8746513284651324865132" | chpasswd && adduser stupid sudo


RUN pip3 install flask
RUN rm /root/flag
RUN rm /root/vulncode.py
RUN rm -rf /root/templates/

RUN mkdir /home/stupid/templates/
COPY ./sudoers /etc/sudoers
COPY ./app.py /home/stupid/app.py
COPY ./flag.txt /

RUN chmod 500 /flag.txt
COPY ./templates/ /home/stupid/templates/
COPY ./entry.sh /
RUN chmod 4755 /entry.sh
