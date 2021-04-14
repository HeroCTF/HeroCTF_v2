FROM vulnerables/cve-2014-6271

COPY ./src/ /var/www/html/
COPY ./flag.txt /
COPY ./wazuuup /usr/lib/cgi-bin/
COPY default /etc/apache2/sites-available/
RUN chmod 755 /usr/lib/cgi-bin/wazuuup
RUN rm /usr/lib/cgi-bin/vulnerable
