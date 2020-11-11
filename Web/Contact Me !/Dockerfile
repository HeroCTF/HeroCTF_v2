FROM php:7.2-apache
RUN apt-get update && apt-get upgrade -y
RUN apt-get install phantomjs -y

COPY src/ /var/www/html/
COPY entry.sh /
RUN chmod 777 /var/www/html/sessions/
RUN chmod +x /entry.sh

CMD apachectl -D FOREGROUND
