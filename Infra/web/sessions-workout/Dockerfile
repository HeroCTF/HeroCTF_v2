FROM php:7.2-apache

RUN useradd -s /bin/bash haxorhome

COPY src/ /var/www/html/
COPY ./mySup3rs3cr3tfile.txt /home/haxorhome/mySup3rs3cr3tfile.txt

RUN chmod 444 /home/haxorhome/mySup3rs3cr3tfile.txt
RUN chmod 777 /var/www/html/OhD4Sessions/
