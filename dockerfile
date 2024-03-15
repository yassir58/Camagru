FROM debian:latest

RUN apt update -y
RUN apt upgrade -y
RUN apt install nginx openssl curl -y
COPY ./nginx-default.conf /etc/nginx/sites-enabled/default
RUN apt-get install php-fpm php-mysql php-json -y
RUN service php8.2-fpm restart
RUN echo "<?php phpinfo(); ?>" >> /var/www/html/info.php
ADD ./test-files /var/www/html

CMD service php8.2-fpm start && nginx -g 'daemon off;'